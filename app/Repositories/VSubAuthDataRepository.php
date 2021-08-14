<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\VSubAuthData;

class VSubAuthDataRepository extends BaseRepository
{
    protected $vSubAuthData;

    public function __construct(
        VSubAuthData $vSubAuthData
    )
    {
        parent::__construct($vSubAuthData);
        $this->vSubAuthData = $vSubAuthData;
    }
}
