<?php

namespace Database\Seeders;

use App\Models\League;
use Illuminate\Database\Seeder;

/**
 * Class LeagueSeeder
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package Database\Seeders
 * Created 27/09/2020
 */
class LeagueSeeder extends Seeder
{
    const CANTIDAD_LIGAS = 100;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        League::factory()->count(self::CANTIDAD_LIGAS)->create();
    }
}
