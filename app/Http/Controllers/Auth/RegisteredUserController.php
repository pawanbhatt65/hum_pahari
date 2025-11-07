<?php
namespace App\Http\Controllers\Auth;

use App\Events\Registered;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        // Pass redirect URL from query parameter to the registration form
        $redirectUrl = $request->query('redirect');
        return view('auth.register', compact('redirectUrl'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'mobile'   => ['required', 'numeric', 'digits:10'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'string', 'in:user,seller,admin'],
        ]);
        // Log::info("Validation", ['validator' => $request->all()]);

        if ($validator->fails()) {
            Log::info("Validation errors", ['errors' => $validator->errors()->toArray()]);
            Alert::warning('Error', $validator->errors()->first());
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name'     => $request->name,
                'mobile'   => $request->mobile,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);

            event(new Registered($user));

            // Log::info("User registered successfully", ['user_id' => $user->id]);

            Alert::success('Success', 'You are registered successfully, please check your email!');

            if ($user->role === 'user') {
                // Log the user in and regenerate session
                Auth::login($user);
                $request->session()->regenerate();

                // Check for redirect URL from query parameter
                $redirectUrl = $request->input('redirect');
                if ($redirectUrl && filter_var($redirectUrl, FILTER_VALIDATE_URL)) {
                    // Validate URL is within your app
                    $parsedUrl = parse_url($redirectUrl);
                    $host      = $parsedUrl['host'] ?? '';
                    $appHost   = parse_url(config('app.url'))['host'];

                    if ($host === $appHost && str_contains($redirectUrl, '/homestays/detail/')) {
                        // Log::info("Redirecting to saved URL", ['url' => $redirectUrl]);
                        return redirect()->to($redirectUrl);
                    }
                }

                // Fallback to homepage
                return redirect()->intended(route('home', absolute: false));
            } else {
                // For seller or other roles, redirect to homepage without login
                // Signal to clear localStorage (handled client-side)
                return redirect()->route('home')->with('clearLocalStorage', true);
            }
        } catch (\Exception $e) {
            Log::error("Registration failed", ['error' => $e->getMessage()]);
            Alert::error('Error', 'Registration failed. Please try again.');
            return back()->withInput();
        }
    }
}
