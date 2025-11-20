@extends('seller_layout.master')

@section('title')
    HomeStays: Common-Space
@endsection

@section('styles')
    <style>

    </style>
@endsection

@section('contents')
    <div class="content-wrapper">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Common Space</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('homestays.index') }}">
                                    Homestays
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a id="editHomestayRoute" href="">
                                    Edit Homestay
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Common Space</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-between">
                                    <h3 class="card-title">Common Space List</h3>
                                    <a href="" id="add-new-common-space" class="btn btn-primary btn-sm">
                                        + Add New Common Space
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="commonSpace_list" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    {{-- modal view for details-start --}}
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="benefit-details">
                <form id="editCommonSpaceForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title">Homestay Name</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Common Space</label>
                                        <input type="text" name="name" id="name" placeholder="Enter Common Space"
                                            value="" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">Update It</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- modal view for details-end --}}
@endsection


@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let url = window.location.href.split('/').slice(-2)[0];
            // console.log("url is: ", url);

            // edit homestay route on breadcrumb
            var editRouteTemplate = "{{ route('homestays.edit', ':id') }}";
            var editFullUrl = editRouteTemplate.replace(':id', url);
            $("#editHomestayRoute").attr("href", editFullUrl);

            // add action parameter on add new common space link
            var routeTemplate = "{{ route('homestays.getAddNewCommonSpace', ':id') }}";
            var fullUrl = routeTemplate.replace(':id', url);
            $("#add-new-common-space").attr("href", fullUrl);

            // show list table data
            let tables = $("#commonSpace_list").DataTable({
                responsive: true,
                lengthChange: true, // Enable page length menu
                lengthMenu: [10, 15, 20], // Options for rows per page
                pageLength: 10, // Default rows per page
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                processing: true,
                serverSide: true,
                scrollX: true,
                order: [
                    [1, 'desc']
                ], // Sort by 'id' column (index 1) in descending order
                ajax: {
                    url: '{{ route('homestays.commonSpaceses', ':id') }}'.replace(':id', url),
                    type: 'GET',
                    dataSrc: function(json) {
                        if (!json || json.error) {
                            console.error('Invalid JSON response:', json);
                            alert('Error loading data: ' + (json?.error || 'Invalid response'));
                            return [];
                        }
                        return json.data;
                    },
                    error: function(xhr, error, thrown) {
                        console.error('DataTables AJAX error:', xhr.responseText, error, thrown);
                        alert('Failed to load common space data: ' + xhr.status + ' ' + xhr.statusText);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            // Now chain buttons separately on the API instance to avoid overwriting 'tables'
            tables.buttons().container().appendTo('#commonSpace_list_wrapper .col-md-6:eq(0)');

            // Handle edit button click
            $('#commonSpace_list').on('click', '.edit_btn', function(e) {
                e.preventDefault(); // Prevent default button behavior
                // console.log('Edit button clicked'); // Debug
                const homestayId = $(this).data('homestay-id');
                const commonSpaceId = $(this).data('common-space-id');
                // console.log('Homestay ID:', homestayId, 'common space ID:', commonSpaceId); // Debug

                const ajaxUrl = `/seller/homestays/${homestayId}/common-spaces/edit/${commonSpaceId}`;

                // console.log('AJAX URL:', ajaxUrl); // Debug

                $.ajax({
                    url: ajaxUrl,
                    type: 'GET',
                    success: function(data) {
                        // console.log('AJAX success:', data); // Debug
                        if (data.error) {
                            console.error('Error fetching common space:', data.error);
                            alert('Error: ' + data.error);
                            return;
                        }

                        const user_data = data.data;
                        // console.log('Fetched data:', user_data);

                        // Populate modal form
                        $('#editCommonSpaceForm').attr('action',
                            "{{ route('homestays.putEditCommonSpace', ['id' => ':id', 'common_spaces_id' => ':common_spaces_id']) }}"
                            .replace(':id', homestayId)
                            .replace(':common_spaces_id', commonSpaceId));
                        $('#editModal #name').val(user_data.name || '');
                        $('#editModal .modal-title').text((user_data.home_stay.name || '') +
                            ' Common Space Edit');

                        // Show modal
                        $('#editModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error('AJAX error:', xhr.responseJSON);
                        alert('Error fetching common space data: ' + (xhr.responseJSON?.error ||
                            'Unknown error'));
                    }
                });
            });

            // Handle form submission
            $('#editCommonSpaceForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const url = form.attr('action');

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            $('#editModal').modal('hide');
                            tables.ajax.reload();
                        } else {
                            alert('Error: ' + (response.error || 'Unknown error'));
                        }
                    },
                    error: function(xhr) {
                        console.error('AJAX error:', xhr.responseJSON);
                        alert('Error updating common space: ' + (xhr.responseJSON?.error ||
                            'Unknown error'));
                    }
                });
            });


            // Handle delete button click
            $('#commonSpace_list').on('click', '.delete-btn', function() {
                const homestayId = $(this).data('homestay-id');
                const commonSpaceId = $(this).data('common-space-id');

                if (confirm('Are you sure you want to delete this common space?')) {
                    $.ajax({
                        url: '{{ route('homestays.deleteCommonSpace', ['id' => ':homestay_id', 'common_spaces_id' => ':common_spaces_id']) }}'
                            .replace(':homestay_id', homestayId)
                            .replace(':common_spaces_id', commonSpaceId),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.success);
                                tables.ajax.reload();
                            } else {
                                alert('Error: ' + (response.error || 'Unknown error'));
                            }
                        },
                        error: function(xhr) {
                            console.error('AJAX error:', xhr.responseText);
                            alert('Error deleting common space: ' + (xhr.responseJSON?.error ||
                                'Unknown error'));
                        }
                    });
                }
            });
        });
    </script>
@endsection
