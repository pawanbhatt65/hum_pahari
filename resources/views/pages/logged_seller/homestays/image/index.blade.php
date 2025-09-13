@extends('seller_layout.master')

@section('title')
    HomeStays: Image
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
                        <h1>Image</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Image</li>
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
                                    <h3 class="card-title">Image List</h3>
                                    <a href="" id="add-new-image" class="btn btn-primary btn-sm">
                                        + Add New Image
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="image_list" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Image</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Image</th>
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

            let url = window.location.href.split('/').slice(-2)[0];
            // console.log("url is: ", url);

            // add action parameter on add new Image link
            var routeTemplate = "{{ route('homestays.getAddNewImage', ':id') }}";
            var fullUrl = routeTemplate.replace(':id', url);
            $("#add-new-image").attr("href", fullUrl);

            // show list table data
            let tables = $("#image_list").DataTable({
                responsive: true,
                lengthMenu: [], // Options for rows per page
                lengthChange: false, // Enable page length menu
                pageLength: 10, // Default rows per page
                autoWidth: false,
                buttons: [],
                processing: true,
                serverSide: true,
                scrollX: true,
                "searching": false,
                order: [
                    [1, 'desc']
                ], // Sort by 'id' column (index 1) in descending order
                ajax: {
                    url: '{{ route('homestays.images', ':id') }}'.replace(':id', url),
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
                        alert('Failed to load Image data: ' + xhr.status + ' ' + xhr.statusText);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image'
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
            tables.buttons().container().appendTo('#image_list_wrapper .col-md-6:eq(0)');


            // Handle delete button click
            $('#image_list').on('click', '.delete-btn', function() {
                const homestayId = $(this).data('homestay-id');
                const imageId = $(this).data('image-id');

                if (confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: '{{ route('homestays.deleteImage', ['id' => ':homestay_id', 'image_id' => ':image_id']) }}'
                            .replace(':homestay_id', homestayId)
                            .replace(':image_id', imageId),
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
                            alert('Error deleting image: ' + (xhr.responseJSON
                                ?.error ||
                                'Unknown error'));
                        }
                    });
                }
            });
        });
    </script>
@endsection
