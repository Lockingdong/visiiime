<?php

namespace App\Repositories;

use App\Models\VPost;

class VPostRepository extends BaseRepository
{
    protected $vPost;

    public function __construct(
        VPost $vPost
    )
    {
        parent::__construct($vPost);
        $this->vPost = $vPost;
    }

    public function getAllVPosts()
    {
        return $this->vPost
                    ->orderBy('post_order', 'DESC')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }

    public function getAvalVPosts()
    {
        return $this->vPost
            ->with('vCategory')
            ->where('post_status', VPost::POST_AVAILABLE)
            ->orderBy('post_order')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
    }
}
