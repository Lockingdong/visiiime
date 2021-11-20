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
use Crypt;

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

            Log::info($data);

            // 第一階段驗證
            $validator = Validator::make($data, [
                'model_id' => 'required',
                'model_name' => 'required',
                'vd' => 'required',
                'event_type' => 'required',
            ]);

            if($validator->fails()) {
                Log::error($validator->errors()->all());
                return '0';
            }

            $data['vd'] = json_decode(Crypt::decryptString($data['vd']), true);

            Log::info($data['vd']);

            // 第二階段驗證
            $validator2 = Validator::make($data['vd'], [
                'browser' => 'max:100',
                'city' => 'max:100',
                'date' => 'max:20',
                'ip' => 'required|max:100',
                'lang' => 'max:100',
                'refer' => 'max:300',
                'system' => 'max:100',
            ]);

            

            if($validator2->fails()) {
                Log::error($validator2->errors()->all());
                return '0';
            }

            // $ipKey = "{$data['vd']['ip']}:{$data['model_id']}";
            // if(Redis::exists($ipKey)) {
            //     Log::info('ipKey ' . $ipKey . ' exist !');
            //     return '0';
            // }
            // Redis::set($ipKey, 1, 'EX', Config::get('app.track_ip_expire'));

            $vTrack = $data['vd'];
            $vTrack['model_id'] = $data['model_id'];
            $vTrack['model_parent_id'] = $data['model_parent_id'];
            $vTrack['event_type'] = $data['event_type'];
            $vTrackEvent = new VTrackEvent($vTrack);

            $this->vTrackEventService->create($vTrackEvent);

            return '1';

        } catch(Throwable $th) {

            Log::error($th->getMessage());

            return '0';

        }

    }

    public function eventGet(Request $request)
    {

        try {

            $data = $request->all();

            $validator = Validator::make($data, [
                'model_id' => 'required',
                'start_at' => 'required|date_format:Y-m-d',
                'end_at' => 'required|date_format:Y-m-d',
                'is_parent' => 'required|boolean'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => $validator->errors()->all()
                ], 400);
            }

            $id = $request->model_id;
            $isParent = $request->is_parent;
            $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->start_at . ' 00:00:00');
            $endAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->end_at . ' 23:59:59');

            return response()->json([
                'status' => 'succ',
                'data' => $this->vTrackEventService->getTrackDatasByModelId($id, $startAt, $endAt, $isParent)
            ], 200);

        } catch (\Throwable $ex) {

            Log::error($ex->getMessage());

            return response()->json([
                'status' => 'fail',
                'data' => '發生錯誤'
            ], 500);
        }
        
    }

    public function getWeekData(Request $request)
    {
        // try {

        //     $id = $request->model_id;
        //     $startAt = Carbon::now()->endOfDay();
        //     $endAt = Carbon::now()->subDay(6)->startOfDay();

        //     return response()->json([
        //         'status' => 'succ',
        //         'data' => $this->vTrackEventService->getTrackDatasByModelId($id, $endAt, $startAt)
        //     ], 200);

        // } catch (\Throwable $ex) {

        //     Log::error($ex->getMessage());

        //     return response()->json([
        //         'status' => 'fail',
        //         'data' => '發生錯誤'
        //     ], 500);

        // }

    }

}
