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
                        <form action="{{ route('homestays.search') }}" method="post">
                            @csrf
                            <div class="form-group mb-3 mb-lg-0">
                                <input type="text" name="name" id="stay_name" placeholder="HomeStay Name"
                                    class="form-control" value="{{ old('name', $filters['name'] ?? '') }}">
                            </div>
                            <div class="form-group mb-3 mb-lg-0">
                                <input type="text" name="location" id="location" placeholder="Location"
                                    class="form-control" value="{{ old('location', $filters['location'] ?? '') }}">
                            </div>
                            <div class="form-group mb-3 mb-lg-0">
                                <input type="number" name="min_price" id="min_price" placeholder="Minimun Price"
                                    class="form-control" value="{{ old('min_price', $filters['min_price'] ?? '') }}">
                            </div>
                            <div class="form-group mb-3 mb-md-0">
                                <input type="number" name="max_price" id="max_price" placeholder="Maximum Price"
                                    class="form-control" value="{{ old('max_price', $filters['max_price'] ?? '') }}">
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" name="button" class="btn btn-primary">
                                    Search
                                </button>
                                @if (!empty($filters))
                                    <a href="{{ route('homestays.clearFilters') }}" class="btn btn-danger">
                                        Clear filters
                                    </a>
                                @endif
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
                    @php
                        // $check_in_time = \Carbon\Carbon::parse($item->check_in_time);
                        // $check_out_time = \Carbon\Carbon::parse($item->check_out_time);
                        // $differenceInDays = floor($check_in_time->diffInDays($check_out_time)); // Use floor() to get integer
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
                                    /{{ $item->days > 1 ? $item->days : '' }}
                                    night{{ $item->days > 1 ? 's' : '' }}
                                </p>
                                <a href="{{ route('homeStayDetail', $item->id) }}" class="btn btn-primary btn-sm mt-2">
                                    View Deal
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

                @if (count($homestay) > 0)
                    <div class="mt-3 paginator-box">
                        {{ $homestay->withQueryString()->links('components.paginator') }}
                    </div>
                @endif

            </div>
        </div>
    </section>
    {{-- tourist-places-end --}}

    {{-- hire-me-start --}}
    {{-- @include('layouts.hireMe') --}}
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
