@extends('backend.layouts.master')

@section('title')
    Admin | Sellers
@endsection

@section('styles')
@endsection

@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="">
                                    <h3 class="card-title">Users List</h3>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="users_list" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Show</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Show</th>
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
@endsection


@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // show list table data
            let tables = $("#users_list").DataTable({
                responsive: true,
                lengthChange: true, // Enable page length menu
                lengthMenu: [20, 50, 100], // Options for rows per page
                pageLength: 20, // Default rows per page
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                processing: true,
                serverSide: true,
                scrollX: true,
                order: [
                    [1, 'desc']
                ], // Sort by 'id' column (index 1) in descending order
                ajax: {
                    url: "{{ route('registered-seller.list') }}",
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
                        alert('Failed to load homestay data: ' + xhr.status + ' ' + xhr.statusText);
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
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'show',
                        name: 'show',
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
            })
            // .buttons().container().appendTo('#users_list_wrapper .col-md-6:eq(0)');
            // Append DataTable buttons
            tables.buttons().container().appendTo('#users_list_wrapper .col-md-6:eq(0)');

            // Debug: Log the DataTable instance to ensure it's valid
            // console.log('DataTable instance after init:', tables);

            // Delete user
            $('#users_list').on('click', '.delete-btn', function() {
                if (confirm('Are you sure you want to delete this seller?')) {
                    const id = $(this).data('id');
                    // Debug: Log the table instance before delete
                    // console.log('Table instance before delete:', tables);

                    $.ajax({
                        url: '{{ route('admin.sellers.delete', ':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        success: function(response) {
                            // console.log('Delete response:', response); // Debug: Log delete response

                            // Check if tables is a valid DataTable instance
                            if (tables && typeof tables.ajax === 'object' && typeof tables.ajax
                                .reload === 'function') {
                                tables.ajax.reload(function(json) {
                                    // console.log('Reload success response:', json); // Debug: Log reload response
                                    alert(response.message ||
                                        'Seller deleted successfully!');
                                }, false); // false preserves paging
                            } else {
                                console.error('Invalid DataTable instance:', tables);
                                alert(
                                    'Error: Unable to reload table. Please refresh the page.'
                                );
                                // Optional: Attempt to reinitialize or redirect
                                window.location.reload(); // Fallback to page refresh
                            }
                        },
                        error: function(xhr) {
                            console.error('Delete error:', xhr.responseText);
                            alert('Failed to delete seller');
                        }
                    });
                }
            });
        });
    </script>
@endsection
