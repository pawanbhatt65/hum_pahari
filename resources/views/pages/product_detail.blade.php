@extends('layouts.master')

@section('title', 'Product | Detail')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/homestay.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/product.css') }}">
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
                            <div class="form-group-container position-relative form-group-product">
                                <div class="icon">
                                    <i class="fa-solid fa-box-open"></i>
                                </div>
                                <input type="text" name="location" id="placeLocation" class="form-control"
                                    placeholder="Search for products">
                            </div>
                            <div class="form-group-container position-relative form-group-categories">
                                <div class="icon">
                                    <i class="fa-solid fa-table-list"></i>
                                </div>
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
                            <div class="form-group-container position-relative form-group-search">
                                <button type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- search-box-end --}}
                {{-- product-details-start --}}
                <div class="col-12">
                    {{-- navigation-links-start --}}
                    <ul class="list-inline product-navigation-links">
                        <li class="list-inline-item">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="">
                                Category
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="" class="active">
                                Product Name
                            </a>
                        </li>
                    </ul>
                    {{-- navigation-links-end --}}
                    {{-- item-details-start --}}
                    <div class="item-details">
                        <div class="item-detail-top" id="productImagesRow">
                            <div class="item-detail-left">
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
                                </div>
                            </div>
                            <div class="item-detail-right">
                                <div class="cat-name">Pahari Dal</div>
                                <div class="product-name">
                                    Bhatt dal black (BUY 500gm) ORGANIC Uttarakhand Food Product
                                </div>
                                <div class="product-desc">
                                    No chemicals or pesticides. This Organic Bhat Dal (black) is sourced mainly from the
                                    high rises of Uttarakhand. सीधा उत्तराखंड मुनस्यारी से डिलीवरी.
                                </div>
                                <div class="product-price"><span>₹</span>120.00</div>
                            </div>
                        </div>
                        <div class="item-detail-bottom">
                            <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-description" type="button" role="tab"
                                        aria-controls="pills-description" aria-selected="true">description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-specification-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-specification" type="button" role="tab"
                                        aria-controls="pills-specification" aria-selected="false">specification</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-review-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-review" type="button" role="tab"
                                        aria-controls="pills-review" aria-selected="false">review</button>
                                </li>
                            </ul>
                            <div class="tab-content item-detail-bottom-box" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                                    aria-labelledby="pills-description-tab" tabindex="0">
                                    <div class="tab-container">
                                        <div class="tab-div">
                                            Some of the same (bhatt) bhat ki dal you can buy from your nearest shop also.
                                            But we are different from others because:
                                        </div>
                                        <h1>
                                            Why Uttarakhand foods are better than others?
                                        </h1>
                                        <ul>
                                            <li>
                                                Our products yield only in high rises areas of Uttarakhand (Himalaya).
                                            </li>
                                            <li>
                                                Our products are natural because in the Himalayan area. We don’t use any
                                                chemicals or pesticides to produce products. We use only natural compost.
                                            </li>
                                            <li>
                                                Our dal is different from other companies in taste and quality because of
                                                the Himalayan climate.
                                            </li>
                                        </ul>
                                        <p>
                                            So try our product one time at least. You will like this 100%. Otherwise, we
                                            will give you a full refund without any questions.
                                        </p>
                                        <p>
                                            भट्ट की चुड़कानी (Bhatt ki Churdkani / Bhatt ki Churkani) – Step by step
                                            presentation. भट्ट की चुरकानी उत्तराखंड के कुमाऊं रीजन की एक परंपरागत रेसिपी है।
                                            Bhatt ki Churdkani बनाने का बहुत आसान तरीका।
                                        </p>
                                        <h3>
                                            भट्ट की चुड़कानी बनाने के लिए सामग्री / Ingredients for Bhatt Ki Churdkani
                                        </h3>
                                        <ul>
                                            <li>
                                                भट्ट दाल (Black Bean) – 1 कप
                                            </li>
                                            <li>गेहूं का आटा (Wheat Flour) – ¼ कप</li>
                                            <li>जीरा (Cumin Seed) – ½ छोटी चम्मच (1/2 TbS)</li>
                                            <li>हींग (Asafoetida) – 2 चुटकी</li>
                                            <li>सूखी लाल मिर्च – 2</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-specification" role="tabpanel"
                                    aria-labelledby="pills-specification-tab" tabindex="0">
                                    <div class="tab-container">
                                        <div class="tab-div">
                                            Some of the same (bhatt) bhat ki dal you can buy from your nearest shop also.
                                            But we are different from others because:
                                        </div>
                                        <h1>
                                            Why Uttarakhand foods are better than others?
                                        </h1>
                                        <ul>
                                            <li>
                                                Our products yield only in high rises areas of Uttarakhand (Himalaya).
                                            </li>
                                            <li>
                                                Our products are natural because in the Himalayan area. We don’t use any
                                                chemicals or pesticides to produce products. We use only natural compost.
                                            </li>
                                            <li>
                                                Our dal is different from other companies in taste and quality because of
                                                the Himalayan climate.
                                            </li>
                                        </ul>
                                        <p>
                                            So try our product one time at least. You will like this 100%. Otherwise, we
                                            will give you a full refund without any questions.
                                        </p>
                                        <p>
                                            भट्ट की चुड़कानी (Bhatt ki Churdkani / Bhatt ki Churkani) – Step by step
                                            presentation. भट्ट की चुरकानी उत्तराखंड के कुमाऊं रीजन की एक परंपरागत रेसिपी है।
                                            Bhatt ki Churdkani बनाने का बहुत आसान तरीका।
                                        </p>
                                        <h3>
                                            भट्ट की चुड़कानी बनाने के लिए सामग्री / Ingredients for Bhatt Ki Churdkani
                                        </h3>
                                        <ul>
                                            <li>
                                                भट्ट दाल (Black Bean) – 1 कप
                                            </li>
                                            <li>गेहूं का आटा (Wheat Flour) – ¼ कप</li>
                                            <li>जीरा (Cumin Seed) – ½ छोटी चम्मच (1/2 TbS)</li>
                                            <li>हींग (Asafoetida) – 2 चुटकी</li>
                                            <li>सूखी लाल मिर्च – 2</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-review" role="tabpanel"
                                    aria-labelledby="pills-review-tab" tabindex="0">
                                    <div class="tab-container star-rating-container">
                                        <p>Based on 385 reviews</p>
                                        <div class="review-box row">
                                            <div class="show-review col-lg-6 col-12">
                                                <div class="show-review-overall">
                                                    <p>Overall</p>
                                                    <span>4.2</span>
                                                </div>
                                                <div class="show-rating-container">
                                                    <ul class="star-rating-list list-inline">
                                                        <li class="list-inline-item">
                                                            <i class="fa-solid fa-star"></i>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="fa-solid fa-star"></i>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="fa-solid fa-star"></i>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="fa-solid fa-star-half-stroke"></i>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="fa-regular fa-star"></i>
                                                        </li>
                                                    </ul>
                                                    <div class="progress-box">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                </div>
                                                <div class="show-rating-container">
                                                    <ul class="star-rating-list list-inline">
                                                        <li class="list-inline-item">
                                                            <i class="fa-solid fa-star"></i>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="fa-solid fa-star"></i>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="fa-solid fa-star"></i>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="fa-solid fa-star-half-stroke"></i>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="fa-regular fa-star"></i>
                                                        </li>
                                                    </ul>
                                                    <div class="progress-box">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-review col-lg-6 col-12">
                                                <form action="" class="form-box">
                                                    <div class="form-group user-group">
                                                        <div class="user-figure">
                                                            <i class="fa-solid fa-user-tie"></i>
                                                        </div>
                                                        <div class="user-name">Rohen Singh</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Comment</label>
                                                        <textarea name="comment" id="comment" class="form-control"></textarea>
                                                    </div>
                                                    <div class="form-group add-star">
                                                        <ul class="star-rating list-inline">
                                                            <li class="list-inline-item">
                                                                <input type="hidden" name="star" value="1">
                                                                <i class="fa-solid fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <input type="hidden" name="star" value="2">
                                                                <i class="fa-regular fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <input type="hidden" name="star" value="3">
                                                                <i class="fa-regular fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <input type="hidden" name="star" value="4">
                                                                <i class="fa-regular fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <input type="hidden" name="star" value="5">
                                                                <i class="fa-regular fa-star"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-sm">Add</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="show-reviews-box">
                                            <div class="single-review">
                                                <div class="review-user-group">
                                                    <div class="user-figure">
                                                        <i class="fa-solid fa-user-tie"></i>
                                                    </div>
                                                    <div class="user-name">Rohen Singh</div> - <div class="review-date">22
                                                        April 2025</div>
                                                </div>
                                                <ul class="star-rating list-inline">
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star-half-stroke"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-regular fa-star"></i>
                                                    </li>
                                                </ul>
                                                <div class="show-comments">
                                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Modi nemo
                                                    dolores repellendus hic incidunt sint, nulla vero adipisci porro illum
                                                    magni, sit officia in fugiat expedita ratione ab libero et?
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="review-user-group">
                                                    <div class="user-figure">
                                                        <i class="fa-solid fa-user-tie"></i>
                                                    </div>
                                                    <div class="user-name">Rohen Singh</div> - <div class="review-date">22
                                                        April 2025</div>
                                                </div>
                                                <ul class="star-rating list-inline">
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star-half-stroke"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-regular fa-star"></i>
                                                    </li>
                                                </ul>
                                                <div class="show-comments">
                                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Modi nemo
                                                    dolores repellendus hic incidunt sint, nulla vero adipisci porro illum
                                                    magni, sit officia in fugiat expedita ratione ab libero et?
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="review-user-group">
                                                    <div class="user-figure">
                                                        <i class="fa-solid fa-user-tie"></i>
                                                    </div>
                                                    <div class="user-name">Rohen Singh</div> - <div class="review-date">22
                                                        April 2025</div>
                                                </div>
                                                <ul class="star-rating list-inline">
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-solid fa-star-half-stroke"></i>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa-regular fa-star"></i>
                                                    </li>
                                                </ul>
                                                <div class="show-comments">
                                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Modi nemo
                                                    dolores repellendus hic incidunt sint, nulla vero adipisci porro illum
                                                    magni, sit officia in fugiat expedita ratione ab libero et?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- item-details-end --}}
                </div>
                {{-- product-details-end --}}
                {{-- related-products-start --}}
                <div class="col-12">
                    <div class="related-product-box">
                        <p class="related-product-heading">Related products</p>
                        <div class="row">
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
                                        <a href="{{ route('productDetail') }}" class="btn btn-primary btn-sm mt-2">View
                                            Deal</a>
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
                        </div>
                    </div>
                </div>
                {{-- related-products-end --}}
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
    <script src="{{ asset('assets/frontend/js/products.js') }}"></script>
@endsection
