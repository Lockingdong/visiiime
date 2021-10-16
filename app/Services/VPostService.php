<?php

namespace App\Services;

use App\Repositories\VPostRepository;

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

    public function getAllVPosts()
    {
        return $this->vPostRepository->getAllVPosts();
    }

    public function getAvalVPosts()
    {
        return $this->vPostRepository->getAvalVPosts();
    }
}
