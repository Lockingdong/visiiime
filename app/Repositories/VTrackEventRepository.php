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

    public function getTrackDatasByModelId(string $id, $start, $end)
    {
        return $this->vTrackEvent->where('model_id', $id)
                                ->whereBetween('created_at', [$start, $end])
                                ->orderBy('created_at', 'asc')
                                ->get()
                                ->groupBy('date');
    }
}
