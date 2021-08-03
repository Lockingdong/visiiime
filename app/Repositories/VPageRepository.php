<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VPage;

class VPageRepository extends BaseRepository
{
    protected $vPage;

    public function __construct(VPage $vPage)
    {
        parent::__construct($vPage);
        $this->vPage = $vPage;
    }

    public function getAvailablePageByUserId($userId)
    {
        return $this->vPage->where('user_id', $userId)->get();
    }

    public function findByPageIdWithUser($userId)
    {
        return $this->vPage
                    ->with('user')
                    ->where('user_id', $userId)
                    ->first();
    }
}
