@extends('backend.app')

@section('title', 'AI Coach - Documents')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cms.ai-coach-page.documents.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item active">AI Coach Page</li>
                                <li class="breadcrumb-item">Documents</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('cms.ai-coach-page.documents.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h5 class="card-title mb-0">
                                                    <i class="fas fa-file-word me-2 text-primary"></i>Generate Script
                                                    Document
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                @if ($setting->generate_script)
                                                    <div class="current-document mb-3 p-3 border rounded bg-light">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <i class="fas fa-file-alt text-primary me-2"></i>
                                                                <span class="fw-bold">Current File:</span>
                                                                <span
                                                                    class="document-name">{{ basename($setting->generate_script) }}</span>
                                                            </div>
                                                            <div>
                                                                <a href="{{ asset($setting->generate_script) }}"
                                                                    class="btn btn-sm btn-outline-primary" target="_blank">
                                                                    <i class="fas fa-eye me-1"></i> View
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="form-check mt-2">
                                                            <input type="checkbox" name="remove_generate_script"
                                                                value="1" id="remove_gen_doc"
                                                                class="form-check-input remove-document-check">
                                                            <label for="remove_gen_doc"
                                                                class="form-check-label text-danger">
                                                                <i class="fas fa-trash-alt me-1"></i>Remove this document
                                                            </label>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="no-document-message text-center text-muted py-3 mb-3">
                                                        <i class="fas fa-file-upload fa-2x mb-2"></i>
                                                        <p>No document uploaded yet</p>
                                                    </div>
                                                @endif

                                                <div class="upload-new">
                                                    <label for="generate_script" class="form-label">
                                                        @if ($setting->generate_script)
                                                            Replace with new document:
                                                        @else
                                                            Upload document:
                                                        @endif
                                                    </label>
                                                    <input type="file" name="generate_script" id="generate_script"
                                                        class="form-control" data-height="150"
                                                        onchange="updateFileName(this, 'generate_script_name')">
                                                    <div id="generate_script_name"
                                                        class="selected-file-name text-muted small mt-1"></div>
                                                    <div class="form-text">Supported formats: PDF, DOC, DOCX (Max: 10MB)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h5 class="card-title mb-0">
                                                    <i class="fas fa-file-powerpoint me-2 text-danger"></i>Practice Pitch
                                                    Document
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                @if ($setting->practice_pitch)
                                                    <div class="current-document mb-3 p-3 border rounded bg-light">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <i class="fas fa-file-alt text-danger me-2"></i>
                                                                <span class="fw-bold">Current File:</span>
                                                                <span
                                                                    class="document-name">{{ basename($setting->practice_pitch) }}</span>
                                                            </div>
                                                            <div>
                                                                <a href="{{ asset($setting->practice_pitch) }}"
                                                                    class="btn btn-sm btn-outline-primary" target="_blank">
                                                                    <i class="fas fa-eye me-1"></i> View
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="form-check mt-2">
                                                            <input type="checkbox" name="remove_practice_pitch"
                                                                value="1" id="remove_prac_doc"
                                                                class="form-check-input remove-document-check">
                                                            <label for="remove_prac_doc"
                                                                class="form-check-label text-danger">
                                                                <i class="fas fa-trash-alt me-1"></i>Remove this document
                                                            </label>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="no-document-message text-center text-muted py-3 mb-3">
                                                        <i class="fas fa-file-upload fa-2x mb-2"></i>
                                                        <p>No document uploaded yet</p>
                                                    </div>
                                                @endif

                                                <div class="upload-new">
                                                    <label for="practice_pitch" class="form-label">
                                                        @if ($setting->practice_pitch)
                                                            Replace with new document:
                                                        @else
                                                            Upload document:
                                                        @endif
                                                    </label>
                                                    <input type="file" name="practice_pitch" id="practice_pitch"
                                                        class="form-control" data-height="150"
                                                        onchange="updateFileName(this, 'practice_pitch_name')">
                                                    <div id="practice_pitch_name"
                                                        class="selected-file-name text-muted small mt-1"></div>
                                                    <div class="form-text">Supported formats: PDF, PPT, PPTX (Max: 10MB)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Save Documents
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
        $(document).ready(function() {
            // Add effects when clicking remove checkbox
            $('.remove-document-check').on('change', function() {
                const documentArea = $(this).closest('.current-document');
                if (this.checked) {
                    documentArea.addClass('text-muted');
                    documentArea.css('opacity', '0.6');
                } else {
                    documentArea.removeClass('text-muted');
                    documentArea.css('opacity', '1');
                }
            });
        });

        // Show selected filename in the UI
        function updateFileName(input, targetId) {
            const target = document.getElementById(targetId);
            if (input.files && input.files[0]) {
                target.textContent = input.files[0].name;
                target.classList.add('text-primary');
                target.innerHTML = '<i class="fas fa-check-circle me-1"></i>' + input.files[0].name;
            } else {
                target.textContent = '';
            }
        }
    </script>
@endpush
