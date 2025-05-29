@extends('backend.app')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .gradient-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .gradient-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 70%);
            z-index: -1;
        }

        .gradient-card-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .gradient-card-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .gradient-card-4 {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stat-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .chart-container {
            position: relative;
            height: 350px;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .status-active {
            color: #28a745;
        }

        .status-inactive {
            color: #dc3545;
        }

        .status-pending {
            color: #ffc107;
        }

        .modern-table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .progress-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            font-size: 1.5rem;
        }

        .data-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .data-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .trend-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .avatar-status {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .active-dot {
            background: #28a745;
        }

        .inactive-dot {
            background: #dc3545;
        }

        .user-avatar {
            position: relative;
            width: 40px;
            height: 40px;
        }

        .activity-indicator {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #4facfe;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: bold;
        }

        .glow-primary {
            box-shadow: 0 0 15px rgba(79, 172, 254, 0.5);
        }
    </style>
@endpush

@section('content')
    <div class="page-content wrapper">
        <div class="container-fluid">

            <!-- Welcome Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1 font-size-22 fw-bold">Welcome back! 👋</h4>
                            <p class="text-muted mb-0">Here's what's happening with your platform today</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="badge bg-success pulse">Live</span>
                            </div>
                            <span class="text-muted">{{ now()->format('l, F j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card gradient-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="progress-circle">
                                        <i class="ri-user-line"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-uppercase mb-1 opacity-75">Total Users</h6>
                                    <h2 class="mb-0 counter-value" data-target="{{ $totalUsers }}">0</h2>
                                    <div class="mt-2">
                                        <span class="trend-badge bg-white text-dark">
                                            <i class="ri-arrow-up-line text-success"></i>
                                            +{{ $newUsersThisMonth }} this month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card gradient-card-2">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="progress-circle">
                                        <i class="ri-user-star-line"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-uppercase mb-1 opacity-75">Consultants</h6>
                                    <h2 class="mb-0 counter-value" data-target="{{ $totalConsultants }}">0</h2>
                                    <div class="mt-2">
                                        <span class="trend-badge bg-white text-dark">
                                            Avg Score: {{ number_format($averageAIScore, 1) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card gradient-card-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="progress-circle">
                                        <i class="ri-book-open-line"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-uppercase mb-1 opacity-75">Active Courses</h6>
                                    <h2 class="mb-0 counter-value" data-target="{{ $activeCourses }}">0</h2>
                                    <div class="mt-2">
                                        <span class="trend-badge bg-white text-dark">
                                            {{ $totalCourses }} Total
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card gradient-card-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="progress-circle">
                                        <i class="ri-mail-line"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-uppercase mb-1 opacity-75">Subscribers</h6>
                                    <h2 class="mb-0 counter-value" data-target="{{ $newsletterSubscribers }}">0</h2>
                                    <div class="mt-2">
                                        <span class="trend-badge bg-white text-dark">
                                            Newsletter
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row mb-4">
                <!-- User Registration Trend -->
                <div class="col-xl-6 mb-4">
                    <div class="card data-card">
                        <div class="card-header border-0 bg-white pt-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title fw-bold mb-0">User Registration Trend</h5>
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown">
                                        Last 6 Months
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="userTrendChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blog Creation Trend -->
                <div class="col-xl-6 mb-4">
                    <div class="card data-card">
                        <div class="card-header border-0 bg-white pt-3">
                            <h5 class="card-title fw-bold mb-0">Content Creation Trend</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="blogTrendChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Statistics -->
            <div class="row mb-4">
                <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                    <div class="card data-card">
                        <div class="card-body text-center p-3">
                            <div class="mx-auto mb-3">
                                <div
                                    class="avatar-md bg-soft-primary rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-article-line text-primary fs-4"></i>
                                </div>
                            </div>
                            <h4 class="counter-value mb-1" data-target="{{ $publishedBlogs }}">0</h4>
                            <p class="text-muted mb-0">Published Blogs</p>
                            <small class="text-muted">{{ $totalBlogs }} Total</small>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                    <div class="card data-card">
                        <div class="card-body text-center p-3">
                            <div class="mx-auto mb-3">
                                <div
                                    class="avatar-md bg-soft-warning rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-star-line text-warning fs-4"></i>
                                </div>
                            </div>
                            <h4 class="counter-value mb-1" data-target="{{ $activeTestimonials }}">0</h4>
                            <p class="text-muted mb-0">Testimonials</p>
                            <small class="text-muted">{{ $totalTestimonials }} Total</small>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                    <div class="card data-card">
                        <div class="card-body text-center p-3">
                            <div class="mx-auto mb-3">
                                <div
                                    class="avatar-md bg-soft-info rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-briefcase-line text-info fs-4"></i>
                                </div>
                            </div>
                            <h4 class="counter-value mb-1" data-target="{{ $activePortfolios }}">0</h4>
                            <p class="text-muted mb-0">Portfolios</p>
                            <small class="text-muted">{{ $totalPortfolios }} Total</small>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                    <div class="card data-card">
                        <div class="card-body text-center p-3">
                            <div class="mx-auto mb-3">
                                <div
                                    class="avatar-md bg-soft-success rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-file-text-line text-success fs-4"></i>
                                </div>
                            </div>
                            <h4 class="counter-value mb-1" data-target="{{ $publishedContent }}">0</h4>
                            <p class="text-muted mb-0">Content Pages</p>
                            <small class="text-muted">{{ $totalContent }} Total</small>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                    <div class="card data-card">
                        <div class="card-body text-center p-3">
                            <div class="mx-auto mb-3">
                                <div
                                    class="avatar-md bg-soft-secondary rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-question-line text-secondary fs-4"></i>
                                </div>
                            </div>
                            <h4 class="counter-value mb-1" data-target="{{ $totalFAQs }}">0</h4>
                            <p class="text-muted mb-0">FAQs</p>
                            <small class="text-muted">Help Center</small>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                    <div class="card data-card">
                        <div class="card-body text-center p-3">
                            <div class="mx-auto mb-3">
                                <div
                                    class="avatar-md bg-soft-purple rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-user-settings-line text-purple fs-4"></i>
                                </div>
                            </div>
                            <h4 class="counter-value mb-1" data-target="{{ $usersWithProfiles }}">0</h4>
                            <p class="text-muted mb-0">User Profiles</p>
                            <small class="text-muted">Complete Profiles</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Row -->
            <div class="row mb-4">
                <!-- User Role Distribution -->
                <div class="col-xl-4 mb-4">
                    <div class="card data-card">
                        <div class="card-header border-0 bg-white pt-3">
                            <h5 class="card-title fw-bold mb-0">User Role Distribution</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="userRoleChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Consultant Industries -->
                <div class="col-xl-4 mb-4">
                    <div class="card data-card">
                        <div class="card-header border-0 bg-white pt-3">
                            <h5 class="card-title fw-bold mb-0">Top Industries</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($consultantIndustries->take(5) as $industry)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $industry->industry ?: 'Other' }}</h6>
                                        <div class="progress bg-soft-primary" style="height: 8px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ ($industry->count / $consultantIndustries->max('count')) * 100 }}%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-3">
                                        <span class="badge bg-primary rounded-pill">{{ $industry->count }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Top Consultants -->
                <div class="col-xl-4 mb-4">
                    <div class="card data-card">
                        <div class="card-header border-0 bg-white pt-3">
                            <h5 class="card-title fw-bold mb-0">Top Consultants</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($topConsultants as $index => $consultant)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-sm position-relative">
                                            <span class="avatar-title rounded-circle bg-soft-primary text-primary fs-4">
                                                {{ substr($consultant->full_name ?? 'N/A', 0, 1) }}
                                            </span>
                                            <span class="avatar-status active-dot"></span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ $consultant->full_name ?? 'N/A' }}</h6>
                                        <p class="text-muted mb-0 small">{{ $consultant->job_title ?? 'Consultant' }}</p>
                                        <small class="text-muted">{{ $consultant->company ?? 'N/A' }}</small>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span
                                            class="badge bg-success rounded-pill">{{ number_format($consultant->ai_score, 1) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="row">
                <!-- Recent Users -->
                <div class="col-xl-6 mb-4">
                    <div class="card data-card">
                        <div class="card-header border-0 bg-white pt-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title fw-bold mb-0">Recent Users</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover mb-0">
                                    <tbody>
                                        @foreach ($recentUsers as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="user-avatar position-relative">
                                                            <img src="{{ $user->avatar }}" alt="avatar"
                                                                class="rounded-circle avatar-xs">
                                                            <span
                                                                class="avatar-status {{ $user->status == 'active' ? 'active-dot' : 'inactive-dot' }}"></span>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h6 class="mb-0">{{ $user->first_name }}
                                                                {{ $user->last_name }}</h6>
                                                            <small class="text-muted">{{ $user->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-soft-info text-info">
                                                        {{ ucfirst($user->role ?? 'User') }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <small
                                                        class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Blogs -->
                <div class="col-xl-6 mb-4">
                    <div class="card data-card">
                        <div class="card-header border-0 bg-white pt-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title fw-bold mb-0">Recent Blogs</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover mb-0">
                                    <tbody>
                                        @foreach ($recentBlogs as $blog)
                                            <tr>
                                                <td>
                                                    <div>
                                                        <h6 class="mb-1">{{ Str::limit($blog->title, 40) }}</h6>
                                                        <small
                                                            class="text-muted">{{ Str::limit($blog->description, 50) }}</small>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    @if ($blog->status == 'published')
                                                        <span class="badge bg-soft-success text-success">Published</span>
                                                    @elseif($blog->status == 'draft')
                                                        <span class="badge bg-soft-warning text-warning">Draft</span>
                                                    @else
                                                        <span class="badge bg-soft-secondary text-secondary">
                                                            {{ ucfirst($blog->status ?? 'Draft') }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <small
                                                        class="text-muted">{{ $blog->created_at->diffForHumans() }}</small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Activities -->
            <div class="row">
                <!-- Recent Testimonials -->
                <div class="col-xl-6 mb-4">
                    <div class="card data-card">
                        <div class="card-header border-0 bg-white pt-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title fw-bold mb-0">Recent Testimonials</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($recentTestimonials as $testimonial)
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start">
                                                    @if ($testimonial->image)
                                                        <img src="{{ asset('storage/' . $testimonial->image) }}"
                                                            alt="testimonial" class="rounded-circle avatar-md me-3">
                                                    @else
                                                        <div class="avatar-md me-3">
                                                            <span class="avatar-title rounded-circle bg-primary fs-4">
                                                                {{ substr($testimonial->name, 0, 1) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-1">{{ $testimonial->name }}</h6>
                                                        <p class="text-muted mb-1 small">{{ $testimonial->title }}</p>
                                                        <div class="d-flex align-items-center">
                                                            <div class="text-warning small">
                                                                @for ($i = 0; $i < 5; $i++)
                                                                    <i class="ri-star-fill"></i>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-3 mb-0 small text-muted">
                                                    {!! Str::limit($testimonial->description, 100) !!}
                                                </p>
                                            </div>
                                            <div class="card-footer bg-transparent border-top">
                                                <small
                                                    class="text-muted">{{ $testimonial->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Newsletter Subscriptions -->
                <div class="col-xl-6 mb-4">
                    <div class="card data-card">
                        <div class="card-header border-0 bg-white pt-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title fw-bold mb-0">Recent Subscribers</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($recentNewsletters as $newsletter)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0 position-relative">
                                        <div class="avatar-sm">
                                            <span class="avatar-title rounded-circle bg-soft-info text-info">
                                                {{ substr($newsletter->name, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">{{ $newsletter->name }}</h6>
                                        <p class="text-muted mb-0 small">{{ $newsletter->email }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <small class="text-muted">{{ $newsletter->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
    <script>
        // $(document).ready(function() {
        //     Echo.private('chat.' + 1).listen('MessageSent', (e) => {
        //         console.log(e);
        //     })
        //     Echo.private('chat.' + 3).listen('MessageSent', (e) => {
        //         console.log(e);
        //     })
        // });

        $(document).ready(function(){
            Echo.private('chat.' + {{ auth()->id() }})
                .listen('MessageSent', (e) => {
                    console.log(e);
                    // You can add your custom logic here to handle the event
                });
            Echo.private('chat.' + {{ auth()->id() }})
                .listen('UserOnline', (e) => {
                    console.log('User is online:', e.user);
                    // Update UI or perform actions based on user online status
                });
            Echo.private('chat.' + {{ auth()->id() }})
                .listen('UserOffline', (e) => {
                    console.log('User is offline:', e.user);
                    // Update UI or perform actions based on user offline status
                });
            Echo.private('chat.' + {{ auth()->id() }})
                .listen('UserTyping', (e) => {
                    console.log('User is typing:', e.user);
                    // Update UI to show typing indicator
                });
        })
    </script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart Colors
            const colors = {
                primary: '#667eea',
                secondary: '#764ba2',
                success: '#43e97b',
                info: '#4facfe',
                warning: '#f093fb',
                danger: '#f5576c',
                gradient: ['#667eea', '#764ba2', '#f093fb', '#f5576c']
            };

            // Counter animation
            const counters = document.querySelectorAll('.counter-value');
            const speed = 200;

            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(() => {
                        counter.innerText = target.toLocaleString();
                    }, 1);
                } else {
                    counter.innerText = target.toLocaleString();
                }
            });

            // Data from backend
            const userTrendData = @json($monthlyUserStats);
            const blogTrendData = @json($monthlyBlogStats);
            const userRoleData = @json($userRoleDistribution);

            // 1. User Registration Trend (Line Chart)
            const userCtx = document.getElementById('userTrendChart').getContext('2d');
            new Chart(userCtx, {
                type: 'line',
                data: {
                    labels: userTrendData.map(item => item.month),
                    datasets: [{
                        label: 'New Users',
                        data: userTrendData.map(item => item.count),
                        fill: true,
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderColor: colors.primary,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderWidth: 3,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 15,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6c757d'
                            }
                        },
                        y: {
                            ticks: {
                                color: '#6c757d'
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        }
                    }
                }
            });

            // 2. Content Creation Trend (Bar Chart)
            const blogCtx = document.getElementById('blogTrendChart').getContext('2d');
            new Chart(blogCtx, {
                type: 'bar',
                data: {
                    labels: blogTrendData.map(item => item.month),
                    datasets: [{
                        label: 'New Posts',
                        data: blogTrendData.map(item => item.count),
                        backgroundColor: colors.gradient.map((color, i) => {
                            const gradient = blogCtx.createLinearGradient(0, 0, 0, 300);
                            gradient.addColorStop(0, color);
                            gradient.addColorStop(1, `${color}80`);
                            return gradient;
                        }),
                        borderColor: 'transparent',
                        borderRadius: 10,
                        borderWidth: 0,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6c757d'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#6c757d'
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        }
                    }
                }
            });

            // 3. User Role Distribution (Doughnut Chart)
            const roleCtx = document.getElementById('userRoleChart').getContext('2d');
            new Chart(roleCtx, {
                type: 'doughnut',
                data: {
                    labels: userRoleData.map(item => item.role),
                    datasets: [{
                        data: userRoleData.map(item => item.count),
                        backgroundColor: [
                            colors.primary,
                            colors.info,
                            colors.success,
                            colors.warning,
                            colors.danger
                        ],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    size: 13
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
