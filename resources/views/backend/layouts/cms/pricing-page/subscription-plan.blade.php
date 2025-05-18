@extends('backend.app')

@section('title', 'Subscription Plans')

@push('styles')
    <link href="{{ asset('backend/css/subscription-plans-card.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="page-content py-4">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center page-title-wrapper">
                <div>
                    <h1 class="page-title">Subscription Plans</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('cms.pricing-page.subscription-plan.index') }}">CMS</a></li>
                            <li class="breadcrumb-item active">Pricing Page</li>
                            <li class="breadcrumb-item">Subscription Plans</li>
                        </ol>
                    </nav>
                </div>
            </div>
            {{-- end page title --}}

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
                                    <div class="recommended-badge-wrapper">
                                        <div class="recommended-badge">
                                            <i class="ri-award-fill me-1"></i> Recommended
                                        </div>
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
