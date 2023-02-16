<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Event extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => strtoupper($this->title),
            'start' => $this->start_date,
            'end'=> $this->end_date,
            'color'=> $this->color,
            'choose'=> $this->choose,
            'notify'=> $this->notify,
            'user_id'=> $this->user_id,
            'category_id'=> $this->category_id
        ];
    }
}
