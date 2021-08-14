<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VUserSubscription;

class VUserSubscriptionRepository extends BaseRepository
{
    protected $vUserSubscription;

    public function __construct(
        VUserSubscription $vUserSubscription
    )
    {
        parent::__construct($vUserSubscription);
        $this->vUserSubscription = $vUserSubscription;
    }
}
