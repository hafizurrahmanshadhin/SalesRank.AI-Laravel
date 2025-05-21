<?php

namespace App\Services\Api\CMS;

use App\Models\AICoachPageHeroSection;
use App\Models\Collaboration;
use App\Models\CoursePreview;
use App\Models\Document;
use App\Models\Testimonial;
use Exception;
use Illuminate\Support\Facades\File;

class AICoachPageService {
    /**
     * Fetch and prepare data for the AI Coach page.
     *
     * @return array
     * @throws Exception
     */
    public function getAICoachPageData(): array {
        try {
            $heroSection   = AICoachPageHeroSection::first();
            $courses       = CoursePreview::first();
            $collaboration = Collaboration::first();
            $testimonials  = Testimonial::where('status', 'active')->get();

            return [
                'hero_section'  => $heroSection,
                'courses'       => $courses,
                'collaboration' => $collaboration,
                'testimonials'  => $testimonials,
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get document for download based on type
     *
     * @param string $type Document type (generate_script or practice_pitch)
     * @return array Information about the document
     * @throws Exception If document is invalid or doesn't exist
     */
    public function getDocumentForDownload(string $type): array {
        try {
            $validTypes = ['generate_script', 'practice_pitch'];

            // Check if type is valid
            if (!in_array($type, $validTypes, true)) {
                throw new Exception('Invalid document type.', 400);
            }

            // Fetch document from database
            $document = Document::first();

            // Check if document exists and has the requested file
            if (!$document || empty($document->$type)) {
                throw new Exception("No $type document found in the database.", 404);
            }

            $filePath = $document->$type;

            // Verify the file exists in the filesystem
            if (!File::exists(public_path($filePath))) {
                throw new Exception("The $type file exists in the database but not on the server.", 404);
            }

            return [
                'file_path' => $filePath,
                'type'      => $type,
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
