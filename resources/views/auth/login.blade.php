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
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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

@endsection
