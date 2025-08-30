@extends('seller_layout.master')

@section('title')
    HomeStays List
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
                        <h1>HomeStays</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active">HomeStays</li>
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
                                <div class="d-flex justify-content-between align-items-between">
                                    <h3 class="card-title">HomeStays List</h3>
                                    <a href="{{ route('homestays.create') }}" class="btn btn-primary btn-sm">
                                        + Add New HomeStays
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="homestays_list" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>City</th>
                                            <th>Approve</th>
                                            <th>Show</th>
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
                                            <th>City</th>
                                            <th>Approve</th>
                                            <th>Show</th>
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

        {{-- modal view for details-start --}}
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Large Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- modal view for details-end --}}
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
            let tables = $("#homestays_list").DataTable({
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
                    url: "{{ route('homestays.homeStayList') }}",
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
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'approve',
                        name: 'approve',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'show',
                        name: 'show',
                        orderable: false,
                        searchable: false
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
            }).buttons().container().appendTo('#homestays_list_wrapper .col-md-6:eq(0)');

            // Show homestay details
            window.showHomeStayFunction = function(button) {
                const row = $(button).closest('tr');
                const data = tables.row(row).data();
                $('#homestay-details').html(`
                    <p><strong>ID:</strong> ${data.id}</p>
                    <p><strong>Name:</strong> ${data.name}</p>
                    <p><strong>City:</strong> ${data.city}</p>
                    <p><strong>Approved:</strong> ${data.is_approved ? 'Yes' : 'No'}</p>
                `);
            };

            // Approve checkbox toggle
            $('#homestays_list').on('click', '.approve-checkbox', function() {
                const id = $(this).data('id');
                const isApproved = $(this).is(':checked');
                $.ajax({
                    url: '{{ route('homestays.approve', ':id') }}'.replace(':id', id),
                    type: 'PUT',
                    data: {
                        is_approved: isApproved
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr) {
                        console.error('Approval error:', xhr.responseText);
                        alert('Failed to update approval status');
                        $(this).prop('checked', !isApproved); // Revert checkbox
                    }
                });
            });

            // Delete homestay
            $('#homestays_list').on('click', '.delete-btn', function() {
                if (confirm('Are you sure you want to delete this homestay?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: '{{ route('homestays.destroy', ':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        success: function(response) {
                            tables.ajax.reload();
                            alert(response.message);
                        },
                        error: function(xhr) {
                            console.error('Delete error:', xhr.responseText);
                            alert('Failed to delete homestay');
                        }
                    });
                }
            });
        });
    </script>
@endsection
