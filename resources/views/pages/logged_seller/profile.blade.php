@extends('seller_layout.master')

@section('title')
    Profile
@endsection

@section('styles')
    <style>
        .error {
            color: rgb(204, 14, 14);
        }

        input.password-input {
            padding-right: 50px;
        }

        .eye {
            position: absolute;
            right: 20px;
            top: 41px;
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
                        <h1>Profile</h1>
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
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- column -->
                    <div class="col-md-12 col-lg-6">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile: {{ auth()->user()->name }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" method="POST" name="updateUser"
                                action="{{ route('seller.updateProfile', auth()->user()->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    {{-- about-Homestay --}}
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                value="{{ auth()->user()->name ?? old('name') }}" placeholder="Enter Name">
                                            <div class="text-danger error" id="nameError"></div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" name="mobile" class="form-control" id="mobile"
                                                value="{{ auth()->user()->mobile ?? old('mobile') }}"
                                                placeholder="Enter Mobile">
                                            <div class="text-danger error" id="mobileError"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col -->

                    <!-- column -->
                    <div class="col-md-12 col-lg-6">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Reset Password: {{ auth()->user()->name }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" method="POST" name="passwordUpdate"
                                action="{{ route('seller.updatePassword', auth()->user()->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    {{-- about-Homestay --}}
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ auth()->user()->email ?? old('email') }}"
                                                placeholder="Enter Email" readonly required>
                                            @error('email')
                                                <div class="text-danger error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12 position-relative">
                                            <label for="current_password">Current Password</label>
                                            <input type="password" name="current_password"
                                                class="form-control password-input" id="current_password" value=""
                                                placeholder="Enter Current Password" required>
                                            <p class="error" id="current-password-error"></p>
                                            <p class="eye"><i class="fas fa-eye"></i></p>
                                        </div>
                                        <div class="form-group col-12 position-relative">
                                            <label for="new_password">New Password</label>
                                            <input type="password" name="new_password" class="form-control password-input"
                                                id="new_password" value="" placeholder="Enter New Password" required>
                                            <p class="error" id="new-password-error"></p>
                                            <p class="eye"><i class="fas fa-eye"></i></p>
                                        </div>
                                        <div class="form-group col-12 position-relative">
                                            <label for="new_password_confirmation">Confirm New Password</label>
                                            <input type="password" name="new_password_confirmation"
                                                class="form-control password-input" id="new_password_confirmation"
                                                value="" placeholder="Enter Confirm New Password" required>
                                            <p class="error" id="confirm-password-error"></p>
                                            <p class="eye"><i class="fas fa-eye"></i></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col -->
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
            "use strict";

            // -------------------------
            // Helpers
            // -------------------------
            const qs = (sel, ctx = document) => ctx.querySelector(sel);
            const qsa = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

            function showError(el, msg) {
                if (!el) return;
                el.textContent = msg || '';
                el.style.display = msg ? 'block' : '';
            }

            function clearError(el) {
                if (!el) return;
                el.textContent = '';
                el.style.display = '';
            }

            // Validation rules
            function validateNameValue(value) {
                if (!value || !value.trim()) return "Name is required.";
                if (value.trim().length > 80) return "Name must not exceed 80 characters.";
                if (!/^[A-Za-z\s]+$/.test(value.trim())) return "Name can contain only letters and spaces.";
                return "";
            }

            function validateMobileValue(value) {
                if (!value) return "Mobile number is required.";
                // allow only 10-digit Indian style numbers, starting with 6-9 (optional)
                if (!/^[6-9]\d{9}$/.test(value))
                    return "Please enter a valid 10-digit mobile number starting with 6-9.";
                return "";
            }

            function validatePasswordValue(value) {
                if (!value) return "Password is required.";
                if (value.length < 8) return "Password must be at least 8 characters.";
                if (value.length > 20) return "Password must not exceed 20 characters.";
                // at least one uppercase, one lowercase, one digit, one special (allowed set)
                if (!/(?=.*[A-Z])/.test(value)) return "Password must contain at least one uppercase letter.";
                if (!/(?=.*[a-z])/.test(value)) return "Password must contain at least one lowercase letter.";
                if (!/(?=.*\d)/.test(value)) return "Password must contain at least one number.";
                if (!/(?=.*[@#$%^&*+=!])/.test(value))
                    return "Password must contain at least one special character (@#$%^&*+=!).";
                if (/\s/.test(value)) return "Password cannot contain spaces.";
                return "";
            }

            // -------------------------
            // Profile form (updateUser)
            // -------------------------
            (function setupProfileForm() {
                const form = document.forms['updateUser'];
                if (!form) return;

                const nameInput = qs('input[name="name"]', form);
                const mobileInput = qs('input[name="mobile"]', form);
                const nameError = document.getElementById('nameError');
                const mobileError = document.getElementById('mobileError');

                // Restrict name input to letters and spaces only (user friendly)
                if (nameInput) {
                    nameInput.addEventListener('input', function() {
                        // replace any non-letter and non-space characters
                        this.value = this.value.replace(/[^A-Za-z\s]/g, '');
                        showError(nameError, validateNameValue(this.value));
                    });
                }

                // Restrict mobile to digits only and max length 10
                if (mobileInput) {
                    mobileInput.setAttribute('maxlength', '10');
                    mobileInput.addEventListener('input', function() {
                        // strip non-digits, then limit to 10 digits
                        this.value = this.value.replace(/\D/g, '').slice(0, 10);
                        showError(mobileError, this.value.length ? validateMobileValue(this.value) :
                            'Mobile number is required.');
                    });

                    // Optional: prevent leading 0 or 1 (Indian mobile starts 6-9)
                    mobileInput.addEventListener('blur', function() {
                        if (this.value && !/^[6-9]\d{9}$/.test(this.value)) {
                            showError(mobileError, validateMobileValue(this.value));
                        } else {
                            clearError(mobileError);
                        }
                    });
                }

                // On submit validate and block if invalid
                form.addEventListener('submit', function(ev) {
                    let hasError = false;

                    const nameVal = nameInput ? nameInput.value.trim() : '';
                    const mobileVal = mobileInput ? mobileInput.value.trim() : '';

                    const nameMsg = validateNameValue(nameVal);
                    const mobileMsg = validateMobileValue(mobileVal);

                    showError(nameError, nameMsg);
                    showError(mobileError, mobileMsg);

                    if (nameMsg) {
                        hasError = true;
                    }
                    if (mobileMsg) {
                        hasError = true;
                    }

                    if (hasError) {
                        ev.preventDefault();
                        // focus first error field
                        if (nameMsg && nameInput) nameInput.focus();
                        else if (mobileMsg && mobileInput) mobileInput.focus();
                    }
                    // else allow normal submit (server-side will validate too)
                });
            })();

            // -------------------------
            // Password update form (passwordUpdate)
            // -------------------------
            (function setupPasswordForm() {
                const form = document.forms['passwordUpdate'];
                if (!form) return;

                const currentInput = qs('input[name="current_password"]', form);
                const newInput = qs('input[name="new_password"]', form);
                const confirmInput = qs('input[name="new_password_confirmation"]', form);

                const currentError = document.getElementById('current-password-error');
                const newError = document.getElementById('new-password-error');
                const confirmError = document.getElementById('confirm-password-error');

                // Eye toggle for password fields: find .eye within same .form-group
                qsa('.eye', form).forEach(function(eye) {
                    eye.style.cursor = 'pointer';
                    eye.addEventListener('click', function() {
                        const parent = eye.closest('.form-group') || document;
                        const input = qs('input', parent);
                        const icon = qs('i', eye);
                        if (!input) return;
                        if (input.type === 'password') {
                            input.type = 'text';
                            if (icon) {
                                icon.classList.remove('fa-eye');
                                icon.classList.add('fa-eye-slash');
                            }
                        } else {
                            input.type = 'password';
                            if (icon) {
                                icon.classList.remove('fa-eye-slash');
                                icon.classList.add('fa-eye');
                            }
                        }
                    });
                });

                // Real-time validation
                if (currentInput) {
                    currentInput.addEventListener('input', function() {
                        showError(currentError, validatePasswordValue(this.value));
                    });
                }
                if (newInput) {
                    newInput.addEventListener('input', function() {
                        showError(newError, validatePasswordValue(this.value));
                        // also re-validate confirm when new changes
                        if (confirmInput && confirmInput.value) {
                            showError(confirmError, validateConfirmPassword(this.value, confirmInput
                                .value));
                        }
                    });
                }
                if (confirmInput) {
                    confirmInput.addEventListener('input', function() {
                        showError(confirmError, validateConfirmPassword(newInput ? newInput.value : '',
                            this.value));
                    });
                }

                function validateConfirmPassword(newVal, confirmVal) {
                    if (!confirmVal) return "Confirm password is required.";
                    if (newVal !== confirmVal) return "Passwords do not match.";
                    return "";
                }

                // submit handler
                form.addEventListener('submit', function(ev) {
                    let hasError = false;

                    const curMsg = currentInput ? validatePasswordValue(currentInput.value) :
                        "Current password is required.";
                    const newMsg = newInput ? validatePasswordValue(newInput.value) :
                        "New password is required.";
                    const confMsg = validateConfirmPassword(newInput ? newInput.value : '',
                        confirmInput ? confirmInput.value : '');

                    showError(currentError, curMsg);
                    showError(newError, newMsg);
                    showError(confirmError, confMsg);

                    if (curMsg) hasError = true;
                    if (newMsg) hasError = true;
                    if (confMsg) hasError = true;

                    if (hasError) {
                        ev.preventDefault();
                        // focus first invalid
                        if (curMsg && currentInput) currentInput.focus();
                        else if (newMsg && newInput) newInput.focus();
                        else if (confMsg && confirmInput) confirmInput.focus();
                    }
                });
            })();

            // -------------------------
            // Utility: make all .eye icons keyboard accessible (Enter/Space)
            // -------------------------
            (function keyboardizeEyeIcons() {
                qsa('.eye').forEach(function(eye) {
                    eye.setAttribute('tabindex', '0');
                    eye.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            eye.click();
                        }
                    });
                });
            })();

        });
    </script>
@endsection
