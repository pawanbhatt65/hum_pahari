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
                                <a href="{{ route('home') }}">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">
                                    Dashboard
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
                <div class="modal-content" id="homestay-details">
                    <div class="modal-header">
                        <h4 class="modal-title">Large Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" id="appointment_id" name="appointment_id" value="">
                                    <h4>
                                        <i class="fa fa-user"></i> : &nbsp;<span class="text-capitalize" id="name">Full
                                            Name</span>
                                        <small class="float-right">Date: <span id="date">2/10/2014</span></small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Email Address</th>
                                            <td><span id="email"></span></td>
                                            <th>Phone Number</th>
                                            <td><span id="phone"></span></td>
                                            <th>Gender</th>
                                            <td id="gender"> </td>
                                        </tr>
                                        <tr>
                                            <th>ID Proof</th>
                                            <td id="idProof"> </td>
                                            <th>ID Number</th>
                                            <td id="idProofNumber"> </td>
                                            <th>Age</th>
                                            <td id="age"> </td>

                                        </tr>
                                        <tr>
                                            <th>Speciality</th>
                                            <td id="speciality"> </td>
                                            <th>Doctor</th>
                                            <td id="specialist"> </td>
                                            <th>Add Doctor</th>
                                            <td id="new_doctor">
                                                {{-- <input type="text" name="add_doctor" id="add_doctor" > --}}
                                                <select id="add_doctor" name="add_doctor" placeholder="Select doctor...">

                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Message</th>
                                            <td id="message"> </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row files_section">
                                <div class="col-12">
                                    <p class="lead">Files:
                                    <div id="appointment_files">
                                    </div>
                                    </p>
                                </div>
                                <div class="col-12">
                                    {{-- <p class="lead" >Audio: <span id="audio"><a href="" target="_blank">click here to play</a></span></p> --}}
                                    <p class="lead">Audio: <span>
                                            <audio id="audio" controls>
                                                <source id="audio_src" src="" type="audio/wav">
                                                Your browser does not support the audio tag.
                                            </audio>
                                        </span></p>
                                </div>
                                <div class="col-12">
                                    {{-- <p class="lead">Video: <span id="video"><a src="">click here to play</a></span></p> --}}
                                    <p class="lead">Video: <span>
                                            <video id="video" width="320" height="240" controls>
                                                <source id="src" src="" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </span></p>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
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
                lengthMenu: [20, 50, 100], // Options for rows per page
                pageLength: 20, // Default rows per page
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                processing: true,
                serverSide: true,
                scrollX: true,
                order: [
                    [1, 'asc']
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
            })
            // .buttons().container().appendTo('#homestays_list_wrapper .col-md-6:eq(0)');
            // Append DataTable buttons
            tables.buttons().container().appendTo('#homestays_list_wrapper .col-md-6:eq(0)');

            // Debug: Log the DataTable instance to ensure it's valid
            console.log('DataTable instance after init:', tables);

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

            // Approve checkbox toggle
            $('#homestays_list').on('click', '.approve-checkbox', function() {
                const id = $(this).data('id');
                const isApproved = $(this).is(':checked');
                // console.log('Toggling approval for ID:', id, 'to', isApproved);
                $.ajax({
                    url: '{{ route('homestays.approve', ':id') }}'.replace(':id', id),
                    type: 'PUT',
                    data: {
                        is_approved: isApproved
                    },
                    success: function(response) {
                        alert(response.success);
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
                    // Debug: Log the table instance before delete
                    // console.log('Table instance before delete:', tables);

                    $.ajax({
                        url: '{{ route('homestays.destroy', ':id') }}'.replace(':id', id),
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
