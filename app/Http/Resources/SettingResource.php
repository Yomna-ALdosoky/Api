<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name'        => $this->name,
            'number id '  => $this->id,
            'about_us'    => $this->about_us,
            'why_us'      => $this->why_us,
            'vision'      => $this->vision,
            'about_footer'=> $this->about_footer,
            'ads_text'    => $this->ads_text
        ];
    }
}
