<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VPageDel;

class VPageDelRepository extends BaseRepository
{
    protected $vPageDel;

    public function __construct(VPageDel $vPageDel)
    {
        parent::__construct($vPageDel);
        $this->vPageDel = $vPageDel;
    }
}