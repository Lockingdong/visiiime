<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VPageService;
use App\Services\VBasicLinkItemService;
use App\Models\VPage;
use Exception;
use Illuminate\Http\Request;
use Log;
use Validator;

class VPageController extends Controller
{
    protected $vPageService;
    protected $vBasicLinkItemService;

    const RULE_MAPPING = [
        'avatar' => 'max:100',
        'user_title' => 'max:20',
        'description' => 'max:150',
        'link_custom_data' => 'max:2000',
        'link_item_order' => 'max:2000',
        'social_links' => 'max:2000'
    ];

    const ATTR_MAPPING = [
        'avatar' => '大頭照',
        'user_title' => '標題',
        'description' => '簡介',
        'link_custom_data' => '連結客製化設定',
        'link_item_order' => '連結順序',
        'social_links' => '媒體連結'
    ];

    public function __construct(
        VPageService $vPageService,
        VBasicLinkItemService $vBasicLinkItemService
    )
    {
        $this->vPageService = $vPageService;
        $this->vBasicLinkItemService = $vBasicLinkItemService;
    }

    public function getPageDataOri($pageId)
    {
        try {

            $vPage = $this->vPageService->find($pageId);
            $vBasicLinkItemsAll = $this->vBasicLinkItemService
                                    ->getAvailableLinksByPageId($pageId);

            $vBasicLinkItems = $vBasicLinkItemsAll->filter(function($item) {
                return $item->link_type !== 'MAIN';
            });
            // $vBasicLinkItems = $vBasicLinkItems->where('link_type', 'MAIN');

            $vBasicLinkItemsMain = $vBasicLinkItemsAll->filter(function($item) {
                return $item->link_type === 'MAIN';
            });
            // $vBasicLinkItemsMain = $vBasicLinkItems->where('link_type', '!=', 'MAIN');

            $vBasicLinkItemsArr = $this->vBasicLinkItemService->linkItemsFormatterOri($vBasicLinkItems)->values()->all();
            $vBasicLinkItemsArrMain = $this->vBasicLinkItemService->linkItemsFormatterOri($vBasicLinkItemsMain)->values()->all();

            $layoutCode = $vPage->layout_code ?? 'leaf';

            return response()->json([
                'status' => 'succ',
                'data' => [
                    'avatar' => [
                        'avatarUrl' => $vPage->avatar
                    ],
                    'userTitle' => [
                        'title' => $vPage->user_title
                    ],
                    'description' => [
                        'text' => $vPage->description
                    ],
                    'linkItemList' => [
                        'listMain' => $vBasicLinkItemsArrMain,
                        'list' => $vBasicLinkItemsArr,
                    ],
                    'socialLinkList' => [
                        'list' => json_decode($vPage->social_links)
                    ],
                    'layout' => [
                        'layoutCode' => $layoutCode,
                        'layoutName' => $layoutCode,
                    ],
                    'customData' => [
                        'background' => [
                            'customBgOn' => false,
                            'bgType' => 'background',
                            'bgName' => 'none',
                            'bgContent' => '',
                            'bgColor' => '#A463BF'
                        ],
                        'linkButton' => [
                            'buttonName' => 'vSquare'
                        ],
                        'text' => [
                            'textColor' => '#222F3D'
                        ]
                    ],
                    'pageData' => [
                        'pageUrl' => $vPage->page_url
                    ]
                ]
            ], 200);

        } catch (\Throwable $ex) {

            Log::error($ex->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);

        }

    }

    public function getPageData($pageId)
    {
        try {

            $vPage = $this->vPageService->find($pageId);
            $vBasicLinkItemsAll = $this->vBasicLinkItemService
                                    ->getAvailableOnlineLinksByPageId($pageId);

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

            return response()->json([
                'status' => 'succ',
                'data' => [
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
                        'background' => [
                            'customBgOn' => false,
                            'bgType' => 'background',
                            'bgName' => 'none',
                            'bgContent' => '',
                            'bgColor' => '#A463BF'
                        ],
                        'linkButton' => [
                            'buttonName' => 'vSquare'
                        ],
                        'text' => [
                            'textColor' => '#222F3D'
                        ]
                    ],
                ]
            ], 200);

        } catch (\Throwable $ex) {

            Log::error($ex->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);

        }

    }

    public function socialLinksUpdate(Request $request)
    {
        try {

            // return $request->all();
            $validator = Validator::make($request->all(), [
                'page_id' => 'required',
                'list' => 'required|' . self::RULE_MAPPING['social_links'],
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all(),
                ], 500);
            }

            $pageId = $request->page_id;
            $list = $request->list;

            $this->vPageService->update($pageId, [
                'social_links' => json_encode($list),
            ]);

            return response()->json([
                'status' => 'succ',
                'data' => '更新成功'
            ], 200);

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);

        }

    }

    public function profileUpdate(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'page_id' => 'bail|required',
                'avatar' => self::RULE_MAPPING['avatar'],
                'user_title' => self::RULE_MAPPING['user_title'],
                'description' => self::RULE_MAPPING['description']
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all(),
                ], 500);
            }
            $pageId = $request->page_id;
            $avatar = $request->avatar;
            $userTitle = $request->user_title;
            $description = $request->description;
            $this->vPageService->update($pageId, [
                'avatar' => $avatar,
                'user_title' => $userTitle,
                'description' => $description
            ]);

            return response()->json([
                'status' => 'succ',
                'data' => '更新成功'
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);
        }
    }

    public function updatePageData(Request $request)
    {
        try {

            $pageId = $request->page_id;
            $field = $request->field;
            $data = $request->data;

            $validator = Validator::make($request->all(), [
                'page_id' => 'bail|required',
                'field' => 'bail|required',
                'data' => self::RULE_MAPPING[$field] ?? '',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'field' => self::ATTR_MAPPING[$request->field],
                    'data' => $validator->errors()->all()
                ], 500);
            }


            $this->vPageService->update($pageId, [$field => $data]);

            return response()->json([
                'status' => 'succ',
                'data' => '更新成功'
            ], 200);

        } catch (\Throwable $ex) {

            Log::error($ex->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);
        }
    }

    public function layoutUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'page_id' => 'required',
                'layout_code' => 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 500);
            }

            $pageId = $request->page_id;
            $layoutCode = $request->layout_code;

            $this->vPageService->updateLayoutCodeByPageId($pageId, $layoutCode);

            return response()->json([
                'status' => 'succ',
                'data' => '更新成功'
            ], 200);

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);
        }

    }
}
