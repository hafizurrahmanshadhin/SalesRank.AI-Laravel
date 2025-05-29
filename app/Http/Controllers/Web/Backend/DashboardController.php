<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Consultant;
use App\Models\Content;
use App\Models\Course;
use App\Models\FAQ;
use App\Models\Newsletter;
use App\Models\Portfolio;
use App\Models\Profile;
use App\Models\SubscriptionPlan;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller {
    /**
     * Display the dashboard page.
     *
     * @return View
     */
    public function index(): View {
        // User Statistics
        $totalUsers        = User::count();
        $activeUsers       = User::where('status', 'active')->count();
        $newUsersThisMonth = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $usersWithProfiles = Profile::count();

        // Consultant Statistics
        $totalConsultants   = Consultant::count();
        $topConsultants     = Consultant::orderBy('ai_score', 'desc')->limit(5)->get();
        $consultantsByLevel = Consultant::selectRaw('ranking_level, COUNT(*) as count')
            ->groupBy('ranking_level')
            ->get();

        // Content Statistics
        $totalCourses     = Course::count();
        $activeCourses    = Course::where('status', 'active')->count();
        $totalBlogs       = Blog::count();
        $publishedBlogs   = Blog::where('status', 'published')->count();
        $totalContent     = Content::count();
        $publishedContent = Content::where('status', 'published')->count();

        // Engagement Statistics
        $totalTestimonials     = Testimonial::count();
        $activeTestimonials    = Testimonial::where('status', 'active')->count();
        $newsletterSubscribers = Newsletter::where('status', 'active')->count();
        $totalPortfolios       = Portfolio::count();
        $activePortfolios      = Portfolio::where('status', 'active')->count();

        // Subscription Statistics
        $subscriptionPlans = SubscriptionPlan::where('status', 'active')->get();
        $totalFAQs         = FAQ::count();

        // Recent Activities
        $recentUsers        = User::latest()->limit(5)->get();
        $recentConsultants  = Consultant::with('user')->latest()->limit(5)->get();
        $recentBlogs        = Blog::latest()->limit(5)->get();
        $recentNewsletters  = Newsletter::latest()->limit(5)->get();
        $recentTestimonials = Testimonial::latest()->limit(5)->get();

        // Monthly User Registration Trend (last 6 months)
        $monthlyUserStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date               = Carbon::now()->subMonths($i);
            $monthlyUserStats[] = [
                'month' => $date->format('M Y'),
                'count' => User::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
            ];
        }

        // Course Level Distribution
        $courseLevels = Course::selectRaw('course_level, COUNT(*) as count')
            ->groupBy('course_level')
            ->get();

        // Additional Analytics
        $userRoleDistribution = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->get();

        $consultantIndustries = Consultant::selectRaw('industry, COUNT(*) as count')
            ->whereNotNull('industry')
            ->groupBy('industry')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        $monthlyBlogStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date               = Carbon::now()->subMonths($i);
            $monthlyBlogStats[] = [
                'month' => $date->format('M Y'),
                'count' => Blog::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
            ];
        }

        $averageAIScore     = Consultant::avg('ai_score') ?? 0;
        $portfoliosByStatus = Portfolio::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        return view('backend.layouts.dashboard.index', compact(
            'totalUsers',
            'activeUsers',
            'newUsersThisMonth',
            'usersWithProfiles',
            'totalConsultants',
            'topConsultants',
            'consultantsByLevel',
            'totalCourses',
            'activeCourses',
            'totalBlogs',
            'publishedBlogs',
            'totalContent',
            'publishedContent',
            'totalTestimonials',
            'activeTestimonials',
            'newsletterSubscribers',
            'totalPortfolios',
            'activePortfolios',
            'subscriptionPlans',
            'totalFAQs',
            'recentUsers',
            'recentConsultants',
            'recentBlogs',
            'recentNewsletters',
            'recentTestimonials',
            'monthlyUserStats',
            'courseLevels',
            'userRoleDistribution',
            'consultantIndustries',
            'monthlyBlogStats',
            'averageAIScore',
            'portfoliosByStatus'
        ));
    }
}
