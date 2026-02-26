<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'Administrador',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'phone' => '912345678',
            'location' => 'Lisboa, Portugal',
            'dob' => '1980-01-01',
            'type' => 'A',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Funcionario',
            'email' => 'funcionario@mail.com',
            'password' => Hash::make('password'),
            'phone' => '960000000',
            'location' => 'Porto, Portugal',
            'dob' => '1995-05-15',
            'type' => 'F',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Utilizador',
            'email' => 'voluntario@mail.com',
            'password' => Hash::make('password'),
            'type' => 'U',
            'email_verified_at' => now(),
        ]);
    }
}
