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

    public function getIndexVBlogPosts()
    {
        return $this->vBlogPost
            ->with('vBlogCategory')
            ->orderBy('post_order')
            ->paginate(5);
    }
}
