<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
            'Id'          => $this->id,
            'Title'       => $this->title,
            'Slug'        => $this->slug,
            'text'        => $this->text,
            'phone'       => $this->phone
        ];
    }
}
