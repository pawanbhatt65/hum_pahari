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

        .multiple-files {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            visibility: hidden;
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
                            <form id="quickForm" method="POST" action="{{ route('homestays.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    {{-- about-Homestay --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Basic Details</h3>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="homeStaysName">Homestay Name</label>
                                            <input type="text" name="name" class="form-control" id="homeStaysName"
                                                placeholder="Enter Homestay Name">
                                        </div>
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
                                            <select class="form-control" name="num_single_room" style="width: 100%;">
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
                                            <select class="form-control" name="num_double_room" style="width: 100%;">
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
                                            <div class="mt-2">
                                                <div class="icheck-primary d-inline mr-3">
                                                    <input type="radio" id="yes_food_allowed" name="food_allowed"
                                                        value="yes" checked>
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
                                            <label for="state">State</label>
                                            <select class="form-control select2" id="state" name="state_id"
                                                style="width: 100%;">
                                                <option value="" selected="selected">Select State</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="district">District</label>
                                            <select class="form-control select2" id="district" name="district_id"
                                                style="width: 100%;">
                                                <option value="" selected="selected">Select District</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="city">City</label>
                                            <input type="text" name="city_id" class="form-control" id="city"
                                                placeholder="Enter Homestay City">
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" class="form-control" id="address"
                                                placeholder="Enter Address">
                                        </div>
                                        <div class="form-group col-12 col-lg-4">
                                            <label for="pin">Pin Code</label>
                                            <input type="text" name="pin" class="form-control" id="pin"
                                                placeholder="Enter Pin Code" maxlength="6">
                                        </div>
                                    </div>

                                    {{-- capacity --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Homestay Capacity</h3>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="num_adult">Number of Adult</label>
                                            <select class="form-control select2" id="num_adult" name="num_adult"
                                                style="width: 100%;">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="num_children">Number of Children</label>
                                            <select class="form-control select2" id="num_children" name="num_children"
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
                                                    data-target="#checkInTime" name="check_in_time" />
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
                                                    data-target="#checkOutTime" name="check_out_time" />
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
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="area_sqft">Area (sq.ft)</label>
                                            <input type="text" name="area" class="form-control" id="area_sqft"
                                                placeholder="Enter Area (sq.ft)">
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="">Guest Access</label>
                                            <div class="mt-2">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="yes_guest_access" name="guest_access"
                                                        value="yes" checked>
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
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="">Mountain View</label>
                                            <div class="mt-2">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="yes_mountain_view" name="mountain_view"
                                                        value="yes" checked>
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
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="room_image">Room Image</label>
                                            <input type="file" name="room_image" class="form-control" id="room_image"
                                                accept="image/*">
                                        </div>
                                    </div>

                                    <!-- Benefits -->
                                    <div class="benefits-container mb-3">
                                        <div class="col-12">
                                            <h3>Benefits</h3>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                <input type="text" name="benefit[]" class="form-control"
                                                    id="benefits_0" placeholder="Enter Benefit">
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
                                            <h3>Common Space</h3>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                <input type="text" name="common_space[]" class="form-control"
                                                    id="common_space_0" placeholder="Enter Common Space">
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
                                            <h3>Safety & Security</h3>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                <input type="text" name="safety_security[]" class="form-control"
                                                    id="safety_security_0" placeholder="Enter Safety & Security">
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
                                            <h3>Bedding</h3>
                                        </div>
                                        <div class="elms row">
                                            <div class="form-group col-12 col-lg-4">
                                                <input type="text" name="bedding[]" class="form-control"
                                                    id="bedding_0" placeholder="Enter Bedding">
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
                                                                    <input type="file" name="images[]" multiple
                                                                        class="multiple-files" accept="image/*" style="z-index: 3;">
                                                                </span>
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
                                            <label for="location">Location (Lat, Long)</label>
                                            <input type="text" name="location" class="form-control" id="location"
                                                placeholder="Click to get geolocation" readonly>
                                            <button type="button" id="getLocation" class="btn btn-primary mt-2">Get
                                                Current Location</button>
                                        </div>
                                        <div class="form-group col-12 col-lg-6">
                                            <label for="one_night_price">One Night Price With Taxes</label>
                                            <input type="text" name="one_night_price" class="form-control"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

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
        $('#quickForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 80,
                    pattern: /^[a-zA-Z0-9\s-]+$/
                },
                room_type: {
                    required: true
                },
                bedroom_type: {
                    required: true
                },
                num_room: {
                    required: true
                },
                num_single_room: {
                    required: true
                },
                num_double_room: {
                    required: true
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
                city_id: {
                    required: true
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
                    required: true
                },
                num_children: {
                    required: true
                },
                check_in_time: {
                    required: true
                },
                check_out_time: {
                    required: true
                },
                area: {
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
                    maxsize: 2097152
                }, // 2MB
                'images[]': {
                    required: true,
                    accept: "image/*",
                    maxsize: 819200
                }, // 800KB
                'benefit[]': {
                    required: function(element) {
                        return $(element).val() !== '' || $('input[name="benefit[]"]').length > 1;
                    }
                },
                location: {
                    required: true
                },
                one_night_price: {
                    required: true,
                    number: true,
                    min: 0
                }
            },
            messages: {
                name_error: {
                    required: "Please enter homestay name",
                    maxlength: "Name cannot exceed 80 characters",
                    pattern: "Name can only contain letters, digits, hyphens, and spaces"
                },
                note_error: {
                    pattern: "Note can only contain letters, digits, hyphens, spaces, $, &, @, #, +, ."
                },
                address_error: {
                    pattern: "Address can only contain letters, digits, hyphens, commas, and spaces"
                },
                pin_error: {
                    digits: "Pin code must be 6 digits",
                    minlength: "Pin code must be 6 digits"
                },
                check_in_time_error: {
                    required: "Please select check-in time"
                },
                room_image_error: {
                    maxsize: "Room image must be less than 2MB"
                },
                'images[]': {
                    maxsize: "Each image must be less than 800KB"
                }
            },
            errorPlacement: function(error, element) {
                // console.log("element.attr('name'): ", element.attr("name"));
                if (element.attr("name") === "images[]") {
                    // console.log("element.parent().parent(): ", element.parent().parent());
                    error.insertAfter(element.parent().parent())
                } else {
                    error.appendTo(element.parent());
                }
                error.addClass('d-block');
            }
        });

        // Custom validation method for file size
        $.validator.addMethod('maxsize', function(value, element, param) {
            return this.optional(element) || (element.files[0] && element.files[0].size <= param);
        }, 'File size must be less than {0} bytes');

        // Room count validation
        $('#num_room, #num_single_room, #num_double_room').on('change', function() {
            const numRoom = parseInt($('#num_room').val()) || 0;
            const numSingle = parseInt($('#num_single_room').val()) || 0;
            const numDouble = parseInt($('#num_double_room').val()) || 0;
            if (numSingle + numDouble > numRoom) {
                $('#num_single_room').addClass('error');
                $('#num_double_room').addClass('error');
                $('#num_single_room').after(
                    '<label class="error">Total single and double bedrooms cannot exceed total rooms.</label>');
            } else {
                $('#num_single_room, #num_double_room').removeClass('error');
                $('#num_single_room, #num_double_room').parent().find('.error').remove();
            }
        });

        // Load states and districts using Axios
        async function loadStates() {
            try {
                const response = await axios.get('/states');
                const select = document.getElementById('state');
                response.data.forEach(state => {
                    const option = document.createElement('option');
                    option.value = state.id;
                    option.textContent = state.name;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading states:', error);
            }
        }
        loadStates();

        // state change event
        $('#state').on('change', function() {
            const stateId = $(this).val();
            if (stateId) {
                // remove state error message if exists
                $(this).parent().find("#state-error").remove();
                $.ajax({
                    url: `/states/${stateId}/districts`,
                    type: 'GET',
                    success: function(data) {
                        const districtSelect = $('#district');
                        districtSelect.empty();
                        districtSelect.append('<option value="">Select District</option>');
                        data.forEach(function(district) {
                            districtSelect.append(
                                `<option value="${district.id}">${district.name}</option>`);
                        });
                        districtSelect.prop('disabled', false);
                    },
                    error: function() {
                        alert('Error loading districts. Please try again.');
                    }
                });
            } else {
                $('#district').empty().append('<option value="">Select District</option>').prop('disabled', true);
            }
        });

        // district change event
        $('#district').on('change', function() {
            const districtId = $(this).val();
            if (districtId) {
                // remove district error message if exists
                $(this).parent().find("#district-error").remove();
            }
        });

        // if room_image have a value error message will be removed else error message will be shown
        $('#room_image').on('change', function() {
            if ($(this).val()) {
                $(this).parent().find('#room_image-error').remove();
            } else {
                // $(this).after('<label id="room_image-error" class="error" for="room_image">Please upload a room image.</label>');
            }
        });

        // Dynamic fields
        function addDynamicField(containerClass, fieldName, idPrefix) {
            $(`.${containerClass} .add-benefit`).click(function() {
                const count = $(`.${containerClass} .elms .form-group`).length;
                const html = `
                        <div class="form-group col-12 col-lg-4">
                            <input type="text" name="${fieldName}[]" class="form-control" id="${idPrefix}_${count}" placeholder="Enter ${fieldName.replace('-', ' ')}">
                        </div>`;
                $(`.${containerClass} .elms`).append(html);
                // Re-validate the form
                // $('#quickForm').validate().element(`#${idPrefix}_${count}`);
            });

            $(`.${containerClass} .remove-benefit`).click(function() {
                const formGroups = $(`.${containerClass} .elms .form-group`);
                if (formGroups.length > 1) {
                    formGroups.last().remove();
                }
            });
        }

        addDynamicField('benefits-container', 'benefit', 'benefits');
        addDynamicField('common-space-container', 'common-space', 'common_space');
        addDynamicField('safety-security-container', 'safety-security', 'safety_security');
        addDynamicField('bedding-container', 'bedding', 'bedding');

        // Image count validation
        $('input[name="images[]"]').on('change', function() {
            const files = this.files;
            if (files.length < 1 || files.length > 10) {
                $(this).after('<label class="error">Please upload between 1 and 10 images.</label>');
            } else {
                $(this).parent().find('.error').remove();
            }
            for (let file of files) {
                if (file.size > 819200) {
                    $(this).after(`<label class="error">${file.name} exceeds 800KB.</label>`);
                }
            }
        });

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
                        $('#location').after('<label id="location-error" class="error">Please click to Get Current Location button.</label>');
                    }
                }, function(error) {
                    alert('Geolocation failed: ' + error.message);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        });
    </script>
@endsection
