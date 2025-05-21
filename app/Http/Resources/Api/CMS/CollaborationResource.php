<?php

namespace App\Http\Resources\Api\CMS;

use App\Http\Resources\Api\CMS\FAQResource;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollaborationResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'faqs'        => FAQResource::collection(FAQ::where('type', 'Collaboration')->where('status', 'active')->get()),
        ];
    }
}
