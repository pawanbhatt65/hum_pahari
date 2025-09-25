<?php
namespace App\Http\Controllers;

use App\Models\HomeStay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    // homepage
    public function home(Request $request)
    {
        $homestay = HomeStay::where('is_approved', true)
        // Constrain the `images` relationship
            ->with(['images' => function ($query) {
                $query->take(3);
            }])
            ->take(12)
            ->orderBy('id', 'DESC')
            ->get();
        Log::info("home stay image", ["homestay" => $homestay]);
        return view('pages.home', compact('homestay'));
    }

    // homestays
    public function homestays()
    {
        $homestay = HomeStay::where('is_approved', true)
        // Constrain the `images` relationship
            ->with(['images' => function ($query) {
                $query->orderBy('id', 'DESC');
            }])
            ->orderBy('id', 'DESC')
            ->get();
        return view('pages.homestay', compact('homestay'));
    }
    // homestays detail page
    public function homeStayDetail(Request $request, $id)
    {
        $homestay = HomeStay::with(['images' => function ($query) {
            $query->orderBy('id', 'DESC');
        }])
            ->with('benefits')
            ->with('commonSpaces')
            ->with('safetySecurities')
            ->with('beddings')
            ->with('state')
            ->with('district')
            ->findOrFail($id);
        return view('pages.homestay_detail', compact('homestay'));
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
