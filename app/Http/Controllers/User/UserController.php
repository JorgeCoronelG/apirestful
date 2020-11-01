<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Requests\User\EmailUserRequest;
use App\Http\Requests\User\UpdateEmailUserRequest;
use App\Http\Requests\User\UpdatePasswordUserRequest;
use App\Http\Resources\User\UserResource;
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
     * Función para actualizar el email
     *
     * @param UpdateEmailUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function updateEmail(UpdateEmailUserRequest $request, User $user)
    {
        $user = $this->userService->updateEmail($request->validated(), $user);
        return $this->showOne(new UserResource($user));
    }

    /**
     * Función para actualizar la contraseña
     *
     * @param UpdatePasswordUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function updatePassword(UpdatePasswordUserRequest $request, User $user)
    {
        $this->userService->updatePassword($request->validated(), $user);
        return $this->noContentResponse();
    }

    /**
     * Función para reestablecer la contraseña
     *
     * @param EmailUserRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function resetPassword(EmailUserRequest $request)
    {
        $this->userService->resetPassword($request->validated());
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
