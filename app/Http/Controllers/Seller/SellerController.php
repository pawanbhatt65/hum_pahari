<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class SellerController extends Controller
{
    // for dashboard page
    public function getDashboard(Request $req)
    {
        $homestays        = Auth::user()->homeStays->count();
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

    // for updating profile
    public function postUpdateProfile(Request $req, $id)
    {
        $seller = Auth::user();
        if ($seller->id != $id) {
            Log::warning("Unauthorized profile update attempt", ['attempted_seller_id' => $id, 'actual_seller_id' => $seller->id]);

            Alert::error('Error', 'Unauthorized action.', 3500);
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $req->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $seller->id,
            'mobile' => 'required|string|max:20',
        ], [
            'name.required'   => 'Name is required.',
            'email.required'  => 'Email is required.',
            'email.email'     => 'Please provide a valid email address.',
            'email.unique'    => 'This email is already taken.',
            'mobile.required' => 'Mobile number is required.',
        ]);

        $seller->name   = $req->input('name');
        $seller->mobile = $req->input('mobile');
        $seller->save();

        Log::info("Profile updated successfully", ['seller_id' => $seller->id]);
        Alert::success('Success', 'Profile updated successfully.', 3500);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
