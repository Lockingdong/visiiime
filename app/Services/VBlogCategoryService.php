<?php

namespace App\Services;

use App\Repositories\VBlogCategoryRepository;

class VBlogCategoryService extends BaseService
{
    protected $vBlogCategoryRepository;

    public function __construct(
        VBlogCategoryRepository $vBlogCategoryRepository
    )
    {
        parent::__construct($vBlogCategoryRepository);
        $this->vBlogCategoryRepository = $vBlogCategoryRepository;
    }

}
