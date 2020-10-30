<?php

namespace App\Mail\User;

use App\Models\User;
use App\Util\Messages;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $newPassword;

    /**
     * ResetPassword constructor.
     *
     * @param User $user
     * @param String $newPassword
     */
    public function __construct(User $user, String $newPassword)
    {
        $this->user = $user;
        $this->newPassword = $newPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->user->role) {
            case User::USUARIO_SUPER_ADMINISTRADOR:
                return $this->markdown('emails.users.reset-password')
                    ->with([
                        'name' => $this->user->email,
                        'new_password' => $this->newPassword
                    ])->subject(Messages::CONFIRM_EMAIL);
            case User::USUARIO_ADMINISTRADOR:
                return $this->markdown('emails.users.reset-password')
                    ->with([
                        'name' => $this->user->league->name,
                        'new_password' => $this->newPassword
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
