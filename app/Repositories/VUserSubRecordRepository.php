<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VUserSubRecord;

class VUserSubRecordRepository extends BaseRepository
{
    protected $vUserSubRecord;

    public function __construct(
        VUserSubRecord $vUserSubRecord
    )
    {
        parent::__construct($vUserSubRecord);
        $this->vUserSubRecord = $vUserSubRecord;
    }

    public function getHistSubRecordsByUserId(string $userId)
    {
        // dd($userId);
        return $this->vUserSubRecord
                    ->where('user_id', $userId)
                    ->whereIn('us_pay_status', [VUserSubRecord::US_PAY_SUCCESS, VUserSubRecord::US_PAY_FAIL])
                    ->orderBy('created_at', 'ASC')
                    ->get();
    }

    public function getSubRecordsByUserId(string $merOrderNo)
    {
        // dd($userId);
        return $this->vUserSubRecord
                    ->where('mer_order_no', $merOrderNo)
                    ->whereIn('us_pay_status', [VUserSubRecord::US_PAY_SUCCESS, VUserSubRecord::US_PAY_FAIL])
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }
}
