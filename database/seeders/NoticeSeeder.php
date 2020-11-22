<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\Notice;
use Illuminate\Database\Seeder;

/**
 * Class NoticeSeeder
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package Database\Seeders
 * Created 21/11/2020
 */
class NoticeSeeder extends Seeder
{
    const CANTIDAD_NOTICIAS_POR_LIGA = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        League::select('id')->get()->map(function (League $league) {
            $league->notices()->saveMany(Notice::factory()->times(self::CANTIDAD_NOTICIAS_POR_LIGA)->make());
            return $league;
        });
    }
}
