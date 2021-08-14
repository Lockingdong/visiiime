<?php

namespace App\Services;

use App\Repositories\VUserSubscriptionRepository;

class VUserSubscriptionService extends BaseService
{
    protected $vUserSubscriptionRepository;

    public function __construct(
        VUserSubscriptionRepository $vUserSubscriptionRepository
    )
    {
        parent::__construct($vUserSubscriptionRepository);
        $this->vUserSubscriptionRepository = $vUserSubscriptionRepository;
    }
}
