@extends('backend.app')

@section('title', 'Subscription Plans')

@push('styles')
    <style>
        /* Modern card styling */
        .plan-card {
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
            background: #ffffff;
        }

        .plan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        /* Card header styling */
        .plan-header {
            padding: 24px;
            position: relative;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Price styling */
        .plan-price {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: baseline;
        }

        .plan-currency {
            font-size: 1.25rem;
            font-weight: 600;
            margin-right: 2px;
        }

        .plan-interval {
            font-size: 0.9rem;
            color: #6c757d;
            margin-left: 4px;
            font-weight: 400;
        }

        /* Features list styling */
        .feature-list {
            padding: 24px;
        }

        .feature-item {
            padding: 8px 0;
            display: flex;
            align-items: flex-start;
        }

        .feature-icon {
            color: #10b981;
            font-size: 1rem;
            margin-right: 12px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Plan card title */
        .plan-title {
            position: relative;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #1f2937;
        }

        /* Status badge styling */
        .status-badge {
            position: absolute;
            top: 24px;
            right: 24px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 1;
        }

        .status-badge.active {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .status-badge.inactive {
            background-color: rgba(156, 163, 175, 0.1);
            color: #6c757d;
        }

        /* Card footer styling */
        .plan-footer {
            padding: 16px 24px 24px;
            background-color: rgba(0, 0, 0, 0.01);
        }

        /* Recommended badge styling */
        .recommended-badge {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 4px 12px;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 4px;
            margin-top: 8px;
            box-shadow: 0 2px 6px rgba(59, 130, 246, 0.25);
        }

        /* Buttons styling */
        .btn-toggle-status {
            width: 100%;
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 16px;
            margin-bottom: 16px;
            transition: all 0.2s ease;
        }

        .btn-toggle-status.active {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border-color: rgba(16, 185, 129, 0.2);
        }

        .btn-toggle-status.active:hover {
            background-color: rgba(16, 185, 129, 0.15);
        }

        .btn-toggle-status.inactive {
            background-color: rgba(156, 163, 175, 0.1);
            color: #6c757d;
            border-color: rgba(156, 163, 175, 0.2);
        }

        .btn-toggle-status.inactive:hover {
            background-color: rgba(156, 163, 175, 0.15);
        }

        .btn-edit {
            width: 100%;
            border-radius: 8px;
            font-weight: 500;
            padding: 12px 24px;
            background-color: #3b82f6;
            border-color: #3b82f6;
            transition: all 0.2s ease;
        }

        .btn-edit:hover {
            background-color: #2563eb;
            border-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        }

        /* Page title styling */
        .page-title-wrapper {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .breadcrumb-item a {
            color: #3b82f6;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        /* New plan button */
        .btn-new-plan {
            background-color: #3b82f6;
            border-color: #3b82f6;
            border-radius: 8px;
            font-weight: 500;
            padding: 12px 24px;
            transition: all 0.2s ease;
        }

        .btn-new-plan:hover {
            background-color: #2563eb;
            border-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        }
    </style>
@endpush

@section('content')
    <div class="page-content py-4">
        <div class="container-fluid">

            {{-- Page Title & Actions --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center page-title-wrapper">
                <div>
                    <h1 class="page-title">Subscription Plans</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('cms.pricing-page.subscription-plan.index') }}">CMS</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Subscription Plans</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="" class="btn btn-new-plan">
                        <i class="ri-add-line me-1"></i> New Plan
                    </a>
                </div>
            </div>

            {{-- Cards Grid --}}
            <div class="row g-4">
                @foreach ($plans as $plan)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="plan-card position-relative">
                            {{-- Plan Header --}}
                            <div class="plan-header">
                                {{-- Status Badge --}}
                                <div class="status-badge {{ $plan->status === 'active' ? 'active' : 'inactive' }}">
                                    {{ ucfirst($plan->status) }}
                                </div>

                                {{-- Plan Name and Title --}}
                                <h4 class="plan-title">{{ $plan->name }}</h4>

                                {{-- Price --}}
                                <div class="plan-price">
                                    <span class="plan-currency">{{ $plan->currency }}</span>
                                    {{ number_format($plan->price, 2) }}
                                    <span class="plan-interval">/ {{ ucfirst($plan->billing_interval) }}</span>
                                </div>

                                {{-- Description --}}
                                @if ($plan->description)
                                    <p class="text-muted mb-0 mt-2">{{ $plan->description }}</p>
                                @endif

                                {{-- Recommended Badge --}}
                                @if ($plan->is_recommended)
                                    <div class="recommended-badge">
                                        <i class="ri-award-fill me-1"></i> Recommended
                                    </div>
                                @endif
                            </div>

                            {{-- Features List --}}
                            <div class="feature-list">
                                @foreach ($plan->features as $feature)
                                    <div class="feature-item">
                                        <i class="ri-checkbox-circle-fill feature-icon"></i>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Action Footer --}}
                            <div class="plan-footer">
                                {{-- Status Toggle Button --}}
                                <form action="{{ route('cms.pricing-page.subscription-plan.toggle-status', $plan) }}"
                                    method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-toggle-status {{ $plan->status === 'active' ? 'active' : 'inactive' }}">
                                        {{ $plan->status === 'active' ? 'Deactivate Plan' : 'Activate Plan' }}
                                    </button>
                                </form>

                                {{-- Edit Button --}}
                                <a href="{{ route('cms.pricing-page.subscription-plan.edit', $plan) }}"
                                    class="btn btn-edit">
                                    <i class="ri-pencil-line me-1"></i> Edit Plan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
