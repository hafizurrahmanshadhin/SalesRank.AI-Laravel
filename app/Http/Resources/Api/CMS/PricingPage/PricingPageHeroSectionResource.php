<?php

namespace App\Http\Resources\Api\CMS\PricingPage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PricingPageHeroSectionResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'sub_title'   => $this->sub_title,
            'image'       => $this->image ? url($this->image) : null,
            'description' => $this->description,
        ];
    }
}
