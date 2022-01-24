<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\VLayoutService;
use App\Models\VLayout;
use App\Models\VTheme;
use App\Enum\VRolePermission;

class VLayoutGradientSeeder extends Seeder
{
    protected $layouts =  [
        [
            'layout_display_name' => 'visiiime',
            'layout_code' => 'visiiime',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgGradient","bgImage":"","bgColor":"#b5abf2","bgColor2":"#495ce9"},"linkButton":{"buttonName":"","buttonBorder":"md-border","buttonRadius":"sm-bdrs","buttonBgColor":"transparent","buttonTextColor":"#ffffff"},"text":{"textColor":"#212121"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'fantastic',
            'layout_code' => 'fantastic',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgGradient","bgImage":"","bgColor":"#7A60FF","bgColor2":"#00FCD8"},"linkButton":{"buttonName":"","buttonBorder":"md-border","buttonRadius":"sm-bdrs","buttonBgColor":"transparent","buttonTextColor":"#ffffff"},"text":{"textColor":"#212121"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'mojito',
            'layout_code' => 'mojito',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgGradient","bgImage":"","bgColor":"#93F9B9","bgColor2":"#1D976C"},"linkButton":{"buttonName":"","buttonBorder":"md-border","buttonRadius":"sm-bdrs","buttonBgColor":"transparent","buttonTextColor":"#ffffff"},"text":{"textColor":"#212121"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'can you feel the love tonight',
            'layout_code' => 'cyftlt',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgGradient","bgImage":"","bgColor":"#4568DC","bgColor2":"#B06AB3"},"linkButton":{"buttonName":"","buttonBorder":"md-border","buttonRadius":"sm-bdrs","buttonBgColor":"transparent","buttonTextColor":"#ffffff"},"text":{"textColor":"#212121"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'opa',
            'layout_code' => 'opa',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgGradient","bgImage":"","bgColor":"#f4eaa5","bgColor2":"#b2e3bd"},"linkButton":{"buttonName":"","buttonBorder":"md-border","buttonRadius":"sm-bdrs","buttonBgColor":"transparent","buttonTextColor":"#ffffff"},"text":{"textColor":"#212121"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'bourbon',
            'layout_code' => 'bourbon',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgGradient","bgImage":"","bgColor":"#ddd6f3","bgColor2":"#faaca8"},"linkButton":{"buttonName":"","buttonBorder":"md-border","buttonRadius":"sm-bdrs","buttonBgColor":"transparent","buttonTextColor":"#ffffff"},"text":{"textColor":"#212121"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'blurry',
            'layout_code' => 'blurry',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgGradient","bgImage":"","bgColor":"#d5ffd5","bgColor2":"#fc888c"},"linkButton":{"buttonName":"","buttonBorder":"md-border","buttonRadius":"sm-bdrs","buttonBgColor":"transparent","buttonTextColor":"#ffffff"},"text":{"textColor":"#212121"},"support":{"display":true}}',
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

        VLayout::where('layout_bg_name', 'bgGradient')->delete();

        foreach($this->layouts as $k => $layout) {
            
            $newLayout = new VLayout(array_merge([
                'theme_name' => VTheme::VBasic,
                'layout_order' => $k + 1,
                'layout_bg_name' => 'bgGradient',
            ],
            $layout));

            $this->vLayoutService->create($newLayout);
        }

        echo "success!!!\n";
    }
}
