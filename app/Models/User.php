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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'role', 'verified', 'verification_token', 'email_verified_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verification_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
     * Función para generar el token de verificación
     *
     * @return string token de 40 caracteres
     */
    public static function generarTokenVerificacion()
    {
        return Str::random(40);
    }

    /**
     * Obtiene el usuario propietario de la liga
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function league()
    {
        return $this->belongsTo(League::class);
    }
}
