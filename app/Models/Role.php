<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Models
 * Created 27/11/2020
 */
class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    const ROLE_ADMINISTRADOR = 'Administrador';
    const ROLE_LIGA = 'Liga de fútbol';
    const ROLE_RESPONSABLE_EQUIPO = 'Responsable de equipo';
    const ROLE_JUGADOR = 'Jugador';
    const ROLE_ARBITRO = 'Árbitro';

    /**
     * Relación muchos a muchos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Obtener un rol por nombre
     *
     * @param string $name
     * @return mixed
     */
    public static function findByName(string $name)
    {
        return Role::where('name', $name)->firstOrFail();
    }
}
