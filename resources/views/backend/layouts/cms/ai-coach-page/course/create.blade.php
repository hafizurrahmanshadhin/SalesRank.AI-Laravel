@extends('backend.app')

@section('title', 'Create Course')

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
                                    <a href="{{ route('cms.ai-coach-page.course.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item">AI Coach Page</li>
                                <li class="breadcrumb-item">Course Section</li>
                                <li class="breadcrumb-item">Create</li>
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
                            <form action="{{ route('cms.ai-coach-page.course.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" placeholder="Please Enter Title"
                                                value="{{ old('title') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="conduct_by" class="form-label">Instructor:</label>
                                            <input type="text"
                                                class="form-control @error('conduct_by') is-invalid @enderror"
                                                id="conduct_by" name="conduct_by" placeholder="Please Enter Instructor Name"
                                                value="{{ old('conduct_by') }}">
                                            @error('conduct_by')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="course_duration" class="form-label">Course Duration (Weeks):</label>
                                            <input type="number"
                                                class="form-control @error('course_duration') is-invalid @enderror"
                                                id="course_duration" name="course_duration"
                                                placeholder="Please Enter Duration" value="{{ old('course_duration') }}">
                                            @error('course_duration')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="course_level" class="form-label">Course Level:</label>
                                            <select name="course_level" id="course_level"
                                                class="form-select @error('course_level') is-invalid @enderror">
                                                <option value="" disabled selected>-- Select Level --</option>
                                                <option value="beginner"
                                                    {{ old('course_level') === 'beginner' ? 'selected' : '' }}>
                                                    Beginner
                                                </option>
                                                <option value="intermediate"
                                                    {{ old('course_level') === 'intermediate' ? 'selected' : '' }}>
                                                    Intermediate
                                                </option>
                                                <option value="advanced"
                                                    {{ old('course_level') === 'advanced' ? 'selected' : '' }}>
                                                    Advanced
                                                </option>
                                            </select>
                                            @error('course_level')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="description" class="form-label">Description:</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                placeholder="Type here...">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="image" class="form-label">Image:</label>
                                        <input type="file"
                                            class="form-control dropify @error('image') is-invalid @enderror" name="image"
                                            id="image" value="{{ old('image') }}">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('cms.ai-coach-page.course.index') }}"
                                            class="btn btn-danger">Cancel</a>
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
