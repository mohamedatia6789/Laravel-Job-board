<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
      
        
        user::create([
            "name" => "Mohamed Atia Omran" ,
            "email" => "mohamed@admin.com",
            "password" => Hash::make("mohamed.100#"),
            "role" => "Admin"
        ]);
        user::create([
            "name" => "Mohamed Atia " ,
            "email" => "Man@Editor.com",
            "password" => Hash::make("mohamed.100#"),
            "role" => "Editor"
        ]);
        user::create([
            "name" => "Mohamed Omran" ,
            "email" => "Woman@Editor.com",
            "password" => Hash::make("mohamed.100#"),
            "role" => "Editor"
        ]);
    }
}
