<?php

namespace Database\Seeders;

use App\Models\Role;
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

        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        DB::table('role_user')->truncate();
        // DB::table('leagues')->truncate();
        // DB::table('notices')->truncate();

        Role::flushEventListeners();
        User::flushEventListeners();
        // League::flushEventListeners();
        // Notice::flushEventListeners();

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(UserLeagueSeeder::class);
        // $this->call(NoticeSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
