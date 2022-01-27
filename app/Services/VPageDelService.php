<?php

namespace App\Services;

use App\Repositories\VPageDelRepository;

class VPageService extends BaseService
{
    protected $vPageDelRepository;

    public function __construct(
        VPageDelRepository $vPageDelRepository
    )
    {
        parent::__construct($vPageDelRepository);
        $this->vPageDelRepository = $vPageDelRepository;
    }
}
