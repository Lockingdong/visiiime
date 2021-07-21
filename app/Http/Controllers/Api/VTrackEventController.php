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

            $validator = Validator::make($data, [
                'browser' => 'max:20',
                'city' => 'max:20',
                'date' => 'max:20',
                'event_type' => '',
                'ip' => 'required|max:100',
                'lang' => 'max:20',
                'model_id' => 'required',
                'model_name' => 'required',
                'refer' => 'max:300',
                'system' => 'max:20',
            ]);

            $ipKey = "{$data['ip']}:{$data['model_id']}";
            if(Redis::exists($ipKey)) {
                return '0';
            }
            Redis::set($ipKey, 1, 'EX', Config::get('app.track_ip_expire'));

            if($validator->fails()) {
                Log::error(json_encode($validator->errors()->all()));
                return '0';
            }

            $vTrackEvent = new VTrackEvent($data);

            $this->vTrackEventService->create($vTrackEvent);

            return '1';

        } catch(Throwable $th) {

            Log::error($th->getMessage());

            return '0';

        }

    }

    public function getWeekData(Request $request)
    {

        $id = $request->model_id;
        $startAt = Carbon::now()->endOfDay();
        $endAt = Carbon::now()->subDay(7)->startOfDay();

        return $this->vTrackEventService->getTrackDatasByModelId($id, $endAt, $startAt);

    }

}
