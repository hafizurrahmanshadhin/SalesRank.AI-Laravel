<?php

namespace App\Services\Api;

use App\Models\Newsletter;
use Throwable;

class NewsletterService {
    /**
     * Create a new newsletter entry.
     *
     * @param array $data
     * @return Newsletter
     * @throws Throwable
     */
    public function createNewsletter(array $data): Newsletter {
        try {
            return Newsletter::create($data);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
