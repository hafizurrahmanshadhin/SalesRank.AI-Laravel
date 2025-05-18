@extends('backend.app')

@section('title', 'Consulting Page | Hero Section')

@push('styles')
    <style>
        .dropify-wrapper {
            height: 285px;
        }
    </style>
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
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cms.consulting-page.hero-section.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item active">Consulting Page</li>
                                <li class="breadcrumb-item">Hero Section</li>
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
                            <form method="POST" action="{{ route('cms.consulting-page.hero-section.update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" id="title" placeholder="Please Enter Title"
                                                value="{{ old('title', $data->title ?? '') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            placeholder="About System...">{{ old('description', $data->description ?? '') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="image" class="form-label">Image:</label>
                                            <input type="hidden" name="remove_image" value="0">
                                            <input class="form-control dropify @error('image') is-invalid @enderror"
                                                type="file" name="image" id="image"
                                                data-default-file="@isset($data){{ asset($data->image) }}@endisset">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            $('#image').on('dropify.afterClear', function(event, element) {
                $('input[name="remove_image"]').val('1');
            });
        });
    </script>
@endpush
