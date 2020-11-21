<?php

namespace App\Models;

use App\Models\Traits\HasSorts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class League
 *
 * @autor JorgeCoronelG
 * @version 1.0
 * @package App\Models
 * Created 27/09/2020
 */
class League extends Model
{
    use HasFactory, SoftDeletes, HasSorts;

    public $allowedSorts = [
        'name' => 'name',
        'email' => 'users.email'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id'];

    /**
     * Obtiene el usuario relacionado a la liga
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $params): Builder
    {
        if (isset($params['name']) && trim($params['name']) !== '') {
            $query->where('name', 'LIKE', '%'.$params['name'].'%');
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param array $filter
     * @return Builder
     */
    public function scopeWithUser(Builder $query, array $filter): Builder
    {
        $query->join('users', 'leagues.user_id', '=', 'users.id')
            ->whereHas('user', function ($query) use ($filter) {
                $query->filter($filter);
            });

        return $query;
    }
}
