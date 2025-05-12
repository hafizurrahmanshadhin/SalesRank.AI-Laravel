@extends('backend.app')

@section('title', 'Edit Case Study')

@push('styles')
    <style>
        .dropify-wrapper {
            border: 2px dashed #6c757d;
            border-radius: 5px;
        }

        .page-title-box {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- Start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cms.home-page.case-studies.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item active">Home Page</li>
                                <li class="breadcrumb-item active">Case Studies Section</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End page title --}}

            {{-- Messages --}}
            @if (session('t-success'))
                <div class="alert alert-success">{{ session('t-success') }}</div>
            @endif
            @if (session('t-error'))
                <div class="alert alert-danger">{{ session('t-error') }}</div>
            @endif

            {{-- Main Form --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Case Study</h5>
                        </div>
                        <div class="card-body">
                            {{-- Update method --}}
                            <form action="{{ route('cms.home-page.case-studies.update', $caseStudy->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                {{-- Choose or create category --}}
                                <div class="mb-3">
                                    <label class="form-label">Select Existing Category</label>
                                    <select name="existing_category" class="form-select">
                                        <option value="">-- None --</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat }}"
                                                {{ $caseStudy->category === $cat ? 'selected' : '' }}>
                                                {{ $cat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">If you want to use an old category, select here.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Or Create New Category</label>
                                    <input type="text" name="category_name" id="category_name"
                                        class="form-control @error('category_name') is-invalid @enderror"
                                        placeholder="Enter a new category name" value="{{ old('category_name', '') }}">
                                    @error('category_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <small class="text-muted">If you prefer a new category, type it here.</small>
                                </div>

                                {{-- File upload (can handle multiple images) --}}
                                <div class="mb-3">
                                    <label for="images" class="form-label">Upload Images</label>
                                    <input type="file" name="images[]" id="images" multiple
                                        class="form-control dropify @error('images.*') is-invalid @enderror">
                                    @error('images.*')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <small class="text-muted">You can upload multiple images at once.</small>
                                </div>

                                {{-- Existing Images --}}
                                @if ($caseStudy->images && is_array($caseStudy->images))
                                    <div class="mb-3">
                                        <label class="form-label">Existing Images</label><br>
                                        @foreach ($caseStudy->images as $img)
                                            <img src="{{ asset($img) }}" alt="img"
                                                style="max-width: 80px; max-height: 80px; object-fit: cover; margin:5px;">
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Submit Button --}}
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Update Case Study
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endpush
