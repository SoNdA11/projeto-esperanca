<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'paulo@teste.com.br')->first()) {
            User::create([
                'name' => 'Paulo',
                'email' => 'paulo@teste.com.br',
                'password' => Hash::make('12345678', ['rounds' => 12]),
            ]);
        }

        if (!User::where('email', 'cesar@teste.com.br')->first()) {
            User::create([
                'name' => 'Cesar',
                'email' => 'cesar@teste.com.br',
                'password' => Hash::make('12345678', ['rounds' => 12]),
            ]);
        }
    }
}
