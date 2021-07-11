<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VPageService;
use Validator;
use App\Models\VPage;

class VPageController extends Controller
{
    protected $vPageService;

    public function __construct(
        VPageService $vPageService
    )
    {
        $this->vPageService = $vPageService;
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
