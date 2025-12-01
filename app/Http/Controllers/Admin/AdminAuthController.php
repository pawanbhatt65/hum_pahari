<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    // Show admin login form
    public function adminLogin(Request $request)
    {
        return view('backend.pages.login');
    }

    // Handle admin login form submission
    public function postAdminLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            // Regenerate session (security)
            $request->session()->regenerate();

            Alert::success('Login Successful', 'Welcome back, Admin!');
            return redirect()->route('admin.dashboard');
        }

        Alert::error('Login Failed', 'Invalid email or password');
        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }

}
