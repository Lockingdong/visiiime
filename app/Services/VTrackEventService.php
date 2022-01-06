<?php

namespace App\Services;

use App\Repositories\VTrackEventRepository;
use App\Models\VTrackEvent;
use Jenssegers\Agent\Agent;
use Spatie\Referer\Referer;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\VO\TrackEventGetVO;
use Log;
use Throwable;

class VTrackEventService extends BaseService
{
    protected $vTrackEventRepository;

    public function __construct(
        VTrackEventRepository $vTrackEventRepository
    )
    {
        parent::__construct($vTrackEventRepository);
        $this->vTrackEventRepository = $vTrackEventRepository;
    }

    public function getVisitorData(): ?array
    {

        $ip = request()->ip();
        $location = \GeoIP::getLocation($ip);
        $agent = new \Agent();
        try {
            $trackEvent = new VTrackEvent([
                'ip' => $ip,
                'country' => $location->country,
                'iso_code' => $location->iso_code,
                'city' => $location->city,
                'refer' => app(Referer::class)->get(),
                'browser' => $agent->browser(),
                'system' => $agent->platform(),
                'lang' => request()->getPreferredLanguage(),
                'device' => $agent->isDesktop() ? '電腦' : '行動裝置'
            ]);

            return $trackEvent->toArray();

        } catch(Throwable $th) {

            Log::error($th->getMessage());

            return null;

        }

    }


    public function getTrackDatasByModelId(TrackEventGetVO $trackEventGetVO)
    {

        return $this->vTrackEventRepository->getTrackDatasByModelId($trackEventGetVO)
                    ->map(function($item) {
                        $item->ip = encrypt($item->ip);
                        return $item;
                    });
        
        // $trackDataArr = [];
        // $trackDatas = $this->vTrackEventRepository->getTrackDatasByModelId($id, $start, $end);

        // $dateRange = CarbonPeriod::create($start, $end)->toArray();
        // foreach($dateRange as $date) {
        //     $d = $date->format('Y-m-d');
        //     $trackDataArr[$d] = $trackDatas[$d] ?? [];
        // }

        // return $trackDatas;
    }
}
