<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnalyticTypesResource extends JsonResource
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
            'type' => 'analyticTypes',
            'attributes' => [
                'name' => $this->name,
                'units' => $this->units,
                'is_numeric' => $this->is_numeric,
                'num_decimal_places' => $this->num_decimal_places
            ]
        ];
    }
}
