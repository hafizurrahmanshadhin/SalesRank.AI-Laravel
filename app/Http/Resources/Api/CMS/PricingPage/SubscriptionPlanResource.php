<?php

namespace App\Http\Resources\Api\CMS\PricingPage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPlanResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'billing_interval' => $this->billing_interval,
            'price'            => number_format($this->price, 2),
            'currency'         => $this->currency,
            'description'      => $this->description,
            'features'         => $this->features ?? [],
            'is_recommended'   => $this->is_recommended,
        ];
    }
}
