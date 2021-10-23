<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VBasicLinkItemService;
use App\Models\VBasicLinkItem;
use Exception;
use Illuminate\Support\Facades\Log;
use Validator;
use DB;
use Crypt;

class VBasicLinkItemController extends Controller
{
    protected $vBasicLinkItemService;

    const RULE_MAPPING = [
        'link' => 'max:120',
        'link_name' => 'max:15',
        'valid' => 'max:1',
        'thumbnail' => 'max:150',
        'start_at' => 'max:20',
        'end_at' => 'max:20',
    ];

    const ATTR_MAPPING = [
        'link' => '連結',
        'link_name' => '連結名稱',
        'valid' => '有無通過驗證',
        'thumbnail' => '連結圖',
        'start_at' => '開始時間',
        'end_at' => '結束時間',
    ];

    public function __construct(
        VBasicLinkItemService $vBasicLinkItemService
    )
    {
        $this->vBasicLinkItemService = $vBasicLinkItemService;
    }

    public function linkItemStore(Request $request)
    {
        try {
            // todo validator

            $linkItemData = $request->all();
            $linkItem = new VBasicLinkItem($linkItemData);

            $newLinkItem = $this->vBasicLinkItemService->create($linkItem);

            return response()->json([
                'status' => 'succ',
                'data' => [
                    'id' => $newLinkItem->id
                ]
            ], 200);

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);
        }
    }

    public function linkItemDelete(Request $request)
    {
        try {
            $id = $request->id;

            $rs = $this->vBasicLinkItemService->destroy($id);
            if($rs === 0) {
                throw new Exception('刪除失敗');
            }

            return response()->json([
                'status' => 'succ',
            ], 200);

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);
        }

    }

    public function linkItemUpdate(Request $request)
    {

        try {

            $id = $request->id;
            $field = $request->field;
            $data = $request->data;

            $validator = Validator::make($request->all(), [
                'id' => 'bail|required',
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


            $rs = $this->vBasicLinkItemService->update($id, [$field => $data]);
            if(!$rs) {
                throw new Exception('更新失敗');
            }

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

    
    public function linkItemContentUpdate(Request $request)
    {

        try {

            $linkType = $request->link_type;
            if($linkType === null) {
                throw new Exception('link type is required');
            }

            $validator = Validator::make(
                $request->all(), 
                $this->getLinkItemContentUpdateRules($linkType)
            );

            $id = $request->id;
            $linkName = $request->link_name;
            $link = $request->link;
            $valid = $request->valid;
            $online = $request->online;
            $mediaOpenType = $request->media_open_type;

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 500);
            }

            $this->vBasicLinkItemService->update($id, [
                'link_name' => $linkName,
                'link' => $link,
                'valid' => $valid,
                'online' => $online,
                'link_type' => $linkType,
                'media_open_type' => $mediaOpenType
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

    private function getLinkItemContentUpdateRules(string $linkTpe)
    {
        switch ($linkTpe) {
            case VBasicLinkItem::LINK_TYPE_NORMAL:
                return [
                    'id' => 'required',
                    'link_name' => 'required|max:50',
                    'link' => 'required|max:200|url',
                    'valid' => 'required|boolean',
                    'online' => 'required|boolean',
                    'link_type' => 'required|string'
                ];
                break;
            case VBasicLinkItem::LINK_TYPE_MEDIA:
                return [
                    'id' => 'required',
                    'link_name' => 'required|max:50',
                    'link' => 'required|max:200|url',
                    'valid' => 'required|boolean',
                    'online' => 'required|boolean',
                    'link_type' => 'required|string',
                    'media_open_type' => 'required|string'
                ];
                break;
            case VBasicLinkItem::LINK_TYPE_SOCIAL:
                return [
                    'id' => 'required',
                    'link_name' => 'required|max:50',
                    'link' => 'required|max:200|url',
                    'valid' => 'required|boolean',
                    'online' => 'required|boolean',
                    'link_type' => 'required|string'
                ];
                break;
            case VBasicLinkItem::LINK_TYPE_TITLE:
                return [
                    'id' => 'required',
                    'link_name' => 'required|max:50',
                    'valid' => 'required|boolean',
                    'online' => 'required|boolean',
                    'link_type' => 'required|string'
                ];
                break;
            default:
                throw new Exception('link type not found');
                break;
        }

    }


    public function linkItemStartEndTimeUpdate(Request $request)
    {

        try {

            $id = $request->id;
            $startAt = $request->start_at;
            $endAt = $request->end_at;

            $this->vBasicLinkItemService->update($id, [
                'start_at' => $startAt,
                'end_at' => $endAt,
            ]);

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


    public function linkItemDisplayUpdate(Request $request)
    {

        try {

            $id = $request->id;
            $linkImgMode = $request->link_img_mode;
            $linkColMode = $request->link_col_mode;

            $this->vBasicLinkItemService->update($id, [
                'link_img_mode' => $linkImgMode,
                'link_col_mode' => $linkColMode,
            ]);

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


    public function linkItemPwdUpdate(Request $request)
    {
        try {

            $id = $request->id;
            $linkPwd = $request->link_pwd;
            $encrytedLinkPwd = Crypt::encryptString($linkPwd);

            $this->vBasicLinkItemService->update($id, [
                'link_pwd' => $encrytedLinkPwd,
            ]);

            return response()->json([
                'status' => 'succ',
                'data' => [
                    'pwd' => $linkPwd
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


    public function linkItemCheckPwdCorrect(Request $request)
    {
        try {

            $id = $request->id;
            $linkPwd = $request->link_pwd;
            
            [$result, $link] = $this->vBasicLinkItemService->checkLinkPwdCorrectAndGetLink($id, $linkPwd);

            return response()->json([
                'status' => 'succ',
                'data' => [
                    'result' => $result,
                    'link' => $link,
                ],
            ], 200);

        } catch (\Throwable $ex) {

            Log::error($ex->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);
        }

    }


    public function linkItemsUpdate(Request $request)
    {
        $links = $request->list;
        $pageId = $request->pageId;
        $linksToDelete = $request->deleteItems;

        DB::beginTransaction();

        try {

            $ids = [];
            foreach($links as $key => $link) {

                $linkItem = $this->vBasicLinkItemService->updateOrCreate(
                    ['id' => $link['id']],
                    [
                        'page_id' => $pageId,
                        'user_id' => null,
                        'link_order' => $key,
                        //'link_status' => $link['linkStatus'],
                        'link_name' => $link['linkName'],
                        'link' => $link['link'],
                        'valid' => $link['valid'],
                        'online' => $link['online'],
                        'link_type' => $link['linkType'],
                        'start_at' => $link['startAt'],
                        'end_at' => $link['endAt'],
                        'thumbnail' => $link['thumbnail'],
                        'link_custom_data' => json_encode($link['linkCustomData']),
                        'media_open_type' => $link['mediaOpenType'],
                        'media_name' => $link['mediaName'],
                        'collector' => json_encode($link['collector']),
                    ]
                );
                $ids[] = $linkItem->id;
            }

            // delete
            $this->vBasicLinkItemService->multiDeleteById($linksToDelete);

            DB::commit();
            return response()->json([
                'status' => 'succ',
                'data' => [
                    'ids' => $ids
                ]
            ], 200);
        } catch (\Throwable $ex) {

            DB::rollback();

            Log::error($ex->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);
        }

    }


    /**
     * 
     * request: [
     *  [
     *      'id' => 'test1234',
     *      'link_order' => 3
     *  ]
     * ]
     */

    public function linkItemsOrderUpdate(Request $request)
    {

        try {

            // return $request->all();

            $validator = Validator::make($request->all(), [
                'dataset' => 'required|array',
            ]);

            $dataset = $request->dataset;

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 500);
            }

            $vBasicLinkItem = new VBasicLinkItem;
            $index = 'id';

            $this->vBasicLinkItemService->linkItemsOrderUpdate($vBasicLinkItem, $dataset, $index);

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
