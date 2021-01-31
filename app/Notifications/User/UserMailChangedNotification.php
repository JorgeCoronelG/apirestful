<?php

namespace App\Notifications\User;

use App\Models\User;
use App\Util\Messages;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class UserMailChangedNotification
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Notifications\User
 * Created 30/01/2021
 */
class UserMailChangedNotification extends Notification
{
    use Queueable;

    private $user;

    /**
     * UserMailChangedNotification constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)
            ->subject(Messages::EMAIL_UPDATED)
            ->markdown('emails.users.email-updated', [
                'name' => $this->user->complete_name,
                'verification_token' => $this->user->verification_token
            ]);
    }
}
