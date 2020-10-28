<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\User\LoginResource;
use App\Models\User;
use App\Services\User\LoginService;

/**
 * Class LoginController
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Controllers\User
 * Created 04/10/2020
 */
class LoginController extends ApiController
{
    private $loginService;

    /**
     * LoginController constructor.
     *
     * @param LoginService $loginService
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Función para iniciar sesión
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $user = $this->loginService->login($request->validated());
        return $this->showOne(new LoginResource($user));
    }

    /**
     * Función para cerrar sesión y eliminar el api_token del usuario
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function logout(User $user)
    {
        $this->loginService->logout($user);
        return $this->noContentResponse();
    }
}
