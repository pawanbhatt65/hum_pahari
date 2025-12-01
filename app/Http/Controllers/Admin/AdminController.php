<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeStay;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    // dashboard view
    public function dashboard(Request $request)
    {
        return view('backend.pages.dashboard');
    }

    // registered sellers view
    public function registeredSeller(Request $request)
    {
        return view('backend.pages.sellers.index');
    }

    // homestay list data
    public function sellersList(Request $request)
    {
        if ($request->ajax()) {
            try {
                $users = User::select(['id', 'name', 'mobile', 'email']);

                $data = DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('show', function ($row) {
                        $btn = '<a href="' . route('admin.sellers.show', $row->id) . '" class="btn btn-default show-btn"><i class="fas fa-eye"></i></a>';
                        return $btn;
                    })
                    ->addColumn('delete', function ($row) {
                        return '<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                    })
                    ->rawColumns(['show', 'delete'])
                    ->make(true);

                // Log::info("data", ['datatable' => $data]);
                return $data;
            } catch (\Exception $e) {
                Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => 'Server error occurred'], 500);
            }
        }

        return view('backend.pages.sellers.index');
    }

    // seller details view
    public function sellerShow($id)
    {
        $seller = User::findOrFail($id);
        return view('backend.pages.sellers.show', compact('seller'));
    }

    // seller details list data for view
    public function sellerShowList(Request $request, $id)
    {
        if (! $request->ajax()) {
            return response()->json(['error' => 'Bad request'], 400);
        }

        try {
            // Validate seller exists
            $seller = User::findOrFail($id);

            // Query homestays owned by this seller (use query builder so DataTables can paginate/sort/search)
            $query = HomeStay::query()
                ->where('user_id', $seller->id)
                ->orderBy('id', 'DESC')
                ->with(['state', 'district']);

            // Use DataTables on the query (Eloquent builder)
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', fn($row) => $row->name)
                ->addColumn('mobile', fn($row) => optional($seller)->mobile ?? '-') // if you want to show seller mobile
                ->addColumn('email', fn($row) => optional($seller)->email ?? '-')
                ->addColumn('stateName', fn($row) => $row->state->name)
                ->addColumn('districtName', fn($row) => $row->district->name)
                ->addColumn('price', fn($row) => $row->price)
                ->addColumn('show', function ($row) use ($seller) {
                    // show homestay by id
                    $btn = '<a href="' . route('admin.homestay.show', ['seller_id' => $seller->id, 'homestay_id' => $row->id]) . '" class="btn btn-default show-btn"><i class="fas fa-eye"></i></a>';
                    return $btn;
                })
                ->addColumn('delete', function ($row) use ($seller) {
                    return '<button type="button" class="btn btn-danger btn-sm delete-btn" data-seller_id="' . $seller->id . '" data-homestay_id="' . $row->id . '"><i class="fas fa-trash"></i></button>';
                })
                ->rawColumns(['show', 'delete'])
                ->make(true);

        } catch (\Exception $e) {
            Log::error('DataTables error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error occurred'], 500);
        }
    }

    // delete seller
    public function sellerDelete(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => true, 'message' => 'Seller deleted successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete Seller'], 500);
        }
    }

    // show home-stay details
    public function sellerShowHomeStay(Request $request, string $seller_id, string $homestay_id)
    {
        $homestay = HomeStay::findOrFail($homestay_id);
        $seller   = User::findOrFail($seller_id);

        return view('backend.pages.sellers.homestay_show', compact('homestay', 'seller'));
    }

    // homestay delete
    public function sellerDeleteHomeStay(Request $request, string $seller_id, string $homestay_id)
    {
        try {
            $homestay = HomeStay::findOrFail($homestay_id);
            $homestay->delete();
            // Alert::success('Success', 'Homestay deleted successfully.', 4000);
            return response()->json(['success' => true, 'message' => 'Homestay deleted successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete homestay'], 500);
        }
    }

// admin logout
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
