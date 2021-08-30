<?php

namespace App\Services;

use App\Repositories\VBlogPostRepository;

class VBlogPostService extends BaseService
{
    protected $vBlogPostRepository;

    public function __construct(
        VBlogPostRepository $vBlogPostRepository
    )
    {
        parent::__construct($vBlogPostRepository);
        $this->vBlogPostRepository = $vBlogPostRepository;
    }

    public function getAllVBlogPosts()
    {
        return $this->vBlogPostRepository->getAllVBlogPosts();
    }
}
