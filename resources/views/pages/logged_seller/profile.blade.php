@extends('seller_layout.master')

@section('title')
    Add HomeStays
@endsection

@section('styles')
    <style>
        .error {
            color: rgb(204, 14, 14);
        }

        #check_in_time-error,
        #check_out_time-error {
            flex-basis: 100%
        }

        .multiple-files {}
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
                        <h1>Add Homestay</h1>
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
                            <li class="breadcrumb-item active">Add Homestay</li>
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
                    <div class="col-md-8 col-lg-6 offset-md-2 offset-lg-3">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile: {{ auth()->user()->name }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" method="POST"
                                action="{{ route('seller.updateProfile', auth()->user()->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    {{-- about-Homestay --}}
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="homeStaysName">Name</label>
                                            <input type="text" name="name" class="form-control" id="homeStaysName"
                                                value="{{ auth()->user()->name ?? old('name') }}" placeholder="Enter Name">
                                            @error('name')
                                                <div class="text-danger error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" name="mobile" class="form-control" id="mobile"
                                                value="{{ auth()->user()->mobile ?? old('mobile') }}"
                                                placeholder="Enter Mobile">
                                            @error('mobile')
                                                <div class="text-danger error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ auth()->user()->email ?? old('email') }}"
                                                placeholder="Enter Email" readonly>
                                            @error('email')
                                                <div class="text-danger error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
@endsection
