<?php

namespace App\Observers\User;

use App\Mail\User\UserCreated;
use App\Mail\User\UserMailChanged;
use App\Models\User;
use App\Util\Constants;
use Illuminate\Support\Facades\Mail;

/**
 * Class UserObserver
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Observers\User
 * Created 24/10/2020
 */
class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param User $user
     * @throws \Exception
     */
    public function created(User $user)
    {
        /*retry(Constants::TIMES_TO_RESEND_EMAIL, function () use ($user) {
            Mail::to($user)->send(new UserCreated($user));
        }, Constants::SLEEP_TO_RESEND_EMAIL);*/
    }

    /**
     * Handle the user "updated" event.
     *
     * @param User $user
     * @throws \Exception
     */
    public function updated(User $user)
    {
        if ($user->isDirty('email')) {
            retry(Constants::TIMES_TO_RESEND_EMAIL, function () use ($user) {
                Mail::to($user)->send(new UserMailChanged($user));
            }, Constants::SLEEP_TO_RESEND_EMAIL);
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
