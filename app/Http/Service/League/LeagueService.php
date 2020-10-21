<?php

namespace App\Http\Service\League;

use App\Models\League;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class LeagueService
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Service\League
 * Created 03/10/2020
 */
class LeagueService
{
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
        }
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
