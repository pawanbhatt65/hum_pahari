<?php
namespace App\Http\Controllers;

use App\Models\District;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function getStates(Request $request)
    {
        Log::info(['states' => $request->all()]);
        return Cache::remember('states', 3600, fn() => State::all());
    }

    public function getDistricts($stateId)
    {
        return Cache::remember("districts_{$stateId}", 3600, fn() => District::where('state_id', $stateId)->get());
    }
}
