<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VUserSubRecordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    protected $vUserSubRecordService;

    public function __construct(
        VUserSubRecordService $vUserSubRecordService
    )
    {
        $this->vUserSubRecordService = $vUserSubRecordService;
    }

    public function subRecords(Request $request)
    {
        
        try {

            $merOrderNo = $request->mer_order_no;
            
            $subRecords = $this->vUserSubRecordService->getSubRecordsByUserId($merOrderNo);

            return response()->json([
                'status' => 200,
                'data' => [
                    'subRecords' => $this->vUserSubRecordService->subRecordsApiTransformer($subRecords)
                ]
            ], 200);

        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            return response()->json([
                'status' => 500,
                'data' => '發生錯誤'
            ], 200);
        }

    }
}
