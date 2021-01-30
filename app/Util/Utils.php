<?php

namespace App\Util;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class Utils
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Utils
 * Created 10/11/2020
 */
class Utils
{
    /**
     * Función para quitar palabras repetidas
     *
     * @param string|null $urlSort
     * @return array|null
     */
    public static function cleanExtraSort(string $urlSort = null)
    {
        if (is_null($urlSort)) {
            return null;
        }

        $cleanSort = array();

        $urlSort = str_replace(' ','', $urlSort);

        $direction = Constants::ORDER_BY_ASC;

        if (Str::of($urlSort)->startsWith('-')) {
            $direction = Constants::ORDER_BY_DESC;
            $urlSort = Str::substr($urlSort, 1);
        }

        $cleanSort[$urlSort] = $direction;

        return $cleanSort;
    }

    /**
     * Función para obtener los registros por página de la petición
     *
     * @param Request $request
     * @return int
     */
    public static function getPerPage(Request $request): int
    {
        $perPage = Constants::PAGINATION_ITEMS_DEFAULT;
        if ($request->get(Constants::PAGINATION_QUERY_PARAM_KEY)) {
            if (intval($request->get(Constants::PAGINATION_QUERY_PARAM_KEY)) > 0) {
                $perPage = intval($request->get(Constants::PAGINATION_QUERY_PARAM_KEY));
            }
        }
        return $perPage;
    }
}
