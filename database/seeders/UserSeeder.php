<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    // Check if user 1 exists to avoid duplicates
    if (!\App\Models\User::find(1)) {
        \App\Models\User::create([
            'id_user' => 1, // Force ID 1 so your Postman works
            'username' => 'GuruTest',
            'password' => bcrypt('password123')
        ]);
    }
}
}
