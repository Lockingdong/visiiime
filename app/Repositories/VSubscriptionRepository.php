<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VSubscription;

class VSubscriptionRepository extends BaseRepository
{
    protected $vSubscription;

    public function __construct(
        VSubscription $vSubscription
    )
    {
        parent::__construct($vSubscription);
        $this->vSubscription = $vSubscription;
    }
}
