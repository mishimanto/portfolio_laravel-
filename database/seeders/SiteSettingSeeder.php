<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'site_title' => 'Portfolio',
            'site_description' => 'My Personal Portfolio Website',
            'background_image' => null,
            'show_social_icons' => true,
        ]);
    }
}
