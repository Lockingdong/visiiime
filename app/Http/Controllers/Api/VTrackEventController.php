<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VTrackEventService;
use App\Models\VTrackEvent;
use Validator;
use Log;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Carbon;

class VTrackEventController extends Controller
{

    protected $vTrackEventService;

    public function __construct(
        VTrackEventService $vTrackEventService
    )
    {
        $this->vTrackEventService = $vTrackEventService;
    }

    public function eventCreate(Request $request)
    {

        try {

            $data = $request->all();

            // 第一階段驗證
            $validator = Validator::make($data, [
                'model_id' => 'required',
                'v_data' => 'required',
                'event_type' => 'required',
            ]);

            if($validator->fails()) {
                Log::error(json_encode($validator->errors()->all()));
                return '0';
            }

            // 第二階段驗證
            $validator2 = Validator::make($data['v_data'], [
                'browser' => 'max:100',
                'city' => 'max:100',
                'date' => 'max:20',
                'ip' => 'required|max:100',
                'lang' => 'max:100',
                'model_name' => 'required',
                'refer' => 'max:300',
                'system' => 'max:100',
            ]);

            if($validator2->fails()) {
                Log::error(json_encode($validator2->errors()->all()));
                return '0';
            }

            $ipKey = "{$data['v_data']['ip']}:{$data['model_id']}";
            if(Redis::exists($ipKey)) {
                Log::info('ipKey ' . $ipKey . ' exist !');
                return '0';
            }
            Redis::set($ipKey, 1, 'EX', Config::get('app.track_ip_expire'));

            $vTrack = $data['v_data'];
            $vTrack['model_id'] = $data['model_id'];
            $vTrack['event_type'] = $data['event_type'];
            $vTrackEvent = new VTrackEvent($vTrack);

            $this->vTrackEventService->create($vTrackEvent);

            return '1';

        } catch(Throwable $th) {

            Log::error($th->getMessage());

            return '0';

        }

    }

    public function getWeekData(Request $request)
    {
        try {

            $id = $request->model_id;
            $startAt = Carbon::now()->endOfDay();
            $endAt = Carbon::now()->subDay(6)->startOfDay();

            return response()->json([
                'status' => 'succ',
                'data' => $this->vTrackEventService->getTrackDatasByModelId($id, $endAt, $startAt)
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
