<?php
namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Models\HomeStay;
use App\Models\User;
use App\Models\UserRegister;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    // homepage
    public function home(Request $request)
    {
        // If search results exist → show them
        if (session()->has('searched_homestays')) {
            $homestay = session('searched_homestays');
        } else {
            // Default homepage listings
            $homestay = HomeStay::where('is_approved', true)
                ->with(['images' => function ($query) {
                    $query->take(3);
                }])
                ->take(12)
                ->orderBy('id', 'DESC')
                ->get();
        }

        return view('pages.home', compact('homestay'));
    }

    // homepage search homestay
    public function postHomeStaySearch(Request $request)
    {
        $data = $request->validate([
            'destination' => ['nullable', 'string'],
            'pin'         => ['nullable', 'string'],
        ]);

        $homestaysQuery = HomeStay::where('is_approved', true);

        if (! empty($data['destination'])) {
            $homestaysQuery->where(function ($q) use ($data) {
                $q->where('address', 'LIKE', '%' . $data['destination'] . '%')
                    ->orWhere('city', 'LIKE', '%' . $data['destination'] . '%');
            });
        }
        if (! empty($data['pin'])) {
            $homestaysQuery->where('pincode', 'LIKE', '%' . $data['pin'] . '%');
        }

        $result = $homestaysQuery
            ->with(['images' => function ($q) {$q->take(3);}])
            ->orderBy('id', 'DESC')
            ->get();
        // Log::info('Homestay Search Results: ', ['results' => $result->toArray()]);

        return view('pages.home', ['homestay' => $result]);
    }

    // homestays
    public function homestays(Request $request)
    {
        // Retrieve filters from session (if any)
        $filters = session('homestay_filters', []);

        $query = HomeStay::where('is_approved', true)
            ->with(['images' => function ($q) {
                $q->take(3)->orderBy('id', 'DESC');
            }]);

        // Apply filters from session (if present)
        if (! empty($filters['name'])) {
            $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }

        if (! empty($filters['location'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('address', 'LIKE', '%' . $filters['location'] . '%')
                    ->orWhere('city', 'LIKE', '%' . $filters['location'] . '%');
            });
        }

        // price handling: if min & max present use between, else >= or <=
        if (isset($filters['min_price']) && isset($filters['max_price'])) {
            $min = (float) $filters['min_price'];
            $max = (float) $filters['max_price'];
            if ($min > $max) {[$min, $max] = [$max, $min];}
            $query->whereBetween('price', [$min, $max]);
        } elseif (isset($filters['min_price'])) {
            $query->where('price', '>=', (float) $filters['min_price']);
        } elseif (isset($filters['max_price'])) {
            $query->where('price', '<=', (float) $filters['max_price']);
        }

        $homestay = $query->orderBy('id', 'DESC')->paginate(52);

        // Pass current filters to the view so the form fields can show them
        return view('pages.homestay', compact('homestay', 'filters'));
    }

    // homestays search from homestays page
    public function postHomeStayHomeStaySearch(Request $request)
    {
        $data = $request->validate([
            'name'      => ['nullable', 'string'],
            'location'  => ['nullable', 'string'],
            'min_price' => ['nullable', 'numeric'],
            'max_price' => ['nullable', 'numeric'],
        ]);

        // Save only the small filter values in session (NOT the query/result)
        $filters = array_filter($data, function ($v) {
            return $v !== null && $v !== '';
        });

        session(['homestay_filters' => $filters]);

        // Redirect to the listing page with NO filter params in URL
        return redirect()->route('homestays');
    }

    // in HomeController
    public function clearFilters()
    {
        session()->forget('homestay_filters');
        return redirect()->route('homestays');
    }

    // homestays detail page
    public function homeStayDetail(Request $request, $id)
    {
        $homestay = HomeStay::with(['images' => function ($query) {
            $query->orderBy('id', 'DESC');
        }])
            ->with('benefits')
            ->with('commonSpaces')
            ->with('safetySecurities')
            ->with('beddings')
            ->with('state')
            ->with('district')
            ->findOrFail($id);
        return view('pages.homestay_detail', compact('homestay'));
    }

    // products
    public function products()
    {
        return view('pages.products');
    }

    // product detail page
    public function productDetail()
    {
        return view('pages.product_detail');
    }

    // blogs
    public function blogs()
    {
        return view('pages.blogs');
    }

    // blog detail
    public function blogDetail()
    {
        return view('pages.blog_detail');
    }

    // user registering/booking homestay
    public function postUserRegistering(Request $request)
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
}
