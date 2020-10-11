<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserSeeder
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package Database\Seeders
 * Created 27/09/2020
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Se crea un usuario SUPER-ADMINISTRADOR
        User::create([
            'email' => 'tprog.jorge.coronel@outlook.com',
            'password' => Hash::make('password'),
            'role' => User::USUARIO_SUPER_ADMINISTRADOR,
            'verification_token' => null,
            'verified' => User::USUARIO_VERIFICADO,
            'email_verified_at' => now()
            // 'api_token' => Str::random(User::TOKEN_LENGTH)
        ]);
    }
}
