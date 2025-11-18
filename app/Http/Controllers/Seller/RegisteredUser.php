<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class RegisteredUser extends Controller
{
    /**
     * Display a listing of the registered users.
     */
    public function index(Request $request)
    {
        // If not AJAX, return the view (seller page)
        if (! $request->ajax()) {
            return view('pages.logged_seller.registeredUsers.index');
        }

        try {
            $user = Auth::user();
            if (! $user) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $query = UserRegister::with('homestays') // ensure relation name is homeStay
                ->whereHas('homestays', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->select(['id', 'name', 'phone', 'email', 'check_in_time', 'check_out_time', 'address', 'home_stay_id']);

            $data = DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('show', function ($row) {
                    // Show button should link to the homestay show route (not the booking id)
                    $homestayId = $row->home_stay_id;
                    $btn        = '<button class="btn btn-default show-btn" data-id="' . e($homestayId) . '" onclick="showHomeStayFunction(this)"><i class="fas fa-eye"></i></button>';
                    return $btn;
                })
                ->rawColumns(['show'])
                ->make(true);

            return $data;
        } catch (\Exception $e) {
            Log::error('DataTables error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    /**
     * Show the form for creating a new registered users.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created registered users in storage.
     */
    public function store(Request $request)
    {
        #
    }

    /**
     * Display the specified registered users.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified registered users.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified registered users in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified registered users from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
