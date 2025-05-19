@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<style>
    .navbar-menu .navbar-nav .nav-sm .nav-link:before {
        display: none;
    }
</style>

<div class="app-menu navbar-menu">
    {{-- Logo & Toggle Button --}}
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo.png') }}" alt="Logo" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo.png') }}" alt="Logo" height="40">
            </span>
        </a>

        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo.png') }}" alt="Logo" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo.png') }}" alt="Logo" height="40">
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>

        <div class="vertical-menu-btn-wrapper header-item vertical-icon">
            <button type="button"
                class="btn btn-sm px-0 fs-xl vertical-menu-btn topnav-hamburger shadow hamburger-icon"
                id="topnav-hamburger-icon">
                <i class='bx bx-chevrons-right'></i>
                <i class='bx bx-chevrons-left'></i>
            </button>
        </div>
    </div>
    {{-- Logo & Toggle Button --}}

    <div id="scrollbar">
        {{-- Sidebar Start --}}
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="ri-dashboard-line"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                {{-- CMS --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/cms/*') ? 'active' : '' }}" href="#sidebarCms"
                        data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->is('admin/cms/*') ? 'true' : 'false' }}"
                        aria-controls="sidebarCms">
                        <i class="ri-file-list-line"></i>
                        <span data-key="t-cms">CMS</span>
                    </a>

                    <div class="collapse menu-dropdown {{ request()->is('admin/cms/*') ? 'show' : '' }}"
                        id="sidebarCms">
                        <ul class="nav nav-sm flex-column">
                            {{-- Testimonials --}}
                            <li class="nav-item">
                                <a href="{{ route('cms.testimonials.index') }}"
                                    class="nav-link {{ request()->routeIs('cms.testimonials.*') ? 'active' : '' }}"
                                    data-key="t-testimonials" style="white-space: nowrap">
                                    <i class="ri-chat-smile-3-line me-1"></i>
                                    Testimonials
                                </a>
                            </li>

                            {{-- FAQ --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->is('admin/cms/faq*') ? 'active' : '' }}"
                                    href="#sidebarFaq" data-bs-toggle="collapse" role="button"
                                    aria-expanded="{{ request()->is('admin/cms/faq*') ? 'true' : 'false' }}"
                                    aria-controls="sidebarFaq">
                                    <i class="ri-question-line"></i>
                                    <span data-key="t-faq">FAQ</span>
                                </a>

                                <div class="collapse menu-dropdown {{ request()->is('admin/cms/faq*') ? 'show' : '' }}"
                                    id="sidebarFaq">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('cms.faq.sales-rank.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.faq.sales-rank*') ? 'active' : '' }}"
                                                data-key="t-sales-rank">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-sales-rank">SalesRank.AI</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ route('cms.faq.collaboration.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.faq.collaboration*') ? 'active' : '' }}"
                                                data-key="t-collaboration">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-collaboration">Collaboration</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Home Page --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->is('admin/cms/home-page*') ? 'active' : '' }}"
                                    href="#sidebarHomePage" data-bs-toggle="collapse" role="button"
                                    aria-expanded="{{ request()->is('admin/cms/home-page*') ? 'true' : 'false' }}"
                                    aria-controls="sidebarHomePage">
                                    <i class="ri-home-4-line me-1"></i>
                                    <span data-key="t-home-page">Home Page</span>
                                </a>

                                <div class="collapse menu-dropdown {{ request()->is('admin/cms/home-page*') ? 'show' : '' }}"
                                    id="sidebarHomePage">
                                    <ul class="nav nav-sm flex-column">
                                        {{-- Hero Section --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.home-page.hero-section.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.home-page.hero-section.*') ? 'active' : '' }}"
                                                data-key="t-hero-section">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-hero-section">Hero Section</span>
                                            </a>
                                        </li>

                                        {{-- Video Banner --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.home-page.video-banner.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.home-page.video-banner.*') ? 'active' : '' }}"
                                                data-key="t-video-banner">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-video-banner">Video Banner Section</span>
                                            </a>
                                        </li>

                                        {{-- Feature Blocks --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.home-page.feature-blocks.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.home-page.feature-blocks.*') ? 'active' : '' }}"
                                                data-key="t-feature-blocks">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-feature-blocks">Feature Blocks Section</span>
                                            </a>
                                        </li>

                                        {{-- Blogs Preview --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.home-page.blogs-preview.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.home-page.blogs-preview.*') ? 'active' : '' }}"
                                                data-key="t-blogs-preview">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-blogs-preview">Blogs Preview Section</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- About Page --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->is('admin/cms/about-page*') ? 'active' : '' }}"
                                    href="#sidebarAboutPage" data-bs-toggle="collapse" role="button"
                                    aria-expanded="{{ request()->is('admin/cms/about-page*') ? 'true' : 'false' }}"
                                    aria-controls="sidebarAboutPage">
                                    <i class="ri-information-line me-1"></i>
                                    <span data-key="t-about-page">About Page</span>
                                </a>

                                <div class="collapse menu-dropdown {{ request()->is('admin/cms/about-page*') ? 'show' : '' }}"
                                    id="sidebarAboutPage">
                                    <ul class="nav nav-sm flex-column">
                                        {{-- Hero Section --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.about-page.hero-section.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.about-page.hero-section.*') ? 'active' : '' }}"
                                                data-key="t-hero-section">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-hero-section">Hero Section</span>
                                            </a>
                                        </li>

                                        {{-- Mission Statement --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.about-page.mission-statement.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.about-page.mission-statement.*') ? 'active' : '' }}"
                                                data-key="t-mission-statement">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-mission-statement">Mission Statement</span>
                                            </a>
                                        </li>

                                        {{-- Partner Spotlight --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.about-page.partner-spotlight.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.about-page.partner-spotlight.*') ? 'active' : '' }}"
                                                data-key="t-partner-spotlight">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-partner-spotlight">Partner Spotlight</span>
                                            </a>
                                        </li>

                                        {{-- Features --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.about-page.feature.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.about-page.feature.*') ? 'active' : '' }}"
                                                data-key="t-feature">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-feature">Features Section</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Pricing Page --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->is('admin/cms/pricing-page*') ? 'active' : '' }}"
                                    href="#sidebarPricingPage" data-bs-toggle="collapse" role="button"
                                    aria-expanded="{{ request()->is('admin/cms/pricing-page*') ? 'true' : 'false' }}"
                                    aria-controls="sidebarPricingPage">
                                    <i class="ri-price-tag-3-line me-1"></i>
                                    <span data-key="t-pricing-page">Pricing Page</span>
                                </a>

                                <div class="collapse menu-dropdown {{ request()->is('admin/cms/pricing-page*') ? 'show' : '' }}"
                                    id="sidebarPricingPage">
                                    <ul class="nav nav-sm flex-column">
                                        {{-- Hero Section --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.pricing-page.hero-section.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.pricing-page.hero-section.*') ? 'active' : '' }}"
                                                data-key="t-hero-section">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-hero-section">Hero Section</span>
                                            </a>
                                        </li>

                                        {{-- Subscription Plan --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.pricing-page.subscription-plan.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.pricing-page.subscription-plan.*') ? 'active' : '' }}"
                                                data-key="t-subscription-plan">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-subscription-plan"
                                                    style="white-space: nowrap;">Subscription Plan</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Consulting Page --}}
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ request()->is('admin/cms/consulting-page*') ? 'active' : '' }}"
                                    href="#sidebarConsultingPage" data-bs-toggle="collapse" role="button"
                                    aria-expanded="{{ request()->is('admin/cms/consulting-page*') ? 'true' : 'false' }}"
                                    aria-controls="sidebarConsultingPage">
                                    <i class="ri-discuss-line me-1"></i>
                                    <span data-key="t-consulting-page">Consulting Page</span>
                                </a>

                                <div class="collapse menu-dropdown {{ request()->is('admin/cms/consulting-page*') ? 'show' : '' }}"
                                    id="sidebarConsultingPage">
                                    <ul class="nav nav-sm flex-column">
                                        {{-- Hero Section --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.consulting-page.hero-section.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.consulting-page.hero-section.*') ? 'active' : '' }}"
                                                data-key="t-hero-section">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-hero-section">Hero Section</span>
                                            </a>
                                        </li>

                                        {{-- AI Powered Insights Section --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.consulting-page.ai-powered-insights.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.consulting-page.ai-powered-insights.*') ? 'active' : '' }}"
                                                data-key="t-hero-section">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-hero-section">AI Powered Insights Section</span>
                                            </a>
                                        </li>

                                        {{-- Growth Story Section --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.consulting-page.growth-story.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.consulting-page.growth-story.*') ? 'active' : '' }}"
                                                data-key="t-growth-story">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-growth-story">Growth Story Section</span>
                                            </a>
                                        </li>

                                        {{-- Sales Evaluation Section --}}
                                        <li class="nav-item">
                                            <a href="{{ route('cms.consulting-page.sales-evaluation.index') }}"
                                                class="nav-link {{ request()->routeIs('cms.consulting-page.sales-evaluation.*') ? 'active' : '' }}"
                                                data-key="t-sales-evaluation">
                                                <i class="ri-checkbox-blank-circle-fill"
                                                    style="font-size:0.6rem; margin-right:-0.6rem;"></i>
                                                <span data-key="t-sales-evaluation">Sales Evaluation Section</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Newsletter Subscriber --}}
                <li class="nav-item">
                    <a href="{{ route('newsletter.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('newsletter.index') ? 'active' : '' }}"
                        data-key="t-newsletter-subscriber">
                        <i class="ri-mail-send-line"></i>
                        <span data-key="t-newsletter-subscriber">Newsletter Subscriber</span>
                    </a>
                </li>

                <hr>
                {{-- Settings --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/settings*') ? 'active' : '' }}"
                        href="#sidebarPages" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->is('admin/settings*') ? 'true' : 'false' }}"
                        aria-controls="sidebarPages">
                        <i class="ri-settings-3-line"></i>
                        <span data-key="t-pages">Settings</span>
                    </a>

                    <div class="collapse menu-dropdown {{ request()->is('admin/settings*') ? 'show' : '' }}"
                        id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('profile.setting') }}"
                                    class="nav-link {{ request()->routeIs('profile.setting') ? 'active' : '' }}"
                                    data-key="t-profile-setting">
                                    <i class="ri-checkbox-blank-circle-fill"
                                        style="font-size:0.4rem; margin-right:-1rem;"></i>
                                    <span data-key="t-profile-setting">Profile Settings</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('system.index') }}"
                                    class="nav-link {{ request()->routeIs('system.index') ? 'active' : '' }}"
                                    data-key="t-system-settings">
                                    <i class="ri-checkbox-blank-circle-fill"
                                        style="font-size:0.4rem; margin-right:-1rem;"></i>
                                    <span data-key="t-system-settings">System Settings</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('mail.setting') }}"
                                    class="nav-link {{ request()->routeIs('mail.setting') ? 'active' : '' }}"
                                    data-key="t-smtp-server">
                                    <i class="ri-checkbox-blank-circle-fill"
                                        style="font-size:0.4rem; margin-right:-1rem;"></i>
                                    <span data-key="t-smtp-server">SMTP Server</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('integration.setting') }}"
                                    class="nav-link {{ request()->routeIs('integration.setting') ? 'active' : '' }}"
                                    data-key="t-integration-settings">
                                    <i class="ri-checkbox-blank-circle-fill"
                                        style="font-size:0.4rem; margin-right:-1rem;"></i>
                                    <span data-key="t-integration-settings">Integration Settings</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('social.index') }}"
                                    class="nav-link {{ request()->routeIs('social.index') ? 'active' : '' }}"
                                    data-key="t-social-media-settings">
                                    <i class="ri-checkbox-blank-circle-fill"
                                        style="font-size:0.4rem; margin-right:-1rem;"></i>
                                    <span data-key="t-social-media-settings">Social Media Settings</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('settings.dynamic_page.index') }}"
                                    class="nav-link {{ request()->routeIs('settings.dynamic_page.*') ? 'active' : '' }}"
                                    data-key="t-dynamic-page-settings">
                                    <i class="ri-checkbox-blank-circle-fill"
                                        style="font-size:0.4rem; margin-right:-1rem;"></i>
                                    <span data-key="t-dynamic-page-settings">Dynamic Page Settings</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('terms-and-conditions.index') }}"
                                    class="nav-link {{ request()->routeIs('terms-and-conditions.index') ? 'active' : '' }}"
                                    data-key="t-terms-and-conditions">
                                    <i class="ri-checkbox-blank-circle-fill"
                                        style="font-size:0.4rem; margin-right:-1rem;"></i>
                                    <span data-key="t-terms-and-conditions">Terms & Conditions</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('privacy-policy.index') }}"
                                    class="nav-link {{ request()->routeIs('privacy-policy.index') ? 'active' : '' }}"
                                    data-key="privacy-policy">
                                    <i class="ri-checkbox-blank-circle-fill"
                                        style="font-size:0.4rem; margin-right:-1rem;"></i>
                                    <span data-key="privacy-policy">Privacy Policy</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        {{-- Sidebar End --}}
    </div>

    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
