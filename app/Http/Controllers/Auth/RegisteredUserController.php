<?php
namespace App\Http\Controllers\Auth;

use App\Events\Registered;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
    public function create(): View
    {
        return view('auth.register');
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

            return redirect()->route('home');

        } catch (\Exception $e) {
            Log::error("Registration failed", ['error' => $e->getMessage()]);
            Alert::error('Error', 'Registration failed. Please try again.');
            return back()->withInput();
        }
    }
}
