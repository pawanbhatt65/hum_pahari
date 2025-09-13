<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Bedding;
use App\Models\Benefit;
use App\Models\CommonSpace;
use App\Models\HomeStay;
use App\Models\HomeStayImages;
use App\Models\SafetySecurity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
                'num_adult'          => 'required|integer|min:1|max:12',
                'num_children'       => 'required|integer|min:1|max:12',
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
    public function show(Request $request, string $id)
    {
        try {
            // Check if user is authenticated
            $user = Auth::user();
            if (! $user) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }
                return redirect()->route('login')->with('error', 'Please log in to view homestay details.');
            }

            // Validate ID
            if (! is_numeric($id) || $id <= 0) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Invalid homestay ID'], 400);
                }
                return redirect()->back()->with('error', 'Invalid homestay ID.');
            }

            // Fetch homestay with relationships
            $listing = HomeStay::with([
                'state'            => fn($query)            => $query->select('id', 'name'),
                'district'         => fn($query)         => $query->select('id', 'name'),
                'beddings'         => fn($query)         => $query->select('id', 'home_stay_id', 'name'),
                'benefits'         => fn($query)         => $query->select('id', 'home_stay_id', 'name'),
                'commonSpaces'     => fn($query)     => $query->select('id', 'home_stay_id', 'name'),
                'images'           => fn($query)           => $query->select('id', 'home_stay_id', 'image_path'),
                'safetySecurities' => fn($query) => $query->select('id', 'home_stay_id', 'name'),
            ])
                ->where('id', $id)
                ->where('user_id', $user->id)
                ->first();
            // Log::info('details', ['listing' => $listing, 'state' => $listing->state]);

            // Check if homestay exists
            if (! $listing) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
                }
                return redirect()->back()->with('error', 'Homestay not found or you do not have access.');
            }

            // Handle AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'data_row' => [
                        'id'                     => $listing->id,
                        'name'                   => $listing->name,
                        'room_type'              => $listing->room_type,
                        'bedroom_type'           => $listing->bedroom_type,
                        'number_of_rooms'        => $listing->number_of_rooms,
                        'number_of_single_rooms' => $listing->number_of_single_rooms,
                        'number_of_double_rooms' => $listing->number_of_double_rooms,
                        'food_allowed'           => $listing->food_allowed,
                        'note'                   => $listing->note,
                        'city'                   => $listing->city,
                        'address'                => $listing->address,
                        'pincode'                => $listing->pincode,
                        'number_of_adults'       => $listing->number_of_adults,
                        'number_of_children'     => $listing->number_of_children,
                        'check_in_time'          => $listing->check_in_time,
                        'check_out_time'         => $listing->check_out_time,
                        'area'                   => $listing->area,
                        'guest'                  => $listing->guest,
                        'mountain_view'          => $listing->mountain_view,
                        'room_image'             => $listing->room_image,
                        'upto_3days_prior'       => $listing->upto_3days_prior,
                        'upto_2days_prior'       => $listing->upto_2days_prior,
                        '1day_prior'             => $listing->{"1day_prior"},
                        'same_day_cancellation'  => $listing->same_day_cancellation,
                        'no_show'                => $listing->no_show,
                        'location'               => $listing->location,
                        'price'                  => $listing->price,
                        'is_approved'            => $listing->is_approved,
                        'state_name'             => $listing->state ? $listing->state->name : null,
                        'district_name'          => $listing->district ? $listing->district->name : null,
                        'beddings'               => $listing->beddings->toArray(),
                        'benefits'               => $listing->benefits->toArray(),
                        'common_spaces'          => $listing->common_spaces->toArray(),
                        'home_stay_images'       => $listing->home_stay_images->toArray(),
                        'safety_securities'      => $listing->safety_securities->toArray(),
                    ],
                ], 200);
            }

            // Handle non-AJAX request
            return view('pages.logged_seller.homestays.show', compact('listing'));
        } catch (\Exception $e) {
            Log::error('Show Homestay error: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Server error occurred'], 500);
            }
            return redirect()->back()->with('error', 'An error occurred while fetching homestay details.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Check if user is authenticated
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login')->with('error', 'Please log in to view homestay details.');
        }

        // Fetch homestay with relationships
        $listing = HomeStay::with([
            'state'            => fn($query)            => $query->select('id', 'name'),
            'district'         => fn($query)         => $query->select('id', 'name'),
            'beddings'         => fn($query)         => $query->select('id', 'home_stay_id', 'name'),
            'benefits'         => fn($query)         => $query->select('id', 'home_stay_id', 'name'),
            'commonSpaces'     => fn($query)     => $query->select('id', 'home_stay_id', 'name'),
            'images'           => fn($query)           => $query->select('id', 'home_stay_id', 'image_path'),
            'safetySecurities' => fn($query) => $query->select('id', 'home_stay_id', 'name'),
        ])
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();
        // Log::info("listing", ['listing'=> $listing]);
        return view('pages.logged_seller.homestays.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info("Log before validation");
        // Validate request
        $rules = [
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
            'num_adult'          => 'required|integer|min:1|max:12',
            'num_children'       => 'required|integer|min:1|max:12',
            'check_in_time'      => 'required|date_format:Y-m-d',
            'check_out_time'     => 'required|date_format:Y-m-d|after:check_in_time',
            'area'               => 'required|numeric|min:0',
            'guest_access'       => 'required|in:yes,no',
            'mountain_view'      => 'required|in:yes,no',
            'location'           => 'required|string|regex:/^-?\d+\.\d{6},\s*-?\d+\.\d{6}$/',
            'one_night_price'    => 'required|numeric|min:0',
            'up_to_3_days_prior' => 'required|in:No Refund,5%,10%,15%,20%,25%,30%,35%,40%,45%,50%,Full Refund',
            'up_to_2_days_prior' => 'required|in:No Refund,5%,10%,15%,20%,25%,30%,35%,40%,45%,50%,Full Refund',
            'up_to_1_day_prior'  => 'required|in:No Refund,5%,10%,15%,20%,25%,30%,35%,40%,45%,50%,Full Refund',
            'check_in_day'       => 'required|in:No Refund,5%,10%,15%,20%,25%,30%,35%,40%,45%,50%,Full Refund',
            'no_show'            => 'required|in:No Refund,5%,10%,15%,20%,25%,30%,35%,40%,45%,50%,Full Refund',
        ];

        $messages = [
            'check_in_time.date_format' => 'Check In Time must be Y-m-d format',
            'check_out_time.after'      => 'Check Out Time should be after Check In Time',
            'location.regex'            => 'Location must be in the format: latitude, longitude (e.g., 12.345678, 76.543210).',
            'name.regex'                => 'Name can only contain letters, digits, spaces, and hyphens.',
            'note.regex'                => 'Note can only contain letters, digits, spaces, and special characters (-, $, &, @, #, +, .).',
            'address.regex'             => 'Address can only contain letters, digits, spaces, commas, and hyphens.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        // Step 2: Check for validation failure
        // if ($validator->fails()) {
        //     // Step 3: Loop through errors and show an alert for each
        //     // foreach ($validator->errors()->all() as $error) {
        //     //     Alert::error('Error', $error);
        //     // }
        //     return back()->withInput();
        // }

        Log::info("data after validation");

        $homeStay = HomeStayImages::find($id);

        if (! $homeStay) {
            Alert::error('Error', 'Home stay image not found.');
            return back();
        }

        $homeStay->update([
            "name"                   => $rules["name"],
            "room_type"              => $rules["roomType"],
            "bedroom_type"           => $rules["bedroomType"],
            "number_of_rooms"        => $rules["num_room"],
            "number_of_single_rooms" => $rules["num_single_room"],
            "number_of_double_rooms" => $rules["num_double_room"],
            "food_allowed"           => $rules["food_allowed"],
            "note"                   => $rules["note"],
            "state_id "              => $rules["state_id"],
            "district_id"            => $rules["district_id"],
            "city"                   => $rules["city"],
            "address"                => $rules["address"],
            "pincode"                => $rules["pin"],
            "number_of_adults"       => $rules["num_adult"],
            "number_of_children"     => $rules["num_children"],
            "check_in_time"          => $rules["check_in_time"],
            "check_out_time"         => $rules["check_out_time"],
            "area"                   => $rules["area"],
            "guest"                  => $rules["guest_access"],
            "mountain_view"          => $rules["mountain_view"],
            "location"               => $rules["location"],
            "price"                  => $rules["one_night_price"],
            "upto_3days_prior"       => $rules["up_to_3_days_prior"],
            "upto_2days_prior"       => $rules["up_to_2_days_prior"],
            "1day_prior"             => $rules["up_to_1_day_prior"],
            "same_day_cancellation"  => $rules["check_in_day"],
            "no_show"                => $rules["no_show"],
        ]);

        Alert::success('Success', 'Home stay updated successfully.', 3500);
        return redirect()->route('homestays.index');
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

    /**
     * get all benefits
     */
    public function benefits(Request $request, string $id)
    {
        if ($request->ajax()) {
            try {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                $query = Benefit::where('home_stay_id', $id)
                    ->whereHas('homeStay', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });

                // Total records without filtering
                $totalRecords = $query->count();

                // Apply search (if any)
                if ($request->has('search') && $request->search['value']) {
                    $searchValue = $request->search['value'];
                    $query->where('name', 'like', "%{$searchValue}%");
                }

                $filteredRecords = $query->count();

                // Log::info("request is: ", ['isRequest'=> $request]);
                // Apply ordering
                if ($request->has('order')) {
                    $orderColumn = $request->order[0]['column']; // Index of column
                    $orderDir    = $request->order[0]['dir'];
                    $columns     = ['id', 'name']; // Map to your DB columns (skip index/edit/delete)
                    if (isset($columns[$orderColumn])) {
                        $query->orderBy($columns[$orderColumn], $orderDir);
                    }
                }

                // Pagination
                $start  = $request->get('start', 0);
                $length = $request->get('length', 10);
                $query->offset($start)->limit($length);

                $benefits = $query->select(['id', 'name', 'home_stay_id'])->get();
                // Log::info("benefits", ['benefits'=> $benefits]);

                // Add DT_RowIndex and action columns (as in your original)
                $data = $benefits->map(function ($row, $index) use ($start) {
                    $row->DT_RowIndex = $start + $index + 1;
                    $row->edit        = '<button type="button" class="btn btn-secondary btn-sm edit_btn" data-homestay-id="' . $row->home_stay_id . '" data-benefit-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-pen-fancy"></i></button>';
                    $row->delete      = '<button type="button" class="btn btn-danger btn-sm delete-btn" data-homestay-id="' . $row->home_stay_id . '" data-benefit-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    return $row;
                });
                // Log::info("benefit_data", ['benefit_data'=> $data]);

                return response()->json([
                    'recordsTotal'    => $totalRecords,
                    'recordsFiltered' => $filteredRecords,
                    'data'            => $data,
                ]);

            } catch (\Exception $e) {
                Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => 'Server error occurred'], 500);
            }
        }

        return view('pages.logged_seller.homestays.benefits', compact('id'));
    }

    /**
     * add a new benefit
     */
    public function getAddNewBenefit(Request $request, string $id)
    {
        return view('pages.logged_seller.homestays.add-brnefit', compact('id'));
    }

    /**
     * store new benefit
     */
    public function postAddNewBenefit(Request $request, string $id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $data = $request->validate([
                'name' => 'required|string|max:255',
            ]);
            Benefit::create([
                'name'         => $data['name'],
                'home_stay_id' => $id,
            ]);
            Alert::success('Success', 'Benefit added successfully.');
            return redirect()->route('homestays.benefits', $id);
        } catch (\Throwable $th) {
            Log::error('DataTables error: ' . $th->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    /**
     * get specific benefit data for edit
     */

    public function getEditBenefit(Request $request, string $id, string $benefit_id)
    {
        // Log::info('request: ', ['home_stay_id' => $id, 'benefit_id' => $benefit_id]);
        try {
            if ($request->ajax()) {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                // Validate homestay
                $homestay = HomeStay::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();

                if (! $homestay) {
                    Log::info("error", ['error' => 'Homestay not found or you do not have access']);
                    return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
                }
                // Log::info('homestay', ['homestay' => $homestay]);

                // Fetch benefit
                $benefit = Benefit::where('id', $benefit_id)
                    ->where('home_stay_id', $id)
                    ->with('homeStay')
                    ->select(['id', 'home_stay_id', 'name'])
                    ->first();

                if (! $benefit) {
                    Log::info("error", ['error' => 'Benefit not found']);
                    return response()->json(['error' => 'Benefit not found'], 404);
                }

                // Log::info('Fetched benefit', ['home_stay_id' => $id, 'benefit_id' => $benefit_id, "benefit" => $benefit]);

                return response()->json([
                    'success' => true,
                    'data'    => $benefit,
                ], 200);
            }

            // Non-AJAX: Redirect to edit form (optional)
            return redirect()->route('homestays.benefits', ['id' => $id, 'benefit_id' => $benefit_id]);
        } catch (\Exception $e) {
            Log::error('Get Edit Benefit error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    // Add putEditBenefit and deleteBenefit from previous responses
    public function putEditBenefit(Request $request, string $id, string $benefit_id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }
                return redirect()->route('login')->with('error', 'Please log in to edit benefits.');
            }

            $homestay = HomeStay::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $homestay) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
                }
                return redirect()->back()->with('error', 'Homestay not found or you do not have access.');
            }

            $benefit = Benefit::where('id', $benefit_id)
                ->where('home_stay_id', $id)
                ->first();

            if (! $benefit) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Benefit not found'], 404);
                }
                return redirect()->back()->with('error', 'Benefit not found.');
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $benefit->update($validated);

            if ($request->ajax()) {
                return response()->json(['success' => 'Benefit updated successfully'], 200);
            }

            return redirect()->back()->with('success', 'Benefit updated successfully.');
        } catch (\Exception $e) {
            Log::error('Edit Benefit error: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Server error occurred'], 500);
            }
            return redirect()->back()->with('error', 'An error occurred while updating the benefit.');
        }
    }

    // delete a benefit
    public function deleteBenefit(Request $request, string $id, string $benefit_id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $homestay = HomeStay::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $homestay) {
                return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
            }

            $benefit = Benefit::where('id', $benefit_id)
                ->where('home_stay_id', $id)
                ->first();

            if (! $benefit) {
                return response()->json(['error' => 'Benefit not found'], 404);
            }

            $benefit->delete();

            return response()->json(['success' => 'Benefit deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Delete Benefit error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    /**
     * start common-space functions
     */
    // common-space list page
    public function commonSpaceses(Request $request, string $id)
    {
        // Log::info("calling");
        if ($request->ajax()) {
            // Log::info("calling inside ajax");
            try {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                $query = CommonSpace::where('home_stay_id', $id)
                    ->whereHas('homeStay', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });
                // Log::info("query data: ", ['query' => $query]);

                // Total records without filtering
                $totalRecords = $query->count();

                // Apply search (if any)
                if ($request->has('search') && $request->search['value']) {
                    $searchValue = $request->search['value'];
                    $query->where('name', 'like', "%{$searchValue}%");
                }

                $filteredRecords = $query->count();

                // Apply ordering
                if ($request->has('order')) {
                    $orderColumn = $request->order[0]['column']; // Index of column
                    $orderDir    = $request->order[0]['dir'];
                    $columns     = ['id', 'name']; // Map to your DB columns (skip index/edit/delete)
                    if (isset($columns[$orderColumn])) {
                        $query->orderBy($columns[$orderColumn], $orderDir);
                    }
                }

                // Pagination
                $start  = $request->get('start', 0);
                $length = $request->get('length', 10);
                $query->offset($start)->limit($length);

                $commonSpaces = $query->select(['id', 'name', 'home_stay_id'])->get();

                // Add DT_RowIndex and action columns (as in your original)
                $data = $commonSpaces->map(function ($row, $index) use ($start) {
                    $row->DT_RowIndex = $start + $index + 1;
                    $row->edit        = '<button type="button" class="btn btn-secondary btn-sm edit_btn" data-homestay-id="' . $row->home_stay_id . '" data-common-space-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-pen-fancy"></i></button>';
                    $row->delete      = '<button type="button" class="btn btn-danger btn-sm delete-btn" data-homestay-id="' . $row->home_stay_id . '" data-common-space-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    return $row;
                });

                return response()->json([
                    'recordsTotal'    => $totalRecords,
                    'recordsFiltered' => $filteredRecords,
                    'data'            => $data,
                ]);

            } catch (\Exception $e) {
                Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => 'Server error occurred'], 500);
            }
        }
        return view('pages.logged_seller.homestays.common-space.index');
    }

    // get specific common space data for edit
    public function getEditCommonSpace(Request $request, string $id, string $common_spaces_id)
    {
        // Log::info('request: ', ['home_stay_id' => $id, 'common_spaces_id' => $common_spaces_id]);
        try {
            if ($request->ajax()) {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                // Validate homestay
                $homestay = HomeStay::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();

                if (! $homestay) {
                    Log::info("error", ['error' => 'Homestay not found or you do not have access']);
                    return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
                }
                // Log::info('homestay', ['homestay' => $homestay]);

                // Fetch common_space
                $common_space = CommonSpace::where('id', $common_spaces_id)
                    ->where('home_stay_id', $id)
                    ->with('homeStay')
                    ->select(['id', 'home_stay_id', 'name'])
                    ->first();

                if (! $common_space) {
                    Log::info("error", ['error' => 'Common Space not found']);
                    return response()->json(['error' => 'Common Space not found'], 404);
                }

                // Log::info('Fetched common_space', ['home_stay_id' => $id, 'common_spaces_id' => $common_spaces_id, "common_space" => $common_space]);

                return response()->json([
                    'success' => true,
                    'data'    => $common_space,
                ], 200);
            }

            // Non-AJAX: Redirect to edit form (optional)
            return redirect()->route('homestays.commonSpaceses', ['id' => $id, 'common_spaces_id' => $common_spaces_id]);
        } catch (\Exception $e) {
            Log::error('Get Edit Benefit error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    // Add putEditCommonSpace and common space from previous responses
    public function putEditCommonSpace(Request $request, string $id, string $common_spaces_id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }
                return redirect()->route('login')->with('error', 'Please log in to edit benefits.');
            }

            $homestay = HomeStay::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $homestay) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
                }
                return redirect()->back()->with('error', 'Homestay not found or you do not have access.');
            }

            $common_space = CommonSpace::where('id', $common_spaces_id)
                ->where('home_stay_id', $id)
                ->first();

            if (! $common_space) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Common Space not found'], 404);
                }
                return redirect()->back()->with('error', 'Common Space not found.');
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $common_space->update($validated);

            if ($request->ajax()) {
                return response()->json(['success' => 'Common Space updated successfully'], 200);
            }

            return redirect()->back()->with('success', 'Common Space updated successfully.');
        } catch (\Exception $e) {
            Log::error('Edit Common Space error: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Server error occurred'], 500);
            }
            return redirect()->back()->with('error', 'An error occurred while updating the Common Space.');
        }
    }

    /**
     * add a new common space
     */
    public function getAddNewCommonSpace(Request $request, string $id)
    {
        return view('pages.logged_seller.homestays.common-space.create', compact('id'));
    }

    /**
     * store new common space
     */
    public function postAddNewCommonSpace(Request $request, string $id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $data = $request->validate([
                'name' => 'required|string|max:255',
            ]);
            CommonSpace::create([
                'name'         => $data['name'],
                'home_stay_id' => $id,
            ]);
            Alert::success('Success', 'Common Space added successfully.');
            return redirect()->route('homestays.commonSpaceses', $id);
        } catch (\Throwable $th) {
            Log::error('DataTables error: ' . $th->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    // delete a common space
    public function deleteCommonSpace(Request $request, string $id, string $common_spaces_id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $homestay = HomeStay::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $homestay) {
                return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
            }

            $commonSpace = CommonSpace::where('id', $common_spaces_id)
                ->where('home_stay_id', $id)
                ->first();

            if (! $commonSpace) {
                return response()->json(['error' => 'Common Space not found'], 404);
            }

            $commonSpace->delete();

            return response()->json(['success' => 'Common Space deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Delete Common Space error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    /**
     * start safety & securities functions
     */
    // safety & securities list page
    public function safetySecurities(Request $request, string $id)
    {
        // Log::info("calling");
        if ($request->ajax()) {
            // Log::info("calling inside ajax");
            try {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                $query = SafetySecurity::where('home_stay_id', $id)
                    ->whereHas('homeStay', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });
                // Log::info("query data: ", ['query' => $query]);

                // Total records without filtering
                $totalRecords = $query->count();

                // Apply search (if any)
                if ($request->has('search') && $request->search['value']) {
                    $searchValue = $request->search['value'];
                    $query->where('name', 'like', "%{$searchValue}%");
                }

                $filteredRecords = $query->count();

                // Apply ordering
                if ($request->has('order')) {
                    $orderColumn = $request->order[0]['column']; // Index of column
                    $orderDir    = $request->order[0]['dir'];
                    $columns     = ['id', 'name']; // Map to your DB columns (skip index/edit/delete)
                    if (isset($columns[$orderColumn])) {
                        $query->orderBy($columns[$orderColumn], $orderDir);
                    }
                }

                // Pagination
                $start  = $request->get('start', 0);
                $length = $request->get('length', 10);
                $query->offset($start)->limit($length);

                $safetySecurity = $query->select(['id', 'name', 'home_stay_id'])->get();

                // Add DT_RowIndex and action columns (as in your original)
                $data = $safetySecurity->map(function ($row, $index) use ($start) {
                    $row->DT_RowIndex = $start + $index + 1;
                    $row->edit        = '<button type="button" class="btn btn-secondary btn-sm edit_btn" data-homestay-id="' . $row->home_stay_id . '" data-safety-security-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-pen-fancy"></i></button>';
                    $row->delete      = '<button type="button" class="btn btn-danger btn-sm delete-btn" data-homestay-id="' . $row->home_stay_id . '" data-safety-security-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    return $row;
                });

                return response()->json([
                    'recordsTotal'    => $totalRecords,
                    'recordsFiltered' => $filteredRecords,
                    'data'            => $data,
                ]);

            } catch (\Exception $e) {
                Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => 'Server error occurred'], 500);
            }
        }
        return view('pages.logged_seller.homestays.safety-security.index');
    }

    // get specific common space data for edit
    public function getEditSafetySecurity(Request $request, string $id, string $safety_security_id)
    {
        // Log::info('request: ', ['home_stay_id' => $id, 'safety_security_id' => $safety_security_id]);
        try {
            if ($request->ajax()) {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                // Validate homestay
                $homestay = HomeStay::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();

                if (! $homestay) {
                    Log::info("error", ['error' => 'Homestay not found or you do not have access']);
                    return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
                }
                // Log::info('homestay', ['homestay' => $homestay]);

                // Fetch safety_security
                $safety_security = SafetySecurity::where('id', $safety_security_id)
                    ->where('home_stay_id', $id)
                    ->with('homeStay')
                    ->select(['id', 'home_stay_id', 'name'])
                    ->first();

                if (! $safety_security) {
                    Log::info("error", ['error' => 'Safety & Security not found']);
                    return response()->json(['error' => 'Safety & Security not found'], 404);
                }

                // Log::info('Fetched safety_security', ['home_stay_id' => $id, 'safety_security_id' => $safety_security_id, "safety_security" => $safety_security]);

                return response()->json([
                    'success' => true,
                    'data'    => $safety_security,
                ], 200);
            }

            // Non-AJAX: Redirect to edit form (optional)
            return redirect()->route('homestays.commonSpaceses', ['id' => $id, 'safety_security_id' => $safety_security_id]);
        } catch (\Exception $e) {
            Log::error('Get Edit Benefit error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    // Add putEditSafetySecurity and Safety & Security from previous responses
    public function putEditSafetySecurity(Request $request, string $id, string $safety_security_id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }
                return redirect()->route('login')->with('error', 'Please log in to edit benefits.');
            }

            $homestay = HomeStay::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $homestay) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
                }
                return redirect()->back()->with('error', 'Homestay not found or you do not have access.');
            }

            $safety_security = SafetySecurity::where('id', $safety_security_id)
                ->where('home_stay_id', $id)
                ->first();

            if (! $safety_security) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Safety & Security not found'], 404);
                }
                return redirect()->back()->with('error', 'Safety & Security not found.');
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $safety_security->update($validated);

            if ($request->ajax()) {
                return response()->json(['success' => 'Safety & Security updated successfully'], 200);
            }

            return redirect()->back()->with('success', 'Safety & Security updated successfully.');
        } catch (\Exception $e) {
            Log::error('Edit Safety & Security error: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Server error occurred'], 500);
            }
            return redirect()->back()->with('error', 'An error occurred while updating the Safety & Security.');
        }
    }

    /**
     * add a new Safety & Security
     */
    public function getAddNewSafetySecurity(Request $request, string $id)
    {
        return view('pages.logged_seller.homestays.safety-security.create', compact('id'));
    }

    /**
     * store new Safety & Security
     */
    public function postAddNewSafetySecurity(Request $request, string $id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $data = $request->validate([
                'name' => 'required|string|max:255',
            ]);
            SafetySecurity::create([
                'name'         => $data['name'],
                'home_stay_id' => $id,
            ]);
            Alert::success('Success', 'Safety & Security added successfully.');
            return redirect()->route('homestays.safetySecurities', $id);
        } catch (\Throwable $th) {
            Log::error('DataTables error: ' . $th->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    // delete a Safety & Security
    public function deleteSafetySecurity(Request $request, string $id, string $safety_security_id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $homestay = HomeStay::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $homestay) {
                return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
            }

            $safetySecurity = SafetySecurity::where('id', $safety_security_id)
                ->where('home_stay_id', $id)
                ->first();

            if (! $safetySecurity) {
                return response()->json(['error' => 'Safety & Security not found'], 404);
            }

            $safetySecurity->delete();

            return response()->json(['success' => 'Safety & Security deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Delete Safety & Security error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    /**
     * start beddings functions
     */
    // bedding list page
    public function beddings(Request $request, string $id)
    {
        // Log::info("calling");
        if ($request->ajax()) {
            // Log::info("calling inside ajax");
            try {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                $query = Bedding::where('home_stay_id', $id)
                    ->whereHas('homeStay', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });
                // Log::info("query data: ", ['query' => $query]);

                // Total records without filtering
                $totalRecords = $query->count();

                // Apply search (if any)
                if ($request->has('search') && $request->search['value']) {
                    $searchValue = $request->search['value'];
                    $query->where('name', 'like', "%{$searchValue}%");
                }

                $filteredRecords = $query->count();

                // Apply ordering
                if ($request->has('order')) {
                    $orderColumn = $request->order[0]['column']; // Index of column
                    $orderDir    = $request->order[0]['dir'];
                    $columns     = ['id', 'name']; // Map to your DB columns (skip index/edit/delete)
                    if (isset($columns[$orderColumn])) {
                        $query->orderBy($columns[$orderColumn], $orderDir);
                    }
                }

                // Pagination
                $start  = $request->get('start', 0);
                $length = $request->get('length', 10);
                $query->offset($start)->limit($length);

                $beddings = $query->select(['id', 'name', 'home_stay_id'])->get();

                // Add DT_RowIndex and action columns (as in your original)
                $data = $beddings->map(function ($row, $index) use ($start) {
                    $row->DT_RowIndex = $start + $index + 1;
                    $row->edit        = '<button type="button" class="btn btn-secondary btn-sm edit_btn" data-homestay-id="' . $row->home_stay_id . '" data-bedding-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"><i class="fas fa-pen-fancy"></i></button>';
                    $row->delete      = '<button type="button" class="btn btn-danger btn-sm delete-btn" data-homestay-id="' . $row->home_stay_id . '" data-bedding-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    return $row;
                });

                return response()->json([
                    'recordsTotal'    => $totalRecords,
                    'recordsFiltered' => $filteredRecords,
                    'data'            => $data,
                ]);

            } catch (\Exception $e) {
                Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => 'Server error occurred'], 500);
            }
        }
        return view('pages.logged_seller.homestays.bedding.index');
    }

    // get specific bedding data for edit
    public function getEditBedding(Request $request, string $id, string $bedding_id)
    {
        // Log::info('request: ', ['home_stay_id' => $id, 'bedding_id' => $bedding_id]);
        try {
            if ($request->ajax()) {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                // Validate homestay
                $homestay = HomeStay::where('id', $id)
                    ->where('user_id', $user->id)
                    ->first();

                if (! $homestay) {
                    Log::info("error", ['error' => 'Homestay not found or you do not have access']);
                    return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
                }
                // Log::info('homestay', ['homestay' => $homestay]);

                // Fetch bedding
                $bedding = Bedding::where('id', $bedding_id)
                    ->where('home_stay_id', $id)
                    ->with('homeStay')
                    ->select(['id', 'home_stay_id', 'name'])
                    ->first();

                if (! $bedding) {
                    Log::info("error", ['error' => 'Safety & Security not found']);
                    return response()->json(['error' => 'Safety & Security not found'], 404);
                }

                // Log::info('Fetched bedding', ['home_stay_id' => $id, 'bedding_id' => $bedding_id, "bedding" => $bedding]);

                return response()->json([
                    'success' => true,
                    'data'    => $bedding,
                ], 200);
            }

            // Non-AJAX: Redirect to edit form (optional)
            return redirect()->route('homestays.beddings', ['id' => $id, 'bedding_id' => $bedding_id]);
        } catch (\Exception $e) {
            Log::error('Get Edit Benefit error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    // Add putEditBedding and bedding from previous responses
    public function putEditBedding(Request $request, string $id, string $bedding_id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }
                return redirect()->route('login')->with('error', 'Please log in to edit benefits.');
            }

            $homestay = HomeStay::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $homestay) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
                }
                return redirect()->back()->with('error', 'Homestay not found or you do not have access.');
            }

            $bedding = Bedding::where('id', $bedding_id)
                ->where('home_stay_id', $id)
                ->first();

            if (! $bedding) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Bedding not found'], 404);
                }
                return redirect()->back()->with('error', 'Bedding not found.');
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $bedding->update($validated);

            if ($request->ajax()) {
                return response()->json(['success' => 'Bedding updated successfully'], 200);
            }

            return redirect()->back()->with('success', 'Bedding updated successfully.');
        } catch (\Exception $e) {
            Log::error('Edit Bedding error: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Server error occurred'], 500);
            }
            return redirect()->back()->with('error', 'An error occurred while updating the Bedding.');
        }
    }

    /**
     * add a new bedding
     */
    public function getAddNewBedding(Request $request, string $id)
    {
        return view('pages.logged_seller.homestays.bedding.create', compact('id'));
    }

    /**
     * store new bedding
     */
    public function postAddNewBedding(Request $request, string $id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $data = $request->validate([
                'name' => 'required|string|max:255',
            ]);
            Bedding::create([
                'name'         => $data['name'],
                'home_stay_id' => $id,
            ]);
            Alert::success('Success', 'Bedding added successfully.');
            return redirect()->route('homestays.beddings', $id);
        } catch (\Throwable $th) {
            Log::error('DataTables error: ' . $th->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    // delete a bedding
    public function deleteBedding(Request $request, string $id, string $bedding_id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $homestay = HomeStay::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $homestay) {
                return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
            }

            $bedding = Bedding::where('id', $bedding_id)
                ->where('home_stay_id', $id)
                ->first();

            if (! $bedding) {
                return response()->json(['error' => 'Bedding not found'], 404);
            }

            $bedding->delete();

            return response()->json(['success' => 'Bedding deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Delete Bedding error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    /**
     * start images functions
     */
    // images list page
    public function images(Request $request, string $id)
    {
        // Log::info("calling");
        if ($request->ajax()) {
            // Log::info("calling inside ajax");
            try {
                $user = Auth::user();
                if (! $user) {
                    return response()->json(['error' => 'User not authenticated'], 401);
                }

                $query = HomeStayImages::where('home_stay_id', $id)
                    ->whereHas('homeStay', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });
                // Log::info("query data: ", ['query' => $query]);

                // Total records without filtering
                $totalRecords = $query->count();

                $filteredRecords = $query->count();

                // Apply ordering
                if ($request->has('order')) {
                    $orderColumn = $request->order[0]['column']; // Index of column
                    $orderDir    = $request->order[0]['dir'];
                    $columns     = ['id', 'image_path']; // Map to your DB columns (skip index/edit/delete)
                    if (isset($columns[$orderColumn])) {
                        $query->orderBy("id", "DESC");
                    }
                }

                // Pagination
                $start  = $request->get('start', 0);
                $length = $request->get('length', 10);
                $query->offset($start)->limit($length);

                $images = $query->select(['id', 'image_path', 'home_stay_id'])->get();

                // Add DT_RowIndex and action columns (as in your original)
                $data = $images->map(function ($row, $index) use ($start) {
                    $row->DT_RowIndex = $start + $index + 1;
                    $row->image       = '<img src="' . env('APP_URL') . "/storage/" . $row->image_path . '" alt="Image" style="width: 100px; height: 100px;" />';
                    $row->delete      = '<button type="button" class="btn btn-danger btn-sm delete-btn" data-homestay-id="' . $row->home_stay_id . '" data-image-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    return $row;
                });

                return response()->json([
                    'recordsTotal'    => $totalRecords,
                    'recordsFiltered' => $filteredRecords,
                    'data'            => $data,
                ]);

            } catch (\Exception $e) {
                Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => 'Server error occurred'], 500);
            }
        }
        return view('pages.logged_seller.homestays.image.index');
    }

    /**
     * add a new image
     */
    public function getAddNewImage(Request $request, string $id)
    {
        return view('pages.logged_seller.homestays.image.create', compact('id'));
    }

    /**
     * store new image
     */
    public function postAddNewImage(Request $request, string $id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $data = $request->validate([
                'image' => 'required|image|max:800',
            ]);
            $roomImagePath = $request->file('image')->store('homestays/images', 'public');
            HomeStayImages::create([
                'image_path'   => $roomImagePath,
                'home_stay_id' => $id,
            ]);
            Alert::success('Success', 'Image added successfully.');
            return redirect()->route('homestays.images', $id);
        } catch (\Throwable $th) {
            Log::error('DataTables error: ' . $th->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    // delete a image
    public function deleteImage(Request $request, string $id, string $image_id)
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $homestay = HomeStay::where('id', $id)
                ->where('user_id', $user->id)
                ->first();

            if (! $homestay) {
                return response()->json(['error' => 'Homestay not found or you do not have access'], 404);
            }

            $image = HomeStayImages::where('id', $image_id)
                ->where('home_stay_id', $id)
                ->first();

            if (! $image) {
                return response()->json(['error' => 'Image not found'], 404);
            }

            $image->delete();

            return response()->json(['success' => 'Image deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Delete Image error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }
}
