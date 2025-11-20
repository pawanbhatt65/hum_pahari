@extends('seller_layout.master')

@section('title')
    HomeStays: Show
@endsection

@section('styles')
    <style>
        /* top-image-slider-css-start */
        .top-box-image {
            max-width: 400px;
        }

        .product-image-thumbs {
            position: relative;
            scroll-behavior: smooth;
            white-space: nowrap;
        }

        .product-image-thumb {
            display: inline-block;
        }

        .product-image-thumb.active img {
            border: 2px solid #007bff;
        }

        .gallery-arrow {
            background-color: #6c757d;
            color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            padding: 10px;
            height: 40px;
            width: 40px;
            top: 50%;
            transform: translateY(-50%);
        }

        .gallery-arrow-left {
            left: 20px;
        }

        .gallery-arrow-right {
            right: 20px;
        }

        .gallery-arrow:hover {
            background-color: #5e5f60;
        }

        .gallery-arrow:disabled {
            opacity: 0.5;
            color: rgba(255, 255, 255, 0.8);
            background-color: #5e5f60;
            cursor: not-allowed;
        }

        /* top-image-slider-css-end */
        /* room-image-section-css-start */
        .room-image {
            max-width: 100%;
            width: 100%;
        }

        @media only screen and (min-width: 992px) {
            .room-image {
                width: 400px;
            }
        }

        /* room-image-section-css-end */
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
    </style>
@endsection

@section('contents')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Homestay</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('homestays.index') }}">
                                    Homestays
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Homestay</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12 top-box-image">
                                @if ($listing->images && $listing->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $listing->images[0]->image_path) }}"
                                        class="product-image" alt="Homestay Image">
                                @else
                                    <img src="{{ asset('images/placeholder.jpg') }}" class="product-image"
                                        alt="No Image Available">
                                @endif
                            </div>
                            <div class="col-12 position-relative">
                                <button
                                    class="btn btn-outline-secondary position-absolute start-0 top-50 translate-middle-y d-none d-sm-block gallery-arrow gallery-arrow-left"
                                    style="z-index: 10;">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <div class="product-image-thumbs d-flex flex-nowrap overflow-hidden">
                                    @forelse ($listing->images ?? [] as $index => $image)
                                        <div
                                            class="product-image-thumb {{ $index === 0 ? 'active' : '' }} me-2 mb-2 flex-shrink-0">
                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                alt="Homestay Thumbnail {{ $index + 1 }}" class="img-thumbnail"
                                                style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;">
                                        </div>
                                    @empty
                                        <p class="m-0">No images available.</p>
                                    @endforelse
                                </div>
                                <button
                                    class="btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y d-none d-sm-block gallery-arrow gallery-arrow-right"
                                    style="z-index: 10;">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3">{{ $listing->name }}</h3>
                            <p>{{ $listing->note }}</p>

                            <hr>

                            <div class="bg-gray py-2 px-3 mt-4">
                                {{-- <h2 class="mb-0">
                                    {{$listing->price}}
                                </h2> --}}
                                <h5 class="mt-0">
                                    <small>Price (Between Check In to Check Out Time): {{ $listing->price }} </small>
                                </h5>
                            </div>

                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 col-lg-6">
                            <nav class="w-100">
                                <div class="nav nav-tabs" id="product-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="product-basic-detail-tab" data-toggle="tab"
                                        href="#product-basic-detail" role="tab" aria-controls="product-basic-detail"
                                        aria-selected="true">Basic Details</a>
                                    <a class="nav-item nav-link" id="product-address-detail-tab" data-toggle="tab"
                                        href="#product-address-detail" role="tab" aria-controls="product-address-detail"
                                        aria-selected="false">Address Details</a>
                                    <a class="nav-item nav-link" id="product-capacity-tab" data-toggle="tab"
                                        href="#product-capacity" role="tab" aria-controls="product-capacity"
                                        aria-selected="false">Capacity</a>
                                </div>
                            </nav>
                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="product-basic-detail" role="tabpanel"
                                    aria-labelledby="product-basic-detail-tab">
                                    <h6>Food Available: <b>{{ $listing->food_allowed }}</b></h6>
                                    <h6 class="mt-3">Room Type: <b>{{ $listing->room_type }}</b></h6>
                                    <h6 class="mt-3">Bedroom Type: <b>{{ $listing->bedroom_type }}</b></h6>
                                    <h6 class="mt-3">Number of Bedroom: <b>{{ $listing->number_of_rooms }}</b></h6>
                                    <h6 class="mt-3">Number of Single Rooms:
                                        <b>{{ $listing->number_of_single_rooms }}</b>
                                    </h6>
                                    <h6 class="mt-3">Number of Double Rooms:
                                        <b>{{ $listing->number_of_double_rooms }}</b>
                                    </h6>
                                </div>
                                <div class="tab-pane fade" id="product-address-detail" role="tabpanel"
                                    aria-labelledby="product-address-detail-tab">
                                    <h6>Country: <b>India</b></h6>
                                    <h6 class="mt-3">State: <b>{{ $listing->state->name }}</b></h6>
                                    <h6 class="mt-3">District: <b>{{ $listing->district->name }}</b></h6>
                                    <h6 class="mt-3">City: <b>{{ $listing->city }}</b></h6>
                                    <h6 class="mt-3">Address: <b>{{ $listing->address }}</b></h6>
                                    <h6 class="mt-3">Pin Code: <b>{{ $listing->pincode }}</b></h6>
                                </div>
                                <div class="tab-pane fade" id="product-capacity" role="tabpanel"
                                    aria-labelledby="product-capacity-tab">

                                    <h6>Number of Adult: <b>{{ $listing->number_of_adults }}</b></h6>
                                    <h6 class="mt-3">Number of Children: <b>{{ $listing->number_of_children }}</b></h6>
                                    <h6 class="mt-3">
                                        Check In Time:
                                        <b>
                                            {{ date('d-M-Y', strtotime($listing->check_in_time)) }}
                                        </b>
                                    </h6>
                                    <h6 class="mt-3">
                                        Check Out Time:
                                        <b>
                                            {{ date('d-M-Y', strtotime($listing->check_out_time)) }}
                                        </b>
                                    </h6>
                                    <h6 class="mt-3">Area (sq.ft): <b>{{ $listing->area }}</b></h6>
                                    <h6 class="mt-3">Guest Access: <b>{{ $listing->guest }}</b></h6>
                                    <h6 class="mt-3">Mountain View: <b>{{ $listing->mountain_view }}</b></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <figure class="d-flex justify-content-end align-items-center">
                                <img src="{{ asset('storage/' . $listing->room_image) }}" alt="{{ $listing->name }}"
                                    class="img-fluid room-image">
                            </figure>
                        </div>
                    </div>
                    {{-- {{ $listing->commonSpaces }} --}}
                    <div class="row mt-4">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                {{-- @if ($listing->benefits && $listing->benefits->isNotEmpty()) --}}
                                <a class="nav-item nav-link active" id="product-benefits-tab" data-toggle="tab"
                                    href="#product-benefits" role="tab" aria-controls="product-benefits"
                                    aria-selected="false">Benefits</a>
                                {{-- @endif --}}
                                {{-- @if ($listing->commonSpaces && $listing->commonSpaces->isNotEmpty()) --}}
                                <a class="nav-item nav-link" id="product-common-space-tab" data-toggle="tab"
                                    href="#product-common-space" role="tab" aria-controls="product-common-space"
                                    aria-selected="false">Common Space</a>
                                {{-- @endif --}}
                                {{-- @if ($listing->safetySecurities && $listing->safetySecurities->isNotEmpty()) --}}
                                <a class="nav-item nav-link" id="product-safety-security-tab" data-toggle="tab"
                                    href="#product-safety-security" role="tab"
                                    aria-controls="product-safety-security" aria-selected="false">Safety &
                                    Security</a>
                                {{-- @endif --}}
                                {{-- @if ($listing->beddings && $listing->beddings->isNotEmpty()) --}}
                                <a class="nav-item nav-link" id="product-bedding-tab" data-toggle="tab"
                                    href="#product-bedding" role="tab" aria-controls="product-bedding"
                                    aria-selected="false">Bedding</a>
                                {{-- @endif --}}
                                <a class="nav-item nav-link" id="product-rules-policies-tab" data-toggle="tab"
                                    href="#product-rules-policies" role="tab" aria-controls="product-rules-policies"
                                    aria-selected="false">Rules & Policies</a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-benefits" role="tabpanel"
                                aria-labelledby="product-benefits-tab">
                                <ul>
                                    @forelse ($listing->benefits as $benefit)
                                        <li class="mt-3">{{ $benefit->name }}</li>
                                    @empty
                                        <h3 class="strong">No benefit available yet!</h3>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="product-common-space" role="tabpanel"
                                aria-labelledby="product-common-space-tab">
                                <ul>
                                    @forelse ($listing->commonSpaces as $common)
                                        <li class="mt-3">{{ $common->name }}</li>
                                    @empty
                                        <h3 class="strong">No common space available yet!</h3>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="product-safety-security" role="tabpanel"
                                aria-labelledby="product-safety-security-tab">
                                <ul>
                                    @forelse ($listing->safetySecurities as $safe)
                                        <li class="mt-3">{{ $safe->name }}</li>
                                    @empty
                                        <h3 class="strong">No safety & security options available yet!</h3>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="product-bedding" role="tabpanel"
                                aria-labelledby="product-bedding-tab">
                                <ul>
                                    @forelse ($listing->beddings as $bed)
                                        <li class="mt-3">{{ $bed->name }}</li>
                                    @empty
                                        <h3 class="strong">No bedding available yet!</h3>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="product-rules-policies" role="tabpanel"
                                aria-labelledby="product-rules-policies-tab">
                                <ul>
                                    <li>Up to 3 days Prior: <b>{{ $listing->upto_3days_prior }}</b></li>
                                    <li class="mt-3">Up to 2 days Prior: <b>{{ $listing->upto_2days_prior }}</b></li>
                                    <li class="mt-3">Up to 1 days Prior: <b>{{ $listing->{"1day_prior"} }}</b></li>
                                    <li class="mt-3">On the day of check-in:
                                        <b>{{ $listing->same_day_cancellation }}</b>
                                    </li>
                                    <li class="mt-3">No show: <b>{{ $listing->no_show }}</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- show-location-map --}}
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="map-box-large">
                                <div class="map" id="map" data-geo-location="{{ $listing->location }}">
                                </div>
                                <div id="map-link" class="map-link"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            @if (count($listing->registerUsers) > 0)
                <div class="card card-solid mt-4">
                    <div class="card-body">
                        <table id="registeredUsersList" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listing->registerUsers as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['phone'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>{{ date('d M Y', strtotime($user['check_in_time'])) }}</td>
                                        <td>{{ date('d M Y', strtotime($user['check_out_time'])) }}</td>
                                        <td>{{ $user['address'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No registered users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Address</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            @endif

        </section>
        <!-- /.content -->
    </div>
@endsection


@section('scripts')
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt5DYIAisGK-fooNcWeIlp3snMUkqhhFA&libraries=places"></script>

    <script>
        $(document).ready(function() {
            // Thumbnail click to update main image
            $('.product-image-thumb').on('click', function() {
                const $image_element = $(this).find('img');
                const newSrc = $image_element.attr('src');
                if (newSrc) {
                    $('.product-image').prop('src', newSrc);
                    $('.product-image-thumb').removeClass('active');
                    $(this).addClass('active');
                } else {
                    console.error('No image source found for thumbnail:', $image_element);
                }
            });

            // Arrow navigation for scrolling thumbnails
            const $thumbsContainer = $('.product-image-thumbs');
            const $leftArrow = $('.gallery-arrow-left');
            const $rightArrow = $('.gallery-arrow-right');
            const scrollAmount = 320; // Adjust based on thumbnail width + margin (100px + 8px margin)

            function updateArrowState() {
                const scrollLeft = $thumbsContainer.scrollLeft();
                const maxScroll = $thumbsContainer[0].scrollWidth - $thumbsContainer[0].clientWidth;

                $leftArrow.prop('disabled', scrollLeft <= 0);
                $rightArrow.prop('disabled', scrollLeft >= maxScroll);
            }

            // Initial arrow state
            updateArrowState();

            // Update arrow state on scroll
            $thumbsContainer.on('scroll', updateArrowState);

            // Left arrow click
            $leftArrow.on('click', function() {
                $thumbsContainer.animate({
                    scrollLeft: $thumbsContainer.scrollLeft() - scrollAmount
                }, 300, updateArrowState);
            });

            // Right arrow click
            $rightArrow.on('click', function() {
                $thumbsContainer.animate({
                    scrollLeft: $thumbsContainer.scrollLeft() + scrollAmount
                }, 300, updateArrowState);
            });
        });
    </script>

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
@endsection
