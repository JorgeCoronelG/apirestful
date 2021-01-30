<?php

namespace App\Observers\League;

use App\Models\League;

/**
 * Class LeagueObserver
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Observers\League
 * Created 24/10/2020
 */
class LeagueObserver
{
    /**
     * Handle the league "created" event.
     *
     * @param League $league
     * @throws \Exception
     */
    public function created(League $league)
    {
        /*retry(Constants::TIMES_TO_RESEND_EMAIL, function () use ($league) {
            Mail::to($league->user)->send(new UserCreated($league->user));
        }, Constants::SLEEP_TO_RESEND_EMAIL);*/
    }

    /**
     * Handle the league "updated" event.
     *
     * @param  \App\Models\League  $league
     * @return void
     */
    public function updated(League $league)
    {
        //
    }

    /**
     * Handle the league "deleted" event.
     *
     * @param  \App\Models\League  $league
     * @return void
     */
    public function deleted(League $league)
    {
        //
    }

    /**
     * Handle the league "restored" event.
     *
     * @param  \App\Models\League  $league
     * @return void
     */
    public function restored(League $league)
    {
        //
    }

    /**
     * Handle the league "force deleted" event.
     *
     * @param  \App\Models\League  $league
     * @return void
     */
    public function forceDeleted(League $league)
    {
        //
    }
}
