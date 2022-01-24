<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\VLayoutService;
use App\Models\VLayout;
use App\Models\VTheme;
use App\Enum\VRolePermission;

class VLayoutImageSeeder extends Seeder
{

    protected $layouts = [
        [
            'layout_display_name' => 'naughty',
            'layout_code' => 'naughty',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgImage","bgImage":"https://local-web.visiiime.com/VBasic/layout/bg/naughty.png","bgColor":"#ffffff","bgColor2":"#212121"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#3646b0","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'celestial',
            'layout_code' => 'celestial',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgImage","bgImage":"https://local-web.visiiime.com/VBasic/layout/bg/celestial.png","bgColor":"#ffffff","bgColor2":"#212121"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#3d2eb2","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'river',
            'layout_code' => 'river',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgImage","bgImage":"https://local-web.visiiime.com/VBasic/layout/bg/river.png","bgColor":"#ffffff","bgColor2":"#212121"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#1b3c7e","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
        
        [
            'layout_display_name' => 'lush',
            'layout_code' => 'lush',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgImage","bgImage":"https://local-web.visiiime.com/VBasic/layout/bg/lush.png","bgColor":"#ffffff","bgColor2":"#212121"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#114f48","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'marble',
            'layout_code' => 'marble',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgImage","bgImage":"https://local-web.visiiime.com/VBasic/layout/bg/marble.png","bgColor":"#ffffff","bgColor2":"#212121"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#263238","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
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

        VLayout::where('layout_bg_name', 'bgImage')->delete();

        $url = \URL::to('/');

        foreach($this->layouts as $k => $layout) {
            
            $newLayout = new VLayout(array_merge([
                'theme_name' => VTheme::VBasic,
                'layout_order' => $k + 21,
                'layout_bg_name' => 'bgImage',
            ],
            $layout));

            $newLayout->layout_setting = str_replace('https://local-web.visiiime.com', $url, $newLayout->layout_setting);

            $this->vLayoutService->create($newLayout);
        }

        echo "success!!!\n";
    }
}
