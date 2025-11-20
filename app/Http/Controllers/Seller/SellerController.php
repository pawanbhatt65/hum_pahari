<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SellerController extends Controller
{
    // for dashboard page
    public function getDashboard(Request $req)
    {
        $homestays = Auth::user()->homeStays->count();
        $registered_users = Auth::user()->homeStays->flatMap(function ($homestay) {
            return $homestay->registerUsers;
        })->unique('id')->count();
        // Log::info("seller-dashboard", ['seller_id' => Auth::id(), 'homestays_count' => $homestays, 'registered_users_count' => $registered_users]);
        return view('pages.logged_seller.dashboard', compact('homestays', 'registered_users'));
    }

    // for profile page
    public function getProfile(Request $req)
    {
        $seller = Auth::user();
        return view('pages.logged_seller.profile', compact('seller'));
    }
}
