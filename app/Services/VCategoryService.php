<?php

namespace App\Services;

use App\Repositories\VCategoryRepository;

class VCategoryService extends BaseService
{
    protected $vCategoryRepository;

    public function __construct(
        VCategoryRepository $vCategoryRepository
    )
    {
        parent::__construct($vCategoryRepository);
        $this->vCategoryRepository = $vCategoryRepository;
    }

    public function getFaqCategories($modelName)
    {
        return $this->vCategoryRepository->getFaqCategories($modelName);
    }
}
