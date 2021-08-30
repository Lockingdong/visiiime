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


//     "page_id": "test1234",
//   "user_id": "test1234",
//   "link_status": "",
//   "link_name": "",
//   "link": "",
//   "online": "",
//   "link_type": "NORMAL",
//   "start_at": "",
//   "end_at": "",
//   "thumbnail": "",
//   "link_custom_data": "",
//   "media_open_type": "",
//   "collector": "",
//   "item_custom_data": ""
}
