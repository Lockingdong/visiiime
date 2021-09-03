<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VPageService;
use App\Services\VBasicLinkItemService;
use App\Models\VPage;
use App\Models\VBasicLinkItem;
use App\Services\VPermissionService;
use Exception;
use Illuminate\Http\Request;
use Log;
use Validator;

class VPageController extends Controller
{
    protected $vPageService;
    protected $vBasicLinkItemService;
    protected $vPermissionService;

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
        VBasicLinkItemService $vBasicLinkItemService,
        VPermissionService $vPermissionService
    )
    {
        $this->vPageService = $vPageService;
        $this->vBasicLinkItemService = $vBasicLinkItemService;
        $this->vPermissionService = $vPermissionService;
    }

    public function getPageDataOri($pageId)
    {
        try {

            $vPage = $this->vPageService->find($pageId);

            $vBasicLinkItemsAll = $this->vBasicLinkItemService->getAvailableLinksByPageId($pageId);

            $vBasicLinkItemsArr = $this->vBasicLinkItemService->linkItemsOriTransformer($vBasicLinkItemsAll)->groupBy('linkArea');

            $layoutCode = $vPage->layout_code ?? 'leaf';

            $vPermissions = $this->vPermissionService->getPermissionsByRoleName($vPage->user->role);

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
                        'listMain' => $vBasicLinkItemsArr[VBasicLinkItem::LINK_AREA_MAIN] ?? [],
                        'list' => $vBasicLinkItemsArr[VBasicLinkItem::LINK_AREA_NORMAL] ?? [],
                        'listSocial' => $vBasicLinkItemsArr[VBasicLinkItem::LINK_AREA_SOCIAL] ?? [],
                    ],
                    'socialLinkList' => [
                        'list' => json_decode($vPage->social_links)
                    ],
                    'layout' => [
                        'layoutCode' => $layoutCode,
                        'layoutName' => $layoutCode,
                    ],
                    'customData' => $vPage->getCustomData(),
                    'pageData' => [
                        'pageUrl' => $vPage->page_url
                    ],
                    'analystic' => [
                        'gaId' => $vPage->ga_id,
                        'fbPx' => $vPage->fb_px,
                    ],
                    'seo' => [
                        'seoTitle' => $vPage->seo_title,
                        'seoDesc' => $vPage->seo_desc,
                    ],
                    'permissions' => $vPermissions
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
            $userTitle = $request->user_title;
            $description = $request->description;
            $this->vPageService->update($pageId, [
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

    public function customDataUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'page_id' => 'required',
                'custom_data' => 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 500);
            }

            // 驗證 custom data
            $validator2 = Validator::make($request->custom_data, [
                'background' => 'required',
                'linkButton' => 'required',
                'text' => 'required',
            ]);


            if($validator2->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator2->errors()->all()
                ], 500);
            }

            $customData = $request->custom_data;
            array_walk_recursive($customData, function (&$value) {
                $value = $value === null ? "" : $value;
            });

            $pageId = $request->page_id;

            $this->vPageService->updateCustomDataByPageId($pageId, json_encode($customData));

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


    public function pageUriUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'page_id' => 'required',
                'page_url' => 'required|min:3|max:20|unique:v_pages,page_url,' . $request->page_id,
            ]);

            $attributes = [
                'page_url' => '網址名稱',
            ];

            $validator->setAttributeNames($attributes);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 500);
            }

            $pageId = $request->page_id;
            $pageUrl = $request->page_url;

            $this->vPageService->update($pageId, [
                'page_url' => $pageUrl
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

    public function pageAnalysticUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'page_id' => 'required',
                'ga_id' => 'min:10|max:15',
                'fb_px' => 'min:10|max:15',
            ]);

            $attributes = [
            ];

            $validator->setAttributeNames($attributes);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 500);
            }

            $pageId = $request->page_id;
            $gaId = $request->ga_id;
            $fbPx = $request->fb_px;

            $this->vPageService->update($pageId, [
                'ga_id' => $gaId,
                'fb_px' => $fbPx,
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

    public function pageSeoUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'page_id' => 'required',
                'seo_title' => 'max:15',
                'seo_desc' => 'max:200',
            ]);

            $attributes = [
            ];

            $validator->setAttributeNames($attributes);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 500);
            }

            $pageId = $request->page_id;
            $seoTitle = $request->seo_title;
            $seoDesc = $request->seo_desc;

            $this->vPageService->update($pageId, [
                'seo_title' => $seoTitle,
                'seo_desc' => $seoDesc,
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
}
