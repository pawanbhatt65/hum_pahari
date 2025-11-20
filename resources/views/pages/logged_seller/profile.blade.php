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
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" method="POST" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    {{-- about-Homestay --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Homestay <small><em>Basic Details</em>
                                                </small></label>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="homeStaysName">Homestay Name</label>
                                            <input type="text" name="name" class="form-control" id="homeStaysName"
                                                value="{{ old('name') }}" placeholder="Enter Homestay Name">
                                            <div class="text-danger error"></div>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Room Type</label>
                                            <select class="form-control" name="roomType" style="width: 100%;"
                                                value="{{ old('roomType') }}">
                                                <option value="Standard" selected="selected">Standard</option>
                                                <option value="Deluxe">Deluxe</option>
                                            </select>
                                            <div class="text-danger error"></div>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Bedroom Type</label>
                                            <select class="form-control" name="bedroomType" style="width: 100%;"
                                                value="{{ old('bedroomType') }}">
                                                <option value="Single Bedroom" selected="selected">Single Bedroom</option>
                                                <option value="Double Bedroom">Double Bedroom</option>
                                                <option value="Both">Both</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Number of Bedrooms</label>
                                            <select class="form-control" name="num_room" id="num_room" style="width: 100%;"
                                                value="{{ old('num_room') }}">
                                                <option value="1" selected="selected">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Number of Single Bedrooms</label>
                                            <select class="form-control" name="num_single_room" id="num_single_room"
                                                value="{{ old('num_single_room') }}" style="width: 100%;">
                                                <option value="0" selected="selected">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Number of Double Bedrooms</label>
                                            <select class="form-control" name="num_double_room" id="num_double_room"
                                                value="{{ old('num_double_room') }}" style="width: 100%;">
                                                <option value="0" selected="selected">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="">Food Allowed</label>
                                            <div class="mt-2">
                                                <div class="icheck-primary d-inline mr-3">
                                                    <input type="radio" id="yes_food_allowed" name="food_allowed"
                                                        value="yes"
                                                        {{ old('food_allowed', 'yes') == 'yes' ? 'checked' : '' }}>
                                                    <label for="yes_food_allowed">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="no_food_allowed" name="food_allowed"
                                                        value="no" {{ old('food_allowed') == 'no' ? 'checked' : '' }}>
                                                    <label for="no_food_allowed">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="add_note">Add Note</label>
                                            <input type="text" name="note" class="form-control" id="add_note"
                                                value="{{ old('note') }}" placeholder="Enter Note">
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
