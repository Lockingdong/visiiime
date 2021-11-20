<?php

namespace App\Services;

use App\Repositories\VTrackEventRepository;
use App\Models\VTrackEvent;
use Jenssegers\Agent\Agent;
use Spatie\Referer\Referer;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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

        try {
            $trackEvent = new VTrackEvent([
                'ip' => request()->ip(),
                'country' => geoip()->getLocation()->country,
                'iso_code' => geoip()->getLocation()->iso_code,
                'city' => geoip()->getLocation()->city,
                'refer' => app(Referer::class)->get(),
                'browser' => \Agent::browser(),
                'system' => \Agent::platform(),
                'lang' => request()->getPreferredLanguage(),
                'device' => \Agent::isDesktop() ? '電腦' : '行動裝置'
            ]);

            return $trackEvent->toArray();

        } catch(Throwable $th) {

            Log::error($th->getMessage());

            return null;

        }

    }


    public function getTrackDatasByModelId(string $id, Carbon $start, Carbon $end, bool $isParent)
    {

        return $this->vTrackEventRepository->getTrackDatasByModelId($id, $start, $end, $isParent);
        
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
