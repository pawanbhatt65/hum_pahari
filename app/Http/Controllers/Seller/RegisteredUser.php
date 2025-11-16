<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\HomeStay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Contracts\DataTable;

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

                $homestays = HomeStay::where('user_id', $user->id)
                    ->select(['id', 'name', 'city', 'is_approved']);

                $data = DataTable::of($homestays)
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
        //
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
