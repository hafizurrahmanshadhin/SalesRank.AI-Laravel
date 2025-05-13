@extends('backend.app')

@section('title', 'Edit Feature Blocks')

@push('styles')
    <style>
        .page-title-box {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
        }

        .remove-existing-image,
        .remove-new-image {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            outline: none;
        }

        .image-container,
        .new-image-container {
            display: inline-block;
            position: relative;
            margin: 5px;
        }

        .image-container img,
        .new-image-container img {
            max-width: 80px;
            max-height: 80px;
            object-fit: cover;
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
                                    <a href="{{ route('cms.home-page.feature-blocks.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item active">Home Page</li>
                                <li class="breadcrumb-item active">Feature Blocks Section</li>
                                <li class="breadcrumb-item active">Edit</li>
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
                            <h5 class="card-title mb-0">Edit Feature Blocks</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cms.home-page.feature-blocks.update', $featureBlocks->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                {{-- Show category (read-only) --}}
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <input type="text" value="{{ $featureBlocks->category }}" class="form-control"
                                        disabled>
                                </div>

                                {{-- File upload (can handle multiple images) --}}
                                <div class="mb-3">
                                    <label for="images" class="form-label">Upload Images</label>
                                    <input type="file" name="images[]" id="images" multiple
                                        class="form-control @error('images.*') is-invalid @enderror">
                                    @error('images.*')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <small class="text-muted">You can upload multiple images at once. Preview below.</small>

                                    {{-- Preview for newly selected images --}}
                                    <div id="previewContainer" class="d-flex flex-wrap mt-2" style="gap:10px;"></div>
                                </div>

                                {{-- Hidden input to track removed *existing* images --}}
                                <input type="hidden" name="removed_images" id="removed_images" value="">

                                {{-- Existing Images --}}
                                @if ($featureBlocks->images && is_array($featureBlocks->images))
                                    <div class="mt-3">
                                        <label class="form-label">Existing Images</label><br>
                                        @foreach ($featureBlocks->images as $img)
                                            <div class="image-container">
                                                <img src="{{ asset($img) }}" alt="img" />
                                                <button type="button" class="remove-existing-image"
                                                    data-path="{{ $img }}">
                                                    &times;
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Update
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
        document.addEventListener('DOMContentLoaded', function() {
            // For existing images
            const removedImages = document.getElementById('removed_images');
            let removedPaths = [];

            document.querySelectorAll('.remove-existing-image').forEach(button => {
                button.addEventListener('click', function() {
                    const path = this.dataset.path;
                    removedPaths.push(path);
                    removedImages.value = JSON.stringify(removedPaths);
                    this.parentElement.remove();
                });
            });

            // For newly selected images
            const imagesInput = document.getElementById('images');
            const previewContainer = document.getElementById('previewContainer');

            imagesInput.addEventListener('change', function() {
                // Keep track of new files in a DataTransfer so we can remove some
                const dt = new DataTransfer();
                let files = Array.from(imagesInput.files);
                previewContainer.innerHTML = ''; // Clear old previews

                files.forEach((file, index) => {
                    dt.items.add(file); // accumulate all files

                    const previewDiv = document.createElement('div');
                    previewDiv.classList.add('new-image-container');
                    previewDiv.style.position = 'relative';

                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.maxWidth = '80px';
                    img.style.maxHeight = '80px';
                    img.style.objectFit = 'cover';
                    img.alt = 'preview';

                    // Create a remove button for new images
                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = '×';
                    removeBtn.classList.add('remove-new-image');
                    removeBtn.style.position = 'absolute';
                    removeBtn.style.top = '-8px';
                    removeBtn.style.right = '-8px';
                    removeBtn.style.borderRadius = '50%';
                    removeBtn.style.border = 'none';
                    removeBtn.style.backgroundColor = 'rgba(0,0,0,0.7)';
                    removeBtn.style.color = '#fff';
                    removeBtn.style.width = '24px';
                    removeBtn.style.height = '24px';
                    removeBtn.style.cursor = 'pointer';

                    removeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        files.splice(index, 1); // remove from the array

                        // Build a fresh DataTransfer after removal
                        const newDt = new DataTransfer();
                        files.forEach(f => newDt.items.add(f));
                        imagesInput.files = newDt.files;

                        previewDiv.remove(); // remove the preview
                    });

                    previewDiv.appendChild(img);
                    previewDiv.appendChild(removeBtn);
                    previewContainer.appendChild(previewDiv);
                });

                // Update the file input with the final list
                imagesInput.files = dt.files;
            });
        });
    </script>
@endpush
