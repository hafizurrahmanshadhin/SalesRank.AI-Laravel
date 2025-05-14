@extends('backend.app')

@section('title', 'Edit Testimonial')

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
            {{-- Start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cms.testimonials.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item active">Testimonials</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End page title --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('cms.testimonials.update', ['id' => $testimonial->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="name" class="form-label">Name:</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $testimonial->name) }}"
                                                placeholder="Please Enter Name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title"
                                                value="{{ old('title', $testimonial->title) }}"
                                                placeholder="Please Enter Title">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="description" class="form-label">Description:</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                placeholder="Type here...">{{ old('description', $testimonial->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="image" class="form-label">Image:</label>
                                        <input type="file"
                                            class="form-control dropify @error('image') is-invalid @enderror" id="image"
                                            name="image"
                                            data-default-file="{{ $testimonial->image ? asset($testimonial->image) : '' }}">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Submit & Cancel Buttons --}}
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('cms.testimonials.index') }}" class="btn btn-danger">Cancel</a>
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
@endpush
