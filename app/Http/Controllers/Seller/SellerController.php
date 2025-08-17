<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SellerController extends Controller
{
    // for dashboard page
    public function getDashboard(Request $req)
    {
        // Log::info("seller-dashboard");
        return view('pages.logged_seller.dashboard');
    }
}
