@extends('seller_layout.master')

@section('title')
    HomeStays: Safety-Security
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
                        <h1>Safety & Security</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Safety & Security</li>
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
                                    <h3 class="card-title">Safety & Security List</h3>
                                    <a href="" id="add-new-safety-security" class="btn btn-primary btn-sm">
                                        + Add New Safety & Security
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="safetySecurity_list" class="table table-bordered table-striped">
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
                <form id="editSafetySecurityForm" action="" method="POST">
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
                                        <label for="name">Safety & Security</label>
                                        <input type="text" name="name" id="name" placeholder="Enter Safety & Security"
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

            // add action parameter on add new safety & security link
            var routeTemplate = "{{ route('homestays.getAddNewSafetySecurity', ':id') }}";
            var fullUrl = routeTemplate.replace(':id', url);
            $("#add-new-safety-security").attr("href", fullUrl);

            // show list table data
            let tables = $("#safetySecurity_list").DataTable({
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
                    url: '{{ route('homestays.safetySecurities', ':id') }}'.replace(':id', url),
                    type: 'GET',
                    dataSrc: function(json) {
                        if (!json || json.error) {
                            console.error('Invalid JSON response:', json);
                            alert('Error loading data: ' + (json?.error || 'Invalid response'));
                            return [];
                        }
                        // console.log("json data: ", json.data)
                        return json.data;
                    },
                    error: function(xhr, error, thrown) {
                        console.error('DataTables AJAX error:', xhr.responseText, error, thrown);
                        alert('Failed to load safety & security data: ' + xhr.status + ' ' + xhr.statusText);
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
            tables.buttons().container().appendTo('#safetySecurity_list_wrapper .col-md-6:eq(0)');

            // Handle edit button click
            $('#safetySecurity_list').on('click', '.edit_btn', function(e) {
                e.preventDefault(); // Prevent default button behavior
                // console.log('Edit button clicked'); // Debug
                const homestayId = $(this).data('homestay-id');
                const safetySecurityId = $(this).data('safety-security-id');
                // console.log('Homestay ID:', homestayId, 'safety & security ID:', safetySecurityId); // Debug

                const ajaxUrl = `/seller/homestays/${homestayId}/safety-security/edit/${safetySecurityId}`;

                // console.log('AJAX URL:', ajaxUrl); // Debug

                $.ajax({
                    url: ajaxUrl,
                    type: 'GET',
                    success: function(data) {
                        // console.log('AJAX success:', data); // Debug
                        if (data.error) {
                            console.error('Error fetching safety & security:', data.error);
                            alert('Error: ' + data.error);
                            return;
                        }

                        const user_data = data.data;
                        // console.log('Fetched data:', user_data);

                        // Populate modal form
                        $('#editSafetySecurityForm').attr('action',
                            "{{ route('homestays.putEditSafetySecurity', ['id' => ':id', 'safety_security_id' => ':safety_security_id']) }}"
                            .replace(':id', homestayId)
                            .replace(':safety_security_id', safetySecurityId));
                        $('#editModal #name').val(user_data.name || '');
                        $('#editModal .modal-title').text((user_data.home_stay.name || '') +
                            ' Safety & Security Edit');

                        // Show modal
                        $('#editModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error('AJAX error:', xhr.responseJSON);
                        alert('Error fetching safety & security data: ' + (xhr.responseJSON?.error ||
                            'Unknown error'));
                    }
                });
            });

            // Handle form submission
            $('#editSafetySecurityForm').on('submit', function(e) {
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
                        alert('Error updating safety & security: ' + (xhr.responseJSON?.error ||
                            'Unknown error'));
                    }
                });
            });


            // Handle delete button click
            $('#safetySecurity_list').on('click', '.delete-btn', function() {
                const homestayId = $(this).data('homestay-id');
                const safetySecurityId = $(this).data('safety-security-id');

                if (confirm('Are you sure you want to delete this safety & security?')) {
                    $.ajax({
                        url: '{{ route('homestays.deleteSafetySecurity', ['id' => ':homestay_id', 'safety_security_id' => ':safety_security_id']) }}'
                            .replace(':homestay_id', homestayId)
                            .replace(':safety_security_id', safetySecurityId),
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
                            alert('Error deleting safety security: ' + (xhr.responseJSON?.error ||
                                'Unknown error'));
                        }
                    });
                }
            });
        });
    </script>
@endsection
