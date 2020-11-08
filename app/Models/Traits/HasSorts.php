<?php

namespace App\Models\Traits;

use App\Util\Constants;
use App\Util\Messages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Trait HasSorts
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Models\Traits
 * Created 07/11/2020
 */
trait HasSorts
{
    /**
     * Método para ordenar un modelo genérico
     *
     * @param Builder $query
     * @param $sort
     */
    public function scopeApplySort(Builder $query, $sort)
    {
        if (!property_exists($this, 'allowedSorts')) {
            abort(500, Messages::getMessageHasNotAllowedSorts(get_class($this)));
        }

        if (is_null($sort)) {
            return;
        }

        $sortFields = Str::of($sort)->explode(',');

        foreach ($sortFields as $sortField) {
            $direction = Constants::ORDER_BY_ASC;

            if (Str::of($sortField)->startsWith('-')) {
                $direction = Constants::ORDER_BY_DESC;
                $sortField = Str::of($sortField)->substr(1);
            }

            if (collect($this->allowedSorts)->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }

    /**
     * Método para ordenar por default un modelo en caso de que no tenga parámetros
     *
     * @param Builder $query
     * @param $sort
     */
    public function scopeApplySortDefault(Builder $query, $sort)
    {
        if (!is_null($sort)) {
            return;
        }

        $query->orderBy('id', Constants::ORDER_BY_DESC);
    }
}
