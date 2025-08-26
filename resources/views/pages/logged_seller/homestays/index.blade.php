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
                                <a href="{{ route('seller.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">HomeStays</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
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
                    <div id="jsGrid1"></div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('scripts')
    <script>
        $(function() {
            $("#jsGrid1").jsGrid({
                height: "100%",
                width: "100%",

                sorting: true,
                paging: true,

                data: homestays,

                fields: [{
                        name: "Name",
                        type: "text",
                        width: 150
                    },
                    {
                        name: "Age",
                        type: "number",
                        width: 50
                    },
                    {
                        name: "Address",
                        type: "text",
                        width: 200
                    },
                    {
                        name: "Country",
                        type: "select",
                        items: db.countries,
                        valueField: "Id",
                        textField: "Name"
                    },
                    {
                        name: "Married",
                        type: "checkbox",
                        title: "Is Married"
                    }
                ]
            });
        });
    </script>
@endsection
