<?php

namespace App\Mail\User;

use App\Models\User;
use App\Util\Messages;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserMailChanged
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Mail\User
 * Created 24/10/2020
 */
class UserMailChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * UserMailChanged constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->user->role) {
            case User::USUARIO_ADMINISTRADOR:
                return $this->markdown('emails.users.email-updated')
                    ->with([
                        'name' => $this->user->league->name,
                        'verification_token' => $this->user->verification_token
                    ])->subject(Messages::EMAIL_UPDATED);
            case User::USUARIO_RESPONSABLE_EQUIPO:
                // Pendiente
            case User::USUARIO_JUGADOR:
                // Pendiente
            case User::USUARIO_ARBITRO:
                // Pendiente
        }
    }
}
