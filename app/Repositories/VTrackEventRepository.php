<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VTrackEvent;
use App\VO\TrackEventGetVO;

class VTrackEventRepository extends BaseRepository
{
    protected $vTrackEvent;

    public function __construct(
        VTrackEvent $vTrackEvent
    )
    {
        parent::__construct($vTrackEvent);
        $this->vTrackEvent = $vTrackEvent;
    }

    public function getTrackDatasByModelId(TrackEventGetVO $trackEventGetVO)
    {
        // \Log::info($this->vTrackEvent
        // ->whereBetween('created_at', [$start, $end])
        // ->orderBy('created_at', 'asc')
        // ->get());
        return $this->vTrackEvent->where($trackEventGetVO->isParent ? 'model_parent_id' : 'model_id', $trackEventGetVO->modelId)
                                ->where('event_type', $trackEventGetVO->eventType)
                                ->whereBetween('created_at', [$trackEventGetVO->startAt, $trackEventGetVO->endAt])
                                ->orderBy('created_at', 'asc')
                                ->get();
    }
}
