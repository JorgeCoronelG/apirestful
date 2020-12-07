<?php

namespace App\Models;

use App\Models\Traits\HasSorts;
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

    public $allowedSorts = [
        'email' => 'email',
        'complete_name' => 'complete_name',
        'phone' => 'phone',
        'birthday' => 'birthday',
        'gender' => 'gender'
    ];

    const USER_VERIFIED = true;
    const USER_NOT_VERIFIED = false;
    const USER_PHOTO_DEFAULT = 'i3M5VBKYnWPB1GYBACNt0IQI8TF9nfIemC7h5oaJ.png';
    const USER_MALE = 1;
    const USER_FEMALE = 2;
    const TOKEN_LENGTH = 150;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'complete_name', 'phone', 'photo', 'birthday', 'gender'];

    /**
     * Función que regresa si el usuario está verificado o no
     *
     * @return bool true / verificado - false / no verificado
     */
    public function isVerified()
    {
        return $this->verified == User::USER_VERIFIED;
    }

    /**
     * Función para generar un token
     *
     * @param int $length
     * @return string
     */
    public static function generarToken(int $length)
    {
        return Str::random($length);
    }

    /**
     * Relación muchos a muchos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Relación uno a uno
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
     * @param string $email
     * @return mixed
     */
    public static function findByEmail(string $email)
    {
         return User::where('email', $email)->firstOrFail();
    }

    /**
     * Obtener un usuario por su token de verificación
     *
     * @param string $token
     * @return mixed
     */
    public static function findByVerificationToken(string $token) {
        return User::where('verification_token', $token)->firstOrFail();
    }

    /**
     * @param $query
     * @param $params
     * @return mixed
     */
    public function scopeFilter($query, $params)
    {
        if (isset($params['email']) && trim($params['email']) !== '') {
            $query->where('email', 'LIKE', '%'.$params['email'].'%');
        }
        if (isset($params['complete_name']) && trim($params['complete_name']) !== '') {
            $query->where('complete_name', 'LIKE', '%'.$params['complete_name'].'%');
        }
        if (isset($params['phone']) && trim($params['phone']) !== '') {
            $query->where('phone', 'LIKE', '%'.$params['phone'].'%');
        }
        if (isset($params['birthday']) && trim($params['birthday']) !== '') {
            $query->where('birthday', $params['birthday']);
        }
        if (isset($params['gender']) && trim($params['gender']) !== '') {
            $query->where('gender', $params['gender']);
        }

        return $query;
    }
}
