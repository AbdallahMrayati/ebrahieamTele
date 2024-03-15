<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('123456789'),
            'creditBalance' => 0,
            'role_id' => '1',
        ]);
        User::create([
            'name' => 'employee',
            'username' => 'employee',
            'password' => Hash::make('123456789'),
            'creditBalance' => 0,
            'role_id' => '3',
        ]);
        User::create([
            'name' => 'customer',
            'username' => 'customer',
            'password' => Hash::make('123456789'),
            'creditBalance' => 0,
            'role_id' => '2',
        ]);
    }
}
