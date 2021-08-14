<?php

namespace App\Services;
use App\Repositories\VSubAuthDataRepository;

class VSubAuthDataService extends BaseService
{
    protected $vSubAuthDataRepository;

    public function __construct(
        VSubAuthDataRepository $vSubAuthDataRepository
    )
    {
        parent::__construct($vSubAuthDataRepository);
        $this->vSubAuthDataRepository = $vSubAuthDataRepository;
    }
}
