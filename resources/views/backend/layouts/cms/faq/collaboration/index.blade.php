@extends('backend.app')

@section('title', 'Collaboration')

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
            {{-- Start page title --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cms.faq.collaboration.index') }}">CMS</a>
                                </li>
                                <li class="breadcrumb-item active">FAQ</li>
                                <li class="breadcrumb-item active">Collaboration</li>
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
                            <form method="POST" action="{{ route('cms.faq.collaboration.preview.update') }}">
                                @csrf
                                @method('PATCH')
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div>
                                            <label for="title" class="form-label">Title:</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" id="title" placeholder="Please Enter Title"
                                                value="{{ old('title', $collaboration->title ?? '') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="main_description" name="description"
                                            placeholder="About System...">{{ old('description', $collaboration->description ?? '') }}</textarea>
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
                            <h5 class="card-title mb-0">All Frequently Asked Questions</h5>
                            <a href="{{ route('cms.faq.collaboration.create') }}" class="btn btn-primary btn-sm"
                                id="addNewPage">Add FAQ</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="column-id">#</th>
                                            <th class="column-content">Question</th>
                                            <th class="column-content">Answer</th>
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

    {{-- Modal for viewing FAQ details start --}}
    <div class="modal fade" id="viewFAQModal" tabindex="-1" aria-labelledby="FAQModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="FAQModalLabel" class="modal-title">FAQ Details</h5>
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
    {{-- Modal for viewing FAQ details end --}}
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
                        url: "{{ route('cms.faq.collaboration.index') }}",
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
                            data: 'question',
                            name: 'question',
                            orderable: true,
                            searchable: true,
                            width: '40%',
                            render: function(data) {
                                return '<div style="white-space:normal;word-break:break-word;">' +
                                    data + '</div>';
                            }
                        },
                        {
                            data: 'answer',
                            name: 'answer',
                            orderable: true,
                            searchable: true,
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
                            width: '5%'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            // width: '10%'
                        },
                    ],
                });

                $('#datatable').on('draw.dt', function() {
                    $('td.column-action').each(function() {
                        let buttonCount = $(this).find('button').length;
                        let width = 5 + (buttonCount - 1) * 5;
                        $(this).css('width', width + '%');
                    });
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        // Fetch and display FAQ details in the modal
        async function showFAQDetails(id) {
            let url = '{{ route('cms.faq.collaboration.show', ['id' => ':id']) }}';
            url = url.replace(':id', id);

            try {
                let response = await axios.get(url);
                if (response.data && response.data.data) {
                    let data = response.data.data;
                    let modalBody = document.querySelector('#viewFAQModal .modal-body');
                    modalBody.innerHTML = `
                    <p><strong>Question:</strong> ${data.question}</p>
                    <p><strong>Answer:</strong> ${data.answer}</p>
                `;
                } else {
                    toastr.error('No data returned from the server.');
                }
            } catch (error) {
                console.error(error);
                toastr.error('Could not fetch FAQ details.');
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
            let url = '{{ route('cms.faq.collaboration.status', ['id' => ':id']) }}'.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url.replace(':id', id),
                success: function(resp) {
                    console.log(resp);
                    $('#datatable').DataTable().ajax.reload();
                    if (resp.success === true) {
                        toastr.success(resp.message);
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred. Please try again.');
                }
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
            let url = '{{ route('cms.faq.collaboration.destroy', ['id' => ':id']) }}'.replace(':id', id);
            let csrfToken = '{{ csrf_token() }}';
            $.ajax({
                type: "DELETE",
                url: url.replace(':id', id),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(resp) {
                    $('#datatable').DataTable().ajax.reload();
                    if (resp['t-success']) {
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }
    </script>
@endpush
