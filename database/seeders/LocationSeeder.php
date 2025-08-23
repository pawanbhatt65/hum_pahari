<?php
namespace Database\Seeders;

use App\Models\District;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // Seed States
            $statesPath = storage_path('app/public/location_assets/states.json');
            if (! file_exists($statesPath)) {
                throw new \Exception("File not found: $statesPath");
            }
            $statesData = json_decode(file_get_contents($statesPath), true)['records'];
            $states     = [];
            foreach ($statesData as $state) {
                $states[$state['state_code']] = State::firstOrCreate(
                    ['code' => $state['state_code']],
                    ['name' => $state['state_name_english']]
                );
            }

            // Seed Districts
            $districtsPath = storage_path('app/public/location_assets/districts.json');
            if (! file_exists($districtsPath)) {
                throw new \Exception("File not found: $districtsPath");
            }
            $districtsData = json_decode(file_get_contents($districtsPath), true)['records'];
            foreach ($districtsData as $district) {
                $state = $states[$district['state_code']] ?? null;
                if ($state) {
                    District::firstOrCreate(
                        ['state_id' => $state->id, 'name' => $district['district_name_english']]
                    );
                } else {
                    Log::warning("State not found for district: {$district['district_name_english']} (state_code: {$district['state_code']})");
                }
            }
        } catch (\Exception $e) {
            Log::error("Seeder error: {$e->getMessage()}");
            throw $e;
        }
    }
}
