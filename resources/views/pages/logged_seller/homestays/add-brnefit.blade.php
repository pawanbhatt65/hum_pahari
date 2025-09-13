@extends('seller_layout.master')

@section('title')
    Homestay: Add Benefit
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
                        <h1>Add Benefit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Add Benefit</li>
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
                    <form id="editBenefitForm" action="{{ route('homestays.postAddNewBenefit', $id) }}" class="col-md-12"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Benefit</label>
                            <input type="text" name="name" id="name" placeholder="Enter Benefit" value=""
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
@endsection
