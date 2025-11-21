@extends('layouts.master')

@section('title', 'Register')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/auth.css') }}">
@endsection

@section('content')
    <section class="register-section">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="form-card">
                        <form action="{{ route('register') }}" method="POST" name="registrationFormHandler" novalidate>
                            @csrf
                            <input type="hidden" name="redirect" value="{{ $redirectUrl ?? '' }}">
                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                {{-- <div class="register">
                                    <input type="radio" name="role" value="user" id="user" checked>
                                    <label for="user">Register as a User</label>
                                </div> --}}
                                {{-- <div class="register ms-2"> --}}
                                <input type="hidden" name="role" value="seller" id="seller" checked>
                                {{-- <label for="seller">Register as a Seller</label>
                                </div> --}}
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" required>
                                <p class="error" id="name-error"></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Mobile</label>
                                <input type="text" class="form-control" name="mobile" maxlength="10" required>
                                <p class="error" id="mobile-error"></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" required>
                                <p class="error" id="email-error"></p>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control password-input" name="password" required>
                                <p class="error" id="password-error"></p>
                                <p class="eye"><i class="fa-solid fa-eye"></i></p>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control password-input" name="password_confirmation"
                                    required>
                                <p class="error" id="cPassword-error"></p>
                                <p class="eye"><i class="fa-solid fa-eye"></i></p>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign up</button>
                            <a href="{{ route('login') }}" class="text-primary ms-2">
                                Already registered?
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/frontend/js/auth.js') }}" defer></script>
@endsection
