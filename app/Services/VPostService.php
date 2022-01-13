<?php

namespace App\Services;

use App\Repositories\VPostRepository;
use App\Models\VCategory;

class VPostService extends BaseService
{
    protected $vPostRepository;

    public function __construct(
        VPostRepository $vPostRepository
    )
    {
        parent::__construct($vPostRepository);
        $this->vPostRepository = $vPostRepository;
    }

    public function getAllVPostsByCateType(string $cateType)
    {

        return $this->vPostRepository->getAllVPostsByCateType($cateType);
    }

    public function getAvalVPosts()
    {
        return $this->vPostRepository->getAvalVPosts();
    }
}
