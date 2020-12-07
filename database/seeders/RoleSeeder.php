<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Class RoleSeeder
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package Database\Seeders
 * Created 27/11/2020
 */
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => Role::ROLE_ADMINISTRADOR]);
        Role::create(['name' => Role::ROLE_LIGA]);
        Role::create(['name' => Role::ROLE_RESPONSABLE_EQUIPO]);
        Role::create(['name' => Role::ROLE_JUGADOR]);
        Role::create(['name' => Role::ROLE_ARBITRO]);
    }
}
