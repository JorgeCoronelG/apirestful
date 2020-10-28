<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Resources
 * Created 03/10/2020
 */
class UserResource extends JsonResource
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
            'email' => $this->email,
            'role' => $this->role,
            'verified' => $this->verified,
        ];
    }
}
