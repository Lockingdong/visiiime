<?php

namespace App\Services;

use App\Repositories\VLayoutRepository;
use Illuminate\Database\Eloquent\Collection;

class VLayoutService extends BaseService
{
    protected $vLayoutRepository;

    public function __construct(
        VLayoutRepository $vLayoutRepository
    )
    {
        parent::__construct($vLayoutRepository);
        $this->vLayoutRepository = $vLayoutRepository;
    }

    public function getAvailableLayoutsByThemeName(string $themeName)
    {
        return $this->vLayoutRepository->getAvailableLayoutsByThemeName($themeName);
    }

    public function getAllLayouts() {
        return $this->vLayoutRepository->getAllLayouts();
    }

    public function layoutsOriFormatter(Collection $collection): array
    {
        return $collection->map(function($item) {
            return [
                'layoutId' => $item->id,
                'layoutDisplayName' => $item->layout_display_name,
                'layoutBgName' => $item->layout_bg_name,
                'layoutCode' => $item->layout_code,
                'layoutRole' => $item->layout_role,
                'layoutSetting' => $item->layout_setting
            ];
        })->values()->all();
    }
}
