<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Pán',
            'last_name' => 'Admin',
            'email' => 'admin@ukf.sk',
            'password' => '123',
            'role' => 'admin',
            'premium_until' => null,
        ]);

        User::create([
            'first_name' => 'Dávid',
            'last_name' => 'Držík',
            'email' => 'ddrzik@ukf.sk',
            'password' => '456',
            'role' => 'user',
            'premium_until' => now()->addDays(30),
        ]);

        User::create([
            'first_name' => 'Jozef',
            'last_name' => 'Kapusta',
            'email' => 'jkapusta@ukf.sk',
            'password' => '789',
            'role' => 'user',
            'premium_until' => null,
        ]);
    }
}
