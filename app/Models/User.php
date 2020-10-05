<?php

namespace App\Models;

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
    use HasFactory, Notifiable, SoftDeletes;

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
    public function esVerificado()
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
         return User::where('email', $email)->first();
    }
}
