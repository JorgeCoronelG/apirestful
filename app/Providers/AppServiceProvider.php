<?php

namespace App\Providers;

use App\Models\League;
use App\Models\User;
use App\Observers\League\LeagueObserver;
use App\Observers\User\UserObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        League::observe(LeagueObserver::class);
        User::observe(UserObserver::class);
    }
}
