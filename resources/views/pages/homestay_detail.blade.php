@extends('layouts.master')

@section('title', 'HomeStays | Detail')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/homestay.css') }}">
@endsection

@section('content')
    <section class="homestay-detail-section">
        <div class="container-fluid container-lg">
            <div class="row">
                {{-- search-box-start --}}
                <div class="col-12">
                    <div class="search-box">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group-container position-relative form-group-location">
                                <div class="icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <input type="text" name="location" id="placeLocation" class="form-control">
                            </div>
                            <div class="form-group-container position-relative form-group-check-in">
                                <div class="icon">
                                    <i class="fa-regular fa-calendar-days"></i>
                                </div>
                                <input type="text" name="check_in" id="check_in" class="form-control">
                            </div>
                            <div class="form-group-container position-relative form-group-check-out">
                                <div class="icon">
                                    <i class="fa-regular fa-calendar-days"></i>
                                </div>
                                <input type="text" name="check_out" id="check_out" class="form-control">
                            </div>
                            <div class="form-group-container position-relative form-group-search">
                                <button type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- search-box-end --}}
                {{-- homestay-images-start --}}
                <div class="col-12 homestay-img-col">
                    <div class="row homestay-inner-row">
                        <div class="col-6 homestay-inner-left">
                            <div class="img">
                                <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aG91c2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-6 homestay-inner-right">
                            <div class="row homestay-inner-inner-row">
                                <div class="col-6">
                                    <div class="img">
                                        <img src="https://static-ethics.sgp1.cdn.digitaloceanspaces.com/utdb/hs/AddPropertyPhotosdescription/2025217_154758_1_Screenshot_20250217_154635.png"
                                            alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="img">
                                        <img src="https://static-ethics.sgp1.cdn.digitaloceanspaces.com/utdb/hs/AddPropertyPhotosdescription/2025217_154832_1_20210106.jpg"
                                            alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="img">
                                        <img src="https://static-ethics.sgp1.cdn.digitaloceanspaces.com/utdb/hs/AddPropertyPhotosdescription/2025217_154838_1_20210122.jpg"
                                            alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-6 position-relative">
                                    <div class="img">
                                        <img src="https://static-ethics.sgp1.cdn.digitaloceanspaces.com/utdb/hs/AddPropertyPhotosdescription/2025217_154919_1_20210103_(2).jpg"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div class="backdrop view-all-backdrop position-absolute">
                                        <i class="fa-solid fa-plus me-1"></i> View All
                                    </div>
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
                                <div class="property-name room_details">Alpine Homestay</div>
                            </div>
                            <div class="room-type verify_details">4 Deluxe Double Bedroom</div>
                            <div class="address-mobile verify_details mt-0 d-flex py-1 mt-1">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-location-dot me-2"></i>
                                    <div>
                                        Village Sunil<span>, </span><span>Auli Road, </span>Joshimath, 246443, Uttarakhand
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div
                                    class="col-xxl-3 col-xl-3 col-lg-4 col-6 d-flex justify-content-between border-right_check_in_out_time border_bottom_property_details ">
                                    <div class=""><small> Check In</small><small class="text-color-blue"> 12:00
                                            PM</small></div>
                                    <div class="text-end"><small> Check out</small><small class="text-color-blue"> 11:00
                                            AM</small></div>
                                </div>
                                <div
                                    class="col-xxl-3 col-xl-3 col-lg-3 col-6 font-size-12 border-right-food_not text-color-blue border_bottom_property_details">
                                    Food is allowed at an extra cost</div>
                                <div
                                    class="col-xxl-6 col-xl-6 col-lg-5 col-12 font-size-12 text-color-blue children_policy">
                                    Child under the age of 12 stays free if sharing the bed with parents. Extra mattress fee
                                    applies if required.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-6 col-12 px-0 ">
                        <div class="premium-room py-3">
                            <div class="row mx-sm-0">
                                <div class="col-6">
                                    <div class="premium-room-title text-capitalize">Deluxe Double Bedroom </div>
                                    <div class=" guest_count room_count_guest">
                                        <div class="py-lg-1 py-md-1 py-sm-1 py-1 text-lg-start text-md-start  text-center">
                                            4 x Adult, 2 x Children | 1 x Room</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <div class="aftr-disc-price">₹4000/- </div>
                                        <div class="taxes-fees">+₹0 Taxes &amp; Fees</div>
                                        <div class="per-night">(Price for 1 Night)</div>
                                        <div class="per-night">Refund as per policy</div>
                                    </div>
                                </div>
                                <div class="in-out-time row  mx-0">
                                    <div
                                        class="checkin-checkout check_in_border row mx-0 col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                                        <div class="col-12 pe-sm-2 px-0 check_in_out_title">Check In</div>
                                        <div class="col-12 pe-2 px-0">06/04/2025</div>
                                    </div>
                                    <div
                                        class="checkin-checkout row mx-0 col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                                        <div class="col-12 px-0 text-end check_in_out_title">Check Out</div>
                                        <div class="col-12 px-0 text-end">07/04/2025</div>
                                    </div>
                                </div>
                                <div class="col-6e">
                                    <div class="text-sm-center text-start mb-lg-2 mb-md-2 mb-sm-2 "><button
                                            class="btn pr-enquiry w-100 btnds detail_page_enquiry">Enquiry</button></div>
                                </div>
                                <div class="col-6e">
                                    <div class="text-center mb-lg-2 mb-md-2 mb-sm-2"><button
                                            class="btn pr-book-now w-100 btnds">Book Now</button></div>
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
                                                        <h3 class="property-title"> Deluxe Double Bedroom </h3>
                                                        <div><img class="mb-3 property_detail_room_image cursor_pointer2"
                                                                src="https://static-ethics.sgp1.cdn.digitaloceanspaces.com/utdb/hs/AddRoomsDetails/2024716_0547_1_20210103.jpg"
                                                                alt=""></div>
                                                    </div>
                                                </td>
                                                <td class="table_room_th_td"><button class="property-type-btn">Max
                                                        Occupancy :
                                                        2</button><button class="property-type-btn">Guest
                                                        Access</button><button class="property-type-btn">12.00 x 10.00
                                                        sq.ft</button><button class="property-type-btn">Double
                                                        bed</button><button class="property-type-btn">Mountain
                                                        View</button>
                                                </td>
                                                <td class="d-xs-none table_room_th_td">
                                                    <div class="property-only">
                                                        <ul class="property-list-item">
                                                            <li class=""> Charging Point </li>
                                                            <li class=""> Chair </li>
                                                            <li class=""> Curtains </li>
                                                            <li class=""> Seating Area </li>
                                                            <li class=""> Mirror </li>
                                                            <li class=""> Dustbin </li>
                                                            <li class=""> Western Toilet Seat </li>
                                                            <li class=""> Geyser </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="align-bottom ">
                                                    <div class="text-end">
                                                        <div class="aftr-disc-price">₹4000/- </div>
                                                        <div class="taxes-fees"> +₹0 Taxes &amp; Fees</div>
                                                        <div class="per-night">(Price for 1 Night)</div>
                                                        <div class="per-night text-end">Refund as per policy</div>
                                                        <div class="text-end bfr-disc-price">Room is not available.</div>
                                                        <div class="text-end mt-3"><button class="btn pr-book-now btnds"
                                                                disabled="">Book Now</button></div>
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
                                <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                    <div class="amenities-servise-name"> 1 Common Area/Living Room </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                    <div class="amenities-servise-name"> 1 Balcony </div>
                                </div>
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
                    <div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7009.36139772129!2d77.39292534584763!3d28.549315627139475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce8c9f43a0957%3A0x823bc3320e36ec90!2sSector%2081%2C%20Noida%2C%20Uttar%20Pradesh%20201305!5e0!3m2!1sen!2sin!4v1743879463827!5m2!1sen!2sin"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                        <div class="amenities-servise-name"> Room Keys </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-mobile mb-3">
                            <div class="col-md-2 col-3 align-content-center">
                                <div class="amenities-left-sec">Bedding</div>
                            </div>
                            <div class="col-md-10 col-9 amenities-border-left">
                                <div class="row mx-0">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                        <div class="amenities-servise-name"> Blankets </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                        <div class="amenities-servise-name"> Cushions </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-auto py-1">
                                        <div class="amenities-servise-name"> Pillows </div>
                                    </div>
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
                                            <div class="data_label text-end text_16">Full Refund</div>
                                        </div>
                                    </div>
                                    <div class="cancellation_tabel_row row mx-0 ">
                                        <div class="col-6 cancellation_tabel_row_header_first_child">
                                            <div class="data_label text-start text_16">Up to 2 days Prior</div>
                                        </div>
                                        <div class="col-6 cancellation_tabel_row_header_second_child">
                                            <div class="data_label text-end text_16">₹10%</div>
                                        </div>
                                    </div>
                                    <div class="cancellation_tabel_row row mx-0 ">
                                        <div class="col-6 cancellation_tabel_row_header_first_child">
                                            <div class="data_label text-start text_16">Up to 1 days Prior</div>
                                        </div>
                                        <div class="col-6 cancellation_tabel_row_header_second_child">
                                            <div class="data_label text-end text_16">₹15%</div>
                                        </div>
                                    </div>
                                    <div class="cancellation_tabel_row row mx-0 ">
                                        <div class="col-6 cancellation_tabel_row_header_first_child">
                                            <div class="data_label text-start text_16">On the day of check-in</div>
                                        </div>
                                        <div class="col-6 cancellation_tabel_row_header_second_child">
                                            <div class="data_label text-end text_16">₹20%</div>
                                        </div>
                                    </div>
                                    <div class="cancellation_tabel_row row mx-0 ">
                                        <div class="col-6 cancellation_tabel_row_header_first_child">
                                            <div class="data_label text-start text_16">No show</div>
                                        </div>
                                        <div class="col-6 cancellation_tabel_row_header_second_child">
                                            <div class="data_label text-end text_16">No Refund</div>
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
    @include('layouts.hireMe')
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
    <script src="{{ asset('assets/frontend/js/homestay.js') }}"></script>
@endsection
