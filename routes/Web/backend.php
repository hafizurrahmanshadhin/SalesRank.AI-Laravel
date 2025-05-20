<?php

use App\Http\Controllers\Web\Backend\CMS\AboutPage\AboutPageHeroSectionController;
use App\Http\Controllers\Web\Backend\CMS\AboutPage\FeatureController;
use App\Http\Controllers\Web\Backend\CMS\AboutPage\MissionStatementController;
use App\Http\Controllers\Web\Backend\CMS\AboutPage\PartnerSpotlightController;
use App\Http\Controllers\Web\Backend\CMS\AICoachPage\AICoachPageHeroSectionController;
use App\Http\Controllers\Web\Backend\CMS\AICoachPage\CourseController;
use App\Http\Controllers\Web\Backend\CMS\AICoachPage\DocumentController;
use App\Http\Controllers\Web\Backend\CMS\ConsultingPage\AIPoweredInsightsController;
use App\Http\Controllers\Web\Backend\CMS\ConsultingPage\ConsultingPageHeroSectionController;
use App\Http\Controllers\Web\Backend\CMS\ConsultingPage\GrowthStoryController;
use App\Http\Controllers\Web\Backend\CMS\ConsultingPage\SalesEvaluationController;
use App\Http\Controllers\Web\Backend\CMS\FAQ\CollaborationController;
use App\Http\Controllers\Web\Backend\CMS\FAQ\SalesRankController;
use App\Http\Controllers\Web\Backend\CMS\HomePage\BlogsPreviewController;
use App\Http\Controllers\Web\Backend\CMS\HomePage\FeatureBlockController;
use App\Http\Controllers\Web\Backend\CMS\HomePage\HomePageHeroSectionController;
use App\Http\Controllers\Web\Backend\CMS\HomePage\HomePageVideoBannerSectionController;
use App\Http\Controllers\Web\Backend\CMS\PricingPage\PricingPageHeroSectionController;
use App\Http\Controllers\Web\Backend\CMS\PricingPage\SubscriptionPlanController;
use App\Http\Controllers\Web\Backend\CMS\TestimonialController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\NewsletterController;
use Illuminate\Support\Facades\Route;

// Route for Admin Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::controller(NewsletterController::class)->prefix('newsletter')->name('newsletter.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/show/{id}', 'show')->name('show');
    Route::get('/status/{id}', 'status')->name('status');
    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
});

// CMS
Route::prefix('cms')->name('cms.')->group(function () {
    // Testimonials
    Route::controller(TestimonialController::class)->prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::patch('/update/{id}', 'update')->name('update');
        Route::get('/status/{id}', 'status')->name('status');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('faq')->name('faq.')->group(function () {
        // SalesRank.AI FAQ
        Route::controller(SalesRankController::class)->prefix('sales-rank')->name('sales-rank.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'updateSalesRankPreview')->name('preview.update');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/status/{id}', 'status')->name('status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        // Collaboration FAQ
        Route::controller(CollaborationController::class)->prefix('collaboration')->name('collaboration.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'updateCollaborationPreview')->name('preview.update');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/status/{id}', 'status')->name('status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });
    });

    // Home Page
    Route::prefix('home-page')->name('home-page.')->group(function () {
        // Hero Section
        Route::controller(HomePageHeroSectionController::class)->prefix('hero-section')->name('hero-section.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // Video Banner Section
        Route::controller(HomePageVideoBannerSectionController::class)->prefix('video-banner')->name('video-banner.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // Case Studies Section
        Route::controller(FeatureBlockController::class)->prefix('feature-blocks')->name('feature-blocks.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::get('/status/{id}', 'status')->name('status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        // Blogs Preview Section
        Route::controller(BlogsPreviewController::class)->prefix('blogs-preview')->name('blogs-preview.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'updateBlogsPreview')->name('update.blogs.preview');
            Route::get('/blog/show/{id}', 'showBlog')->name('show.blog');
            Route::post('/blog/store', 'storeBlog')->name('store.blog');
            Route::put('/blog/update/{id}', 'updateBlog')->name('update.blog');
            Route::get('/blog/status/{id}', 'status')->name('status.blog');
            Route::delete('/blog/destroy/{id}', 'destroy')->name('destroy.blog');
        });
    });

    // About Page
    Route::prefix('about-page')->name('about-page.')->group(function () {
        // Hero Section
        Route::controller(AboutPageHeroSectionController::class)->prefix('hero-section')->name('hero-section.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // Mission Statement
        Route::controller(MissionStatementController::class)->prefix('mission-statement')->name('mission-statement.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // Partner Spotlight
        Route::controller(PartnerSpotlightController::class)->prefix('partner-spotlight')->name('partner-spotlight.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // Feature Section
        Route::controller(FeatureController::class)->prefix('feature')->name('feature.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'updateAIPrompt')->name('ai.prompt.update');
            Route::get('/show/{id}', 'showFeature')->name('show');
            Route::post('/store', 'storeFeature')->name('store');
            Route::put('/update/{id}', 'updateFeature')->name('update');
            Route::get('/status/{id}', 'status')->name('status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });
    });

    // Pricing Page
    Route::prefix('pricing-page')->name('pricing-page.')->group(function () {
        // Hero Section
        Route::controller(PricingPageHeroSectionController::class)->prefix('hero-section')->name('hero-section.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // Subscription Plan
        Route::controller(SubscriptionPlanController::class)->prefix('subscription-plan')->name('subscription-plan.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/update/{id}', 'update')->name('edit');
            Route::patch('/{subscription_plan}/toggle-status', 'toggleStatus')->name('toggle-status');
            Route::patch('/{subscription_plan}/toggle-recommended', 'toggleRecommended')->name('toggle-recommended');
        });
    });

    // Consulting Page
    Route::prefix('consulting-page')->name('consulting-page.')->group(function () {
        // Hero Section
        Route::controller(ConsultingPageHeroSectionController::class)->prefix('hero-section')->name('hero-section.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // AI Powered Insights Section
        Route::controller(AIPoweredInsightsController::class)->prefix('ai-powered-insights')->name('ai-powered-insights.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::get('/status/{id}', 'status')->name('status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        // Growth Story Section
        Route::controller(GrowthStoryController::class)->prefix('growth-story')->name('growth-story.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'updateGrowthStory')->name('banner.update');
            Route::post('/store', 'store')->name('store');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::get('/status/{id}', 'status')->name('status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        // Sales Evaluation Section
        Route::controller(SalesEvaluationController::class)->prefix('sales-evaluation')->name('sales-evaluation.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'updateSalesEvaluationBanner')->name('banner.update');
            Route::get('/show/{id}', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::get('/status/{id}', 'status')->name('status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });
    });

    // AICoachPage Page
    Route::prefix('ai-coach-page')->name('ai-coach-page.')->group(function () {
        // Hero Section
        Route::controller(AICoachPageHeroSectionController::class)->prefix('hero-section')->name('hero-section.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // Documents Section
        Route::controller(DocumentController::class)->prefix('documents')->name('documents.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // Course Section
        Route::controller(CourseController::class)->prefix('course')->name('course.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'updateCoursePreview')->name('preview.update');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::get('/status/{id}', 'status')->name('status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });
    });
});
