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
                                            <select name="existing_category" id="existing_category"
                                                class="form-select @error('existing_category') is-invalid @enderror">
                                                <option value="">-- None --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category }}"
                                                        {{ old('existing_category') === $category ? 'selected' : '' }}>
                                                        {{ $category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('existing_category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @else
                                                {{-- Only show the help text if there's no error --}}
                                                <small class="text-muted">
                                                    If you want to use an existing category, select here.
                                                </small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Create Category --}}
                                    <div class="col-md-6">
                                        <div>
                                            <label for="category_name" class="form-label">Or Create New Category</label>
                                            <input type="text" name="category_name" id="category_name"
                                                class="form-control @error('category_name') is-invalid @enderror"
                                                placeholder="Enter a new category name"
                                                value="{{ old('category_name', '') }}">
                                            @error('category_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @else
                                                {{-- Only show the help text if there's no error --}}
                                                <small class="text-muted">
                                                    If you prefer a new category, type it here.
                                                </small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- File upload (can handle multiple images) --}}
                                    <div class="col-12">
                                        <label for="images" class="form-label">Upload Images</label>
                                        <input type="file" name="images[]" id="images" multiple
                                            class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror">
                                        {{-- Show error for the overall "images" field --}}
                                        @error('images')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        {{-- Show first error from any file in "images.*" --}}
                                        @error('images.*')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        {{-- Only show help text if there's no error on images or images.* --}}
                                        @if (!$errors->has('images') && !$errors->has('images.*'))
                                            <small class="text-muted">
                                                You can upload multiple images at once. Scroll down to see previews.
                                            </small>
                                        @endif

                                        {{-- Preview container --}}
                                        <div id="previewContainer" class="d-flex flex-wrap mt-2" style="gap:10px;"></div>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i> Submit
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const existingCategory = document.getElementById('existing_category');
            const categoryNameInput = document.getElementById('category_name');
            const imagesInput = document.getElementById('images');
            const previewContainer = document.getElementById('previewContainer');

            // On page load, set fields based on previous input
            if (existingCategory.value) {
                categoryNameInput.disabled = true;
            }
            if (categoryNameInput.value.trim()) {
                existingCategory.disabled = true;
            }

            // If user picks an existing category, disable the new category field
            existingCategory.addEventListener('change', function() {
                if (this.value) {
                    categoryNameInput.value = '';
                    categoryNameInput.disabled = true;
                } else {
                    categoryNameInput.disabled = false;
                }
            });

            // If user types a new category, disable the existing category dropdown
            categoryNameInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    existingCategory.selectedIndex = 0;
                    existingCategory.disabled = true;
                } else {
                    existingCategory.disabled = false;
                }
            });

            // Multi-file preview & removal
            imagesInput.addEventListener('change', function() {
                const dt = new DataTransfer();
                let files = Array.from(imagesInput.files);
                previewContainer.innerHTML = '';

                files.forEach((file, index) => {
                    dt.items.add(file);

                    const previewDiv = document.createElement('div');
                    previewDiv.style.position = 'relative';

                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.maxWidth = '120px';
                    img.style.maxHeight = '120px';
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '4px';
                    img.alt = 'preview';

                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = 'x';
                    removeBtn.style.position = 'absolute';
                    removeBtn.style.top = '0';
                    removeBtn.style.right = '0';
                    removeBtn.style.borderRadius = '50%';
                    removeBtn.style.border = 'none';
                    removeBtn.style.backgroundColor = 'rgba(0,0,0,0.7)';
                    removeBtn.style.color = '#fff';
                    removeBtn.style.width = '24px';
                    removeBtn.style.height = '24px';
                    removeBtn.style.cursor = 'pointer';

                    removeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        files.splice(index, 1);

                        const newDt = new DataTransfer();
                        files.forEach(f => newDt.items.add(f));
                        imagesInput.files = newDt.files;

                        previewDiv.remove();
                    });

                    previewDiv.appendChild(img);
                    previewDiv.appendChild(removeBtn);
                    previewContainer.appendChild(previewDiv);
                });

                imagesInput.files = dt.files;
            });
        });
    </script>
@endpush

{{-- If there's a validation error specifically stating "This category already exists…", enable the dropdown. --}}
@if ($errors->has('category_name') && Str::contains($errors->first('category_name'), 'already exists'))
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Re-enable the existing category dropdown so that the user
                // can immediately pick the existing category from the list.
                document.getElementById('existing_category').disabled = false;
            });
        </script>
    @endpush
@endif
