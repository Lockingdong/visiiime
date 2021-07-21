<?php

namespace App\Services;

use App\Repositories\VTrackEventRepository;
use App\Models\VTrackEvent;
use Jenssegers\Agent\Agent;
use Spatie\Referer\Referer;
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

    public function getVisitorData(string $modelId, string $modelName): ?array
    {

        try {
            $agent = new Agent();
            $trackEvent = new VTrackEvent([
                'model_id' => $modelId,
                'model_name' => $modelName,
                'event_type' => 'page_view',
                'date' => now()->format('Y-m-d'),
                'ip' => request()->ip(),
                'country' => geoip()->getLocation()->country,
                'city' => geoip()->getLocation()->city,
                'refer' => app(Referer::class)->get(),
                'browser' => $agent->browser(),
                'system' => $agent->platform(),
                'lang' => request()->getPreferredLanguage()
            ]);

            return $trackEvent->toArray();

        } catch(Throwable $th) {

            Log::error($th->getMessage());

            return null;

        }

    }


    public function getTrackDatasByModelId(string $id, $start, $end)
    {
        return $this->vTrackEventRepository->getTrackDatasByModelId($id, $start, $end);
    }
}
