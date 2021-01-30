<?php

namespace App\Models\Traits;

use App\Util\Constants;
use App\Util\Messages;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait HasSort
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Models\Traits
 * Created 07/11/2020
 */
trait HasSort
{
    /**
     * Functión para odenar por cualquier campo del modelo
     *
     * @param Builder $query
     * @param array|null $sortField
     * @return Builder
     */
    public function scopeApplySort(Builder $query, array $sortField = null)
    {
        if (!property_exists($this, 'allowedSorts')) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, Messages::getMessageHasNotAllowedSorts(get_class($this)));
        }

        if (is_null($sortField)) {
            return $query->orderBy('id', Constants::ORDER_BY_DESC);
        }

        foreach ($sortField as $field => $direction) {
            if (!array_key_exists($field, $this->allowedSorts)) {
                abort(Response::HTTP_BAD_REQUEST, Messages::INVALID_QUERY_PARAMETER);
            }

            $query->orderBy($this->allowedSorts[$field], $direction);
        }

        return $query;
    }
}
