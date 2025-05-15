<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NewsletterRequest;
use App\Http\Resources\Api\NewsletterResource;
use App\Services\Api\NewsletterService;
use Illuminate\Http\JsonResponse;
use Throwable;

class NewsletterController extends Controller {
    protected NewsletterService $newsletterService;

    public function __construct(NewsletterService $newsletterService) {
        $this->newsletterService = $newsletterService;
    }

    /**
     * Store a new newsletter entry.
     *
     * @param NewsletterRequest $request
     * @return JsonResponse
     */
    public function store(NewsletterRequest $request): JsonResponse {
        try {
            $newsletter = $this->newsletterService->createNewsletter($request->validated());

            return Helper::jsonResponse(true, 'Newsletter stored successfully.', 201, new NewsletterResource($newsletter));
        } catch (Throwable $e) {
            return Helper::jsonResponse(false, 'Failed to store newsletter: ' . $e->getMessage(), 500);
        }
    }
}
