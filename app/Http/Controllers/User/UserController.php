<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Requests\User\UpdateEmailUserRequest;
use App\Models\User;
use App\Services\User\UserService;

/**
 * Class UserController
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Controllers\User
 * Created 24/10/2020
 */
class UserController extends ApiController
{
    private $userService;

    /**
     * UserController constructor.
     *
     * @param $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Método para actualizar el email del usuario
     *
     * @param UpdateEmailUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(UpdateEmailUserRequest $request, User $user)
    {
        $this->userService->updateEmail($request->validated(), $user);
        return $this->noContentResponse();
    }

    /**
     * Función para reenviar el token de verificación
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function resend(User $user) {
        $this->userService->resendToken($user);
        return $this->noContentResponse();
    }

    /**
     * Función para verificar el email
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function verify($token)
    {
        $this->userService->verify($token);
        return $this->noContentResponse();
    }
}
