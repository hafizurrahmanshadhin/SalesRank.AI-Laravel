<?php

namespace App\Http\Resources\Api\CMS\ConsultingPage;

use App\Http\Resources\Api\CMS\ConsultingPage\GrowthStoryResource;
use App\Models\GrowthStory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrowthStoryBannerResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'list'  => GrowthStoryResource::collection(GrowthStory::where('status', 'active')->get()),
        ];
    }
}
