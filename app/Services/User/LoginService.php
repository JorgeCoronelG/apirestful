<?php

namespace App\Services\User;

use App\Models\User;
use App\Util\Messages;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginService
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Services\User
 * Created 04/10/2020
 */
class LoginService
{
    /**
     * Función para iniciar sesión
     *
     * @param array $data
     * @return mixed
     */
    public function login(array $data)
    {
        $user = $this->checkAccount($data['email'], $data['password']);
        $user->api_token = User::generateApiToken(User::TOKEN_LENGTH);
        $user->saveOrFail();
        return $user;
    }

    /**
     * Función para cerrar sesión
     *
     * @param User $user
     * @throws \Throwable
     */
    public function logout(User $user)
    {
        $user->api_token = null;
        $user->saveOrFail();
    }

    /**
     * Función para verificar si existe el usuario, si la contraseña es igual y si está verificado
     *
     * @param String $email
     * @param String $password
     * @return mixed
     */
    private function checkAccount(String $email, String $password)
    {
        $user = User::findByEmail($email);
        if (Hash::check($password, $user->password)) {
            if ($user->isVerified()) {
                return $user;
            }
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, Messages::USER_NOT_VERIFIED);
        }
        abort(Response::HTTP_UNPROCESSABLE_ENTITY, Messages::CREDENTIALS_INVALID);
    }
}
