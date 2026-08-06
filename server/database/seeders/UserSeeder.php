<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@executiveclerk.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Receiving Clerk',
            'email' => 'receiving@executiveclerk.test',
            'password' => Hash::make('password'),
            'role' => 'receiving_clerk',
        ]);

        User::create([
            'name' => 'Executive Clerk',
            'email' => 'executive@executiveclerk.test',
            'password' => Hash::make('password'),
            'role' => 'executive_clerk',
        ]);
    }
}
