<?php

namespace App\Services\Api\CMS;

use App\Models\SocialMedia;
use App\Models\SystemSetting;
use Exception;

class HeaderAndFooterService {
    /**
     * Fetch and prepare system setting plus social media data.
     *
     * @throws Exception
     */
    public function getHeaderFooterData(): object {
        try {
            $systemSetting = SystemSetting::first();
            $socialMedias  = SocialMedia::all();

            if (!$systemSetting) {
                throw new Exception('No Data Found');
            }

            // Return an object containing both sets of data
            return (object) [
                'system_setting' => $systemSetting,
                'social_medias'  => $socialMedias,
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
