<?php

namespace App\Http\Resources\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Trait ArrayCollection
 *
 * @author JorgeCoronelG
 * @package App\Http\Resources
 * @version 1.0
 * Created 30/01/2021
 */
trait ArrayCollection
{
    /**
     * Función para retornar una respuesta de ResourceCollection
     *
     * @param ResourceCollection $collection
     * @return array
     */
    public function getArrayCollection(ResourceCollection $collection): array
    {
        return [
            'data' => $collection->collection,
            'pagination' => [
                'total' => $collection->total(),
                'current_page' => $collection->currentPage(),
                'from' => $collection->firstItem(),
                'first_page_url' => ($collection->onFirstPage()) ? null : $collection->url(1),
                'next_page_url' => $collection->nextPageUrl(),
                'prev_page_url' => $collection->previousPageUrl(),
                'last_page_url' => $collection->url($collection->lastPage()),
                'per_page' => $collection->count(),
                'to' => $collection->lastItem()
            ]
        ];
    }
}
