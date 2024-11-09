<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FloorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'floor_number' => $this->floor_number,
            'description' => $this->description,
            'units' => UnitResource::collection($this->whenLoaded('units')),
        ];
    }
}
