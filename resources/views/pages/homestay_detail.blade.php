@extends('layouts.master')

@section('title', 'HomeStays | Detail')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/homestay.css') }}">

    <style>
        /* map-section-css-start */
        .map {
            height: 300px;
            width: 100%;
        }

        .map-box-large {
            display: block;
            position: relative;
        }

        .map-link {
            position: absolute;
            top: 0;
            left: 0;
        }

        .large-map-link {
            background-color: #fff;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            margin-top: 8px;
            margin-left: 8px;
            padding: 10px;
        }

        .map-lan-log {
            color: #222;
            font-weight: 800;
        }

        .large-map-link p {
            font-size: 13px;
            margin-bottom: 0;
        }

        .large-map-link__link {
            color: #061a3a;
            transition: all 0.7s ease-in-out;
        }

        /* map-section-css-end */

        /* carouse-arrow-start */
        .carouse-arrow {
            color: #fff;
            top: 50%;
            bottom: unset;
            transform: translateY(-50%);
            width: 40px;
            background-color: rgb(255, 87, 34);
            height: 40px;
        }

        /* carouse-arrow-end */
        /* register-modal-start */
        .register-modal input:focus {
            box-shadow: none;
        }

        .register-modal .form-control.is-invalid:focus,
        .register-modal .was-validated .form-control:invalid:focus {
            box-shadow: none;
        }

        /* register-modal-end */
    </style>

    {{-- show google map --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt5DYIAisGK-fooNcWeIlp3snMUkqhhFA&libraries=places"></script>
@endsection

@section('content')
    <section class="homestay-detail-section">
        <div class="container-fluid container-lg">
            <div class="row">
                {{-- search-box-start --}}
                {{-- @include('components.homestay_search') --}}
                {{-- search-box-end --}}
                {{-- homestay-images-start --}}
                <div class="col-12 homestay-img-col">
                    <div class="row homestay-inner-row">
                        <div class="col-6 homestay-inner-left">
                            <div class="img">
                                <img src="{{ asset('storage/' . $homestay->images[0]?->image_path) }}"
                                    alt="{{ $homestay->name }}" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-6 homestay-inner-right">
                            <div class="row homestay-inner-inner-row">
                                <div class="col-6">
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $homestay->images[1]?->image_path) }}"
                                            alt="{{ $homestay->name }}" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $homestay->images[2]?->image_path) }}"
                                            alt="{{ $homestay->name }}" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $homestay->images[3]?->image_path) }}"
                                            alt="{{ $homestay->name }}" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-6 position-relative">
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $homestay->images[4]?->image_path) }}"
                                            alt="{{ $homestay->name }}" class="img-fluid">
                                    </div>
                                    @if (count($homestay->images) > 4)
                                        <div class="backdrop view-all-backdrop position-absolute" data-toggle="modal"
                                            data-target="#modal-xl">
                                            <i class="fa-solid fa-plus me-1"></i> View All
                                        </div>
                                        @include('components.homestay_image', [
                                            'images' => $homestay->images,
                                        ])
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- homestay-images-end --}}
                {{-- homestay-basic-detail-start --}}
                <div class="row mx-0">
                    <div class="col-xl-8 ps-lg-0 ps-md-0 ps-sm-0 col-lg-7 col-md-6 col-12 property_details_card">
                        <div class="property-name-type mx-sm-0 premium-room px-sm-3">
                            <div class="d-flex">
                                <div class="property-name room_details">{{ $homestay->name }}</div>
                            </div>
                            <div class="room-type verify_details">
                                {{-- 4 Deluxe Double Bedroom --}}
                                @php
                                    $rooms = [];

                                    if ($homestay->number_of_single_rooms > 0) {
                                        $rooms[] =
                                            $homestay->number_of_single_rooms .
                                            ' Single Bedroom' .
                                            ($homestay->number_of_single_rooms > 1 ? 's' : '');
                                    }

                                    if ($homestay->number_of_double_rooms > 0) {
                                        $rooms[] =
                                            $homestay->number_of_double_rooms .
                                            ' Double Bedroom' .
                                            ($homestay->number_of_double_rooms > 1 ? 's' : '');
                                    }

                                    $numberOfRooms = implode(', ', $rooms);
                                @endphp
                                {{ $homestay->room_type }} Room, {{ $numberOfRooms }}
                            </div>
                            <div class="address-mobile verify_details mt-0 d-flex py-1 mt-1">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-location-dot me-2"></i>
                                    <div>
                                        {{ $homestay->address }}, {{ $homestay->city }},
                                        {{ $homestay->district->name }}, {{ $homestay->pincode }},
                                        {{ $homestay->state->name }}, India
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div
                                    class="col-xxl-3 col-xl-3 col-lg-4 col-6 d-flex justify-content-between border-right_check_in_out_time border_bottom_property_details ">
                                    <div class="">
                                        <small> Check In</small>
                                        <small class="text-color-blue">
                                            {{ date('h:i A', strtotime($homestay->check_in_time)) }}
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <small> Check out</small>
                                        <small class="text-color-blue">
                                            {{ date('h:i A', strtotime($homestay->check_out_time)) }}
                                        </small>
                                    </div>
                                </div>
                                <div
                                    class="col-xxl-3 col-xl-3 col-lg-3 col-6 font-size-12 border-right-food_not text-color-blue border_bottom_property_details">
                                    {{ $homestay->food_allowed === 'yes' ? 'Food is allowed at an extra cost' : 'No Food Allowed' }}
                                </div>
                                <div
                                    class="col-xxl-6 col-xl-6 col-lg-5 col-12 font-size-12 text-color-blue children_policy">
                                    {{ $homestay->note }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-6 col-12 px-0 ">
                        <div class="premium-room py-3">
                            <div class="row mx-sm-0">
                                <div class="col-6">
                                    <div class="premium-room-title text-capitalize">
                                        {{ $homestay->room_type }}
                                        {{ $homestay->bedroom_type === 'Both' ? 'Single & Double Bedroom' : $homestay->bedroom_type }}
                                    </div>
                                    <div class=" guest_count room_count_guest">
                                        <div class="py-lg-1 py-md-1 py-sm-1 py-1 text-lg-start text-md-start  text-center">
                                            @php
                                                $persone = [];
                                                if ($homestay->number_of_adults > 0) {
                                                    $persone[] = $homestay->number_of_adults . ' x Adult';
                                                }
                                                if ($homestay->number_of_children > 0) {
                                                    $persone[] = $homestay->number_of_children . ' x Children';
                                                }
                                                $numberOfPersons = implode(', ', $persone);
                                            @endphp
                                            {{ $numberOfPersons }} |
                                            {{ $homestay->number_of_rooms > 1 ? $homestay->number_of_rooms . ' X Rooms' : $homestay->number_of_rooms . ' X Room' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        @php
                                            $check_in_time = \Carbon\Carbon::parse($homestay->check_in_time);
                                            $check_out_time = \Carbon\Carbon::parse($homestay->check_out_time);
                                            $differenceInDays = floor($check_in_time->diffInDays($check_out_time));
                                        @endphp
                                        <div class="aftr-disc-price">₹{{ $homestay->price }}/- </div>
                                        <div class="taxes-fees">Taxes &amp; Fees</div>
                                        <div class="per-night">(Price for {{ $differenceInDays }} Night)</div>
                                        <div class="per-night">Refund as per policy</div>
                                    </div>
                                </div>
                                <div class="in-out-time row  mx-0">
                                    <div
                                        class="checkin-checkout check_in_border row mx-0 col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                                        <div class="col-12 pe-sm-2 px-0 check_in_out_title">Check In</div>
                                        <div class="col-12 pe-2 px-0">
                                            {{ date('d M Y h:i A', strtotime($homestay->check_in_time)) }}
                                        </div>
                                    </div>
                                    <div
                                        class="checkin-checkout row mx-0 col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                                        <div class="col-12 px-0 text-end check_in_out_title">Check Out</div>
                                        <div class="col-12 px-0 text-end">
                                            {{ date('d M Y h:i A', strtotime($homestay->check_out_time)) }}
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-6e">
                                    <div class="text-sm-center text-start mb-lg-2 mb-md-2 mb-sm-2 ">
                                        <button class="btn pr-enquiry w-100 btnds detail_page_enquiry">
                                            Enquiry
                                        </button>
                                    </div>
                                </div> --}}
                                <div class="col-6e">
                                    <div class="text-center mb-lg-2 mb-md-2 mb-sm-2">
                                        {{-- @if (Auth::user())
                                            <a href="" class="btn pr-book-now w-100 btnds">
                                                Book Now
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}"
                                                class="btn pr-book-now w-100 btnds save-page-url">
                                                Book Now
                                            </a>
                                        @endif --}}
                                        <button type="button" class="btn pr-book-now w-100 btnds" data-toggle="modal"
                                            data-target="#modal-default">
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- homestay-basic-detail-end --}}

                {{-- homestay-advance-detail-start --}}
                <div class="d-xs-none">
                    <div class="d-flex justify-content-between border-bottom height_tab mx-mobile mt-4"><a
                            href="#rooms&amp;spaces">
                            <div class="tablink">Rooms &amp; Spaces</div>
                        </a><a href="#location">
                            <div class="tablink">Location</div>
                        </a><a href="#amenities">
                            <div class="tablink">Amenities</div>
                        </a><a href="#rules&amp;policies">
                            <div class="tablink">Rules &amp; Policies</div>
                        </a></div>
                </div>

                <div class="col-12">
                    <div id="rooms&amp;spaces" class="rooms d-xs-none">
                        <div class="row mx-mobile">
                            <h3 class="property-details-title mb-0">Rooms</h3>
                            <div class="col-12 rounded-5">
                                <div class="table_room_space_radius">
                                    <table class="table-room-spaces">
                                        <thead class="">
                                            <tr class="table_room_space__tr">
                                                <th class="d-xs-none table_room_th_td">Room Type </th>
                                                <th class="d-xs-none table_room_th_td">Highlights</th>
                                                <th class="d-xs-none table_room_th_td">Benefits</th>
                                                <th class="text-end d-xs-none">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="row_hover ">
                                                <td class="whole-property-rowspan table_room_th_td">
                                                    <div class="whole-property">
                                                        <h3 class="property-title">
                                                            {{ $homestay->room_type }}
                                                            {{ $homestay->bedroom_type === 'Both' ? 'Single & Double Bedroom' : $homestay->bedroom_type }}
                                                        </h3>
                                                        <div>
                                                            <img class="mb-3 property_detail_room_image cursor_pointer2"
                                                                src="{{ asset('storage/' . $homestay->room_image) }}"
                                                                alt="{{ $homestay->name }}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="table_room_th_td">
                                                    <button class="property-type-btn">
                                                        Max Occupancy :
                                                        {{ $homestay->number_of_adults + $homestay->number_of_children }}
                                                    </button>
                                                    @if ($homestay->guest === 'yes')
                                                        <button class="property-type-btn">
                                                            Guest Access
                                                        </button>
                                                    @endif

                                                    <button class="property-type-btn">
                                                        {{ $homestay->area }} sq.ft
                                                    </button>
                                                    @if ($homestay->bedroom_type != 'Both')
                                                        <button class="property-type-btn">
                                                            {{ $homestay->bedroom_type }}
                                                        </button>
                                                    @endif
                                                    @if ($homestay->bedroom_type == 'Both')
                                                        <button class="property-type-btn">
                                                            Single & Double Bedroom
                                                        </button>
                                                    @endif

                                                    @if ($homestay->mountain_view === 'yes')
                                                        <button class="property-type-btn">
                                                            Mountain View
                                                        </button>
                                                    @endif
                                                </td>
                                                <td class="table_room_th_td">
                                                    <div class="property-only">
                                                        <ul class="property-list-item" style="padding-left: 2rem;">
                                                            @forelse ($homestay->benefits as $benefit)
                                                                <li class="">{{ $benefit->name }}</li>
                                                            @empty
                                                                <li>No Benefit Available Yet.</li>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="align-bottom ">
                                                    @php
                                                        $check_in_time = \Carbon\Carbon::parse(
                                                            $homestay->check_in_time,
                                                        );
                                                        $check_out_time = \Carbon\Carbon::parse(
                                                            $homestay->check_out_time,
                                                        );
                                                        $differenceInDays = floor(
                                                            $check_in_time->diffInDays($check_out_time),
                                                        );
                                                        // \Log::info('differenceInDays: ' . $differenceInDays);
                                                    @endphp
                                                    <div class="text-end">
                                                        <div class="aftr-disc-price">₹{{ $homestay->price }}/- </div>
                                                        <div class="taxes-fees"> +₹0 Taxes &amp; Fees</div>
                                                        <div class="per-night">(Price for
                                                            {{ $differenceInDays > 1 ? $differenceInDays : '' }}
                                                            night{{ $differenceInDays > 1 ? 's' : '' }})</div>
                                                        <div class="per-night text-end">Refund as per policy</div>
                                                        {{-- <div class="text-end bfr-disc-price">Room is not available.</div> --}}
                                                        <div class="text-end mt-3">
                                                            {{-- @if (Auth::user())
                                                                <a href="" class="btn pr-book-now btnds">
                                                                    Book Now
                                                                </a>
                                                            @else
                                                                <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}"
                                                                    class="btn pr-book-now btnds save-page-url">
                                                                    Book Now
                                                                </a>
                                                            @endif --}}
                                                            <button type="button" class="btn pr-book-now btnds"
                                                                data-toggle="modal" data-target="#modal-default">
                                                                Book Now
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rooms mx-lg-0 mx-md-0 mx-sm-0 mt-4">
                    <div class="row mx-mobile mb-3">
                        <div class="col-md-2 col-3 align-content-center">
                            <div class="amenities-left-sec">Common Spaces </div>
                        </div>
                        <div class="col-md-10 col-9 amenities-border-left">
                            <div class="row mx-0">
                                @forelse ($homestay->commonSpaces as $commonSpace)
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                        <div class="amenities-servise-name"> {{ $commonSpace->name }} </div>
                                    </div>
                                @empty
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                        <div class="amenities-servise-name">No Common Space Available Yet.</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div id="location" class="rooms mx-lg-0 mx-md-0 mx-sm-0">
                    <div class="row mx-mobile mt-lg-0 mt-md-0 mt-sm-0 mt-4 location_margin">
                        <div class="col-auto mb-1">
                            <h3 class="property-details-title mb-0 mt-1">Location</h3>
                        </div>
                        <div class="col-auto mt-2 mt-sm-0 d-flex align-items-center"><button type="button"
                                class="google_btn btn py-auto">Direction</button></div>
                    </div>
                    <div class="map-box-large">
                        <div class="map" id="map" data-geo-location="{{ $homestay->location }}">
                        </div>
                        <div id="map-link" class="map-link"></div>
                    </div>
                </div>

                <div id="amenities" class="rooms mx-lg-0 mx-md-0 mx-sm-0 ">
                    <div class="row mx-mobile mt-lg-0 mt-md-0 mt-sm-0 mt-4">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <h3 class="property-details-title">Property Amenities </h3>
                        </div>
                    </div>
                    <div class="amenities-sec">
                        <div class="row mx-mobile mb-3">
                            <div class="col-md-2 col-3 align-content-center">
                                <div class="amenities-left-sec">Safety &amp; Security</div>
                            </div>
                            <div class="col-md-10 col-9 amenities-border-left">
                                <div class="row mx-0">
                                    @forelse ($homestay->safetySecurities as $safetySecurity)
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                            <div class="amenities-servise-name"> {{ $safetySecurity->name }} </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                            <div class="amenities-servise-name"> No Safety & Security Available Yet. </div>
                                        </div>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                        <div class="row mx-mobile mb-3">
                            <div class="col-md-2 col-3 align-content-center">
                                <div class="amenities-left-sec">Bedding</div>
                            </div>
                            <div class="col-md-10 col-9 amenities-border-left">
                                <div class="row mx-0">
                                    @forelse ($homestay->beddings as $bedding)
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                            <div class="amenities-servise-name"> {{ $bedding->name }} </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                            <div class="amenities-servise-name"> No Bedding Available Yet. </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div id="rules&amp;policies" class="rooms">
                        <div class="row mx-mobile mt-lg-0 mt-md-0 mt-sm-0 mt-4">
                            <div class="col-12">
                                <h3 class="property-details-title">Rules &amp; Policies</h3>
                            </div>
                        </div>
                        <div class="my-3">
                            <h5 class="cancel_heading spacing-x text_16">Cancellation Policy</h5>
                            <div class="spacing-x">
                                <div class="cancellation_tabel">
                                    <div class="cancellation_tabel_row row mx-0 ">
                                        <div class="col-6 cancellation_tabel_row_header_first_child">
                                            <div class="header_label text-start text_16 fw-bolder">Cancellation period
                                            </div>
                                        </div>
                                        <div class="col-6 cancellation_tabel_row_header_second_child">
                                            <div class="header_label text-end text_16 fw-bolder">Cancellation Amount</div>
                                        </div>
                                    </div>
                                    <div class="cancellation_tabel_row row mx-0 ">
                                        <div class="col-6 cancellation_tabel_row_header_first_child">
                                            <div class="data_label text-start text_16">Up to 3 days Prior</div>
                                        </div>
                                        <div class="col-6 cancellation_tabel_row_header_second_child">
                                            <div class="data_label text-end text_16">
                                                ₹{{ $homestay->upto_3days_prior }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cancellation_tabel_row row mx-0 ">
                                        <div class="col-6 cancellation_tabel_row_header_first_child">
                                            <div class="data_label text-start text_16">Up to 2 days Prior</div>
                                        </div>
                                        <div class="col-6 cancellation_tabel_row_header_second_child">
                                            <div class="data_label text-end text_16">
                                                ₹{{ $homestay->upto_2days_prior }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cancellation_tabel_row row mx-0 ">
                                        <div class="col-6 cancellation_tabel_row_header_first_child">
                                            <div class="data_label text-start text_16">Up to 1 days Prior</div>
                                        </div>
                                        <div class="col-6 cancellation_tabel_row_header_second_child">
                                            <div class="data_label text-end text_16">
                                                ₹{{ $homestay['1day_prior'] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cancellation_tabel_row row mx-0 ">
                                        <div class="col-6 cancellation_tabel_row_header_first_child">
                                            <div class="data_label text-start text_16">On the day of check-in</div>
                                        </div>
                                        <div class="col-6 cancellation_tabel_row_header_second_child">
                                            <div class="data_label text-end text_16">
                                                ₹{{ $homestay->same_day_cancellation }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cancellation_tabel_row row mx-0 ">
                                        <div class="col-6 cancellation_tabel_row_header_first_child">
                                            <div class="data_label text-start text_16">No show</div>
                                        </div>
                                        <div class="col-6 cancellation_tabel_row_header_second_child">
                                            <div class="data_label text-end text_16">
                                                {{ $homestay->no_show }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- homestay-advance-detail-end --}}
            </div>
        </div>
    </section>
    {{-- hire-me-start --}}
    {{-- @include('layouts.hireMe') --}}
    {{-- hire-me-end --}}

    {{-- user-register-modal-start --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('registering-users.store') }}" method="POST" class="register-modal">
                    @csrf
                    <input type="hidden" name="homestay_id" value="{{ $homestay->id }}">
                    <div class="modal-header justify-content-between align-items-center">
                        <h4 class="modal-title">{{ $homestay->name }}: Book Now</h4>
                        <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="name">
                                    Name <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Your Name">
                                <p class="text-danger error" id="nameError"></p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">
                                    Phone <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Enter Your Phone">
                                <p class="text-danger error" id="phoneError"></p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">
                                    Email <sup class="text-danger">*</sup>
                                </label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Your Email">
                                <p class="text-danger error" id="emailError"></p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="check_in">
                                    Check In <sup class="text-danger">*</sup>
                                </label>
                                <input type="datetime-local" class="form-control" name="check_in" id="check_in">
                                <p class="text-danger error" id="checkInError"></p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="check_out">
                                    Check Out <sup class="text-danger">*</sup>
                                </label>
                                <input type="datetime-local" class="form-control" name="check_out" id="check_out">
                                <p class="text-danger error" id="checkOutError"></p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">
                                    Address
                                </label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Your Address">
                                <p class="text-danger error" id="addressError"></p>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">
                            Book Now
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- user-register-modal-end --}}
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- jQuery --}}
    <script src="{{ asset('assets/frontend/logged_seller/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/frontend/logged_seller/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- user-register-modal-script-start --}}
    <script>
        (function() {
            // Select form and controls
            const form = document.querySelector('.register-modal');
            if (!form) return;

            const inputs = {
                name: form.querySelector('#name'),
                phone: form.querySelector('#phone'),
                email: form.querySelector('#email'),
                check_in: form.querySelector('#check_in'),
                check_out: form.querySelector('#check_out'),
                address: form.querySelector('#address'),
            };

            // error elements (existing in your markup)
            const errors = {
                name: document.getElementById('nameError'),
                phone: document.getElementById('phoneError'),
                email: document.getElementById('emailError'),
                check_in: document.getElementById('checkInError'),
                check_out: document.getElementById('checkOutError'),
                address: document.getElementById('addressError'),
            };

            // Validation regexes
            const nameRe = /^[A-Za-z\s]+$/; // letters and spaces only
            const phoneStripRe = /[^\d\+]/g; // keep digits and plus for stripping (we'll count digits)
            const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // reasonable email test
            // Accept date formats that start with YYYY-MM-DD (time optional)
            const dateStartRe = /^\s*(\d{4}-\d{2}-\d{2})/;

            // Helpers
            function showError(fieldKey, message) {
                const el = errors[fieldKey];
                if (el) el.textContent = message;
                const inp = inputs[fieldKey];
                if (inp) inp.classList.add('is-invalid');
            }

            function clearError(fieldKey) {
                const el = errors[fieldKey];
                if (el) el.textContent = '';
                const inp = inputs[fieldKey];
                if (inp) inp.classList.remove('is-invalid');
            }

            // Individual field validators return true if valid, false otherwise
            function validateName() {
                const v = (inputs.name.value || '').trim();
                if (!v) {
                    showError('name', 'Name is required.');
                    return false;
                }
                if (!nameRe.test(v)) {
                    showError('name', 'Name should contain only letters and spaces.');
                    return false;
                }
                clearError('name');
                return true;
            }

            function validatePhone() {
                let v = (inputs.phone.value || '').trim();
                if (!v) {
                    showError('phone', 'Phone is required.');
                    return false;
                }
                // remove spaces, dashes, parentheses etc but keep + possibly at start
                // Count digits only
                const digits = v.replace(/\D/g, '');
                if (digits.length < 6 || digits.length > 16) {
                    showError('phone', 'Phone must contain between 6 and 16 digits (country code optional).');
                    return false;
                }
                // Basic allowed pattern: optional +, digits, spaces, hyphens, parentheses
                if (!/^\+?[\d\-\s\(\)]+$/.test(v)) {
                    showError('phone', 'Invalid phone format.');
                    return false;
                }
                clearError('phone');
                return true;
            }

            function validateEmail() {
                const v = (inputs.email.value || '').trim();
                if (!v) {
                    showError('email', 'Email is required.');
                    return false;
                }
                if (!emailRe.test(v)) {
                    showError('email', 'Please enter a valid email address.');
                    return false;
                }
                clearError('email');
                return true;
            }

            // Parse date string to a Date object if it contains a valid YYYY-MM-DD; otherwise invalid.
            function parseDateOnly(value) {
                if (!value) return null;
                // const m = dateStartRe.exec(value);
                const m = value;
                // console.log("m", m)
                if (!m) return null;
                // m[1] is YYYY-MM-DD
                // const parts = m[1].split('-').map(Number);
                // const dt = new Date(Date.UTC(parts[0], parts[1] - 1, parts[2]));
                // // check valid date
                // if (dt && dt.getUTCFullYear() === parts[0] && dt.getUTCMonth() === parts[1] - 1 && dt.getUTCDate() ===
                //     parts[2]) {
                //     return dt;
                // }
                // return null;
                return m;
            }

            function validateCheckIn() {
                const v = (inputs.check_in.value || '').trim();
                if (!v) {
                    showError('check_in', 'Check-in date is required.');
                    return false;
                }
                const d = parseDateOnly(v);
                if (!d) {
                    showError('check_in', 'Enter a valid date (YYYY-MM-DD). Time is optional.');
                    return false;
                }
                clearError('check_in');
                return true;
            }

            function validateCheckOut() {
                const vin = (inputs.check_in.value || '').trim();
                const vout = (inputs.check_out.value || '').trim();
                if (!vout) {
                    showError('check_out', 'Check-out date is required.');
                    return false;
                }
                const dIn = parseDateOnly(vin);
                const dOut = parseDateOnly(vout);
                if (!dOut) {
                    showError('check_out', 'Enter a valid date (YYYY-MM-DD). Time is optional.');
                    return false;
                }
                if (dIn && dOut && dOut < dIn) {
                    showError('check_out', 'Check-out cannot be earlier than check-in.');
                    return false;
                }
                clearError('check_out');
                return true;
            }

            function validateAddress() {
                const v = (inputs.address.value || '').trim();
                if (!v) {
                    clearError('address');
                    return true;
                }
                // allow letters, numbers, commas, dots, slashes, dashes, #, parentheses and spaces
                if (!/^[A-Za-z0-9\s:;\.,#\-\/\(\)]+$/.test(v)) {
                    showError('address', 'Address contains invalid characters.');
                    return false;
                }
                clearError('address');
                return true;
            }

            // Attach real-time validation handlers (on input / change)
            if (inputs.name) inputs.name.addEventListener('input', validateName);
            if (inputs.phone) inputs.phone.addEventListener('input', validatePhone);
            if (inputs.email) inputs.email.addEventListener('input', validateEmail);
            if (inputs.check_in) inputs.check_in.addEventListener('change', () => {
                validateCheckIn();
                validateCheckOut();
            });
            if (inputs.check_out) inputs.check_out.addEventListener('change', validateCheckOut);
            if (inputs.address) inputs.address.addEventListener('input', validateAddress);

            // Submit handling - your button is type="button", so hook the click OR form submit
            // Prefer hooking form submit for future-proofing
            form.addEventListener('submit', function(ev) {
                ev.preventDefault();

                const ok =
                    validateName() &
                    validatePhone() &
                    validateEmail() &
                    validateCheckIn() &
                    validateCheckOut() &
                    validateAddress();

                if (ok) {
                    // form is valid; submit normally
                    // if you want AJAX submission, replace this with fetch/XHR
                    form.submit();
                } else {
                    // focus first invalid field
                    const firstInvalid = form.querySelector('.is-invalid, .text-danger.error:not(:empty)');
                    if (firstInvalid) {
                        if (firstInvalid.focus) firstInvalid.focus();
                    }
                }
            });

            // The modal's "Book Now" button in your HTML is type="button". Let's also attach it to trigger form submit.
            const bookBtn = form.querySelector('.modal-footer .btn-primary');
            if (bookBtn) {
                bookBtn.addEventListener('click', function(ev) {
                    // trigger form submit, will run the validation above
                    form.requestSubmit ? form.requestSubmit() : form.dispatchEvent(new Event('submit', {
                        cancelable: true
                    }));
                });
            }
        })();
    </script>
    {{-- user-register-modal-script-end --}}

    {{-- show map --}}
    <script>
        function showMap(lat, lng) {
            var coord = {
                lat: lat,
                lng: lng
            };
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: coord,
                disableDefaultUI: false,
                streetViewControl: false,
                fullscreenControl: true,
            });

            var marker = new google.maps.Marker({
                position: coord,
                map: map
            });

            var mapLinkUrl = `https://www.google.com/maps/search/?api=1&query=${lat},${lng}`;

            if (google.maps.places) {
                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch({
                    location: coord,
                    radius: 50
                }, function(results, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK && results[0]) {
                        var placeName = results[0].name || "Place";
                        var mapLinkContainer = document.getElementById('map-link');
                        mapLinkContainer.innerHTML = `
                            <div class="large-map-link">
                                <div class="map-lan-log">${lat} ${lng}</div>
                                <p>${placeName}</p>
                                <a href="${mapLinkUrl}" target="_blank" class="large-map-link__link">View Large Map</a>
                            </div>
                        `;
                    } else {
                        // console.error("No place name found.");
                        var mapLinkContainer = document.getElementById('map-link');
                        mapLinkContainer.innerHTML = `
                            <div class="large-map-link">
                                <div class="map-lan-log">${lat} ${lng}</div>
                                <a href="${mapLinkUrl}" target="_blank" class="large-map-link__link">View Large Map</a>
                            </div>
                        `;
                    }
                });
            } else {
                // console.error("Google Places library not loaded.");
                var mapLinkContainer = document.getElementById('map-link');
                mapLinkContainer.innerHTML = `
                    <div class="large-map-link">
                        <div class="map-lan-log">${lat} ${lng}</div>
                        <a href="${mapLinkUrl}" target="_blank" class="large-map-link__link">View Large Map</a>
                    </div>
                `;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const mapId = document.getElementById('map');
            if (mapId) {
                var geoLocation = mapId.getAttribute('data-geo-location');
                if (geoLocation) {
                    var coordinates = geoLocation.split(',');
                    var lat = parseFloat(coordinates[0]);
                    var lng = parseFloat(coordinates[1]);
                    showMap(lat, lng);
                } else {
                    console.error("No geo location data found.");
                }
            }
        });
    </script>

    {{-- check-in, check-out time --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            flatpickr('#check_in, #check_out', {
                dateFormat: "M d, Y",
                minDate: "today",
            })
        })
    </script>
    <script src="{{ asset('assets/frontend/js/homestay.js') }}"></script>
@endsection
