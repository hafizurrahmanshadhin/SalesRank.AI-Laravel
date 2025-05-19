@extends('backend.app')

@section('title', 'Growth Story')

@push('styles')
    <style>
        .form-control:focus {
            box-shadow: none !important;
            outline: none !important;
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
                                    <a href="{{ route('cms.consulting-page.growth-story.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item active">Consulting Page</li>
                                <li class="breadcrumb-item">Growth Story</li>
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
                            <form method="POST" action="{{ route('cms.consulting-page.growth-story.banner.update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" id="title">Title</span>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" id="title" placeholder="Please Enter Title"
                                        value="{{ old('title', $growthStoryBanner->title ?? '') }}" aria-label="Large"
                                        aria-describedby="title" />
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Growth Story List --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All Growth Story List</h5>
                            <button type="button" class="btn btn-primary btn-sm" id="addNewGrowthStory">
                                Add New
                            </button>
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
                                            <th class="column-status">Status</th>
                                            <th class="column-action">Action</th>
                                            {{-- Hidden column for storing raw image URL so we can
                                                 display in Dropify during editing --}}
                                            <th class="d-none">image_url</th>
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
    <div class="modal fade" id="createGrowthStoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="createGrowthStoryForm" class="modal-content" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create New Growth Story</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                        <span class="text-danger error-text create_title_error"></span>
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
    <div class="modal fade" id="editGrowthStoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editGrowthStoryForm" class="modal-content" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" id="edit_GrowthStory_id" name="id">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Growth Story</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" id="edit_title" name="title" class="form-control">
                        <span class="text-danger error-text edit_title_error"></span>
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
                        url: "{{ route('cms.consulting-page.growth-story.index') }}",
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
                            width: '65%'
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '20%'
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
                        {
                            data: 'image_url',
                            name: 'image_url',
                            visible: false // hidden column
                        },
                    ],
                });

                // “Add New” button: clear form & Dropify
                $('#addNewGrowthStory').on('click', () => {
                    $('#createGrowthStoryForm')[0].reset();
                    $('.error-text').text('');
                    // Clear Dropify for new upload
                    let dropifyCreate = $('#image').dropify();
                    dropifyCreate = dropifyCreate.data('dropify');
                    dropifyCreate.resetPreview();
                    dropifyCreate.clearElement();

                    $('#createGrowthStoryModal').modal('show');
                });

                // Create form submit
                $('#createGrowthStoryForm').submit(e => {
                    e.preventDefault();
                    $('.error-text').text('');
                    axios.post(
                            "{{ route('cms.consulting-page.growth-story.store') }}",
                            new FormData(e.target)
                        )
                        .then(({
                            data
                        }) => {
                            if (data.status) {
                                $('#createGrowthStoryModal').modal('hide');
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

                // Show Edit modal
                $(document).on('click', '.edit-growthStory', function() {
                    let row = table.row($(this).closest('tr')).data();
                    $('#edit_GrowthStory_id').val(row.id);
                    $('#edit_title').val(row.title);

                    // Re-init Dropify
                    let editDr = $('#edit_image').dropify({
                        defaultFile: row.image_url // existing image
                    });
                    editDr = editDr.data('dropify');
                    editDr.resetPreview();
                    editDr.clearElement();
                    editDr.settings.defaultFile = row.image_url;
                    editDr.destroy();
                    editDr.init();

                    $('.error-text').text('');
                    $('#editGrowthStoryModal').modal('show');
                });

                const updateGrowthStoryUrlTemplate =
                    "{{ route('cms.consulting-page.growth-story.update', ['id' => ':id']) }}";

                // Update form submit
                $('#editGrowthStoryForm').submit(e => {
                    e.preventDefault();
                    $('.error-text').text('');

                    const id = $('#edit_GrowthStory_id').val();
                    const url = updateGrowthStoryUrlTemplate.replace(':id', id);
                    const formData = new FormData(e.target);

                    axios.post(url, formData)
                        .then(({
                            data
                        }) => {
                            if (data.status) {
                                $('#editGrowthStoryModal').modal('hide');
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
            }
        });

        // Image preview modal
        function showImagePreview(imageUrl) {
            let modalBody = document.querySelector('#imagePreviewModal .modal-body');
            modalBody.innerHTML = `
                <div class="text-center">
                    <img src="${imageUrl}" alt="Preview" class="img-fluid" />
                </div>
            `;
        }

        // Status change confirmation
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

        // Status change
        function statusChange(id) {
            let url = '{{ route('cms.consulting-page.growth-story.status', ['id' => ':id']) }}'
                .replace(':id', id);

            axios.get(url)
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
                .catch(function() {
                    toastr.error('An error occurred. Please try again.');
                });
        }

        // Delete confirmation
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

        // Delete item
        function deleteItem(id) {
            const url = '{{ route('cms.consulting-page.growth-story.destroy', ['id' => ':id']) }}'
                .replace(':id', id);

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
                .catch(function() {
                    toastr.error('An error occurred. Please try again.');
                });
        }
    </script>
@endpush
