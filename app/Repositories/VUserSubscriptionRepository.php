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


    public function findLatestSubscriptionByUserId(string $userId)
    {
        return $this->vUserSubscription
                    ->where('user_id', $userId)
                    ->where('us_pay_status', VUserSubscription::US_PAY_SUCCESS)
                    ->orderBy('created_at', 'DESC')
                    ->first();
    }
}
