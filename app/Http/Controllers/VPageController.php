<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VPageService;
use App\Services\VBasicLinkItemService;
use Validator;
use App\Models\VPage;

class VPageController extends Controller
{
    protected $vPageService;
    protected $vBasicLinkItemService;

    public function __construct(
        VPageService $vPageService,
        VBasicLinkItemService $vBasicLinkItemService
    )
    {
        $this->vPageService = $vPageService;
        $this->vBasicLinkItemService = $vBasicLinkItemService;
    }

    public function personalPage($url)
    {
        $vPage = $this->vPageService->getPageByPageUrl($url);
        $vBasicLinkItemsAll = $this->vBasicLinkItemService
                                    ->getAvailableLinksByPageId($vPage->id);

        $vBasicLinkItems = $vBasicLinkItemsAll->filter(function($item) {
            return $item->link_type !== 'MAIN';
        });
        // $vBasicLinkItems = $vBasicLinkItems->where('link_type', 'MAIN');

        $vBasicLinkItemsMain = $vBasicLinkItemsAll->filter(function($item) {
            return $item->link_type === 'MAIN';
        });
        // $vBasicLinkItemsMain = $vBasicLinkItems->where('link_type', '!=', 'MAIN');

        $vBasicLinkItemsArr = $this->vBasicLinkItemService->linkItemsFormatterPage($vBasicLinkItems);
        $vBasicLinkItemsArrMain = $this->vBasicLinkItemService->linkItemsFormatterPage($vBasicLinkItemsMain);

        $layoutCode = $vPage->layout_code ?? 'leaf';

        $pageContent = [
            'AVA' => [
                'avatarUrl' => $vPage->avatar
            ],
            'UST' => [
                'title' => $vPage->user_title
            ],
            'DESC' => [
                'text' => $vPage->description
            ],
            'LILM' => [
                'list' => $vBasicLinkItemsArrMain,
            ],
            'LIL' => [
                'list' => $vBasicLinkItemsArr,
            ],
            'SOL' => [
                'list' => json_decode($vPage->social_links)
            ],
            'LYT' => [
                'layoutName' => $layoutCode,
                'layoutClass' => $layoutCode,
            ],
            'CUSD' => [
                'customData' => [
                    'background' => [
                        'customBgOn' => false,
                        'bgType' => 'background',
                        'bgName' => 'none',
                        'bgContent' => '',
                        'bgColor' => '#A463BF'
                    ],
                    'button' => [
                        'buttonName' => 'vSquare'
                    ],
                    'text' => [
                        'textColor' => '#222F3D'
                    ]
                ]
            ],
        ];

        return view('components.pPage.v-basic', compact(
            'vPage',
            'pageContent'
        ));
    }

    public function createAndSetUrlForm()
    {
        $confirmUrl = route('vPage.confirmUrlAndStore');

        return view('components.vPage.create-and-set-url-form', compact(
            'confirmUrl'
        ));
    }

    public function confirmUrlAndStore(Request $request)
    {

        // todo 檢查可使用額度
        $validator = Validator::make($request->all(), [
            'page_url' => 'bail|required|unique:v_pages,page_url|max:20',
        ])->setAttributeNames([
            'page_url' => '網址名稱'
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $vPage = new VPage();
        $vPage->user_id = auth()->id();
        $vPage->page_url = $request->page_url;
        $vPage->user_title = $request->page_url;
        $vPage->description = '我的簡介';
        $vPage->avatar = url('/VBasic/avatar-icon.png');
        $vPage->page_status = VPage::UNCOMPLETED;

        $vPage = $this->vPageService->create($vPage);

        return redirect()->route('vPage.themeSelectForm', [$vPage->id]);

    }


    public function themeSelectForm($pageId)
    {
        $this->vPageService->checkPagePermission($pageId, auth()->id());

        $confirmRoute = route('vPage.confirmTheme', [$pageId]);

        return view('components.vPage.theme-select-form', compact(
            'confirmRoute',
        ));
    }

    public function confirmTheme(Request $request)
    {

        $pageId = $request->pageId;
        $themeId = $request->theme_id;
        $this->vPageService->checkPagePermission($pageId, auth()->id());

        $this->vPageService->update($pageId, [
            'theme_id' => $themeId,
            'page_status' => VPage::AVAILABLE
        ]);

        return redirect()->route('vPage.pageDesign', ['page_id' => $pageId]);

    }

    public function pageList()
    {
        $userId = auth()->id();

        $pageList = $this->vPageService->getAvailablePageByUserId($userId);

        return view('components.vPage.page-list', compact(
            'pageList'
        ));
    }

    public function pageDesign(Request $request)
    {
        if(!$request->has('page_id')) {
            abort(404);
        }

        $pageId = $request->page_id;

        $this->vPageService->checkPagePermission($pageId, auth()->id());

        return view('components.vPage.main');
    }

}
