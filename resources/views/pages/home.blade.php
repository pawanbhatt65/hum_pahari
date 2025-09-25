@extends('layouts.master')

@section('title', 'Home')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')

    {{-- banner-start --}}
    <section class="banner-sec">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.pexels.com/photos/1403653/pexels-photo-1403653.jpeg?auto=compress&cs=tinysrgb&w=600"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <div class="box search-box">
                        <h3 class="title mb-1 mb-md-2">Homestays in Uttarakhand</h3>
                        <p class="has-text-dark">Get affordable price homestays.</p>
                        <div class="search-form">
                            <form name="bannerSearchForm">
                                <div class="mb-3">
                                    <label for="" class="form-label">Destination</label>
                                    <input type="text" name="destination" class="form-control" value="Nainital">
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="check_in">Check In</label>
                                            <input type="text" name="check_in" id="check_in" placeholder="Check In"
                                                class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label for="check_out">Check Out</label>
                                            <input type="text" name="check_out" id="check_out" placeholder="Check Out"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- banner-end --}}

    {{-- tourist-places-start --}}
    <section class="tourist-places">
        <div class="container-lg container-fluid">
            <div class="row g-3" id="homeStaysImagesRow">
                <div class="col-12">
                    <div class="is-title text-center">
                        <h1>HomeStays</h1>
                        <p>
                            The affordable HomeStays.
                        </p>
                    </div>
                </div>
                @forelse ($homestay as $index => $item)
                    @php
                        $check_in_time = \Carbon\Carbon::parse($item->check_in_time);
                        $check_out_time = \Carbon\Carbon::parse($item->check_out_time);
                        $differenceInDays = floor($check_in_time->diffInDays($check_out_time)); // Use floor() to get integer
                        // \Log::info('differenceInDays: ' . $differenceInDays);
                    @endphp
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card card-more">
                            <div class="images">
                                <div class="single-img">
                                    @if ($item->images && $item->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $item->images[0]->image_path) }}"
                                            class="card-img-top" alt="{{ $item->name }}">
                                    @endif
                                </div>
                                <div class="more-imgs">
                                    @forelse ($item->images ?? [] as $index => $img)
                                        <div class="single-img-box">
                                            <img src="{{ asset('storage/' . $img->image_path) }}" alt=""
                                                class="img-fluid">
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">
                                    Apartment: <strong>{{ $item->number_of_rooms }}</strong>
                                    <strong>{{ $item->room_type }}</strong> Bedroom
                                </p>
                                <p class="card-text">
                                    <strong>₹ {{ $item->price }}</strong>
                                    /{{ $differenceInDays > 1 ? $differenceInDays : '' }}
                                    night{{ $differenceInDays > 1 ? 's' : '' }}
                                </p>
                                <a href="{{ route('homeStayDetail', $item->id) }}" class="btn btn-primary btn-sm mt-2">View
                                    Deal</a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

                {{-- <div class="col-12 col-sm-6 col-xl-3">
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
                            <a href="#" class="btn btn-primary btn-sm mt-2">View Deal</a>
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
                            <a href="#" class="btn btn-primary btn-sm mt-2">View Deal</a>
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
                            <a href="#" class="btn btn-primary btn-sm mt-2">View Deal</a>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="view-more text-center">
                        <a href="{{ route('homestays') }}" class="btn btn-secondary btn-sm">
                            View More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- tourist-places-end --}}

    {{-- uttarakhand-local-product-start --}}
    {{-- <section class="uttarakhand-local-products">
        <div class="container-lg container-fluid">
            <div class="row g-3" id="productImagesRow">
                <div class="col-12">
                    <div class="is-title text-center">
                        <h1>Uttarakhand Local Products</h1>
                        <p>
                            You got affordable local product.
                        </p>
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
                                Apartment: <strong>2</strong> Guest <strong>1</strong> Bedroom
                            </p>
                            <p class="card-text">
                                <strong>₹ 1671</strong> /night
                            </p>
                            <a href="#" class="btn btn-primary btn-sm mt-2">View Deal</a>
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
                                Apartment: <strong>2</strong> Guest <strong>1</strong> Bedroom
                            </p>
                            <p class="card-text">
                                <strong>₹ 1671</strong> /night
                            </p>
                            <a href="#" class="btn btn-primary btn-sm mt-2">View Deal</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="view-more text-center">
                        <a href="{{route('products')}}" class="btn btn-secondary btn-sm">
                            View More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- uttarakhand-local-product-end --}}

    {{-- blog-start --}}
    {{-- <section class="tourist-places">
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
                <div class="col-12">
                    <div class="view-more text-center">
                        <a href="{{route('blogs')}}" class="btn btn-secondary btn-sm">
                            View More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- blog-end --}}

    {{-- hire-me-start --}}
    {{-- @include('layouts.hireMe') --}}
    {{-- hire-me-end --}}
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            flatpickr('#check_in, #check_out', {
                dateFormat: "M d, Y",
                minDate: "today",
            })
        })
    </script>
@endsection
