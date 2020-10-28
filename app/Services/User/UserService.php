<?php

namespace App\Services\User;

use App\Mail\User\UserCreated;
use App\Models\User;
use App\Util\Constants;
use App\Util\Messages;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserService
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Services\User
 * Created 28/10/2020
 */
class UserService
{
    /**
     * Función para actualizar el email
     *
     * @param $data
     * @param User $user
     * @throws \Throwable
     */
    public function updateEmail($data, User $user)
    {
        $user->email = $data['email'];
        if (!$user->isDirty()) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, Messages::MODEL_IS_DIRTY);
        }
        $user->verified = User::USUARIO_NO_VERIFICADO;
        $user->verification_token = User::generarToken(User::TOKEN_LENGTH);
        $user->email_verified_at = null;
        $user->saveOrFail();
    }

    /**
     * Función para reenviar el token de verificación
     *
     * @param User $user
     * @throws \Exception
     */
    public function resendToken(User $user)
    {
        if ($user->isVerified()) {
            return abort(Response::HTTP_CONFLICT,Messages::USER_IS_VERIFIED);
        }
        retry(Constants::TIMES_TO_RESEND_EMAIL, function () use ($user) {
            Mail::to($user)->send(new UserCreated($user));
        }, Constants::SLEEP_TO_RESEND_EMAIL);
    }

    /**
     * Función para verificar el usuario
     *
     * @param String $token
     */
    public function verify(String $token)
    {
        $user = User::findByVerificationToken($token);
        $user->verified = User::USUARIO_VERIFICADO;
        $user->verification_token = null;
        $user->email_verified_at = now();
        $user->saveOrFail();
    }
}
