@extends('backend.app')

@section('title', 'Features')

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
                                    <a href="{{ route('cms.about-page.feature.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item active">About Page</li>
                                <li class="breadcrumb-item">Features Section</li>
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
                            <form method="POST" action="{{ route('cms.about-page.feature.ai.prompt.update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" id="title" placeholder="Please Enter Title"
                                                value="{{ old('title', $AIPrompt->title ?? '') }}" style="height: 100px;">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div>
                                            <label for="image" class="form-label">Image:</label>
                                            <input type="hidden" name="remove_image" value="0">
                                            <input class="form-control dropify @error('image') is-invalid @enderror"
                                                type="file" name="image" id="image"
                                                data-default-file="@isset($AIPrompt){{ asset($AIPrompt->image) }}@endisset">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-50"
                                        style="margin-top: -38px; margin-right: 80%;">
                                        Submit
                                    </button>
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
                            <h5 class="card-title mb-0">All Feature List</h5>
                            <button type="button" class="btn btn-primary btn-sm" id="addNewFeature">Add New
                                Feature</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered table-striped align-middle dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="column-id">#</th>
                                            <th class="column-content">Title</th>
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

    {{-- Create Modal Start --}}
    <div class="modal fade" id="createFeatureModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="createFeatureForm" class="modal-content" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create New Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                        <span class="text-danger error-text create_title_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                        <span class="text-danger error-text create_description_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control dropify">
                        <span class="text-danger error-text create_image_error"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Create Modal End --}}

    {{-- Edit Modal Start --}}
    <div class="modal fade" id="editFeatureModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editFeatureForm" class="modal-content" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_feature_id" name="id">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" id="edit_title" name="title" class="form-control">
                        <span class="text-danger error-text edit_title_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea id="edit_description" name="description" class="form-control" rows="4"></textarea>
                        <span class="text-danger error-text edit_description_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Image</label>
                        <input type="file" id="edit_image" name="image" class="form-control dropify"
                            data-default-file="">
                        <span class="text-danger error-text edit_image_error"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Edit Modal End --}}

    {{-- Modal for viewing feature details start --}}
    <div class="modal fade" id="viewFeatureModal" tabindex="-1" aria-labelledby="FeatureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="FeatureModalLabel" class="modal-title">Feature Details</h5>
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
    {{-- Modal for viewing feature details end --}}

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
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#edit_description'))
            .catch(error => {
                console.error(error);
            });

        $(document).ready(function() {
            $('.dropify').dropify();

            $('#image').on('dropify.afterClear', function(event, element) {
                $('input[name="remove_image"]').val('1');
            });

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
                        url: "{{ route('cms.about-page.feature.index') }}",
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
                            width: '5%'
                        },
                        {
                            data: 'title',
                            name: 'title',
                            orderable: true,
                            searchable: true,
                            width: '20%'
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
                            width: '60%',
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
                            width: '5%'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '5%'
                        },
                    ],
                });

                $('#addNewFeature').on('click', () => {
                    $('#createFeatureForm')[0].reset();
                    $('.error-text').text('');
                    $('#createFeatureModal').modal('show');
                });

                $('#createFeatureForm').submit(e => {
                    e.preventDefault();
                    $('.error-text').text('');
                    axios.post("{{ route('cms.about-page.feature.store') }}", new FormData(e.target))
                        .then(({
                            data
                        }) => {
                            if (data.status) {
                                $('#createFeatureModal').modal('hide');
                                table.ajax.reload();
                                toastr.success(data.message);
                            } else {
                                for (let [k, v] of Object.entries(data.errors || {})) {
                                    $(`.create_${k}_error`).text(v[0]);
                                }
                                toastr.error(data.message);
                            }
                        })
                        .catch(() => toastr.error('Something went wrong.'));
                });

                // Show Edit
                $(document).on('click', '.edit-feature', function() {
                    let row = table.row($(this).closest('tr')).data();
                    $('#edit_feature_id').val(row.id);
                    $('#edit_title').val(row.title);
                    $('#edit_description').val(row.description);

                    // Reset and re-init Dropify for the new image
                    $('#edit_image').val('');
                    $('.dropify').dropify();

                    $('.error-text').text('');
                    $('#editFeatureModal').modal('show');
                });

                const updateFeatureUrlTemplate = "{{ route('cms.about-page.feature.update', ['id' => ':id']) }}";

                // Update
                $('#editFeatureForm').submit(e => {
                    e.preventDefault();
                    $('.error-text').text('');

                    // Build URL and gather form data
                    const id = $('#edit_feature_id').val();
                    const url = updateFeatureUrlTemplate.replace(':id', id);
                    const formData = new FormData(e.target);

                    // Send via Axios
                    axios.post(url, formData)
                        .then(({
                            data
                        }) => {
                            if (data.status) {
                                $('#editFeatureModal').modal('hide');
                                table.ajax.reload();
                                toastr.success(data.message);
                            } else {
                                for (let [field, msgs] of Object.entries(data.errors || {})) {
                                    $(`.edit_${field}_error`).text(msgs[0]);
                                }
                                toastr.error(data.message);
                            }
                        })
                        .catch(() => toastr.error('Something went wrong.'));
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        // Fetch and display feature details in the modal
        async function showFeatureDetails(id) {
            let url = '{{ route('cms.about-page.feature.show', ['id' => ':id']) }}';
            url = url.replace(':id', id);

            // Fallback image path
            const defaultImage = "{{ asset('backend/images/users/user-dummy-img.jpg') }}";

            try {
                let response = await axios.get(url);
                if (response.data && response.data.data) {
                    let data = response.data.data;
                    // If 'image' is null, use the default fallback
                    let imgPath = data.image ? `{{ url('/') }}/${data.image}` : defaultImage;
                    let modalBody = document.querySelector('#viewFeatureModal .modal-body');
                    modalBody.innerHTML = `
                        <div class="text-center mb-3">
                            <img src="${imgPath}" alt="Image" width="200" height="200" class="rounded">
                        </div>
                        <p><strong>Title:</strong> ${data.title}</p>
                        <p><strong>Description:</strong> ${data.description}</p>
                    `;
                } else {
                    toastr.error('No data returned from the server.');
                }
            } catch (error) {
                console.error(error);
                toastr.error('Could not fetch testimonial details.');
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
            let url = '{{ route('cms.about-page.feature.status', ['id' => ':id']) }}'.replace(':id', id);

            axios.get(url)
                .then(function(response) {
                    // console.log(response.data);
                    // Reload your DataTable
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
            const url = '{{ route('cms.about-page.feature.destroy', ['id' => ':id']) }}'.replace(':id', id);

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
