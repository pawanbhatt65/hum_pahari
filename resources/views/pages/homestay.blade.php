@extends('layouts.master')

@section('title', 'HomeStays')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/homestay.css') }}">
@endsection

@section('content')

    {{-- filter-start --}}
    <section class="filter">
        <div class="container-lg container-fluid">
            <div class="row g-3">
                <div class="col-12">
                    <div class="is-title text-center">
                        <h1>HomeStays</h1>
                        <p>
                            The affordable HomeStays.
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-filter">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group mb-3 mb-lg-0">
                                <input type="text" name="stay_name" id="stay_name" placeholder="HomeStay Name"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-3 mb-lg-0">
                                <input type="text" name="location" id="location" placeholder="Location"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-3 mb-lg-0">
                                <input type="number" name="min_price" id="min_price" placeholder="Minimun Price"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-3 mb-md-0">
                                <input type="number" name="max_name" id="max_name" placeholder="Maximum Price"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-0">
                                <input type="text" name="date" id="date" placeholder="Stay Date"
                                    class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- filter-end --}}

    {{-- tourist-places-start --}}
    <section class="tourist-places">
        <div class="container-lg container-fluid">
            <div class="row g-3" id="homeStaysImagesRow">
                @forelse ($homestay as $index => $item)
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
                                <a href="{{ route('homeStayDetail', 3) }}" class="btn btn-primary btn-sm mt-2">
                                    View Deal
                                </a>
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
                </div> --}}
            </div>
        </div>
    </section>
    {{-- tourist-places-end --}}

    {{-- hire-me-start --}}
    @include('layouts.hireMe')
    {{-- hire-me-end --}}
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            flatpickr('#date', {
                dateFormat: "M d, Y",
                minDate: "today",
            })
        })
    </script>
@endsection
