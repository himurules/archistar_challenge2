<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyAnalyticsResource extends JsonResource
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
            'type' => 'propertyAnalytics',
            'attributes' => [
                'property_id' => $this->property_id,
                'analytic_type_id' => $this->analytic_type_id,
                'value' => $this->value
            ]
        ];
    }
}
