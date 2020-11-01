<?php

namespace App\Http\Resources\League;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LeagueResource
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Resources
 * Created 03/10/2020
 */
class LeagueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_id' => $this->user_id,
            'user' => UserResource::make($this->user)
        ];
    }
}
