<?php

namespace App\Repositories;

use App\Models\VBlogCategory;

class VBlogCategoryRepository extends BaseRepository
{
    protected $vBlogCategory;

    public function __construct(
        VBlogCategory $vBlogCategory
    )
    {
        parent::__construct($vBlogCategory);
        $this->vBlogCategory = $vBlogCategory;
    }

}
