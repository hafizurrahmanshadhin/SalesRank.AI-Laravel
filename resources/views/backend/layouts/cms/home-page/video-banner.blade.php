@extends('backend.app')

@section('title', 'Home Page | Video Banner')

@push('styles')
    <style>
        /* Card styling */
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eaedf0;
            padding: 1rem 1.25rem;
        }

        .card-title {
            color: #495057;
            margin-bottom: 0;
            font-weight: 600;
        }

        /* Form styling */
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 0.6rem 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Dropify wrapper styling */
        .dropify-wrapper {
            height: 285px;
            border: 2px dashed #6c757d;
            border-radius: 0.5rem;
            background-color: #f8fafb;
            transition: all 0.3s ease;
        }

        .dropify-wrapper:hover {
            background-color: #f1f5f9;
            border-color: #5c636a;
        }

        .dropify-message p {
            font-size: 1rem;
        }

        /* Enhanced video preview container */
        .video-preview-container {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-top: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        /* Improved video player styling */
        .video-preview {
            max-width: 50%;
            margin: 0 auto;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .video-preview video {
            width: 100%;
            height: auto;
            border-radius: 0.5rem;
            background-color: #000;
        }

        /* Custom video controls */
        .video-js .vjs-control-bar {
            background-color: rgba(43, 51, 63, 0.7);
        }

        .video-js .vjs-play-progress {
            background-color: #0d6efd;
        }

        /* Submit button styling */
        .btn-primary {
            padding: 0.6rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.25);
        }

        /* Breadcrumb styling */
        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            font-size: 1.2rem;
            line-height: 1;
            vertical-align: middle;
        }

        /* Section spacing */
        .page-title-box {
            margin-bottom: 1.75rem;
        }

        /* Form row spacing */
        .form-row {
            margin-bottom: 1.5rem;
        }
    </style>
    <link id="fontsLink" href="{{ asset('backend/custom_downloaded_file/video-js.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">CMS</li>
                                <li class="breadcrumb-item">Home Page</li>
                                <li class="breadcrumb-item active">Video Banner Section</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form method="POST" action="{{ route('cms.home-page.video-banner.update') }}"
                                enctype="multipart/form-data" id="videoBannerForm">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    {{-- Title --}}
                                    <div class="col-md-6 form-row">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Banner Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" id="title" placeholder="Enter Banner Title"
                                                value="{{ old('title', $videoBanner->title ?? '') }}">
                                            @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Video Upload --}}
                                    <div class="col-md-6 form-row">
                                        <div class="mb-3">
                                            <label for="video" class="form-label">Banner Video</label>
                                            <input type="hidden" name="remove_video" value="0" id="remove_video">
                                            <input class="form-control @error('video') is-invalid @enderror" type="file"
                                                name="video" id="video" accept="video/mp4,video/webm,video/ogg"
                                                data-default-file="@isset($videoBanner){{ asset($videoBanner->video) }}@endisset">
                                            <small class="form-text text-muted">Recommended format: MP4, WebM (Max:
                                                10MB)</small>
                                            @error('video')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-6 form-row">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Banner Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="5" placeholder="Enter Banner Description">{{ old('description', $videoBanner->description ?? '') }}</textarea>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Feature Image (Poster) --}}
                                    <div class="col-md-6 form-row">
                                        <div class="mb-3">
                                            <label for="video_thumbnail" class="form-label">Feature Image (Poster)</label>
                                            <input type="hidden" name="remove_video_thumbnail" value="0"
                                                id="remove_video_thumbnail">
                                            <input
                                                class="form-control dropify @error('video_thumbnail') is-invalid @enderror"
                                                type="file" name="video_thumbnail" id="video_thumbnail"
                                                accept="image/jpeg,image/png,image/jpg,image/gif"
                                                data-default-file="@isset($videoBanner->video_thumbnail){{ asset($videoBanner->video_thumbnail) }}@endisset">
                                            <small class="form-text text-muted">Recommended size: 1920x1080px (16:9
                                                ratio)</small>
                                            @error('video_thumbnail')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Video Preview --}}
                                    @if (!empty($videoBanner->video))
                                        <div class="col-md-12 mt-4">
                                            <div class="video-preview-container">
                                                <label class="form-label mb-3">Video Preview:</label>
                                                <div class="video-preview">
                                                    <video id="videoPreview"
                                                        class="video-js vjs-big-play-centered vjs-fluid" controls
                                                        preload="auto" width="100%"
                                                        poster="@isset($videoBanner->video_thumbnail){{ asset($videoBanner->video_thumbnail) }}@endisset"
                                                        data-setup='{"fluid": true, "responsive": true, "controls": true}'>
                                                        <source src="{{ asset($videoBanner->video) }}" type="video/mp4">
                                                        <p class="vjs-no-js">
                                                            To view this video please enable JavaScript, and consider
                                                            upgrading to a
                                                            web browser that <a
                                                                href="https://videojs.com/html5-video-support/"
                                                                target="_blank">supports HTML5 video</a>
                                                        </p>
                                                    </video>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Submit Button --}}
                                    <div class="col-12 mt-4">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                                <i class="bi bi-save me-2"></i> Save Changes
                                            </button>
                                        </div>
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
    <script src="{{ asset('backend/custom_downloaded_file/video.min.js') }}"></script>

    <script>
        /* Initialize CKEditor on the description field */
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo',
                    'redo'
                ],
                placeholder: 'Enter banner description here...'
            })
            .catch(error => {
                console.error('Error initializing editor:', error);
            });

        /* Initialize Dropify for file uploads */
        $(document).ready(function() {
            // Initialize dropify with custom messages
            $('.dropify').dropify({
                messages: {
                    default: 'Drag and drop a file here or click',
                    replace: 'Drag and drop or click to replace',
                    remove: 'Remove',
                    error: 'Error uploading file'
                },
                error: {
                    fileSize: 'The file size is too big (max 10MB).',
                    fileExtension: 'The file extension is not allowed.'
                }
            });

            // Handle video removal flag
            $('#video').on('dropify.afterClear', function() {
                $('#remove_video').val('1');
            });

            // Handle thumbnail removal flag
            $('#video_thumbnail').on('dropify.afterClear', function() {
                $('#remove_video_thumbnail').val('1');
            });

            // Initialize Video.js player
            if (document.getElementById('videoPreview')) {
                var player = videojs('videoPreview', {
                    controls: true,
                    autoplay: false,
                    preload: 'auto',
                    fluid: true,
                    responsive: true,
                    playbackRates: [0.5, 1, 1.5, 2]
                });
            }

            // Preview newly uploaded video before form submission
            $('#video').on('change', function(e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];

                    // Check if file is video
                    if (file.type.match('video.*')) {
                        const fileURL = URL.createObjectURL(file);

                        // If video player exists, update source
                        if (player) {
                            player.src({
                                type: file.type,
                                src: fileURL
                            });
                            player.load();
                        } else {
                            // Create video preview container if it doesn't exist
                            if (!$('.video-preview-container').length) {
                                const $previewContainer = $(
                                    '<div class="col-md-12 mt-4"><div class="video-preview-container"><label class="form-label mb-3">Video Preview:</label><div class="video-preview"><video id="videoPreview" class="video-js vjs-big-play-centered vjs-fluid" controls preload="auto" width="100%"></video></div></div></div>'
                                );
                                $('#videoBannerForm .row').append($previewContainer);

                                player = videojs('videoPreview', {
                                    controls: true,
                                    autoplay: false,
                                    preload: 'auto',
                                    fluid: true,
                                    responsive: true,
                                    playbackRates: [0.5, 1, 1.5, 2]
                                });

                                player.src({
                                    type: file.type,
                                    src: fileURL
                                });
                                player.load();
                            }
                        }
                    }
                }
            });

            // Update video poster when thumbnail changes
            $('#video_thumbnail').on('change', function(e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];

                    // Check if file is image
                    if (file.type.match('image.*')) {
                        const fileURL = URL.createObjectURL(file);

                        // If video player exists, update poster
                        if (player) {
                            player.poster(fileURL);
                        }
                    }
                }
            });

            // Form validation before submit
            $('#videoBannerForm').on('submit', function(e) {
                let valid = true;

                // Basic validation
                if ($('#title').val().trim() === '') {
                    $('#title').addClass('is-invalid');
                    valid = false;
                } else {
                    $('#title').removeClass('is-invalid');
                }

                return valid;
            });
        });
    </script>
@endpush
