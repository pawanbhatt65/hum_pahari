<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            // Attempt authentication
            $request->authenticate();

            // Log successful authentication
            // Log::info('Authentication successful', [
            //     'user_id' => $request->user()->id,
            //     'email' => $request->user()->email
            // ]);

            // Regenerate session
            $request->session()->regenerate();

            // Show success alert
            Alert::success('Success', 'You have successfully logged in!');

            // Redirect based on user role
            if ($request->user()->role === "seller") {
                return redirect()->intended(route('seller.dashboard', absolute: false));
            }

            return redirect()->intended(route('user.dashboard', absolute: false));
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log authentication failure
            Log::warning('Authentication failed', [
                'email' => $request->email,
                'error' => $e->getMessage()
            ]);

            // Show error alert
            Alert::error('Error', 'Invalid email or password.');

            // Redirect back to login page with input (except password)
            return redirect()->back()->withInput($request->only('email'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
