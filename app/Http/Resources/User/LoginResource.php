<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LoginResource
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Resources\User
 * Created 04/10/2020
 */
class LoginResource extends JsonResource
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
            'api_token' => $this->api_token
        ];
    }
}
