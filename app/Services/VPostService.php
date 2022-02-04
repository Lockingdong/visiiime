<?php

namespace App\Services;

use App\Repositories\VPostRepository;
use App\Models\VCategory;
use Symfony\Component\CssSelector\Node\FunctionNode;

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
    
    public function getAvailablePostsByType(string $type)
    {
        return $this->vPostRepository->getAvailablePostsByType($type);
    }
}
