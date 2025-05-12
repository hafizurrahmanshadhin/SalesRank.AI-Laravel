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

            {{-- Alert messages --}}
            @if (session('t-success'))
                <div class="alert alert-success">{{ session('t-success') }}</div>
            @endif
            @if (session('t-error'))
                <div class="alert alert-danger">{{ session('t-error') }}</div>
            @endif

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
                                    {{-- Choose or create category --}}
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
                                        <small class="text-muted">You can upload multiple images at once. Scroll down to see
                                            previews.</small>

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
                        </div> {{-- card-body --}}
                    </div> {{-- card --}}
                </div> {{-- col-lg-12 --}}
            </div> {{-- row --}}
        </div> {{-- container-fluid --}}
    </div> {{-- page-content --}}
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('images');
            const previewContainer = document.getElementById('previewContainer');

            // Listen for file selection
            input.addEventListener('change', function(e) {
                // Create a fresh DataTransfer to hold the updated file list
                const dt = new DataTransfer();
                // Convert FileList to an array to iterate and modify
                let files = Array.from(input.files);

                // Clear existing previews
                previewContainer.innerHTML = '';

                files.forEach((file, index) => {
                    // Add each file to the DataTransfer
                    dt.items.add(file);

                    // Create a preview element
                    const previewDiv = document.createElement('div');
                    previewDiv.style.position = 'relative';

                    // Show image thumbnail
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.maxWidth = '120px';
                    img.style.maxHeight = '120px';
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '4px';
                    img.alt = 'preview';

                    // Create a remove button
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

                    // When remove button is clicked, remove this file from the preview & DataTransfer
                    removeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        // Remove from the array
                        files.splice(index, 1);

                        // Rebuild the DataTransfer with remaining files
                        const newDt = new DataTransfer();
                        files.forEach(f => newDt.items.add(f));
                        input.files = newDt.files;

                        // Remove the preview from the UI
                        previewDiv.remove();
                    });

                    // Append elements
                    previewDiv.appendChild(img);
                    previewDiv.appendChild(removeBtn);
                    previewContainer.appendChild(previewDiv);
                });

                // Finally, update the input.files to match the DataTransfer
                input.files = dt.files;
            });
        });
    </script>
@endpush
