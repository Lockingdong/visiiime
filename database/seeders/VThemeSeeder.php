<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VTheme;

class VThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VTheme::create([
            'theme_name' => 'VBasic',
            'theme_code' => 'VBasic',
            'theme_status' => 'AVAL',
        ]);
    }
}
