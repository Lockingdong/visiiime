<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\VLayoutService;
use App\Models\VLayout;
use App\Models\VTheme;

class VLayoutTableSeeder extends Seeder
{

    protected $layouts =  [
        [
            "layoutId" => "layout1",
            "layoutName" => "leaf",
            "layoutImage" => "VBasic/leaf.png"
        ],
        [
            "layoutId" => "layout2",
            "layoutName" => "snow",
            "layoutImage" => "VBasic/snow.png"
        ],
        [
            "layoutId" => "layout3",
            "layoutName" => "fantastic",
            "layoutImage" => "VBasic/gradient-1.png"
        ],
        [
            "layoutId" => "layout4",
            "layoutName" => "lemon",
            "layoutImage" => "VBasic/gradient-2.png"
        ],
        [
            "layoutId" => "layout5",
            "layoutName" => "sunset",
            "layoutImage" => "VBasic/gradient-3.png"
        ],
        [
            "layoutId" => "layout6",
            "layoutName" => "purple",
            "layoutImage" => "VBasic/purple.png"
        ],
        [
            "layoutId" => "layout7",
            "layoutName" => "gray",
            "layoutImage" => "VBasic/gray.png"
        ],
        [
            "layoutId" => "layout8",
            "layoutName" => "young",
            "layoutImage" => "VBasic/greenBg.png"
        ],
        [
            "layoutId" => "layout9",
            "layoutName" => "ocean",
            "layoutImage" => "VBasic/blueBtn.png"
        ],
        [
            "layoutId" => "layout10",
            "layoutName" => "violet",
            "layoutImage" => "VBasic/purpleBtn.png"
        ]
    ];

    protected $vLayoutService;

    public function __construct(VLayoutService $vLayoutService)
    {
        $this->vLayoutService = $vLayoutService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VLayout::truncate();

        foreach($this->layouts as $k => $layout) {

            $newLayout = new VLayout([
                'theme_name' => VTheme::VBasic,
                'layout_display_name' => $layout['layoutName'],
                'layout_name' => $layout['layoutName'],
                'layout_code' => $layout['layoutName'],
                'layout_status' => VLayout::AVAILABLE,
                'layout_image' => url('/') . '/' . $layout['layoutImage'],
                'layout_order' => $k
            ]);

            $this->vLayoutService->create($newLayout);
        }
    }
}
