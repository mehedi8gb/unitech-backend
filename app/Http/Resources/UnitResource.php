<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'unit_number' => $this->unit_number,
            'size' => $this->size,
            'price' => $this->price,
            'booking_status' => new BookingStatusResource($this->bookingStatus),
            'images' => ImageResource::collection($this->images),
            // Add other fields as needed
        ];
    }
}
