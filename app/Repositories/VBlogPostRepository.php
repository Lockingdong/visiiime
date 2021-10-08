<?php

namespace App\Repositories;

use App\Models\VBlogPost;

class VBlogPostRepository extends BaseRepository
{
    protected $vBlogPost;

    public function __construct(
        VBlogPost $vBlogPost
    )
    {
        parent::__construct($vBlogPost);
        $this->vBlogPost = $vBlogPost;
    }

    public function getAllVBlogPosts()
    {
        return $this->vBlogPost
                    ->orderBy('post_order', 'DESC')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }

    public function getAvalVBlogPosts()
    {
        return $this->vBlogPost
            ->with('vBlogCategory')
            ->where('post_status', VBlogPost::POST_AVAILABLE)
            ->orderBy('post_order')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
    }
}
