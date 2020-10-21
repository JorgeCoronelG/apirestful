<?php

namespace App\Http\Service\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class LoginService
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Service\User
 * Created 04/10/2020
 */
class LoginService
{
    /**
     * Función para iniciar sesión
     *
     * @param $data
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function login($data)
    {
        $user = $this->checkAccount($data['email'], $data['password']);
        if ($user) {
            $user->api_token = User::generarToken(User::TOKEN_LENGTH);
            $user->save();
            return $user;
        }
        return null;
    }

    /**
     * Función para verificar si existe el usuario, si la contraseña es igual y si está verificado
     *
     * @param String $email
     * @param String $password
     * @return mixed|null
     */
    private function checkAccount(String $email, String $password)
    {
        $user = User::findByEmail($email);
        if ($user) {
            if (Hash::check($password, $user->password)) {
                if ($user->esVerificado()) {
                    return $user;
                }
            }
        }
        return null;
    }
}
