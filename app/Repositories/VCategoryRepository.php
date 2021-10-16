<?php

namespace App\Repositories;

use App\Models\VCategory;

class VCategoryRepository extends BaseRepository
{
    protected $vCategory;

    public function __construct(
        VCategory $vCategory
    )
    {
        parent::__construct($vCategory);
        $this->vCategory = $vCategory;
    }

}
