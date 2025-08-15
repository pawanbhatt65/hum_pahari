@extends('layouts.master')

@section('title', 'Products')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/homestay.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/product.css') }}">
@endsection

@section('content')

    {{-- filter-start --}}
    <section class="filter">
        <div class="container-lg container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="is-title text-center">
                        <h1>Uttarakhand Local Products</h1>
                        <p>
                            You got affordable local product.
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-filter">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group mb-3 mb-md-0">
                                <select name="category" id="category" class="form-control">
                                    <option value="all_products">All Products</option>
                                    <option value="pahadi_dal">Pahadi Dal</option>
                                    <option value="pahadi_spices">Pahadi Spices</option>
                                    <option value="pahadi_spices">Pahadi Pickels, Chutney & Namak</option>
                                    <option value="pahadi_spices">Pahadi Fruits & Herbs</option>
                                    <option value="pahadi_spices">Pahadi Beverages & Foods</option>
                                    <option value="pahadi_spices">Pahadi Foodgrains & Oils</option>
                                    <option value="pahadi_spices">Pahadi Seeds</option>
                                    <option value="pahadi_spices">Pahadi Vegetable, Bulb & Stems</option>
                                    <option value="pahadi_spices">Uttarakhand Sweets</option>
                                    <option value="pahadi_spices">Himalyan Uttarakhand Special</option>
                                </select>
                            </div>
                            <div class="form-group mb-3 mb-md-0">
                                <input type="number" name="min_price" id="min_price" placeholder="Minimun Price"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-0">
                                <input type="number" name="max_name" id="max_name" placeholder="Maximum Price"
                                    class="form-control">
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
            <div class="row g-3" id="productImagesRow">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text">
                                Pahadi Dal
                            </p>
                            <p class="card-text">
                                <strong>₹ 1671</strong> /Kg
                            </p>
                            <a href="{{ route('productDetail') }}" class="btn btn-primary btn-sm mt-2">View Deal</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <div class="images">
                            <div class="single-img">
                                <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                                    class="card-img-top" alt="...">
                            </div>
                            <div class="more-imgs">
                                <div class="single-img-box">
                                    <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=1980&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="single-img-box">
                                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=2158&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="single-img-box">
                                    <img src="https://plus.unsplash.com/premium_photo-1676321046449-5fc72b124490?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="single-img-box">
                                    <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text">
                                Apartment: <strong>2</strong> Guest <strong>1</strong> Bedroom
                            </p>
                            <p class="card-text">
                                <strong>₹ 1671</strong> /night
                            </p>
                            <a href="{{ route('homeStayDetail') }}" class="btn btn-primary btn-sm mt-2">
                                View Deal
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <div class="images">
                            <div class="single-img">
                                <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                                    class="card-img-top" alt="...">
                            </div>
                            <div class="more-imgs">
                                <div class="single-img-box">
                                    <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=1980&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="single-img-box">
                                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=2158&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="single-img-box">
                                    <img src="https://plus.unsplash.com/premium_photo-1676321046449-5fc72b124490?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="single-img-box">
                                    <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text">
                                Apartment: <strong>2</strong> Guest <strong>1</strong> Bedroom
                            </p>
                            <p class="card-text">
                                <strong>₹ 1671</strong> /night
                            </p>
                            <a href="{{ route('homeStayDetail') }}" class="btn btn-primary btn-sm mt-2">
                                View Deal
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <div class="images">
                            <div class="single-img">
                                <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                                    class="card-img-top" alt="...">
                            </div>
                            <div class="more-imgs">
                                <div class="single-img-box">
                                    <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=1980&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="single-img-box">
                                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=2158&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="single-img-box">
                                    <img src="https://plus.unsplash.com/premium_photo-1676321046449-5fc72b124490?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="single-img-box">
                                    <img src="https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text">
                                Apartment: <strong>2</strong> Guest <strong>1</strong> Bedroom
                            </p>
                            <p class="card-text">
                                <strong>₹ 1671</strong> /night
                            </p>
                            <a href="{{ route('homeStayDetail') }}" class="btn btn-primary btn-sm mt-2">
                                View Deal
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text">
                                Pahadi Dal
                            </p>
                            <p class="card-text">
                                <strong>₹ 1671</strong> /Kg
                            </p>
                            <a href="#" class="btn btn-primary btn-sm mt-2">View Deal</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text">
                                Pahadi Dal
                            </p>
                            <p class="card-text">
                                <strong>₹ 1671</strong> /Kg
                            </p>
                            <a href="#" class="btn btn-primary btn-sm mt-2">View Deal</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text">
                                Pahadi Dal
                            </p>
                            <p class="card-text">
                                <strong>₹ 1671</strong> /Kg
                            </p>
                            <a href="#" class="btn btn-primary btn-sm mt-2">View Deal</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-more">
                        <img src="https://images.pexels.com/photos/813788/pexels-photo-813788.jpeg?auto=compress&cs=tinysrgb&w=600"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Pine View Studio Cottage</h5>
                            <p class="card-text">
                                Pahadi Dal
                            </p>
                            <p class="card-text">
                                <strong>₹ 1671</strong> /Kg
                            </p>
                            <a href="#" class="btn btn-primary btn-sm mt-2">View Deal</a>
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
