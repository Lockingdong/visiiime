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
}
