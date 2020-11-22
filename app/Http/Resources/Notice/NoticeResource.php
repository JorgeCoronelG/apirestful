<?php

namespace App\Http\Resources\Notice;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class NoticeResource
 *
 * @author JorgeCoronelG
 * @version 1.0
 * @package App\Http\Resources\Notice
 * Created 22/11/2020
 */
class NoticeResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'publish_at' => $this->publish_at,
            'league_id' => $this->league_id,
            'league' => [
                'id' => $this->league->id,
                'name' => $this->league->name
            ]
        ];
    }
}
