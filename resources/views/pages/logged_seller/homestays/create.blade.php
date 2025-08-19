@extends('seller_layout.master')

@section('title')
    Add HomeStays
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
                        <h1>Validation</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Validation</li>
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
                            <form id="quickForm" class="">
                                <div class="card-body">
                                    {{-- about-homestays --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Basic Details</h3>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="homeStaysName">HomeStays Name</label>
                                            <input type="text" name="name" class="form-control" id="homeStaysName"
                                                placeholder="Enter HomeStays Name">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label>Type</label>
                                            <div class="select2-purple select2">
                                                <select class="select2" multiple="multiple" data-placeholder="Select a State"
                                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                    <option>Single Bedroom Type</option>
                                                    <option>Double Bedroom Type</option>
                                                    <option>Both</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Room Type</label>
                                            <select class="form-control" name="roomType" style="width: 100%;">
                                                <option selected="selected">Standard</option>
                                                <option>Deluxe</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Bedroom Type</label>
                                            <select class="form-control" name="bedroomType" style="width: 100%;">
                                                <option selected="selected">Single Bedroom</option>
                                                <option>Double Bedroom</option>
                                                <option>Both</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Number of Rooms</label>
                                            <select class="form-control" name="num_room" style="width: 100%;">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Number of Single Bedrooms</label>
                                            <select class="form-control" name="num_single_room"
                                                style="width: 100%;">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label>Number of Double Bedrooms</label>
                                            <select class="form-control" name="num_double_room"
                                                style="width: 100%;">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="">Food Allowed</label>
                                            <div class="">
                                                <div class="icheck-primary d-inline mr-3">
                                                    <input type="radio" id="yes_food_allowed" name="food_allowed"
                                                        value="yes">
                                                    <label for="yes_food_allowed">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="no_food_allowed" name="food_allowed"
                                                        value="no">
                                                    <label for="no_food_allowed">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="add_note">Add Note</label>
                                            <input type="text" name="note" class="form-control" id="add_note"
                                                placeholder="Enter Note">
                                        </div>
                                    </div>

                                    {{-- address --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Address Details</h3>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="exampleInputState1">State</label>
                                            <select class="form-control select2" name="state_id" style="width: 100%;">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="exampleInputEmail1">District</label>
                                            <select class="form-control select2" name="district_id" style="width: 100%;">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="exampleInputEmail1">City</label>
                                            <select class="form-control select2" name="city_id" style="width: 100%;">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="exampleInputAddress1">Address</label>
                                            <input type="text" name="address" class="form-control"
                                                id="exampleInputAddress1" placeholder="Enter Address">
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="exampleInputPin1">Pin Code</label>
                                            <input type="text" name="pin" class="form-control"
                                                id="exampleInputPin1" placeholder="Enter Pin Code" maxlength="6">
                                        </div>
                                    </div>

                                    {{-- capacity --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Homestays Capacity</h3>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="exampleInputEmail1">Number of Adult</label>
                                            <select class="form-control select2" name="num_adult" style="width: 100%;">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="exampleInputEmail1">Number of Children</label>
                                            <select class="form-control select2" name="num_children"
                                                style="width: 100%;">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- time --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Time</h3>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="">Check In Time</label>
                                            <div class="input-group date" id="checkInTime" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#checkInTime" name="checkInTime" />
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
                                                    data-target="#checkOutTime" name="checkOutTime" />
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
                                            <h3>Room & Spaces</h3>
                                        </div>
                                        <div class="form-group col-12 col-lg-3">
                                            <label for="area_sqft">Area (sq.ft)</label>
                                            <input type="text" name="area" class="form-control" id="area_sqft"
                                                placeholder="Enter Area (sq.ft)">
                                        </div>
                                        <div class="form-group col-12 col-lg-3">
                                            <label for="">Guest Access</label>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="yes_guest_access" name="guest_access"
                                                    value="yes">
                                                <label for="yes_guest_access">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="no_guest_access" name="guest_access"
                                                    value="no">
                                                <label for="no_guest_access">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-lg-3">
                                            <label for="">Mountain View</label>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="yes_mountain_view" name="mountain_view"
                                                    value="yes">
                                                <label for="yes_mountain_view">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="no_mountain_view" name="mountain_view"
                                                    value="no">
                                                <label for="no_mountain_view">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 col-lg-3">
                                            <label for="room_image">Room Image</label>
                                            <input type="file" name="room_image" class="form-control"
                                                id="room_image">
                                        </div>
                                    </div>

                                    {{-- benefits --}}
                                    <div class="benefits-container">
                                        <div class="col-12">
                                            <h3>Benefits</h3>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                <label for="benefits_0">Benefits</label>
                                                <input type="text" name="benefit" class="form-control"
                                                    id="benefits_0" placeholder="Enter Benefit">
                                            </div>
                                            <div class="button-container">
                                                <button type="button" class="btn btn-block btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-block btn-danger btn-sm">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- common space --}}
                                    <div class="benefits-container">
                                        <div class="col-12">
                                            <h3>Common Space</h3>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                <label for="common_space">Common Space</label>
                                                <input type="text" name="common_space" class="form-control"
                                                    id="common_space" placeholder="Enter Common Space">
                                            </div>
                                            <div class="button-container">
                                                <button type="button" class="btn btn-block btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-block btn-danger btn-sm">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- property-amenities --}}
                                    {{-- Safety & Security --}}
                                    <div class="benefits-container">
                                        <div class="col-12">
                                            <h3>Safety & Security</h3>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                {{-- <label for="safety_security">Safety & Security</label> --}}
                                                <input type="text" name="safety_security" class="form-control"
                                                    id="safety_security" placeholder="Enter Safety & Security">
                                            </div>
                                            <div class="button-container">
                                                <button type="button" class="btn btn-block btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-block btn-danger btn-sm">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Bedding --}}
                                    <div class="benefits-container">
                                        <div class="elms row">
                                            <div class="col-12">
                                                <h3>Bedding</h3>
                                            </div>
                                            <div class="form-group col-12 col-lg-4">
                                                {{-- <label for="bedding">Bedding</label> --}}
                                                <input type="text" name="bedding" class="form-control" id="bedding"
                                                    placeholder="Enter Bedding">
                                            </div>
                                            <div class="button-container">
                                                <button type="button" class="btn btn-block btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-block btn-danger btn-sm">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- rules & policies --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Rules & Policies</h3>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="up_to_3_days_prior">Up to 3 days Prior</label>
                                            <select class="form-control" name="up_to_3_days_prior" style="width: 100%;">
                                                <option selected="selected">No Refund</option>
                                                <option>₹10%</option>
                                                <option>₹15%</option>
                                                <option>₹20%</option>
                                                <option>Full Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="up_to_2_days_prior">Up to 2 days Prior</label>
                                            <select class="form-control" name="up_to_2_days_prior" style="width: 100%;">
                                                <option selected="selected">No Refund</option>
                                                <option>₹10%</option>
                                                <option>₹15%</option>
                                                <option>₹20%</option>
                                                <option>Full Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="up_to_1_day_prior">Up to 1 days Prior</label>
                                            <select class="form-control" name="up_to_1_day_prior" style="width: 100%;">
                                                <option selected="selected">No Refund</option>
                                                <option>₹10%</option>
                                                <option>₹15%</option>
                                                <option>₹20%</option>
                                                <option>Full Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="check_in_day">On the day of check-in</label>
                                            <select class="form-control" name="check_in_day" style="width: 100%;">
                                                <option selected="selected">No Refund</option>
                                                <option>₹10%</option>
                                                <option>₹15%</option>
                                                <option>₹20%</option>
                                                <option>Full Refund</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="no_show">No show</label>
                                            <select class="form-control" name="no_show" style="width: 100%;">
                                                <option selected="selected">No Refund</option>
                                                <option>₹10%</option>
                                                <option>₹15%</option>
                                                <option>₹20%</option>
                                                <option>Full Refund</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- /.row images -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-default">
                                                <div class="card-header">
                                                    <h3 class="card-title">HomeStay <small><em>Image Upload</em>
                                                        </small></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div id="actions" class="row">
                                                        <div class="col-lg-6">
                                                            <div class="btn-group w-100">
                                                                <span class="btn btn-success col fileinput-button">
                                                                    <i class="fas fa-plus"></i>
                                                                    <span>Add files</span>
                                                                </span>
                                                                {{-- <button type="submit" class="btn btn-primary col start">
                                                                    <i class="fas fa-upload"></i>
                                                                    <span>Start upload</span>
                                                                </button>
                                                                <button type="reset" class="btn btn-warning col cancel">
                                                                    <i class="fas fa-times-circle"></i>
                                                                    <span>Cancel upload</span>
                                                                </button> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 d-flex align-items-center">
                                                            <div class="fileupload-process w-100">
                                                                <div id="total-progress"
                                                                    class="progress progress-striped active"
                                                                    role="progressbar" aria-valuemin="0"
                                                                    aria-valuemax="100" aria-valuenow="0">
                                                                    <div class="progress-bar progress-bar-success"
                                                                        style="width:0%;" data-dz-uploadprogress></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table table-striped files" id="previews">
                                                        <div id="template" class="row mt-2">
                                                            <div class="col-auto">
                                                                <span class="preview"><img src="data:," alt=""
                                                                        data-dz-thumbnail /></span>
                                                            </div>
                                                            <div class="col d-flex align-items-center">
                                                                <p class="mb-0">
                                                                    <span class="lead" data-dz-name></span>
                                                                    (<span data-dz-size></span>)
                                                                </p>
                                                                <strong class="error text-danger"
                                                                    data-dz-errormessage></strong>
                                                            </div>
                                                            <div class="col-4 d-flex align-items-center">
                                                                <div class="progress progress-striped active w-100"
                                                                    role="progressbar" aria-valuemin="0"
                                                                    aria-valuemax="100" aria-valuenow="0">
                                                                    <div class="progress-bar progress-bar-success"
                                                                        style="width:0%;" data-dz-uploadprogress></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto d-flex align-items-center">
                                                                <div class="btn-group">
                                                                    {{-- <button class="btn btn-primary start">
                                                                        <i class="fas fa-upload"></i>
                                                                        <span>Start</span>
                                                                    </button>
                                                                    <button data-dz-remove class="btn btn-warning cancel">
                                                                        <i class="fas fa-times-circle"></i>
                                                                        <span>Cancel</span>
                                                                    </button> --}}
                                                                    <button data-dz-remove class="btn btn-danger delete">
                                                                        <i class="fas fa-trash"></i>
                                                                        <span>Delete</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                    {{-- price --}}
                                    <div class="row">
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="location">Location</label>
                                            <input type="text" name="email" class="form-control" id="location"
                                                placeholder="Enter Checkout Time">
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="one_night_price">One Night Price With Taxes</label>
                                            <input type="text" name="email" class="form-control"
                                                id="one_night_price" placeholder="Enter One Night Price With Taxes">
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
    <script>
        // function for dropdown
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()


            // check in time Date picker
            $('#checkInTime').datetimepicker({
                format: 'L'
            });

            // check out time Date picker
            $('#checkOutTime').datetimepicker({
                format: 'L'
            });
        })

        // DropzoneJS Demo Code Start
        $(function() {
            Dropzone.autoDiscover = false

            // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
            var previewNode = document.querySelector("#template")
            previewNode.id = ""
            var previewTemplate = previewNode.parentNode.innerHTML
            previewNode.parentNode.removeChild(previewNode)

            var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                url: "/target-url", // Set the url
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 20,
                previewTemplate: previewTemplate,
                autoQueue: false, // Make sure the files aren't queued until manually added
                previewsContainer: "#previews", // Define the container to display the previews
                clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
            })

            myDropzone.on("addedfile", function(file) {
                // Hookup the start button
                // file.previewElement.querySelector(".start").onclick = function() {
                //     myDropzone.enqueueFile(file)
                // }
            })

            // Update the total progress bar
            myDropzone.on("totaluploadprogress", function(progress) {
                document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
            })

            myDropzone.on("sending", function(file) {
                // Show the total progress bar when upload starts
                document.querySelector("#total-progress").style.opacity = "1"
                // And disable the start button
                // file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
            })

            // Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("queuecomplete", function(progress) {
                document.querySelector("#total-progress").style.opacity = "0"
            })

            // Setup the buttons for all transfers
            // The "add files" button doesn't need to be setup because the config
            // `clickable` has already been specified.
            // document.querySelector("#actions .start").onclick = function() {
            //     myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
            // }
            // document.querySelector("#actions .cancel").onclick = function() {
            //     myDropzone.removeAllFiles(true)
            // }
        })
        // DropzoneJS Demo Code End

        // function for validation
        $(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    alert("Form successful submitted!");
                }
            });
            $('#quickForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
