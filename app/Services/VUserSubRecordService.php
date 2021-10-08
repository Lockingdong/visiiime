<?php

namespace App\Services;

use App\Repositories\VUserSubRecordRepository;
use Illuminate\Database\Eloquent\Collection;

class VUserSubRecordService extends BaseService
{
    protected $vUserSubRecordRepository;

    public function __construct(
        VUserSubRecordRepository $vUserSubRecordRepository
    )
    {
        parent::__construct($vUserSubRecordRepository);
        $this->vUserSubRecordRepository = $vUserSubRecordRepository;
    }

    public function getHistSubRecordsByUserId(string $userId)
    {
        return $this->vUserSubRecordRepository->getHistSubRecordsByUserId($userId);
    }

    public function getSubRecordsByUserId(string $merOrderNo)
    {
        return $this->vUserSubRecordRepository->getSubRecordsByUserId($merOrderNo);
    }

    public function subRecordsApiTransformer(Collection $subRecords)
    {
        return $subRecords->map(function($item) {
            return [
                'created_at' => $item->created_at->format('Y/m/d'),
                'us_name' => $item->us_name,
                'us_amount' => $item->us_amount,
                'us_period' => $item->us_period,
                'us_pay_status' => $item->payStatus()
            ];
        });
    }
}
