<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnalyticsSummaryResource extends JsonResource
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
            'type' => 'analyticsSummary',
            'attributes' => [
                'name' => $this->name,
                'minValue' => $this->minVal,
                'maxValue' => $this->maxVal,
                'medianValue' => $this->median,
                'withValue%' => ($this->propertiesCount/$this->totalProperties) * 100,
                'withoutValue%' => (($this->totalProperties - $this->propertiesCount)/$this->totalProperties) * 100
            ]
        ];
    }
}
