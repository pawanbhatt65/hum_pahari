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
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <div class="register">
                                    <input type="radio" name="role" value="user" id="user" checked>
                                    <label for="user">Register as a User</label>
                                </div>
                                <div class="register ms-2">
                                    <input type="radio" name="role" value="seller" id="seller">
                                    <label for="seller">Register as a Seller</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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

@endsection
