@extends('layouts.master')

@section('title', 'Blogs')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/blogs.css') }}">
@endsection

@section('content')

    {{-- filter-start --}}
    <section class="filter">
        <div class="container-lg container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="is-title text-center">
                        <h1>Blogs</h1>
                        <p>
                            The affordable HomeStays.
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-filter">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group mb-3 mb-md-0">
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                    <option value="pahadi_dal">Tourism</option>
                                    <option value="pahadi_spices">Famous Place</option>
                                    <option value="pahadi_spices">Tourism</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- filter-end --}}

    {{-- products-start --}}
    <section class="tourist-places">
        <div class="container-lg container-fluid">
            <div class="row g-3">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text mb-2">Category Name</p>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim cum harum distinctio nam
                                soluta deleniti voluptate repellendus suscipit iste perspiciatis.
                            </p>
                            <a href="{{ route('blogDetail') }}" class="btn btn-primary btn-sm mt-2">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text mb-2">Category Name</p>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim cum harum distinctio nam
                                soluta deleniti voluptate repellendus suscipit iste perspiciatis.
                            </p>
                            <a href="{{ route('blogDetail') }}" class="btn btn-primary btn-sm mt-2">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text mb-2">Category Name</p>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim cum harum distinctio nam
                                soluta deleniti voluptate repellendus suscipit iste perspiciatis.
                            </p>
                            <a href="#" class="btn btn-primary btn-sm mt-2">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text mb-2">Category Name</p>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim cum harum distinctio nam
                                soluta deleniti voluptate repellendus suscipit iste perspiciatis.
                            </p>
                            <a href="#" class="btn btn-primary btn-sm mt-2">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- products-end --}}

    {{-- hire-me-start --}}
    @include('layouts.hireMe')
    {{-- hire-me-end --}}
@endsection

@section('scripts')

@endsection
