<?php
namespace App\Http\Controllers\Seller;

use App\Events\BookingCreated;
use App\Http\Controllers\Controller;
use App\Models\HomeStay;
use App\Models\User;
use App\Models\UserRegister;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class RegisteredUser extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.logged_seller.registeredUsers.index');
    }

    // registered Users list data
    public function registeredUsersList(Request $request)
    {
        if ($request->ajax()) {
            try {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                $registeredUsers = UserRegister::where('user_id', $user->id)
                    ->select(['id', 'name', 'city', 'is_approved']);

                $data = DataTables::of($registeredUsers)
                    ->addIndexColumn()
                    ->addColumn('approve', function ($row) {
                        $checked = $row->is_approved ? 'checked' : '';
                        return '<input type="checkbox" class="approve-checkbox" data-id="' . $row->id . '" ' . $checked . '>';
                    })
                    ->addColumn('show', function ($row) {
                        $btn = '<a href="' . route('homestays.show', $row->id) . '" class="btn btn-default show-btn"><i class="fas fa-eye"></i></a>';
                        return $btn;
                    })
                    ->addColumn('edit', function ($row) {
                        return '<a href="' . route('homestays.edit', $row->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-pen-fancy"></i></a>';
                    })
                    ->addColumn('delete', function ($row) {
                        return '<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    })
                    ->rawColumns(['approve', 'show', 'edit', 'delete'])
                    ->make(true);

                // Log::info("data", ['datatable' => $data]);
                return $data;
            } catch (\Exception $e) {
                Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => 'Server error occurred'], 500);
            }
        }

        return view('pages.logged_seller.homestays.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Basic validation rules for required shape
        $request->validate([
            'name'        => ['required', 'string', 'max:255', 'regex:/^[A-Za-z\s]+$/'],
            'phone'       => ['required', 'string', 'max:40'], // further checked below
            'email'       => ['required', 'email', 'max:255'],
            'check_in'    => ['required', 'string'],
            'check_out'   => ['required', 'string'],
            'address'     => ['nullable', 'string', 'max:1000', 'regex:/^[A-Za-z0-9\s\.:;,#\-\/\(\)]*$/'],
            'homestay_id' => ['required', 'integer', 'exists:home_stays,id'],
        ], [
            'name.regex'    => 'Name should contain only letters and spaces.',
            'address.regex' => 'Address may contain letters, numbers, spaces and , . # - / ( ) characters only.',
        ]);

        // Additional phone validation: ensure between 6 and 16 digits (country code optional)
        $rawPhone   = $request->input('phone', '');
        $digitsOnly = preg_replace('/\D+/', '', $rawPhone);
        if (strlen($digitsOnly) < 6 || strlen($digitsOnly) > 16) {
            throw ValidationException::withMessages(['phone' => 'Phone must contain between 6 and 16 digits (country code optional).']);
        }

        // Parse dates (accept many human readable formats). Helper below used.
        try {
            $checkInCarbon = $this->parseHumanDate($request->input('check_in'));
        } catch (\Exception $e) {
            throw ValidationException::withMessages(['check_in' => 'Invalid check-in date. Use a valid date like "2025-11-18" or "Nov 18, 2025".']);
        }

        try {
            $checkOutCarbon = $this->parseHumanDate($request->input('check_out'));
        } catch (\Exception $e) {
            throw ValidationException::withMessages(['check_out' => 'Invalid check-out date. Use a valid date like "2025-11-19" or "Nov 19, 2025".']);
        }

        // Ensure check-out is not earlier than check-in
        if ($checkOutCarbon->lt($checkInCarbon)) {
            throw ValidationException::withMessages(['check_out' => 'Check-out cannot be earlier than check-in.']);
        }

        // Save as YYYY-MM-DD (date-only)
        $data = [
            'name'           => $request->input('name'),
            'phone'          => $rawPhone,
            'email'          => $request->input('email'),
            'check_in_time'  => $checkInCarbon->format('Y-m-d'),
            'check_out_time' => $checkOutCarbon->format('Y-m-d'),
            'address'        => $request->input('address'),
            'home_stay_id'   => $request->input('homestay_id'),
        ];

        $registration = UserRegister::create($data);

        // If you also have a Homestay model instance, pass it — else pass null or the homestay id
        $homestay = HomeStay::find($request->input('homestay_id'));

        $seller = User::find($homestay->user_id);

        event(new BookingCreated($registration, $homestay, $seller));

        // Success alert
        Alert::success('Success!', 'Your homestay has been booked. The owner’s contact number has been sent to your email.');

        // Return back with success message (adjust redirect as you like)
        return redirect()->back()->with('success', 'Booking successful. We will contact you soon.');
    }

    /**
     * Try to parse a human-readable date/time value into a Carbon instance (date-only).
     * Accepts values like:
     *  - "2025-11-18"
     *  - "2025-11-18 10:00"
     *  - "2025-11-18T10:00"
     *  - "Nov 18, 2025"
     *  - "18 Nov 2025"
     *  - "Nov 18, 2025 10:00 AM"
     *
     * Returns Carbon at midnight of that date (server timezone).
     *
     * Throws \Exception on failure.
     */
    protected function parseHumanDate(string $value): Carbon
    {
        $value = trim($value);

        // Common explicit formats to try first
        $formats = [
            'Y-m-d H:i:s',
            'Y-m-d H:i',
            'Y-m-d\TH:i:s',
            'Y-m-d\TH:i',
            'Y-m-d',
            'd-m-Y',
            'd/m/Y',
            'M j, Y', // e.g. Nov 8, 2025 or Nov 18, 2025
            'M d, Y',
            'd M Y', // e.g. 18 Nov 2025
            'j M Y',
            'F j, Y', // November 18, 2025
            'Y/m/d',
        ];

        // Try Carbon::createFromFormat for each format (ignore time after parsing date)
        foreach ($formats as $fmt) {
            try {
                $c = Carbon::createFromFormat($fmt, $value);
                if ($c !== false) {
                    // return date-only at start of day (server timezone)
                    return $c->startOfDay();
                }
            } catch (\Exception $e) {
                // continue trying other formats
            }
        }

        // Fallback: try Carbon::parse which can handle many human formats
        try {
            $c = Carbon::parse($value);
            return $c->startOfDay();
        } catch (\Exception $e) {
            // give up
            throw new \Exception("Unable to parse date: {$value}");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
