<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email', 'admin@gmail.com')->exists()){
            User::create([
                "name" => "admin",
                "email" => "admin@gmail.com",
                "password" => bcrypt("password"),
                "role" => "admin",
                "email_verified_at" => now(),
            ]);

            $this->command->info("Admin user created");
        }
        else {
            $this->command->info("Admin user already exists");
        }
    }
}
