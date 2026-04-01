<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\ContactInfo;
use App\Models\SiteSetting;
use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create default site settings
        SiteSetting::create([
            'site_title' => 'Portfolio',
            'site_description' => 'My Personal Portfolio',
            'background_image' => null,
            'show_social_icons' => true,
        ]);

        // Create default about
        About::create([
            'profile_pic' => null,
            'title' => 'Moynul Islam Shimanto',
            'subtitle' => 'Full Stack Developer',
            'description' => 'Passionate web developer with 5+ years of experience...',
        ]);

        // Create default contact info
        ContactInfo::create([
            'address' => 'Fatullah, Narayanganj, Bangladesh',
            'phone' => '01949854504',
            'email' => 'moynulislamshimanto24@gmail.com',
        ]);

        // Create default social media
        $socials = [
            ['name' => 'twitter', 'icon' => 'twitter', 'link' => '#', 'order' => 1],
            ['name' => 'facebook', 'icon' => 'facebook', 'link' => '#', 'order' => 2],
            ['name' => 'instagram', 'icon' => 'instagram', 'link' => '#', 'order' => 3],
            ['name' => 'linkedin', 'icon' => 'linkedin', 'link' => '#', 'order' => 4],
        ];

        foreach ($socials as $social) {
            SocialMedia::create($social);
        }

        $this->call([
            AdminUserSeeder::class,
            SiteSettingSeeder::class,
            AboutSeeder::class,
            ContactInfoSeeder::class,
            SocialMediaSeeder::class,
        ]);
    }
}
