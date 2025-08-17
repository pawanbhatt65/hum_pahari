<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        Log::debug('Email verification request', [
            'request' => $request->all(),
        ]);

        // Validate the signed URL
        if (! URL::hasValidSignature($request)) {
            Log::warning('Invalid or expired verification link', [
                'id'   => $request->route('id'),
                'hash' => $request->route('hash'),
            ]);
            return redirect()->route('login')->with('error', 'Invalid or expired verification link.');
        }

        // Retrieve user by ID from the URL
        $user = User::findOrFail($request->route('id'));

        // Verify the email hash
        if (! hash_equals((string) $request->route('hash'), sha1($user->email))) {
            Log::warning('Invalid email hash', ['user_id' => $user->id]);
            return redirect()->route('login')->with('error', 'Invalid verification link.');
        }

        Log::debug('Email verification initiated', [
            'user_id'          => $user->id,
            'email'            => $user->email,
            'already_verified' => $user->hasVerifiedEmail(),
            'time'             => now()->toDateTimeString(),
        ]);

        // Check if email is already verified
        if ($user->hasVerifiedEmail()) {
            Log::info('Email already verified', ['user_id' => $user->id]);
            return $this->redirectBasedOnAuth($request->user(), $user);
        }

        // Mark email as verified
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            Log::info('Email verified successfully', ['user_id' => $user->id]);
        }

        return $this->redirectBasedOnAuth($request->user(), $user);
    }

    protected function redirectBasedOnAuth($authUser, $user): RedirectResponse
    {
        // If user is authenticated, redirect to their dashboard
        if ($authUser) {
            return redirect()->intended($this->redirectPath($user));
        }

        // If not authenticated, redirect to login with success message
        return redirect()->route('login')->with('status', 'Your email has been verified. Please log in.');
    }

    protected function redirectPath($user): string
    {
        return match ($user->role) {
            'seller' => route('seller.dashboard'),
            default => route('user.dashboard'),
        };
    }
}
