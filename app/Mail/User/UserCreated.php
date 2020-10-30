<?php

namespace App\Mail\User;

use App\Models\User;
use App\Util\Messages;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserCreated
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Mail\User
 * Created 27/10/2020
 */
class UserCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $user;

    /**
     * UserCreated constructor.
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
                return $this->markdown('emails.users.created',)
                    ->with([
                        'name' => $this->user->league->name,
                        'verification_token' => $this->user->verification_token
                    ])->subject(Messages::CONFIRM_EMAIL);
            case User::USUARIO_RESPONSABLE_EQUIPO:
                // Pendiente
            case User::USUARIO_JUGADOR:
                // Pendiente
            case User::USUARIO_ARBITRO:
                // Pendiente
        }
    }
}
