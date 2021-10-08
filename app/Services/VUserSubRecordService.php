<?php

namespace App\Services;

use App\Repositories\VUserSubRecordRepository;

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
}
