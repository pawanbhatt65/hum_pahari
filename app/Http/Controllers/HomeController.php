<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // homepage
    public function home() {
        return view('pages.home');
    }

    // homestays
    public function homestays()
    {
        return view('pages.homestay');
    }
    // homestays detail page
    public function homeStayDetail()
    {
        return view('pages.homestay_detail');
    }

    // products
    public function products()
    {
        return view('pages.products');
    }

    // product detail page
    public function productDetail()
    {
        return view('pages.product_detail');
    }

    // blogs
    public function blogs()
    {
        return view('pages.blogs');
    }

    // blog detail
    public function blogDetail()
    {
        return view('pages.blog_detail');
    }
}
