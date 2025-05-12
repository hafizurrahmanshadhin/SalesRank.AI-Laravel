@extends('backend.app')

@section('title', 'Create New Case Studies')

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
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End page title --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Create New Case Studies</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cms.home-page.case-studies.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row gy-4">
                                    {{-- Choose Category --}}
                                    <div class="col-md-6">
                                        <div>
                                            <label class="form-label">Select Existing Category</label>
                                            <select name="existing_category" class="form-select">
                                                <option value="">-- None --</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">If you want to use an existing category, select
                                                here.</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="category_name" class="form-label">Or Create New Category</label>
                                            <input type="text" name="category_name" id="category_name"
                                                class="form-control @error('category_name') is-invalid @enderror"
                                                placeholder="Enter a new category name"
                                                value="{{ old('category_name', '') }}">
                                            @error('category_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <small class="text-muted">If you prefer a new category, type it here.</small>
                                        </div>
                                    </div>

                                    {{-- File upload (can handle multiple images) --}}
                                    <div class="col-12">
                                        <label for="images" class="form-label">Upload Images</label>
                                        <input type="file" name="images[]" id="images" multiple
                                            class="form-control @error('images.*') is-invalid @enderror">
                                        @error('images.*')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <small class="text-muted">You can upload multiple images at once.</small>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i>
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
