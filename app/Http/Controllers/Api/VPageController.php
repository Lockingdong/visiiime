<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VPageService;
use App\Services\VBasicLinkItemService;
use App\Models\VPage;
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
        'link_item_order' => 'max:2000'
    ];

    const ATTR_MAPPING = [
        'avatar' => '大頭照',
        'user_title' => '標題',
        'description' => '簡介',
        'link_custom_data' => '連結客製化設定',
        'link_item_order' => '連結順序'
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
            $vBasicLinkItems = $this->vBasicLinkItemService
                                    ->getAvailableLinksByPageId($pageId);

            $vBasicLinkItemsArr = $this->vBasicLinkItemService->linkItemsOriFormatter($vBasicLinkItems)->toArray();

            if($vPage->link_item_order !== null) {
                $vBasicLinkItemsArr = $this->vBasicLinkItemService
                    ->linkItemsOrderFormatter($vBasicLinkItemsArr, json_decode($vPage->link_item_order)->list);
            }

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
                        'listMain' => [],
                        'list' => $vBasicLinkItemsArr,
                    ],
                    'socialLinkList' => [
                        'list' => []
                    ],
                    'layout' => [
                        'layoutId' => 'layout3',
                        'layoutName' => 'fantastic',
                        'layoutClass' => ''
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
}
