<?php

namespace App\Services\User;

use App\Mail\User\ResetPassword;
use App\Models\User;
use App\Notifications\User\UserCreatedNotification;
use App\Util\Constants;
use App\Util\Files;
use App\Util\Messages;
use App\Util\Utils;
use App\Util\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
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
     * Función para mostrar los registros
     *
     * @param Request $request
     * @return mixed
     */
    public function findAll(Request $request)
    {
        $filter['email'] = $request->get('email');
        $filter['complete_name'] = $request->get('complete_name');
        $filter['phone'] = Validations::validatePhoneNumber($request->get('phone'));
        $filter['birthday'] = Validations::validateDate($request->get('birthday'));
        $filter['gender'] = $request->get('gender');
        $perPage = Utils::getPerPage($request);
        $sort = Utils::cleanExtraSort($request->get(Constants::ORDER_BY_QUERY_PARAM_KEY));
        return User::filter($filter)
            ->with('roles')
            ->applySort($sort)
            ->paginate($perPage);
    }

    /**
     * Función para guardar un usuario
     *
     * @param array $data
     * @return mixed
     */
    public function storeUser(array $data)
    {
        DB::beginTransaction();
        $photo = null;
        try {
            if (isset($data['photo'])) {
                $photo = Str::random(Constants::IMAGE_NAME_LENGHT).
                    Files::getImageExtension($data['photo']->getClientOriginalName());
                $pathUrl = Files::getUserImagePublicPath($photo);
                Image::make($data['photo'])
                    ->resize(null, Constants::IMAGE_HEIGHT, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($pathUrl);
            }
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'complete_name' => $data['complete_name'],
                'phone' => $data['phone'],
                'photo' => (!is_null($photo)) ? $photo : User::USER_PHOTO_DEFAULT,
                'birthday' => $data['birthday'],
                'gender' => $data['gender'],
                'verification_token' => User::generateVerificationToken()
            ]);
            $roles = Str::of($data['roles'])->explode(',');
            $user->roles()->attach($roles);
            DB::commit();
            $user->notify(new UserCreatedNotification($user));
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            if (!is_null($photo)) {
                Storage::delete(Files::getUserImageStoragePath($photo));
            }
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

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
        $user->verified = User::USER_NOT_VERIFIED;
        $user->verification_token = User::generateVerificationToken();
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
        /*retry(Constants::TIMES_TO_RESEND_EMAIL, function () use ($user) {
            Mail::to($user)->send(new UserCreated($user));
        }, Constants::SLEEP_TO_RESEND_EMAIL);*/
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
        $user->verified = User::USER_VERIFIED;
        $user->verification_token = null;
        $user->email_verified_at = now();
        $user->saveOrFail();
    }
}
