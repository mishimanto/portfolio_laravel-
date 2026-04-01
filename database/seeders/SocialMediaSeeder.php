<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    public function run(): void
    {
        $socials = [
            ['name' => 'twitter', 'icon' => 'twitter', 'link' => 'https://twitter.com', 'order' => 1, 'is_active' => true],
            ['name' => 'facebook', 'icon' => 'facebook', 'link' => 'https://facebook.com', 'order' => 2, 'is_active' => true],
            ['name' => 'instagram', 'icon' => 'instagram', 'link' => 'https://instagram.com', 'order' => 3, 'is_active' => true],
            ['name' => 'linkedin', 'icon' => 'linkedin', 'link' => 'https://linkedin.com', 'order' => 4, 'is_active' => true],
            ['name' => 'github', 'icon' => 'github', 'link' => 'https://github.com', 'order' => 5, 'is_active' => true],
        ];

        foreach ($socials as $social) {
            SocialMedia::create($social);
        }
    }
}
