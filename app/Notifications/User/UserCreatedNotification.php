<?php

namespace App\Notifications\User;

use App\Models\User;
use App\Util\Messages;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreatedNotification extends Notification
{
    use Queueable;

    private $user;

    /**
     * UserCreatedNotification constructor.
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
     * @return mixed
     */
    public function toMail()
    {
        return (new MailMessage())
            ->subject(Messages::CONFIRM_EMAIL)
            ->markdown('emails.users.created', [
                'name' => $this->user->complete_name,
                'verification_token' => $this->user->verification_token
            ]);
    }
}
