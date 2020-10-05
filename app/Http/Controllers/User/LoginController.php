<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\User\LoginResource;
use App\Http\Service\User\LoginService;
use App\Models\User;

/**
 * Class LoginController
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Controllers\User
 * Created 04/10/2020
 */
class LoginController extends Controller
{
    protected $user;
    private $loginService;

    /**
     * LoginController constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->loginService = new LoginService();
    }

    /**
     * Función para iniciar sesión
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $this->user = $this->loginService->login($request->all());
        if ($this->user) {
            return response()->json(new LoginResource($this->user));
        } else {
            return response()->json(['message' => 'Credenciales inválidas'], 404);
        }
    }

    /**
     * Función para cerrar sesión y eliminar el api_token del usuario
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(User $user)
    {
        $user->api_token = null;
        $user->save();
        return response()->json(null, 200);
    }
}
