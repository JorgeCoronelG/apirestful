<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Traits\ArrayCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class UserCollection
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Resources\User
 * Created 11/12/2020
 */
class UserCollection extends ResourceCollection
{
    use ArrayCollection;

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = UserResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->getArrayCollection($this);
    }
}
