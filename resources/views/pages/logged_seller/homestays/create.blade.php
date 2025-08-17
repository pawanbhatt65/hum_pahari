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
                                <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" class="row">
                                <div class="card-body col-12">
                                    <div class="form-group">
                                        <label for="homeStaysName">HomeStays Name</label>
                                        <input type="text" name="name" class="form-control" id="homeStaysName"
                                            placeholder="Enter HomeStays Name">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Type</label>
                                        <div class="select2-purple">
                                            <select class="select2" multiple="multiple" data-placeholder="Select a State"
                                                data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option>Single Bedroom Type</option>
                                                <option>Double Bedroom Type</option>
                                                <option>Both</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <label>Room Type</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Standard</option>
                                            <option>Delux</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bedroom Type</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Single Bedroom</option>
                                            <option>Double Bedroom</option>
                                            <option>Both</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Number of Rooms</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Number of Single Bedrooms</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Number of Double Bedrooms</label>
                                        <select class="form-control select2" style="width: 100%;">
                                            <option selected="selected">1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Country</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter Country">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">State</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter State">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Dristrict</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter Dristrict">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter City">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pin Code</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter Pin Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="terms" class="custom-control-input"
                                                id="exampleCheck1">
                                            <label class="custom-control-label" for="exampleCheck1">I agree to the <a
                                                    href="#">terms of service</a>.</label>
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
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
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
        })

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
