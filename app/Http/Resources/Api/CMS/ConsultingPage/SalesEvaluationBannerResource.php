<?php

namespace App\Http\Resources\Api\CMS\ConsultingPage;

use App\Http\Resources\Api\CMS\ConsultingPage\SalesEvaluationResource;
use App\Models\SalesEvaluation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesEvaluationBannerResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'image' => $this->image ? url($this->image) : null,
            'list'  => SalesEvaluationResource::collection(SalesEvaluation::where('status', 'active')->get()),
        ];
    }
}
