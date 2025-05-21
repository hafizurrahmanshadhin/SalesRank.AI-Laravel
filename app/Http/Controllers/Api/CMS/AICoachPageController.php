<?php

namespace App\Http\Controllers\Api\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CMS\AICoachPage\AICoachPageHeroSectionResource;
use App\Http\Resources\Api\CMS\AICoachPage\CoursePreviewResource;
use App\Http\Resources\Api\CMS\CollaborationResource;
use App\Http\Resources\Api\CMS\TestimonialResource;
use App\Models\Document;
use App\Services\Api\CMS\AICoachPageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AICoachPageController extends Controller {
    private AICoachPageService $aiCoachPageService;
    public function __construct(AICoachPageService $aiCoachPageService) {
        $this->aiCoachPageService = $aiCoachPageService;
    }

    /**
     * Fetch, transform, and return the AI coach page data.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function index(): JsonResponse {
        try {
            // Fetch the data from the service.
            $data = $this->aiCoachPageService->getAICoachPageData();

            // Transform each piece using the corresponding resources.
            $heroSection   = new AICoachPageHeroSectionResource($data['hero_section']);
            $courses       = new CoursePreviewResource($data['courses']);
            $collaboration = new CollaborationResource($data['collaboration']);
            $testimonials  = TestimonialResource::collection($data['testimonials']);

            return Helper::jsonResponse(true, 'AI coach page data fetched successfully', 200, [
                'hero_section'  => $heroSection,
                'courses'       => $courses,
                'collaboration' => $collaboration,
                'testimonials'  => $testimonials,
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Download a document based on query parameter
     * Example: GET /page/ai-coach/documents/download?type=generate_script
     *
     * @param Request $request
     * @return BinaryFileResponse|JsonResponse
     */
    public function download(Request $request): BinaryFileResponse | JsonResponse {
        try {
            // Get the type from query parameter
            $type = $request->query('type');

            // Check if type parameter exists
            if (!$type) {
                return Helper::jsonResponse(false, 'Missing document type.', 400, [
                    'valid_types'   => ['generate_script', 'practice_pitch'],
                    'example_usage' => url('/api/cms/page/ai-coach/documents/download') . '?type=generate_script',
                ]);
            }

            // Get document info from service - this will throw exceptions for invalid types or missing files
            $documentInfo = $this->aiCoachPageService->getDocumentForDownload($type);

            // Return the file as a download
            return response()->download(public_path($documentInfo['file_path']));

        } catch (Exception $e) {
            // Get HTTP code from exception or default to 500
            $code = method_exists($e, 'getCode') && $e->getCode() >= 400 ? (int) $e->getCode() : 500;

            return Helper::jsonResponse(false, $e->getMessage(), $code, [
                'valid_types'   => ['generate_script', 'practice_pitch'],
                'example_usage' => url('/api/cms/page/ai-coach/documents/download') . '?type=generate_script',
            ]);
        }
    }
}
