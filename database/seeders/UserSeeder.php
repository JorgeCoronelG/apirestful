<?php

namespace Database\Seeders;

use App\Models\Role;
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
    const TOTAL_USERS = 1000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Se crea un usuario ADMINISTRADOR
        $administrador = User::create([
            'email' => 'tprog.jorge.coronel@outlook.com',
            'password' => Hash::make('password'),
            'complete_name' => 'Jorge Coronel González',
            'phone' => '442-317-8052',
            'photo' => User::USER_PHOTO_DEFAULT,
            'birthday' => '1998-08-29',
            'gender' => User::USER_MALE,
            'verified' => User::USER_VERIFIED,
            'email_verified_at' => now()
        ]);
        $administrador->roles()->attach(Role::findByName(Role::ROLE_ADMINISTRADOR)->id);

        // Se crea un usuario ADMINISTRADOR
        $administrador = User::create([
            'email' => 'jamcedeno@gmail.com',
            'password' => Hash::make('password'),
            'complete_name' => 'Jorge Andrés Morales Cedeño',
            'phone' => '442-145-5604',
            'photo' => User::USER_PHOTO_DEFAULT,
            'birthday' => '1996-09-20',
            'gender' => User::USER_MALE,
            'verified' => User::USER_VERIFIED,
            'email_verified_at' => now()
        ]);
        $administrador->roles()->attach(Role::findByName(Role::ROLE_ADMINISTRADOR)->id);

        User::factory()->times(self::TOTAL_USERS)->create();
    }
}
