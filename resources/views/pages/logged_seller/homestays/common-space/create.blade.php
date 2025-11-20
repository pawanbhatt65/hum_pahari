@extends('seller_layout.master')

@section('title')
    Homestay: Add Common Space
@endsection

@section('styles')
    <style>
        .error {
            color: rgb(204, 14, 14);
        }
    </style>
@endsection

@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Common Space</h1>
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
                            <li class="breadcrumb-item">
                                <a id="editCommonSpaceRoute" href="">
                                    Common Space
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Add Common Space</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <form id="editBenefitForm" action="{{ route('homestays.postAddNewCommonSpace', $id) }}" class="col-md-12"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Common Space</label>
                            <input type="text" name="name" id="name" placeholder="Enter Common Space" value=""
                                class="form-control" required>
                        </div>
                        <button type="Submit" class="btn btn-primary">Add It</button>
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // edit homestay route on breadcrumb
            var editRouteTemplate = "{{ route('homestays.edit', ':id') }}";
            var editFullUrl = editRouteTemplate.replace(':id', "{{ $id }}");
            $("#editHomestayRoute").attr("href", editFullUrl);

            // edit benefit route on breadcrumb
            var editCommonSpaceRouteTemplate = "{{ route('homestays.commonSpaceses', ':id') }}";
            var editCommonSpaceRoute = editCommonSpaceRouteTemplate.replace(':id', "{{ $id }}");
            $("#editCommonSpaceRoute").attr("href", editCommonSpaceRoute);
        });
    </script>
@endsection
