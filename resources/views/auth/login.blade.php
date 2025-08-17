@extends('layouts.master')

@section('title', 'Login')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/auth.css') }}">
@endsection

@section('content')
    <section class="register-section">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="form-card">
                        <form action="{{ route('login') }}" method="POST" name="loginFormHandler" novalidate>
                            @csrf
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
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="{{ route('password.request') }}" class="text-primary ms-2">
                                Forgot Password?
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
