<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdmainUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Mohamed Atia Omran" ,
            "email" => "Mohamed@gmail.com" ,
            "password" => Hash::make("mohamed.100#"),
            "role" => "Admin" 
        ]);
    }
}
