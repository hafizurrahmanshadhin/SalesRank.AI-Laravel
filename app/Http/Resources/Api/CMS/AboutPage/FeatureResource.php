<?php

namespace App\Http\Resources\Api\CMS\AboutPage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'image'       => $this->image ? url($this->image) : null,
            'description' => $this->description,
        ];
    }
}
