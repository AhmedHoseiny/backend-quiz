<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class vehiclesResource extends JsonResource
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
            'vehicleName' => $this->name,
            'plate_number' => $this->plate_number,
            'type' => $this->type,
            'cost' => $this->cost,
            'createdAt' => $this->created_at,
        ];
    }
}
