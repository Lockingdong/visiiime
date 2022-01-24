<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\VLayout;

class VLayoutRepository extends BaseRepository
{
    protected $vLayout;

    public function __construct(VLayout $vLayout)
    {
        parent::__construct($vLayout);
        $this->vLayout = $vLayout;
    }

    public function getAvailableLayoutsByThemeName(string $themeName)
    {
        return $this->vLayout
                    ->where('theme_name', $themeName)
                    ->where('layout_status', VLayout::AVAILABLE)
                    ->orderBy('layout_order', 'asc')
                    ->get();
    }

    public function getAllLayouts()
    {
        return $this->vLayout
                    ->orderBy('layout_order', 'ASC')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }
}
