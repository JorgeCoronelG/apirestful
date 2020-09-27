<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
    const CANTIDAD_USUARIOS = 100;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(self::CANTIDAD_USUARIOS)->create();
    }
}
