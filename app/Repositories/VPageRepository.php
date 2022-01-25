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

    public function getAvailablePageByUserId(string $userId)
    {
        return $this->vPage
                    ->where('user_id', $userId)
                    ->whereIn('page_status', [VPage::AVAILABLE, VPage::DISABLED])
                    ->orderBy('created_at', 'ASC')
                    ->get();
    }

    public function findByPageIdWithUser($userId)
    {
        return $this->vPage
                    ->with('user')
                    ->where('user_id', $userId)
                    ->first();
    }

    public function findAvailablePageByPageIdWithUser($userId)
    {
        return $this->vPage
                    ->with('user')
                    ->where('user_id', $userId)
                    ->where('page_status', VPage::AVAILABLE)
                    ->first();
    }

    public function disableAllPageByUserId(string $userId)
    {
        return $this->vPage
                    ->where('user_id', $userId)
                    ->update([
                        'page_status' => VPage::DISABLED
                    ]);
    }

    public function enableAllPageByUserId(string $userId)
    {
        return $this->vPage
                    ->where('user_id', $userId)
                    ->update([
                        'page_status' => VPage::AVAILABLE
                    ]);
    }
}
