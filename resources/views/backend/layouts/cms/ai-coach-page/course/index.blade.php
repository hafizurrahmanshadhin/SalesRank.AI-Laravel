@extends('backend.app')

@section('title', 'Course')

@push('styles')
    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 100px !important;
            max-height: 150px !important;
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
                                <li class="breadcrumb-item active">AI Coach Page</li>
                                <li class="breadcrumb-item">Course Section</li>
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
                            <form method="POST" action="{{ route('cms.ai-coach-page.course.preview.update') }}">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" id="title" placeholder="Please Enter Title"
                                                value="{{ old('title', $coursePreview->title ?? '') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="main_description" name="description"
                                            placeholder="About System...">{{ old('description', $coursePreview->description ?? '') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">List of Courses</h5>
                            <a href="{{ route('cms.ai-coach-page.course.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Add New
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="column-id">#</th>
                                            <th class="column-content">Title</th>
                                            <th class="column-content">Instructor</th>
                                            <th class="column-content">Level</th>
                                            <th class="column-content">Duration</th>
                                            <th class="column-content">Image</th>
                                            <th class="column-content">Description</th>
                                            <th class="column-status">Status</th>
                                            <th class="column-action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Dynamic Data --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for viewing course details start --}}
    <div class="modal fade" id="viewCourseModal" tabindex="-1" aria-labelledby="CourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="CourseModalLabel" class="modal-title">Course Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Dynamic data filled by JS --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for viewing course details end --}}

    {{-- Modal for image preview start --}}
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="imagePreviewModalLabel" class="modal-title">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Filled by showImagePreview() --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for image preview end --}}
@endsection

@push('scripts')
    <script>
        // Keep references to each CKEditor instance
        let mainEditor;

        // Main form CKEditor
        ClassicEditor.create(document.querySelector('#main_description'))
            .then(editor => mainEditor = editor)
            .catch(error => console.error(error));

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            if (!$.fn.DataTable.isDataTable('#datatable')) {
                let table = $('#datatable').DataTable({
                    responsive: true,
                    order: [],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"],
                    ],
                    processing: true,
                    serverSide: true,
                    pagingType: "full_numbers",
                    ajax: {
                        url: "{{ route('cms.ai-coach-page.course.index') }}",
                        type: "GET",
                    },
                    dom: "<'row table-topbar'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>>" +
                        "<'row'<'col-12'tr>>" +
                        "<'row table-bottom'<'col-md-5 dataTables_left'i><'col-md-7'p>>",
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records...",
                        lengthMenu: "Show _MENU_ entries",
                        processing: `
                            <div class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>`,
                    },
                    // Turn off autoWidth so column widths are respected.
                    autoWidth: false,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '3%'
                        },
                        {
                            data: 'title',
                            name: 'title',
                            orderable: true,
                            searchable: true,
                            width: '20%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'conduct_by',
                            name: 'conduct_by',
                            orderable: true,
                            searchable: true,
                            width: '19%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'course_level',
                            name: 'course_level',
                            orderable: true,
                            searchable: true,
                            className: 'text-center',
                            width: '5%'
                        },
                        {
                            data: 'course_duration',
                            name: 'course_duration',
                            orderable: true,
                            searchable: true,
                            className: 'text-center',
                            width: '3%'
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '5%'
                        },
                        {
                            data: 'description',
                            name: 'description',
                            orderable: false,
                            searchable: false,
                            width: '40%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '2%'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '3%'
                        },
                    ],
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        // Fetch and display course details in the modal (including image)
        async function showCourseDetails(id) {
            let url = '{{ route('cms.ai-coach-page.course.show', ['id' => ':id']) }}';
            url = url.replace(':id', id);

            // Fallback image path
            const defaultImage = "{{ asset('backend/images/users/user-dummy-img.jpg') }}";

            try {
                let response = await axios.get(url);
                if (response.data && response.data.data) {
                    let data = response.data.data;
                    // If 'image' is null, use the default fallback
                    let imgPath = data.image ? `{{ url('/') }}/${data.image}` : defaultImage;
                    let modalBody = document.querySelector('#viewCourseModal .modal-body');
                    modalBody.innerHTML = `
                    <div class="text-center mb-3">
                        <img src="${imgPath}" alt="Image" width="100" height="100" class="rounded">
                    </div>
                    <p><strong>Course Title:</strong> ${data.title}</p>
                    <p><strong>Instructor Name:</strong> ${data.conduct_by}</p>
                    <p><strong>Course Level:</strong> ${data.course_level}</p>
                    <p><strong>Course Duration:</strong> ${data.course_duration} Weeks</p>
                    <p><strong>Description:</strong> ${data.description}</p>
                `;
                } else {
                    toastr.error('No data returned from the server.');
                }
            } catch (error) {
                console.error(error);
                toastr.error('Could not fetch course details.');
            }
        }

        // Show image preview in the modal
        function showImagePreview(imageUrl) {
            let modalBody = document.querySelector('#imagePreviewModal .modal-body');
            modalBody.innerHTML = `
                <div class="text-center">
                    <img src="${imageUrl}" alt="Preview" class="img-fluid" />
                </div>
            `;
        }

        // Status Change Confirm Alert
        function showStatusChangeAlert(id) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update the status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusChange(id);
                }
            });
        }

        // Status Change
        function statusChange(id) {
            let url = '{{ route('cms.ai-coach-page.course.status', ['id' => ':id']) }}'.replace(':id', id);

            axios.get(url)
                .then(function(response) {
                    // console.log(response.data);
                    // Reload DataTable
                    $('#datatable').DataTable().ajax.reload();

                    if (response.data.status === true) {
                        toastr.success(response.data.message);
                    } else if (response.data.errors) {
                        toastr.error(response.data.errors[0]);
                    } else {
                        toastr.error(response.data.message);
                    }
                })
                .catch(function(error) {
                    toastr.error('An error occurred. Please try again.');
                    console.error(error);
                });
        }

        // delete Confirm
        function showDeleteConfirm(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to delete this record?',
                text: 'If you delete this, it will be gone forever.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id);
                }
            });
        }

        // Delete Button
        function deleteItem(id) {
            const url = '{{ route('cms.ai-coach-page.course.destroy', ['id' => ':id']) }}'.replace(':id', id);

            axios.delete(url, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(function(response) {
                    $('#datatable').DataTable().ajax.reload();
                    if (response.data.status === true) {
                        toastr.success(response.data.message);
                    } else if (response.data.errors) {
                        toastr.error(response.data.errors[0]);
                    } else {
                        toastr.error(response.data.message);
                    }
                })
                .catch(function(error) {
                    toastr.error('An error occurred. Please try again.');
                    console.error(error);
                });
        }
    </script>
@endpush
