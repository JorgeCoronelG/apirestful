<?php

namespace App\Http\Resources\League;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class LeagueCollection
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Resources\League
 * Created 31/10/2020
 */
class LeagueCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = LeagueResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'pagination' => [
                'total' => $this->total(),
                'current_page' => $this->currentPage(),
                'from' => $this->firstItem(),
                'next_page_url' => $this->nextPageUrl(),
                'per_page' => $this->count(),
                'prev_page_url' => $this->previousPageUrl(),
                'to' => $this->lastItem()
            ]
        ];
    }
}
