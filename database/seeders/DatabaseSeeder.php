<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\Notice;
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
        DB::table('notices')->truncate();

        League::flushEventListeners();
        User::flushEventListeners();
        Notice::flushEventListeners();

        $this->call(UserSeeder::class);
        $this->call(UserLeagueSeeder::class);
        $this->call(NoticeSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
