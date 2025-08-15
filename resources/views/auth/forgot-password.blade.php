@extends('layouts.master')

@section('title', 'Forgot-Password')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/auth.css') }}">
@endsection

@section('content')
    <section class="register-section">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="form-card">
                        <p class="mb-3">
                            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                        </p>
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Email Password Reset Link
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

@endsection
