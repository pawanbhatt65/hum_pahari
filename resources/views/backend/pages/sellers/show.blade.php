@extends('backend.layouts.master')

@section('title')
    Admin | Seller | Show
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
                            <li class="breadcrumb-item">
                                <a href="{{ route('registered-seller.list') }}">
                                    Seller
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ $seller->name }}</li>
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
                                <table id="homestays_list" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>State</th>
                                            <th>District</th>
                                            <th>Price (RS)</th>
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
                                            <th>State</th>
                                            <th>District</th>
                                            <th>Price (RS)</th>
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

            let url = window.location.href.split('/').slice(-1)[0];
            // console.log("url: ", url)

            // edit homestay route on breadcrumb
            var showRouteTemplate = "{{ route('admin.sellers.show_list', ':id') }}";
            var showFullURL = showRouteTemplate.replace(':id', url);

            // show list table data
            let tables = $("#homestays_list").DataTable({
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
                    url: showFullURL,
                    type: 'GET',
                    dataSrc: function(json) {
                        if (!json || json.error) {
                            console.error('Invalid JSON response:', json);
                            alert('Error loading data: ' + (json?.error || 'Invalid response'));
                            return [];
                        }
                        // console.log("json.data: ", json.data);
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
                        data: 'stateName',
                        name: 'stateName'
                    },
                    {
                        data: 'districtName',
                        name: 'districtName',
                    },
                    {
                        data: 'price',
                        name: 'price',
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
            // .buttons().container().appendTo('#homestays_list_wrapper .col-md-6:eq(0)');
            // Append DataTable buttons
            tables.buttons().container().appendTo('#homestays_list_wrapper .col-md-6:eq(0)');

            // Show homestay details: when show button clicked
            window.showHomeStayFunction = function(button) {
                const id = $(button).data("id"); // Use .data() for cleaner attribute access
                console.log("id is: ", id);

                // Fetch modal data and show in modal
                $.ajax({
                    url: "{{ route('homestays.show', ':id') }}".replace(':id',
                        id), // Dynamically replace :id
                    type: "GET",
                    success: function(data) {
                        if (data.error) {
                            console.error('Error fetching homestay:', data.error);
                            alert('Error: ' + data.error);
                            return;
                        }

                        const user_data = data.data_row;
                        // console.log('Fetched data:', user_data);

                        // Update modal content (adjust selectors and fields as per your modal structure)
                        $("#modal-lg #homestayName").text(user_data.name || 'N/A');
                        $("#modal-lg #homestayCity").text(user_data.city || 'N/A');
                        $("#modal-lg #homestayId").text(user_data.id || 'N/A');
                        // Example: $("#modal-lg #idProof").text(user_data.id_type || 'N/A'); // If id_type exists in your model

                        // Show the modal
                        $("#modal-lg").modal("show");
                    },
                    error: function(xhr) {
                        console.error('AJAX error:', xhr.responseJSON);
                        alert('Error fetching homestay data: ' + (xhr.responseJSON?.error ||
                            'Unknown error'));
                    }
                });
            };

            // Delete homestay
            $('#homestays_list').on('click', '.delete-btn', function() {
                if (confirm('Are you sure you want to delete this homestay?')) {
                    const seller_id = $(this).data('seller_id');
                    const homestay_id = $(this).data('homestay_id');
                    // console.log("seller_id: ", seller_id, "homestay_id: ", homestay_id)

                    let url =
                        "{{ route('admin.homestay.Delete', ['seller_id' => ':seller_id', 'homestay_id' => ':homestay_id']) }}";

                    url = url.replace(':seller_id', seller_id).replace(':homestay_id', homestay_id);

                    // console.log(url);

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(response) {
                            // console.log('Delete response:', response); // Debug: Log delete response

                            // Check if tables is a valid DataTable instance
                            if (tables && typeof tables.ajax === 'object' && typeof tables.ajax
                                .reload === 'function') {
                                tables.ajax.reload(function(json) {
                                    // console.log('Reload success response:', json); // Debug: Log reload response
                                    alert(response.message ||
                                        'Homestay deleted successfully!');
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
                            alert('Failed to delete homestay');
                        }
                    });
                }
            });
        });
    </script>
@endsection
