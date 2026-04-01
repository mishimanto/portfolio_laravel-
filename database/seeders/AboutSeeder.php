<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\PersonalInfo;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        About::create([
            'profile_pic' => null,
            'title' => 'John Doe',
            'subtitle' => 'Web Developer & Designer',
            'description' => 'Passionate web developer with 5+ years of experience in creating beautiful and functional websites.',
        ]);

        $personalInfos = [
            ['info_title' => 'Birthday', 'info_desc' => '5 August 1998'],
            ['info_title' => 'Phone', 'info_desc' => '0194985404'],
            ['info_title' => 'City', 'info_desc' => 'Fatullah Narayanganj'],
            ['info_title' => 'Age', 'info_desc' => '28'],
            ['info_title' => 'Degree', 'info_desc' => 'M.Sc.'],
            ['info_title' => 'Email', 'info_desc' => 'moynulislamshimanto24@gmail.com'],
            ['info_title' => 'Freelance', 'info_desc' => 'Available'],
        ];

        foreach ($personalInfos as $info) {
            PersonalInfo::create($info);
        }
    }
}
