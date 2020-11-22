<?php

namespace App\Models;

use App\Models\Traits\HasSorts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notice
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Models
 * Created 21/11/2020
 */
class Notice extends Model
{
    use HasFactory, SoftDeletes, HasSorts;

    public $allowedSorts = [
        'title' => 'title',
        'description' => 'description',
        'publish_at' => 'publish_at',
        'league' => 'league_id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'publish_at', 'league_id'];

    /**
     * Obtiene la liga relacionada a la noticia
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function league()
    {
        return $this->belongsTo(League::class);
    }

    /**
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $params): Builder
    {
        if (isset($params['title']) && trim($params['title']) !== '') {
            $query->where('title', 'LIKE', '%'.$params['title'].'%');
        }
        if (isset($params['description']) && trim($params['description']) !== '') {
            $query->where('description', 'LIKE', '%'.$params['description'].'%');
        }
        if (isset($params['publish_at']) && trim($params['publish_at']) !== '') {
            $query->where('publish_at', $params['publish_at']);
        }
        if (isset($params['league']) && trim($params['league']) !== '') {
            $query->where('league_id', $params['league']);
        }

        return $query;
    }
}
