<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'moynulislamshimanto24@gmail.com',
            'password' => Hash::make('shimanto'),
            'is_admin' => true,
        ]);
    }
}
