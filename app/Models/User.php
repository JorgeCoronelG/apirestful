<?php

namespace App\Models;

use App\Models\Traits\HasSorts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * Class User
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Models
 * Created 27/09/2020
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasSorts;

    public $allowedSorts = ['email', 'role'];

    const USUARIO_VERIFICADO = true;
    const USUARIO_NO_VERIFICADO = false;
    const USUARIO_SUPER_ADMINISTRADOR = 1;
    const USUARIO_ADMINISTRADOR = 2;
    const USUARIO_RESPONSABLE_EQUIPO = 3;
    const USUARIO_JUGADOR = 4;
    const USUARIO_ARBITRO = 5;
    const TOKEN_LENGTH = 150;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'role', 'verification_token'];

    /**
     * Función que regresa si el usuario está verificado o no
     *
     * @return bool true / verificado - false / no verificado
     */
    public function isVerified()
    {
        return $this->verified == User::USUARIO_VERIFICADO;
    }

    /**
     * Función para generar un token
     *
     * @param Int $length
     * @return string
     */
    public static function generarToken(Int $length)
    {
        return Str::random($length);
    }

    /**
     * Obtiene la liga relacionada al usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function league()
    {
        return $this->hasOne(League::class);
    }

    /**
     * Obtener un usuario por su correo
     *
     * @param String $email
     * @return mixed
     */
    public static function findByEmail(String $email)
    {
         return User::where('email', $email)->firstOrFail();
    }

    /**
     * Obtener un usuario por su token de verificación
     *
     * @param String $token
     * @return mixed
     */
    public static function findByVerificationToken(String $token) {
        return User::where('verification_token', $token)->firstOrFail();
    }

    /**
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $params)
    {
        if (isset($params['email']) && trim($params['email']) !== '')
        {
            $query->where('email', 'LIKE', '%'.$params['email'].'%');
        }

        if (isset($params['role']))
        {
            $query->where('role', $params['role']);
        }
    }
}
