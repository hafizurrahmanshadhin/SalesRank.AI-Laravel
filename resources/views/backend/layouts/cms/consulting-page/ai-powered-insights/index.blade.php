@extends('backend.app')

@section('title', 'AI Powered Insights')

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
                                    <a href="{{ route('cms.consulting-page.ai-powered-insights.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item active">Consulting Page</li>
                                <li class="breadcrumb-item">AI Powered Insights</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end page title --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">All AI Powered Insights List</h5>
                            <button type="button" class="btn btn-primary btn-sm" id="addNewData">Add New</button>
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

    {{-- Create Modal Start --}}
    <div class="modal fade" id="createDataModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="createDataForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create New AI Powered Insights</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" placeholder="Please Enter Title"
                            class="form-control">
                        <span class="text-danger error-text create_title_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                        <span class="text-danger error-text create_description_error"></span>
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
    <div class="modal fade" id="editDataModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editDataForm" class="modal-content">
                @csrf
                @method('PATCH')
                <input type="hidden" id="edit_data_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit AI Powered Insights</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Title</label>
                        <input type="text" id="edit_title" name="title" class="form-control">
                        <span class="text-danger error-text edit_title_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea id="edit_description" name="description" class="form-control" rows="4"></textarea>
                        <span class="text-danger error-text edit_description_error"></span>
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

    {{-- View Modal Start --}}
    <div class="modal fade" id="viewDataModal" tabindex="-1" aria-labelledby="DataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="DataModalLabel" class="modal-title">AI Powered Insights Details</h5>
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
    {{-- Viewing Modal End --}}
@endsection

@push('scripts')
    <script>
        let createDescriptionEditor;
        let editDescriptionEditor;

        // Create Editor for "Create" form
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                createDescriptionEditor = editor; // store reference
            })
            .catch(error => {
                console.error(error);
            });

        // Create Editor for "Edit" form
        ClassicEditor
            .create(document.querySelector('#edit_description'))
            .then(editor => {
                editDescriptionEditor = editor; // store reference
            })
            .catch(error => {
                console.error(error);
            });

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
                        url: "{{ route('cms.consulting-page.ai-powered-insights.index') }}",
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
                            width: '20%'
                        },
                        {
                            data: 'description',
                            name: 'description',
                            orderable: false,
                            searchable: false,
                            width: '70%',
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
                            width: '3%'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            width: '4%'
                        },
                    ],
                });

                $('#addNewData').on('click', () => {
                    $('#createDataForm')[0].reset();
                    $('.error-text').text('');
                    createDescriptionEditor.setData(''); // clear CKEditor content
                    $('#createDataModal').modal('show');
                });

                $('#createDataForm').submit(e => {
                    e.preventDefault();
                    $('.error-text').text('');
                    axios.post("{{ route('cms.consulting-page.ai-powered-insights.store') }}", new FormData(
                            e
                            .target))
                        .then(({
                            data
                        }) => {
                            if (data.status) {
                                $('#createDataModal').modal('hide');
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
                $(document).on('click', '.edit-data', function() {
                    let row = table.row($(this).closest('tr')).data();

                    $('#edit_data_id').val(row.id);
                    $('#edit_title').val(row.title);

                    // Instead of .val(), update CKEditor's content:
                    editDescriptionEditor.setData(row.description || '');

                    $('.error-text').text('');
                    $('#editDataModal').modal('show');
                });

                const updateDataUrlTemplate =
                    "{{ route('cms.consulting-page.ai-powered-insights.update', ['id' => ':id']) }}";

                // Update
                $('#editDataForm').submit(e => {
                    e.preventDefault();
                    $('.error-text').text('');

                    // get the data-id and build the real URL
                    const id = $('#edit_data_id').val();
                    const url = updateDataUrlTemplate.replace(':id', id);

                    // collect form data (includes _method=PUT)
                    const formData = new FormData(e.target);

                    // post it
                    axios.post(url, formData)
                        .then(({
                            data
                        }) => {
                            if (data.status) {
                                $('#editDataModal').modal('hide');
                                table.ajax.reload();
                                toastr.success(data.message);
                            } else {
                                // validation errors
                                for (let [field, msgs] of Object.entries(data.errors || {})) {
                                    $(`.edit_${field}_error`).text(msgs[0]);
                                }
                                toastr.error(data.message);
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            toastr.error('Something went wrong.');
                        });
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        // Fetch and display data details in the modal
        async function showDataDetails(id) {
            let url = '{{ route('cms.consulting-page.ai-powered-insights.show', ['id' => ':id']) }}';
            url = url.replace(':id', id);

            try {
                let response = await axios.get(url);
                if (response.data && response.data.data) {
                    let data = response.data.data;
                    let modalBody = document.querySelector('#viewDataModal .modal-body');
                    modalBody.innerHTML = `
                        <p><strong>Title:</strong> ${data.title}</p>
                        <p><strong>Description:</strong> ${data.description}</p>
                    `;
                } else {
                    toastr.error('No data returned from the server.');
                }
            } catch (error) {
                console.error(error);
                toastr.error('Could not fetch details.');
            }
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
            let url = '{{ route('cms.consulting-page.ai-powered-insights.status', ['id' => ':id']) }}'.replace(':id', id);

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
            const url = '{{ route('cms.consulting-page.ai-powered-insights.destroy', ['id' => ':id']) }}'.replace(':id',
                id);

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
