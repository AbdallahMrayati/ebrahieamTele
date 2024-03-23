<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('123456789'),
            'creditBalance' => 0,
        ]);
        // Assign the "admin" role to the user
        $role = Role::findByName('admin');
        $user->assignRole($role);
    }
}
