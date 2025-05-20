<?php

namespace App\Http\Controllers\Api\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CMS\FAQResource;
use App\Http\Resources\Api\CMS\HomePage\BlogResource;
use App\Http\Resources\Api\CMS\HomePage\BlogsPreviewResource;
use App\Http\Resources\Api\CMS\HomePage\FeatureBlockResource;
use App\Http\Resources\Api\CMS\HomePage\HomePageHeroSectionResource;
use App\Http\Resources\Api\CMS\HomePage\HomePageVideoBannerSectionResource;
use App\Http\Resources\Api\CMS\SalesRankAIResource;
use App\Http\Resources\Api\CMS\TestimonialResource;
use App\Models\Blog;
use App\Models\BlogsPreview;
use App\Models\FAQ;
use App\Models\FeatureBlock;
use App\Models\HomePageHeroSection;
use App\Models\HomePageVideoBannerSection;
use App\Models\SalesRankAI;
use App\Models\Testimonial;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class HomePageController extends Controller {
    /**
     * Fetch home page data.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request): JsonResponse {
        try {
            // Fetch hero section and video banner section
            $heroSection        = new HomePageHeroSectionResource(HomePageHeroSection::first());
            $videoBannerSection = new HomePageVideoBannerSectionResource(HomePageVideoBannerSection::first());

            // Fetch all active feature blocks
            $allActiveBlocks = FeatureBlock::where('status', 'active')->get();

            // Calculate total number of images across all blocks
            $totalImagesCount = $allActiveBlocks->sum(function ($block) {
                return is_array($block->images) ? count($block->images) : 0;
            });

            // Map feature blocks using a resource
            $blocks = FeatureBlockResource::collection($allActiveBlocks);

            // Filter images based on category query parameter
            $categoryFilter = $request->query('category');
            $filteredData   = $this->getFilteredData($allActiveBlocks, $categoryFilter);

            // If category filter is provided but no match is found, return an error response
            if ($categoryFilter && !$filteredData['category']) {
                return Helper::jsonResponse(false, 'Invalid category. Please provide a valid category.', 422, [
                    'valid_categories' => $blocks->toArray($request),
                ]);
            }

            // Fetch all active testimonials
            $testimonials = TestimonialResource::collection(Testimonial::where('status', 'active')->get());

            // Fetch SalesRankAI data (assuming only one record exists)
            $salesRankAI     = SalesRankAI::first();
            $salesRankAIData = $salesRankAI ? new SalesRankAIResource($salesRankAI) : null;

            // Fetch FAQs related to SalesRankAI
            $faqs = FAQResource::collection(FAQ::where('status', 'active')->where('type', 'SalesRank')->latest()->take(4)->get());

            // Fetch BlogsPreview data (assuming only one record exists)
            $blogsPreview     = BlogsPreview::first();
            $blogsPreviewData = $blogsPreview ? new BlogsPreviewResource($blogsPreview) : null;

            // Fetch Blog related to BlogsPreview
            $blogs = BlogResource::collection(Blog::where('status', 'active')->get());

            // Return the response
            return Helper::jsonResponse(true, 'Home page data fetched successfully', 200, [
                'hero_section'          => $heroSection,
                'video_banner_section'  => $videoBannerSection,
                'feature_blocks'        => [
                    'all_work' => $totalImagesCount,
                    'blocks'   => $blocks,
                    'category' => $filteredData['category'],
                    'images'   => $filteredData['images'],
                ],
                'testimonials'          => $testimonials,
                'sales_rank_ai'         => [
                    'id'          => $salesRankAIData->id ?? null,
                    'title'       => $salesRankAIData->title ?? null,
                    'description' => $salesRankAIData->description ?? null,
                    'faqs'        => $faqs,
                ],
                'blogs_preview_section' => [
                    'id'          => $blogsPreviewData->id ?? null,
                    'title'       => $blogsPreviewData->title ?? null,
                    'description' => $blogsPreviewData->description ?? null,
                    'blogs'       => $blogs,
                ],
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Get filtered data (images and category) based on category.
     *
     * @param Collection $blocks
     * @param string|null $categoryFilter
     * @return array
     */
    private function getFilteredData($blocks, $categoryFilter): array {
        try {
            if ($categoryFilter) {
                $filteredBlocks = $blocks->filter(function ($block) use ($categoryFilter) {
                    return $block->category === $categoryFilter; // Match full category name
                });

                $firstBlock = $filteredBlocks->first();
                $images     = is_array($firstBlock->images ?? null) ? $this->getFullImageUrls($firstBlock->images) : [];
                $category   = $firstBlock->category ?? null;

                return [
                    'images'   => $images,
                    'category' => $category,
                ];
            }

            $images = $blocks->flatMap(function ($block) {
                return is_array($block->images) ? $this->getFullImageUrls($block->images) : [];
            })->toArray();

            return [
                'images'   => $images,
                'category' => null,
            ];
        } catch (Exception $e) {
            return [
                'images'   => [],
                'category' => null,
                'error'    => $e->getMessage(),
            ];
        }
    }

    /**
     * Convert image paths to full URLs.
     *
     * @param array $images
     * @return array
     */
    private function getFullImageUrls(array $images): array {
        try {
            return array_map(function ($image) {
                return url($image); // Generate full URL for each image
            }, $images);
        } catch (Exception $e) {
            return []; // Return an empty array if an error occurs
        }
    }

    /**
     * Fetch all active FAQs related to SalesRank.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function FAQList(): JsonResponse {
        try {
            $faqs = FAQResource::collection(FAQ::where('status', 'active')->where('type', 'SalesRank')->latest()->get());

            return Helper::jsonResponse(true, 'FAQ list fetched successfully', 200, $faqs);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
