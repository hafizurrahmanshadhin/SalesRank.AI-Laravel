<?php

namespace App\Http\Resources\Api\CMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeaderAndFooterResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        $systemSetting = $this->system_setting;
        $socialMedias  = $this->social_medias;

        return [
            'logo'           => $systemSetting->logo ? url($systemSetting->logo) : asset('frontend/logo.png'),
            'favicon'        => $systemSetting->favicon ? url($systemSetting->favicon) : asset('frontend/aiavatar1.png'),
            'description'    => $systemSetting->description,
            'phone_number'   => $systemSetting->phone_number,
            'email'          => $systemSetting->email,
            'address'        => $systemSetting->address,
            'copyright_text' => $systemSetting->copyright_text,

            // Social Media Links
            'social_media'   => $socialMedias,
        ];
    }
}
