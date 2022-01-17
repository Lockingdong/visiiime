<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VPageService;
use App\Services\VBasicLinkItemService;
use App\Services\UserService;
use App\Models\VPage;
use App\Models\VBasicLinkItem;
use App\Services\VPermissionService;
use Exception;
use Illuminate\Http\Request;
use Log;
use Validator;
use Throwable;
use Auth;

class VPageController extends Controller
{
    protected $vPageService;
    protected $vBasicLinkItemService;
    protected $vPermissionService;
    protected $userService;

    const RULE_MAPPING = [
        'avatar' => 'max:100',
        'user_title' => 'max:20',
        'description' => 'max:150',
        'link_custom_data' => 'max:2000',
        'link_item_order' => 'max:2000',
    ];

    const ATTR_MAPPING = [
        'avatar' => '大頭照',
        'user_title' => '標題',
        'description' => '簡介',
        'link_custom_data' => '連結客製化設定',
        'link_item_order' => '連結順序',
    ];

    public function __construct(
        VPageService $vPageService,
        VBasicLinkItemService $vBasicLinkItemService,
        VPermissionService $vPermissionService,
        UserService $userService
    )
    {
        $this->vPageService = $vPageService;
        $this->vBasicLinkItemService = $vBasicLinkItemService;
        $this->vPermissionService = $vPermissionService;
        $this->userService = $userService;
    }

    public function getPageDataOri($pageId)
    {
        try {

            $vPage = $this->vPageService->find($pageId);

            $vBasicLinkItemsAll = $this->vBasicLinkItemService->getAvailableLinksByPageId($pageId);

            $vBasicLinkItemsArr = $this->vBasicLinkItemService->linkItemsOriTransformer($vBasicLinkItemsAll)->groupBy('linkArea');

            $layoutCode = $vPage->layout_code ?? 'snow';

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
                    'layout' => [
                        'layoutCode' => $layoutCode,
                        'layoutName' => $layoutCode,
                    ],
                    'customData' => $vPage->getCustomData(),
                    'pageData' => [
                        'pageUrl' => $vPage->page_url
                    ],
                    'analystic' => [
                        'gaId' => $vPage->getMeta()->ga_id,
                        'fbPx' => $vPage->getMeta()->fb_px,
                    ],
                    'seo' => [
                        'seoTitle' => $vPage->seo_title,
                        'seoDesc' => $vPage->seo_desc,
                    ],
                    'vPage' => [
                        'pageStatus' => $vPage->page_status,
                        'online' => $vPage->online,
                    ],
                    'permissions' => $vPermissions,
                    'user' => [
                        'isVerified' => Auth::user()->hasVerifiedEmail(),
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

            $validator1 = Validator::make($request->all(), [
                'layout_code' => 'required',
                'page_id' => 'required',
                'custom_data' => 'required',
            ]);

            if($validator1->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator1->errors()->all()
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
            $layoutCode = $request->layout_code;

            $this->vPageService->updateCustomDataByPageId($pageId, json_encode($customData));
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

    public function pageCreate(Request $request)
    {

        try {

            // Log::info($request->all());

            $validator = Validator::make($request->all(), [
                'page_url' => 'required|min:3|max:20|alpha_dash|unique:v_pages,page_url',
                'user_id' => 'required'
            ]);

            // todo 檢查 page 可創建數

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

            // 檢查用戶是否存在
            if($this->userService->getUserById($request->user_id) === null) {
                return response()->json([
                    'status' => 'fail',
                    'data' => [
                        '此用戶不存在'
                    ]
                ], 500);
            }

            $vPage = $this->vPageService->createPage($request->page_url);

            return response()->json([
                'status' => 'succ',
                'data' => [
                    'id' => $vPage->id
                ]
            ], 200);

        } catch (Throwable $th) {

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
                'ga_id' => 'max:15',
                'fb_px' => 'max:15',
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

            $this->vPageService->updateAnalystic($pageId, [
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

    public function pageOnlineUpdate(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'page_id' => 'required',
                'online' => 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 500);
            }

            $pageId = $request->page_id;
            $online = (int) $request->online;

            $this->vPageService->update($pageId, [
                'online' => $online,
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

    public function pageStatusUpdate(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'page_id' => 'required',
                'page_status' => 'required|in:' . VPage::AVAILABLE . ',' . VPage::DISABLED . ',' . VPage::DELETED,
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 500);
            }

            $pageId = $request->page_id;
            $pageStatus = $request->page_status;

            $this->vPageService->update($pageId, [
                'page_status' => $pageStatus,
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
