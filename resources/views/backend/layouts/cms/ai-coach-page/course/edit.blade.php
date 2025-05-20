@extends('backend.app')

@section('title', 'Edit Course')

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
                                    <a href="{{ route('cms.ai-coach-page.course.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item">AI Coach Page</li>
                                <li class="breadcrumb-item">Course Section</li>
                                <li class="breadcrumb-item">Edit</li>
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
                            <form action="{{ route('cms.ai-coach-page.course.update', ['id' => $course->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" value="{{ old('title', $course->title) }}"
                                                placeholder="Please Enter Title">
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
                                                id="conduct_by" name="conduct_by"
                                                value="{{ old('conduct_by', $course->conduct_by) }}"
                                                placeholder="Please Enter Instructor Name">
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
                                                placeholder="Enter duration (e.g. 10)"
                                                value="{{ old('course_duration', $course->course_duration) }}">
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
                                                <option value="" disabled>-- Select Level --</option>
                                                <option value="beginner"
                                                    {{ old('course_level', $course->course_level) === 'beginner' ? 'selected' : '' }}>
                                                    Beginner
                                                </option>
                                                <option value="intermediate"
                                                    {{ old('course_level', $course->course_level) === 'intermediate' ? 'selected' : '' }}>
                                                    Intermediate
                                                </option>
                                                <option value="advanced"
                                                    {{ old('course_level', $course->course_level) === 'advanced' ? 'selected' : '' }}>
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
                                                placeholder="Type here...">{{ old('description', $course->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="image" class="form-label">Image:</label>
                                            {{-- "remove_image" hidden input remains "0" unless switched to "1" via Dropify events --}}
                                            <input type="hidden" name="remove_image" value="0">
                                            <input class="form-control dropify @error('image') is-invalid @enderror"
                                                type="file" name="image" id="image"
                                                data-default-file="{{ $course->image ? asset($course->image) : '' }}">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
        // Initialize Dropify
        let drInput = $('#image').dropify();

        // Listen to Dropify "afterClear" event
        drInput.on('dropify.afterClear', function(event, element) {
            // If user clicks Remove, set remove_image=1
            $('input[name="remove_image"]').val('1');
        });

        // ClassicEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
