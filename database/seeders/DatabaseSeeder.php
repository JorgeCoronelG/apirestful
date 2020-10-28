<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();
        DB::table('leagues')->truncate();

        League::flushEventListeners();
        User::flushEventListeners();

        $this->call(UserSeeder::class);
        $this->call(UserLeagueSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
