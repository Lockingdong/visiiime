<?php

namespace App\Services;

use App\Repositories\VSubscriptionRepository;

class VSubscriptionService extends BaseService
{
    protected $vSubscriptionRepository;

    public function __construct(
        VSubscriptionRepository $vSubscriptionRepository
    )
    {
        parent::__construct($vSubscriptionRepository);
        $this->vSubscriptionRepository = $vSubscriptionRepository;
    }
}
