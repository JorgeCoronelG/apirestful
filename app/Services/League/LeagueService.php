<?php

namespace App\Services\League;

use App\Models\League;
use App\Models\User;
use App\Util\Constants;
use App\Util\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LeagueService
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Services\League
 * Created 03/10/2020
 */
class LeagueService
{
    /**
     * Función para mostrar los registros
     *
     * @param Request $request
     * @return mixed
     */
    public function findALl(Request $request)
    {
        $paramsLeague['name'] = $request->get('name');
        $paramsUser['email'] = $request->get('email');
        $pagination = Constants::PAGINATION_DEFAULT;
        if ($request->get(Constants::PAGINATION_KEY)) {
            if (intval($request->get(Constants::PAGINATION_KEY)) !== 0) {
                $pagination = intval($request->get(Constants::PAGINATION_KEY));
            }
        }
        $sort = $request->get(Constants::ORDER_BY_KEY);
        return League::filter($paramsLeague)
            ->applySort($sort)
            ->whereHas('user', function ($query) use ($paramsUser, $sort) {
                $query->filter($paramsUser)
                    ->applySort($sort);
            })
            ->applySortDefault($sort)
            ->paginate($pagination);
    }

    /**
     * Función para insertar una liga con su usuario
     *
     * @param $data
     * @return mixed
     */
    public function storeLeague($data)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => User::USUARIO_ADMINISTRADOR,
                'verification_token' => User::generarToken(User::TOKEN_LENGTH)
            ]);
            if ($user) {
                $league = $user->league()->create([
                    'name' => $data['name']
                ]);
                if ($league) {
                    DB::commit();
                    return $league;
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, Messages::INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Función para actualizar una liga
     *
     * @param $data
     * @param League $league
     * @return League
     * @throws \Throwable
     */
    public function updateLeague($data, League $league)
    {
        $league->name = $data['name'];
        if (!$league->isDirty()) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, Messages::MODEL_IS_DIRTY);
        }
        $league->saveOrFail();
        return $league;
    }

    /**
     * Función para eliminar una liga y su usuario
     *
     * @param League $league
     */
    public function deleteLeague(League $league)
    {
        DB::transaction(function () use ($league) {
            $league->user()->delete();
            $league->delete();
        });
    }
}
