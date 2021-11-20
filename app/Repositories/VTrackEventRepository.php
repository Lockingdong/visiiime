<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VTrackEvent;

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

    public function getTrackDatasByModelId(string $id, $start, $end, bool $isParent)
    {
        \Log::info($start);
        \Log::info($end);
        // \Log::info($this->vTrackEvent
        // ->whereBetween('created_at', [$start, $end])
        // ->orderBy('created_at', 'asc')
        // ->get());
        return $this->vTrackEvent->where($isParent ? 'model_parent_id' : 'model_id', $id)
                                ->whereBetween('created_at', [$start, $end])
                                ->orderBy('created_at', 'asc')
                                ->get();
    }
}
