<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertiesResource extends JsonResource
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
            'id' => (string)$this->id,
            'type' => 'properties',
            'attributes' => [
                'guid' => $this->guid,
                'suburb' => $this->suburb,
                'state' => $this->state,
                'country' => $this->country
            ]
        ];
    }
}
