<?php

namespace App\Http\Resources\User;

use App\Util\Constants;
use App\Util\Files;
use Carbon\Carbon;
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
        $roles = [];
        foreach ($this->roles as $role) {
            $roles[] = [
                'id' => $role->id,
                'name' => $role->name
            ];
        }
        return [
            'id' => $this->id,
            'email' => $this->email,
            'complete_name' =>  $this->complete_name,
            'phone' => $this->phone,
            'photo' => Files::getFilePublicPath($this->photo, Constants::PATH_USER_IMAGES),
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'verified' => $this->verified,
            'email_verified_at' => ($this->email_verified_at)
                ? Carbon::parse($this->email_verified_at)->diffForHumans(null,null,false,2)
                : null,
            'roles' => $roles,
        ];
    }
}
