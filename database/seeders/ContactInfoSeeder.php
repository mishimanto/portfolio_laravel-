<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    public function run(): void
    {
        ContactInfo::create([
            'address' => 'Fatullah, Narayanganj, Bangladesh',
            'phone' => '+880 194985404',
            'email' => 'moynulislamshimanto24@gmail.com',
        ]);
    }
}
