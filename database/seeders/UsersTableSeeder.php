<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Generate random data for matricula and password
          $matricula = 333;
          $password = Hash::make('password123'); // Change this to the desired default password
  
          // Insert data into the users table
          DB::table('users')->insert([
              'name' => 'John Doe', 
              'matricula' => $matricula,
              'email' => 'john@example.com', 
              'email_verified_at' => now(),
              'password' => $password,
              'remember_token' => Str::random(10),
              'created_at' => now(),
              'updated_at' => now(),
          ]);
    }
}
