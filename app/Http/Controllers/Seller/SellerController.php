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
            'mobile' => 'required|string|max:20',
        ], [
            'name.required'   => 'Name is required.',
            'mobile.required' => 'Mobile number is required.',
        ]);

        $seller->name   = $req->input('name');
        $seller->mobile = $req->input('mobile');
        $seller->save();

        // Log::info("Profile updated successfully", ['seller_id' => $seller->id]);
        Alert::success('Success', 'Profile updated successfully.', 3500);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    // for updating password
    public function postUpdatePassword(Request $req, $id)
    {
        $seller = Auth::user();
        if ($seller->id != $id) {
            Log::warning("Unauthorized password update attempt", ['attempted_seller_id' => $id, 'actual_seller_id' => $seller->id]);
            Alert::error('Error', 'Unauthorized action.', 3500);
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        $req->validate([
            'current_password'          => 'required|string',
            'new_password'              => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string|min:8',
        ], [
            'current_password.required' => 'Current password is required.',
            'new_password.required'     => 'New password is required.',
            'new_password.min'          => 'New password must be at least 8 characters.',
            'new_password.confirmed'    => 'New password confirmation does not match.',
        ]);
        if (! password_verify($req->input('current_password'), $seller->password)) {
            Log::warning("Current password does not match", ['seller_id' => $seller->id]);
            Alert::error('Error', 'Current password is incorrect.', 3500);
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }
        $seller->password = bcrypt($req->input('new_password'));
        $seller->save();
        // Log::info("Password updated successfully", ['seller_id' => $seller->id]);
        Alert::success('Success', 'Password updated successfully.', 3500);
        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
