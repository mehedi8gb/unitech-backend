<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $modelName = preg_replace('/^.*\\\/', '', $this->imageable_type);

        return [
            'id' => $this->id,
            'url' => $this->url,
            'image_type' => $modelName,
//            'alt_text' => $this->alt_text,
        ];
    }
}
