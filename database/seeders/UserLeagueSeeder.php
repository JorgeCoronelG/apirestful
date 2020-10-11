<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UserLeagueSeeder
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package Database\Seeders
 * Created 10/10/2020
 */
class UserLeagueSeeder extends Seeder
{
    const CANTIDAD_USUARIOS = 50;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->times(self::CANTIDAD_USUARIOS)
            ->create(['role' => User::USUARIO_ADMINISTRADOR])
            ->each(function (User $user) {
                League::factory()->create(['user_id' => $user->id]);
            });
    }
}
