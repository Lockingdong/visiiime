<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VUserSubscription;
use Illuminate\Support\Carbon;

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


    public function getAllAuthSubscriptionsByUserId(string $userId)
    {
        return $this->vUserSubscription
                    ->where('user_id', $userId)
                    ->where('us_start_auth', VUserSubscription::US_START_AUTH_Y)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(5);
    }

    public function getLatestNoAuthSubscriptionByUserId(string $userId)
    {
        return $this->vUserSubscription
                    ->where('user_id', $userId)
                    ->where('us_start_auth', VUserSubscription::US_START_AUTH_N)
                    ->first();
    }

    public function getLatestPaySuccSubscriptionByUserId(string $userId)
    {

        $today = Carbon::now()->startOfDay();

        return $this->vUserSubscription
                    ->where('user_id', $userId)
                    ->where('us_pay_status', VUserSubscription::US_PAY_SUCCESS)
                    ->where('us_end_at', '>=', $today)
                    ->orderBy('created_at', 'DESC')
                    ->first();
    }
}
