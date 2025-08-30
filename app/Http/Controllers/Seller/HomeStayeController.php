<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Bedding;
use App\Models\HomeStay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class HomeStayeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.logged_seller.homestays.index');
    }

    // homestay list data
    public function homeStayList(Request $request)
    {
        if ($request->ajax()) {
            try {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                $homestays = HomeStay::where('user_id', $user->id)
                    ->select(['id', 'name', 'city', 'is_approved']);

                $data = DataTables::of($homestays)
                    ->addIndexColumn()
                    ->addColumn('approve', function ($row) {
                        $checked = $row->is_approved ? 'checked' : '';
                        return '<input type="checkbox" class="approve-checkbox" data-id="' . $row->id . '" ' . $checked . '>';
                    })
                    ->addColumn('show', function ($row) {
                        $btn = '<button type="button" class="btn btn-default show-btn" data-id="' . $row->id . '" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-eye"></i></button>';
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
        return view('pages.logged_seller.homestays.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        try {
            // Validate request
            $validated = $request->validate([
                'name'               => 'required|string|max:80|regex:/^[a-zA-Z0-9\s\-]+$/',
                'roomType'           => 'required|in:Standard,Deluxe',
                'bedroomType'        => 'required|in:Single Bedroom,Double Bedroom,Both',
                'num_room'           => 'required|integer|min:1|max:12',
                'num_single_room'    => 'required|integer|min:0|max:6',
                'num_double_room'    => 'required|integer|min:0|max:6',
                'food_allowed'       => 'required|in:yes,no',
                'note'               => 'nullable|string|regex:/^[a-zA-Z0-9\s\-$&@#+.]+$/',
                'state_id'           => 'required|exists:states,id',
                'district_id'        => 'required|exists:districts,id',
                'city'               => 'required|string|max:255',
                'address'            => 'required|string|regex:/^[a-zA-Z0-9\s,\-]+$/',
                'pin'                => 'required|digits:6',
                'num_adult'          => 'required|integer|min:1|max:4',
                'num_children'       => 'required|integer|min:1|max:4',
                'check_in_time'      => 'required|date_format:Y-m-d',
                'check_out_time'     => 'required|date_format:Y-m-d|after:check_in_time',
                'area'               => 'required|numeric|min:0',
                'guest_access'       => 'required|in:yes,no',
                'mountain_view'      => 'required|in:yes,no',
                'room_image'         => 'required|image|max:2048', // 2MB
                'images.*'           => 'required|image|max:800',  // 800KB per image
                'images'             => 'array|min:1|max:10',
                'benefit.*'          => 'nullable|string|max:255|regex:/^[a-zA-Z0-9\s\-]*$/',
                'common_space.*'     => 'nullable|string|max:255|regex:/^[a-zA-Z0-9\s\-]*$/',
                'safety_security.*'  => 'nullable|string|max:255|regex:/^[a-zA-Z0-9\s\-]*$/',
                'bedding.*'          => 'nullable|string|max:255|regex:/^[a-zA-Z0-9\s\-]*$/',
                'location'           => 'required|string|regex:/^-?\d+\.\d{6},\s*-?\d+\.\d{6}$/',
                'one_night_price'    => 'required|numeric|min:0',
                'up_to_3_days_prior' => 'required|in:No Refund,5%,10%,15%,20%,25%,30%,35%,40%,45%,50%,Full Refund',
                'up_to_2_days_prior' => 'required|in:No Refund,5%,10%,15%,20%,25%,30%,35%,40%,45%,50%,Full Refund',
                'up_to_1_day_prior'  => 'required|in:No Refund,5%,10%,15%,20%,25%,30%,35%,40%,45%,50%,Full Refund',
                'check_in_day'       => 'required|in:No Refund,5%,10%,15%,20%,25%,30%,35%,40%,45%,50%,Full Refund',
                'no_show'            => 'required|in:No Refund,5%,10%,15%,20%,25%,30%,35%,40%,45%,50%,Full Refund',
            ], [
                'room_image.max'          => 'Room image must be less than 2MB.',
                'images.*.max'            => 'Each image must be less than 800KB.',
                'images.min'              => 'Please upload at least one image.',
                'images.max'              => 'You can upload up to 10 images.',
                'location.regex'          => 'Location must be in the format: latitude, longitude (e.g., 12.345678, 76.543210).',
                'name.regex'              => 'Name can only contain letters, digits, spaces, and hyphens.',
                'note.regex'              => 'Note can only contain letters, digits, spaces, and special characters (-, $, &, @, #, +, .).',
                'address.regex'           => 'Address can only contain letters, digits, spaces, commas, and hyphens.',
                'benefit.*.regex'         => 'Benefits can only contain letters, digits, spaces, and hyphens.',
                'common_space.*.regex'    => 'Common spaces can only contain letters, digits, spaces, and hyphens.',
                'safety_security.*.regex' => 'Safety & security items can only contain letters, digits, spaces, and hyphens.',
                'bedding.*.regex'         => 'Bedding items can only contain letters, digits, spaces, and hyphens.',
            ]);

            $num_room   = (int) $validated['num_room'];
            $num_single = (int) $validated['num_single_room'];
            $num_double = (int) $validated['num_double_room'];
            // Custom validation for room counts
            if ($num_single + $num_double !== $num_room) {
                Log::info('Room count validation failed', [
                    'num_room'        => $num_room,
                    'num_single_room' => $num_single,
                    'num_double_room' => $num_double,
                ]);
                Alert::error('Error', 'Total single and double bedrooms must equal the number of rooms.');
                return back()->withInput()->withErrors(['num_room' => 'Total single and double bedrooms must equal the number of rooms.']);
            }

            // Custom validation for dynamic fields
            $dynamicFields        = ['benefit', 'common_space', 'safety_security', 'bedding'];
            $hasValidDynamicField = false;
            foreach ($dynamicFields as $field) {
                if ($request->has($field) && array_filter($request->$field, fn($value) => ! empty(trim($value)))) {
                    $hasValidDynamicField = true;
                    break;
                }
            }
            if (! $hasValidDynamicField) {
                Alert::error('Error', 'Please provide at least one benefit, common space, safety & security, or bedding item.');
                return back()->withInput()->withErrors(['benefit' => 'Please provide at least one benefit, common space, safety & security, or bedding item.']);
            }

            // Store room image
            $roomImagePath = $request->file('room_image')->store('homestays/rooms', 'public');

            // Create HomeStay
            $homeStay = HomeStay::create([
                'user_id'                => $user->id,
                'name'                   => $validated['name'],
                'room_type'              => $validated['roomType'],
                'bedroom_type'           => $validated['bedroomType'],
                'number_of_rooms'        => $num_room,
                'number_of_single_rooms' => $num_single,
                'number_of_double_rooms' => $num_double,
                'food_allowed'           => $validated['food_allowed'],
                'note'                   => $validated['note'],
                'state_id'               => $validated['state_id'],
                'district_id'            => $validated['district_id'],
                'city'                   => $validated['city'],
                'address'                => $validated['address'],
                'pincode'                => $validated['pin'],
                'number_of_adults'       => $validated['num_adult'],
                'number_of_children'     => $validated['num_children'],
                'check_in_time'          => $validated['check_in_time'],
                'check_out_time'         => $validated['check_out_time'],
                'area'                   => $validated['area'],
                'guest'                  => $validated['guest_access'],
                'mountain_view'          => $validated['mountain_view'],
                'room_image'             => $roomImagePath,
                'upto_3days_prior'       => $validated['up_to_3_days_prior'],
                'upto_2days_prior'       => $validated['up_to_2_days_prior'],
                '1day_prior'             => $validated['up_to_1_day_prior'],
                'same_day_cancellation'  => $validated['check_in_day'],
                'no_show'                => $validated['no_show'],
                'location'               => $validated['location'],
                'price'                  => $validated['one_night_price'],
            ]);

            // Store benefits
            if ($request->has('benefit')) {
                foreach (array_filter($request->benefit) as $benefit) {
                    $homeStay->benefits()->create(['name' => $benefit]);
                }
            }

            // Store common spaces
            if ($request->has('common_space')) {
                foreach (array_filter($request->common_space) as $space) {
                    $homeStay->commonSpaces()->create(['name' => $space]);
                }
            }

            // Store safety and security
            if ($request->has('safety_security')) {
                foreach (array_filter($request->safety_security) as $safety) {
                    $homeStay->safetySecurities()->create(['name' => $safety]);
                }
            }

            // Store bedding
            if ($request->has('bedding')) {
                foreach (array_filter($request->bedding) as $bedding) {
                    $homeStay->beddings()->create(['name' => $bedding]);
                }
            }

            // Store multiple images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('homestays/images', 'public');
                    $homeStay->images()->create(['image_path' => $imagePath]);
                }
            }

            // Log success
            // Log::info('Homestay created', ['home_stay_id' => $homeStay->id]);

            // Success alert
            Alert::success('Success', 'Homestay created successfully!');

            return redirect()->route('homestays.index'); // Adjust route as needed
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Homestay creation failed', ['errors' => $e->errors()]);
            Alert::error('Error', 'Failed to create homestay. Please check the form.');
            return back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Unexpected error during homestay creation', ['error' => $e->getMessage()]);
            Alert::error('Error', 'An unexpected error occurred.');
            return back()->withInput();
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
        try {
            $homestay = HomeStay::where('user_id', Auth::user()->id)->findOrFail($id);
            $homestay->delete();
            return response()->json(['success' => true, 'message' => 'Homestay deleted']);
        } catch (\Exception $e) {
            Log::error('Delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete homestay'], 500);
        }
    }
}
