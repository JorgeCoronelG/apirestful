<?php

namespace App\Services\User;

use App\Mail\User\ResetPassword;
use App\Mail\User\UserCreated;
use App\Models\User;
use App\Util\Constants;
use App\Util\Messages;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
     * @param array $data
     * @param User $user
     * @return User
     * @throws \Throwable
     */
    public function updateEmail(array $data, User $user)
    {
        $user->email = $data['email'];
        if (!$user->isDirty()) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, Messages::MODEL_IS_DIRTY);
        }
        $user->verified = User::USUARIO_NO_VERIFICADO;
        $user->verification_token = User::generarToken(User::TOKEN_LENGTH);
        $user->email_verified_at = null;
        $user->saveOrFail();
        return $user;
    }

    /**
     * Función para actualizar la contraseña
     *
     * @param array $data
     * @param User $user
     * @throws \Throwable
     */
    public function updatePassword(array $data, User $user)
    {
        $user->password = Hash::make($data['password']);
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
        retry(Constants::TIMES_TO_RESEND_EMAIL, function () use ($user) {
            Mail::to($user)->send(new UserCreated($user));
        }, Constants::SLEEP_TO_RESEND_EMAIL);
    }

    /**
     * Función para enviar la nueva contraseña
     *
     * @param array $data
     * @throws \Exception
     */
    public function resetPassword(array $data)
    {
        $user = User::findByEmail($data['email']);
        if (!$user->isVerified()) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, Messages::USER_NOT_VERIFIED);
        }
        $newPassword = Str::random();
        $user->password = Hash::make($newPassword);
        $user->saveOrFail();
        retry(Constants::TIMES_TO_RESEND_EMAIL, function () use ($user, $newPassword) {
            Mail::to($user)->send(new ResetPassword($user, $newPassword));
        }, Constants::SLEEP_TO_RESEND_EMAIL);
    }

    /**
     * Función para verificar el usuario
     *
     * @param string $token
     */
    public function verify(string $token)
    {
        $user = User::findByVerificationToken($token);
        $user->verified = User::USUARIO_VERIFICADO;
        $user->verification_token = null;
        $user->email_verified_at = now();
        $user->saveOrFail();
    }
}
