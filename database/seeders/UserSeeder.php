<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            (object) [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => '12345678',
            ],
        ];

        foreach ($data as $value) {
            User::create([
                'name' => $value->name,
                'role' => 1,
                'email' => $value->email,
                'email_verified_at' => now(),
                'password' => $value->password,
            ]);
        }
    }
}
