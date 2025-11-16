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
                                <h3 class="card-title">Add <small>Stays</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" method="POST" action="{{ route('homestays.store') }}"
                                enctype="multipart/form-data">
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

                                    {{-- address --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Homestay <small><em>Address Details</em>
                                                </small></label>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="state">State</label>
                                            <select class="form-control select2" id="state" name="state_id"
                                                style="width: 100%;" value="{{ old('state_id') }}">
                                                <option value="" selected="selected">Select State</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="district">District</label>
                                            <select class="form-control select2" id="district" name="district_id"
                                                value="{{ old('district_id') }}" style="width: 100%;">
                                                <option value="" selected="selected">Select District</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="city">City</label>
                                            <input type="text" name="city" class="form-control" id="city"
                                                value="{{ old('city') }}" placeholder="Enter Homestay City">
                                            <div class="text-danger error"></div>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" class="form-control" id="address"
                                                value="{{ old('address') }}" placeholder="Enter Address">
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="pin">Pin Code</label>
                                            <input type="text" name="pin" class="form-control" id="pin"
                                                value="{{ old('pin') }}" placeholder="Enter Pin Code" maxlength="6">
                                        </div>
                                    </div>

                                    {{-- capacity --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Homestay <small><em>Capacity</em>
                                                </small></label>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="num_adult">Number of Adult</label>
                                            <select class="form-control" id="num_adult" name="num_adult"
                                                style="width: 100%;" value="{{ old('num_adult') }}">
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
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="num_children">Number of Children</label>
                                            <select class="form-control" id="num_children" name="num_children"
                                                value="{{ old('num_children') }}" style="width: 100%;">
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
                                    </div>

                                    {{-- time --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Homestay <small><em>Time</em>
                                                </small></label>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="">Check In Time</label>
                                            <div class="input-group date" id="checkInTime" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#checkInTime" name="check_in_time"
                                                    value="{{ old('check_in_time') }}" />
                                                <div class="input-group-append" data-target="#checkInTime"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="">Checkout Time</label>
                                            <div class="input-group date" id="checkOutTime" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#checkOutTime" name="check_out_time"
                                                    value="{{ old('check_out_time') }}" />
                                                <div class="input-group-append" data-target="#checkOutTime"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- rooms & spaces --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Homestay <small><em>Room & Spaces</em>
                                                </small></label>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="area_sqft">Area (sq.ft)</label>
                                            <input type="text" name="area" class="form-control" id="area_sqft"
                                                value="{{ old('area') }}" placeholder="Enter Area (sq.ft)">
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="">Guest Access</label>
                                            <div class="mt-2">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="yes_guest_access" name="guest_access"
                                                        value="yes"
                                                        {{ old('guest_access', 'yes') == 'yes' ? 'checked' : '' }}>
                                                    <label for="yes_guest_access">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="no_guest_access" name="guest_access"
                                                        value="no" {{ old('guest_access') == 'no' ? 'checked' : '' }}>
                                                    <label for="no_guest_access">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="">Mountain View</label>
                                            <div class="mt-2">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="yes_mountain_view" name="mountain_view"
                                                        value="yes"
                                                        {{ old('mountain_view', 'yes') == 'yes' ? 'checked' : '' }}>
                                                    <label for="yes_mountain_view">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="no_mountain_view" name="mountain_view"
                                                        value="no"
                                                        {{ old('mountain_view') == 'no' ? 'checked' : '' }}>
                                                    <label for="no_mountain_view">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="room_image">Room Image</label>
                                            <input type="file" name="room_image" class="form-control" id="room_image"
                                                value="{{ old('room_image') }}" accept="image/*">
                                        </div>
                                    </div>

                                    <!-- Benefits -->
                                    <div class="benefits-container mb-3">
                                        <div class="col-12">
                                            <label for="">Homestay <small><em>Benefits</em>
                                                </small></label>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                <input type="text" name="benefit[]" class="form-control"
                                                    id="benefits_0" placeholder="Enter Benefit"
                                                    value="{{ old('benefit.0') }}">
                                            </div>
                                        </div>
                                        <div class="button-container col-auto d-flex align-items-end">
                                            <button type="button" class="btn btn-primary btn-sm add-benefit mr-2"><i
                                                    class="fa fa-plus"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm remove-benefit"><i
                                                    class="fa fa-minus"></i></button>
                                        </div>
                                    </div>

                                    <!-- Common Space -->
                                    <div class="common-space-container mb-3">
                                        <div class="col-12">
                                            <label for="">Homestay <small><em>Common Space</em>
                                                </small></label>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                <input type="text" name="common_space[]" class="form-control"
                                                    id="common_space_0" placeholder="Enter Common Space"
                                                    value="{{ old('common_space.0') }}">
                                            </div>
                                        </div>
                                        <div class="button-container col-auto d-flex align-items-end">
                                            <button type="button" class="btn btn-primary btn-sm add-benefit mr-2"><i
                                                    class="fa fa-plus"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm remove-benefit"><i
                                                    class="fa fa-minus"></i></button>
                                        </div>
                                    </div>

                                    {{-- property-amenities --}}
                                    <!-- Safety & Security -->
                                    <div class="safety-security-container mb-3">
                                        <div class="col-12">
                                            <label for="">Homestay <small><em>Safety & Security</em>
                                                </small></label>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                <input type="text" name="safety_security[]" class="form-control"
                                                    id="safety_security_0" placeholder="Enter Safety & Security"
                                                    value="{{ old('safety_security.0') }}">
                                            </div>
                                        </div>
                                        <div class="button-container col-auto d-flex align-items-end">
                                            <button type="button" class="btn btn-primary btn-sm add-benefit mr-2"><i
                                                    class="fa fa-plus"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm remove-benefit"><i
                                                    class="fa fa-minus"></i></button>
                                        </div>
                                    </div>

                                    <!-- Bedding -->
                                    <div class="bedding-container mb-3">
                                        <div class="col-12">
                                            <label for="">Homestay <small><em>Bedding</em>
                                                </small></label>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                <input type="text" name="bedding[]" class="form-control"
                                                    id="bedding_0" placeholder="Enter Bedding"
                                                    value="{{ old('bedding.0') }}">
                                            </div>
                                        </div>
                                        <div class="button-container col-auto d-flex align-items-end">
                                            <button type="button" class="btn btn-primary btn-sm add-benefit mr-2"><i
                                                    class="fa fa-plus"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm remove-benefit"><i
                                                    class="fa fa-minus"></i></button>
                                        </div>
                                    </div>

                                    {{-- rules & policies --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Homestay <small><em>Rules & Policies</em>
                                                </small></label>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="up_to_3_days_prior">Up to 3 days Prior</label>
                                            <select class="form-control" name="up_to_3_days_prior" style="width: 100%;"
                                                value="{{ old('up_to_3_days_prior') }}">
                                                <option value="No Refund" selected="selected">No Refund</option>
                                                <option value="5%">₹5%</option>
                                                <option value="10%">₹10%</option>
                                                <option value="15%">₹15%</option>
                                                <option value="20%">₹20%</option>
                                                <option value="25%">₹25%</option>
                                                <option value="30%">₹30%</option>
                                                <option value="35%">₹35%</option>
                                                <option value="40%">₹40%</option>
                                                <option value="45%">₹45%</option>
                                                <option value="50%">₹50%</option>
                                                <option value="Full Refund">Full Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="up_to_2_days_prior">Up to 2 days Prior</label>
                                            <select class="form-control" name="up_to_2_days_prior" style="width: 100%;"
                                                value="{{ old('up_to_2_days_prior') }}">
                                                <option value="No Refund" selected="selected">No Refund</option>
                                                <option value="5%">₹5%</option>
                                                <option value="10%">₹10%</option>
                                                <option value="15%">₹15%</option>
                                                <option value="20%">₹20%</option>
                                                <option value="25%">₹25%</option>
                                                <option value="30%">₹30%</option>
                                                <option value="35%">₹35%</option>
                                                <option value="40%">₹40%</option>
                                                <option value="45%">₹45%</option>
                                                <option value="50%">₹50%</option>
                                                <option value="Full Refund">Full Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="up_to_1_day_prior">Up to 1 days Prior</label>
                                            <select class="form-control" name="up_to_1_day_prior" style="width: 100%;"
                                                value="{{ old('up_to_1_day_prior') }}">
                                                <option value="No Refund" selected="selected">No Refund</option>
                                                <option value="5%">₹5%</option>
                                                <option value="10%">₹10%</option>
                                                <option value="15%">₹15%</option>
                                                <option value="20%">₹20%</option>
                                                <option value="25%">₹25%</option>
                                                <option value="30%">₹30%</option>
                                                <option value="35%">₹35%</option>
                                                <option value="40%">₹40%</option>
                                                <option value="45%">₹45%</option>
                                                <option value="50%">₹50%</option>
                                                <option value="Full Refund">Full Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="check_in_day">On the day of check-in</label>
                                            <select class="form-control" name="check_in_day" style="width: 100%;"
                                                value="{{ old('check_in_day') }}">
                                                <option value="No Refund" selected="selected">No Refund</option>
                                                <option value="5%">₹5%</option>
                                                <option value="10%">₹10%</option>
                                                <option value="15%">₹15%</option>
                                                <option value="20%">₹20%</option>
                                                <option value="25%">₹25%</option>
                                                <option value="30%">₹30%</option>
                                                <option value="35%">₹35%</option>
                                                <option value="40%">₹40%</option>
                                                <option value="45%">₹45%</option>
                                                <option value="50%">₹50%</option>
                                                <option value="Full Refund">Full Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="no_show">No show</label>
                                            <select class="form-control" name="no_show" style="width: 100%;"
                                                value="{{ old('no_show') }}">
                                                <option value="No Refund" selected="selected">No Refund</option>
                                                <option value="5%">₹5%</option>
                                                <option value="10%">₹10%</option>
                                                <option value="15%">₹15%</option>
                                                <option value="20%">₹20%</option>
                                                <option value="25%">₹25%</option>
                                                <option value="30%">₹30%</option>
                                                <option value="35%">₹35%</option>
                                                <option value="40%">₹40%</option>
                                                <option value="45%">₹45%</option>
                                                <option value="50%">₹50%</option>
                                                <option value="Full Refund">Full Refund</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- /.row images -->
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="images">HomeStay <small><em>Image Upload</em></small></label>
                                            <input type="file" name="images[]" multiple
                                                class="multiple-files form-control" accept="image/*" id="images">
                                            <div id="imgs-error-messages" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                    {{-- location & price --}}
                                    <div class="row">
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="location">Location (Lat, Long)</label>
                                            <input type="text" name="location" class="form-control" id="location"
                                                placeholder="Click to get geolocation" value="{{ old('location') }}"
                                                readonly>
                                            <button type="button" id="getLocation" class="btn btn-primary mt-2">Get
                                                Current Location</button>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="one_night_price">Price <small>Between Check In to Check Out
                                                    Time, with Tax</small></label>
                                            <input type="text" name="one_night_price"
                                                value="{{ old('one_night_price') }}" class="form-control"
                                                id="one_night_price"
                                                placeholder="Enter Price (Between Check In to Check Out Time)">
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

    <script>
        $(function() {
            // Initialize Select2
            $('.select2').select2();

            // Date picker for check-in and check-out (format Y-m-d to match backend)
            $('#checkInTime').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                useCurrent: false,
                minDate: moment() // prevent past date selection
                // minDate: moment().add(1, 'days') // uncomment to enforce at least one day in advance
            });

            $('#checkOutTime').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                useCurrent: false
            });

            // Ensure check-out is after check-in
            $('#checkInTime').on('change.datetimepicker', function(e) {
                $('#checkOutTime').datetimepicker('minDate', e.date);
            });

            // Room count validation (real-time feedback)
            $('#num_room, #num_single_room, #num_double_room').on('change', function() {
                const numRoom = parseInt($('#num_room').val() || '0', 10);
                const numSingle = parseInt($('#num_single_room').val() || '0', 10);
                const numDouble = parseInt($('#num_double_room').val() || '0', 10);
                const errorElement = $('#room-count-error');
                if (numRoom !== numSingle + numDouble && !isNaN(numRoom) && !isNaN(numSingle) && !isNaN(
                        numDouble)) {
                    // if (!errorElement.length) {
                    // alert("Total single and double bedrooms must equal the number of rooms.");
                    // }
                } else {
                    errorElement.remove();
                    $('#num_room, #num_single_room, #num_double_room').removeClass('error');
                    $('#num_room-error, #num_single_room-error, #num_double_room-error').remove();
                }
            });

            // Load states and districts using Axios
            async function loadStates() {
                console.log("Loading states...");
                try {
                    const response = await axios.get('/states');
                    // console.log("States loaded:", response);
                    const select = $('#state');
                    select.append('<option value="">Select State</option>');
                    // console.log("select element:", select);
                    response.data.forEach(state => {
                        // console.log("Adding state:", state);
                        select.append(`<option value="${state.id}">${state.name}</option>`);
                    });
                } catch (error) {
                    console.error('Error loading states:', error);
                    Alert.error('Error', 'Failed to load states.');
                }
            }
            loadStates();

            $('#state').on('change', function() {
                const stateId = $(this).val();
                const districtSelect = $('#district');
                if (stateId) {
                    $(this).parent().find('#state-error').remove();
                    $.ajax({
                        url: `/states/${stateId}/districts`,
                        type: 'GET',
                        success: function(data) {
                            districtSelect.empty().append(
                                '<option value="">Select District</option>');
                            data.forEach(district => {
                                districtSelect.append(
                                    `<option value="${district.id}">${district.name}</option>`
                                );
                            });
                            districtSelect.prop('disabled', false);
                        },
                        error: function() {
                            Alert.error('Error', 'Failed to load districts.');
                        }
                    });
                } else {
                    districtSelect.empty().append('<option value="">Select District</option>').prop(
                        'disabled', true);
                    $(this).parent().find('#state-error').remove();
                }
            });

            $('#district').on('change', function() {
                if ($(this).val()) {
                    $(this).parent().find('#district-error').remove();
                }
            });

            $('#room_image').on('change', function() {
                if ($(this).val()) {
                    $(this).parent().find('#room_image-error').remove();
                }
            });

            // Dynamic fields
            function addDynamicField(containerClass, fieldName, idPrefix) {
                $(`.${containerClass} .add-benefit`).click(function() {
                    const count = $(`.${containerClass} .elms .form-group`).length;
                    const html = `
                <div class="form-group col-12 col-lg-4">
                    <input type="text" name="${fieldName}[]" class="form-control" id="${idPrefix}_${count}" placeholder="Enter ${fieldName.replace(/[-_]/g, ' ')}">
                    <label class="error text-danger" for="${idPrefix}_${count}"></label>
                </div>`;
                    $(`.${containerClass} .elms`).append(html);
                    $('#quickForm').validate().element(`#${idPrefix}_${count}`);
                });

                $(`.${containerClass} .remove-benefit`).click(function() {
                    const formGroups = $(`.${containerClass} .elms .form-group`);
                    if (formGroups.length > 1) {
                        formGroups.last().remove();
                    }
                });
            }

            addDynamicField('benefits-container', 'benefit', 'benefits');
            addDynamicField('common-space-container', 'common_space', 'common_space');
            addDynamicField('safety-security-container', 'safety_security', 'safety_security');
            addDynamicField('bedding-container', 'bedding', 'bedding');


            // Geolocation
            $('#getLocation').click(function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = position.coords.latitude.toFixed(6);
                        const lng = position.coords.longitude.toFixed(6);
                        const locationVal = $('#location').val(`${lat}, ${lng}`);
                        if (locationVal) {
                            $('#location-error').remove(); // Remove any existing error message
                            $('#location').removeClass('error'); // Remove error class if exists
                        } else {
                            $('#location').after(
                                '<label id="location-error" class="error">Please click to Get Current Location button.</label>'
                            );
                        }
                    }, function(error) {
                        alert('Geolocation failed: ' + error.message);
                    });
                } else {
                    alert('Geolocation is not supported by this browser.');
                }
            });

            // Custom validation method for room count equality
            $.validator.addMethod('roomCountEqual', function(value, element, param) {
                const numRoom = parseInt($('#num_room').val() || '0', 10);
                const numSingle = parseInt($('#num_single_room').val() || '0', 10);
                const numDouble = parseInt($('#num_double_room').val() || '0', 10);
                // Only validate if all fields have valid numbers
                if (isNaN(numRoom) || isNaN(numSingle) || isNaN(numDouble)) {
                    return true; // Skip validation if any value is invalid
                }
                return numRoom === numSingle + numDouble;
            }, 'Total single and double bedrooms must equal the number of rooms.');

            // Custom validation methods
            $.validator.addMethod('maxsize', function(value, element, param) {
                if (!element.files || !element.files.length) return true;
                return Array.from(element.files).every(file => file.size <= param);
            }, 'File size must be less than {0} bytes');

            // file count validation for multiple file input
            $.validator.addMethod('filecount', function(value, element, param) {
                const files = element.files || [];
                return files.length >= param.min && files.length <= param.max;
            }, 'Please upload between {0} to {1} files');

            // Form validation
            $('#quickForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 80,
                        pattern: /^[a-zA-Z0-9\s-]+$/
                    },
                    roomType: {
                        required: true
                    },
                    bedroomType: {
                        required: true
                    },
                    num_room: {
                        required: true,
                        min: 1,
                        max: 12,
                        roomCountEqual: true // Add custom rule
                    },
                    num_single_room: {
                        required: true,
                        min: 0,
                        max: 6,
                        roomCountEqual: true // Add custom rule
                    },
                    num_double_room: {
                        required: true,
                        min: 0,
                        max: 6,
                        roomCountEqual: true // Add custom rule
                    },
                    food_allowed: {
                        required: true
                    },
                    note: {
                        pattern: /^[a-zA-Z0-9\s-$&@#+.]+$/
                    },
                    state_id: {
                        required: true
                    },
                    district_id: {
                        required: true
                    },
                    city: {
                        required: true,
                        maxlength: 255
                    },
                    address: {
                        required: true,
                        pattern: /^[a-zA-Z0-9\s,-]+$/
                    },
                    pin: {
                        required: true,
                        digits: true,
                        minlength: 6,
                        maxlength: 6
                    },
                    num_adult: {
                        required: true,
                        min: 1,
                        max: 12
                    },
                    num_children: {
                        required: true,
                        min: 1,
                        max: 12
                    },
                    check_in_time: {
                        required: true,
                        date: true
                    },
                    check_out_time: {
                        required: true,
                        date: true
                    },
                    area: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    guest_access: {
                        required: true
                    },
                    mountain_view: {
                        required: true
                    },
                    room_image: {
                        required: true,
                        accept: "image/*",
                        maxsize: 2097152 // 2MB
                    },
                    'images[]': {
                        required: true,
                        accept: "image/*",
                        maxsize: 819200, // 800KB
                        filecount: {
                            min: 1,
                            max: 10
                        }
                    },
                    'benefit[]': {
                        pattern: /^[a-zA-Z0-9\s-]*$/
                    },
                    'common_space[]': {
                        pattern: /^[a-zA-Z0-9\s-]*$/
                    },
                    'safety_security[]': {
                        pattern: /^[a-zA-Z0-9\s-]*$/
                    },
                    'bedding[]': {
                        pattern: /^[a-zA-Z0-9\s-]*$/
                    },
                    location: {
                        required: true,
                        pattern: /^-?\d+\.\d{6}, -?\d+\.\d{6}$/
                    },
                    one_night_price: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    up_to_3_days_prior: {
                        required: true
                    },
                    up_to_2_days_prior: {
                        required: true
                    },
                    up_to_1_day_prior: {
                        required: true
                    },
                    check_in_day: {
                        required: true
                    },
                    no_show: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter homestay name",
                        maxlength: "Name cannot exceed 80 characters",
                        pattern: "Name can only contain letters, digits, hyphens, and spaces"
                    },
                    roomType: "Please select a room type",
                    bedroomType: "Please select a bedroom type",
                    num_room: {
                        required: "Please select the number of rooms",
                        min: "Number of rooms must be at least 1",
                        max: "Number of rooms cannot exceed 6",
                        roomCountEqual: "Total single and double bedrooms must equal the number of rooms."
                    },
                    num_single_room: {
                        required: "Please select the number of single rooms",
                        min: "Number of single rooms cannot be negative",
                        max: "Number of single rooms cannot exceed 6",
                        roomCountEqual: "Total single and double bedrooms must equal the number of rooms."
                    },
                    num_double_room: {
                        required: "Please select the number of double rooms",
                        min: "Number of double rooms cannot be negative",
                        max: "Number of double rooms cannot exceed 6",
                        roomCountEqual: "Total single and double bedrooms must equal the number of rooms."
                    },
                    food_allowed: "Please select if food is allowed",
                    note: {
                        pattern: "Note can only contain letters, digits, hyphens, spaces, $, &, @, #, +, ."
                    },
                    state_id: "Please select a state",
                    district_id: "Please select a district",
                    city: "Please enter a city",
                    address: {
                        required: "Please enter an address",
                        pattern: "Address can only contain letters, digits, hyphens, commas, and spaces"
                    },
                    pin: {
                        required: "Please enter a pin code",
                        digits: "Pin code must be 6 digits",
                        minlength: "Pin code must be 6 digits"
                    },
                    num_adult: "Please select the number of adults",
                    num_children: "Please select the number of children",
                    check_in_time: "Please select check-in time",
                    check_out_time: "Please select check-out time",
                    area: {
                        required: "Please enter the area",
                        number: "Area must be a number",
                        min: "Area must be at least 0"
                    },
                    guest_access: "Please select guest access option",
                    mountain_view: "Please select mountain view option",
                    room_image: {
                        required: "Please upload a room image",
                        accept: "Only image files are allowed",
                        maxsize: "Room image must be less than 2MB"
                    },
                    'images[]': {
                        required: "Please upload at least one image",
                        accept: "Only image files are allowed",
                        maxsize: "Each image must be less than 800KB",
                        filecount: "Please upload between 1 to 10 images"
                    },
                    'benefit[]': {
                        pattern: "Benefits can only contain letters, digits, hyphens, and spaces"
                    },
                    'common_space[]': {
                        pattern: "Common spaces can only contain letters, digits, hyphens, and spaces"
                    },
                    'safety_security[]': {
                        pattern: "Safety & security items can only contain letters, digits, hyphens, and spaces"
                    },
                    'bedding[]': {
                        pattern: "Bedding items can only contain letters, digits, hyphens, and spaces"
                    },
                    location: {
                        required: "Please click to get geolocation",
                        pattern: "Location must be in the format: latitude, longitude (e.g., 12.345678, 76.543210)"
                    },
                    one_night_price: {
                        required: "Please enter the price",
                        number: "Price must be a number",
                        min: "Price must be at least 0"
                    },
                    up_to_3_days_prior: "Please select a refund policy",
                    up_to_2_days_prior: "Please select a refund policy",
                    up_to_1_day_prior: "Please select a refund policy",
                    check_in_day: "Please select a refund policy",
                    no_show: "Please select a refund policy"
                },
                errorPlacement: function(error, element) {
                    if (element.attr('name') === 'images[]') {
                        error.appendTo('#imgs-error-messages');
                    } else if (['benefit[]', 'common_space[]', 'safety_security[]', 'bedding[]']
                        .includes(element.attr('name'))) {
                        error.insertAfter(element);
                    } else {
                        error.appendTo(element.parent());
                    }
                    error.addClass('d-block text-danger');
                },
                highlight: function(element) {
                    $(element).addClass('error');
                },
                unhighlight: function(element) {
                    $(element).removeClass('error');
                },
                submitHandler: function(form) {
                    // Ensure at least one benefit, common_space, etc., is non-empty
                    const dynamicFields = ['benefit[]', 'common_space[]', 'safety_security[]',
                        'bedding[]'
                    ];
                    let hasValidDynamicField = false;
                    dynamicFields.forEach(field => {
                        const values = $(`input[name="${field}"]`).map(function() {
                            return $(this).val();
                        }).get();
                        if (values.some(val => val.trim() !== '')) {
                            hasValidDynamicField = true;
                        }
                    });

                    // Check room count equality
                    const numRoom = parseInt($('#num_room').val()) || 0;
                    const numSingle = parseInt($('#num_single_room').val()) || 0;
                    const numDouble = parseInt($('#num_double_room').val()) || 0;
                    if (numRoom !== numSingle + numDouble) {
                        alert("Total single and double bedrooms must equal the number of rooms.");
                        return;
                    }

                    if (!hasValidDynamicField) {
                        alert(
                            'Please provide at least one benefit, common space, safety & security, or bedding item.'
                        );
                        return false;
                    }
                    form.submit();
                }
            });
        });
    </script>
@endsection
