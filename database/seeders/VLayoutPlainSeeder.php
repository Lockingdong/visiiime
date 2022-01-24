<?php

namespace Database\Seeders;

use App\Enum\VRolePermission;
use Illuminate\Database\Seeder;
use App\Services\VLayoutService;
use App\Models\VLayout;
use App\Models\VTheme;

class VLayoutPlainSeeder extends Seeder
{

    protected $layouts =  [
        [
            'layout_display_name' => 'amethyst',
            'layout_code' => 'amethyst',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgPlain","bgImage":"","bgColor":"#978aff","bgColor2":"#ffffff"},"linkButton":{"buttonName":"","buttonBorder":"md-border","buttonRadius":"sm-bdrs","buttonBgColor":"transparent","buttonTextColor":"#ffffff"},"text":{"textColor":"#212121"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'snow',
            'layout_code' => 'snow',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgPlain","bgImage":"","bgColor":"#ffffff","bgColor2":"#212121"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#263238","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'royal',
            'layout_code' => 'royal',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgPlain","bgImage":"","bgColor":"#263238","bgColor2":"#ffffff"},"linkButton":{"buttonName":"","buttonBorder":"md-border","buttonRadius":"sm-bdrs","buttonBgColor":"transparent","buttonTextColor":"#eceff1"},"text":{"textColor":"#eceff1"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'mystic',
            'layout_code' => 'mystic',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgPlain","bgImage":"","bgColor":"#d7dde8","bgColor2":"#ffffff"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#455a64","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'bora',
            'layout_code' => 'bora',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgPlain","bgImage":"","bgColor":"#e9ecc6","bgColor2":"#ffffff"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#616161","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'weed',
            'layout_code' => 'weed',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgPlain","bgImage":"","bgColor":"#41ccb2","bgColor2":"#ffffff"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#263238","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'pinky',
            'layout_code' => 'pinky',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgPlain","bgImage":"","bgColor":"#fbdae4","bgColor2":"#ffffff"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#c34b7b","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'mango',
            'layout_code' => 'mango',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgPlain","bgImage":"","bgColor":"#fedc59","bgColor2":"#ffffff"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#e65100","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
        ],
        [
            'layout_display_name' => 'ocean',
            'layout_code' => 'ocean',
            'layout_status' => VLayout::AVAILABLE,
            'layout_role' => VRolePermission::VVIP,
            'layout_setting' => '{"background":{"customBgOn":true,"bgType":"background","bgName":"bgPlain","bgImage":"","bgColor":"#b3e5fc","bgColor2":"#ffffff"},"linkButton":{"buttonName":"","buttonBorder":"no-border","buttonRadius":"sm-bdrs","buttonBgColor":"#01579b","buttonTextColor":"#fafafa"},"text":{"textColor":"#263238"},"support":{"display":true}}',
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

        VLayout::where('layout_bg_name', 'bgPlain')->delete();

        foreach($this->layouts as $k => $layout) {
            
            $newLayout = new VLayout(array_merge([
                'theme_name' => VTheme::VBasic,
                'layout_order' => $k + 11,
                'layout_bg_name' => 'bgPlain',
            ],
            $layout));

            $this->vLayoutService->create($newLayout);
        }

        echo "success!!!\n";
    }
}
