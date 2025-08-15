<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            Log::info("user", ['is_user' => $request->user()]);
            return redirect()->intended(route('login', absolute: false));
        }
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($request->user()->role === 'seller') {
            return redirect()->route('seller.dashboard');
        }
        return redirect()->intended(route('user.dashboard', absolute: false));
    }
}
