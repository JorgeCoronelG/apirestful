<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Requests\User\EmailUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateEmailUserRequest;
use App\Http\Requests\User\UpdatePasswordUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        /**$this->middleware('permission:'.
            User::USUARIO_SUPER_ADMINISTRADOR.','.
            User::USUARIO_ADMINISTRADOR.','.
            User::USUARIO_RESPONSABLE_EQUIPO.','.
            User::USUARIO_JUGADOR.','.
            User::USUARIO_ARBITRO);*/
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $users = $this->userService->findAll($request);
        return $this->showAll(new UserCollection($users->appends($request->all())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->storeUser($request->validated());
        return $this->showOne(new UserResource($user), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return $this->showOne(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->userService->updateUser($request->validated(), $user);
        return $this->showOne(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return $this->noContentResponse();
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
