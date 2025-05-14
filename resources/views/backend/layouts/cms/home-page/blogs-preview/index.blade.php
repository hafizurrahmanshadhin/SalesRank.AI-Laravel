@extends('backend.app')

@section('title', 'Blogs Preview')

@push('styles')
    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 50px !important;
            max-height: 100px !important;
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
                                    <a href="{{ route('cms.home-page.blogs-preview.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item">Home Page</li>
                                <li class="breadcrumb-item active">Blogs Preview Section</li>
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
                            <form method="POST" action="{{ route('cms.home-page.blogs-preview.update') }}">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    {{-- Banner Title --}}
                                    <div class="col-md-12">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" id="title" placeholder="Please Enter Title"
                                                value="{{ old('title', $blogsPreview->title ?? '') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Banner Description --}}
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            placeholder="About System...">{{ old('description', $blogsPreview->description ?? '') }}</textarea>
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
                            <h5 class="card-title mb-0">All Blogs List</h5>
                            <button type="button" class="btn btn-primary btn-sm" id="addNewBlog">Add New Blog</button>
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

    {{-- Create Modal --}}
    <div class="modal fade" id="createServiceModal" tabindex="-1" aria-labelledby="createServiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createServiceModalLabel">Create New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createServiceForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create_services_name" class="form-label">Services Name:</label>
                            <input type="text" class="form-control" id="create_services_name" name="services_name"
                                placeholder="Please Enter Services Name">
                            <span class="text-danger error-text create_services_name_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="create_platform_fee" class="form-label">Platform Fee:</label>
                            <input type="text" class="form-control" id="create_platform_fee" name="platform_fee"
                                placeholder="Please Enter Platform Fee">
                            <span class="text-danger error-text create_platform_fee_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
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

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            var table = $('#datatable').DataTable({
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
                    url: "{{ route('cms.home-page.blogs-preview.index') }}",
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
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'services_name',
                        name: 'services_name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'platform_fee',
                        name: 'platform_fee',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ],
                columnDefs: [{
                    targets: -1,
                    render: function(data, type, row) {
                        return `
                            <div class="hstack gap-3 fs-base">
                                <a href="javascript:void(0);" class="link-primary text-decoration-none edit-service" data-id="${row.id}" title="Edit">
                                    <i class="ri-pencil-line" style="font-size: 24px;"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="showDeleteConfirm('${row.id}')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                </a>
                            </div>
                        `;
                    },
                }],
            });

            // Show Create Modal
            $('#addNewService').click(function() {
                $('#createServiceModal').modal('show');
                $('#createServiceForm')[0].reset();
                $('.error-text').text('');
            });

            // Handle Create Form Submission
            $('#createServiceForm').submit(function(e) {
                e.preventDefault();
                $('.error-text').text('');
                let formData = $(this).serialize();

                axios.post("{{ route('service.store') }}", formData)
                    .then(function(response) {
                        if (response.data.success) {
                            $('#createServiceModal').modal('hide');
                            $('#createServiceForm')[0].reset();
                            table.ajax.reload();
                            toastr.success(response.data.message);
                        } else {
                            $.each(response.data.errors, function(key, value) {
                                $('.create_' + key + '_error').text(value[0]);
                            });
                            toastr.error('Please fix the errors.');
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                        toastr.error('An error occurred while creating the service.');
                    });
            });
        });
    </script>
@endpush
