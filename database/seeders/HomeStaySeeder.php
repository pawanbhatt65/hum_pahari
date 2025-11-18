<?php
namespace Database\Seeders;

use App\Models\Bedding;
use App\Models\Benefit;
use App\Models\CommonSpace;
use App\Models\HomeStay;
use App\Models\HomeStayImages;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HomeStaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Configurable: how many homestays to create
        $homestayCount = 150;

        // Fixed values requested by you
        $stateId     = 39;
        $districtIds = [452, 453, 454, 455, 456, 457];
        $cityName    = 'uttarakhand city';

        // Example lists for bedding/benefits/common spaces (expand as needed)
        $beddingOptions = [
            'Blanket', 'Bed', 'Pillow', 'Bedsheet', 'Extra Mattress', 'Bolster',
        ];

        $benefitOptions = [
            'Newspaper', 'Swimming Pool', 'Free Parking', 'WiFi', 'Breakfast Included', 'Laundry Service',
        ];

        $commonSpaceOptions = [
            'Balcony', 'Roof Terrace', 'Lobby', 'Garden', 'Shared Kitchen', 'Common Lounge',
        ];

        // Image base: using picsum as placeholder. Replace with real image URLs if you want.
        $imageBase = 'https://picsum.photos/seed/';

        for ($i = 0; $i < $homestayCount; $i++) {
            $roomType    = $faker->randomElement(['Standard', 'Delux']);
            $bedroomType = $faker->randomElement(['Single Bedroom', 'Double Bedroom', 'Both']);
            $noSingle    = $faker->numberBetween(1, 10);
            $noDouble    = $faker->numberBetween(1, 10);
            $foodAllowed = $faker->randomElement(['yes', 'no']);

            $homestay = HomeStay::create([
                                               
                'user_id'                => 1, // change as needed
                'name'                   => ucfirst($faker->words(3, true)) . ' Homestay',
                'room_type'              => $roomType,
                'bedroom_type'           => $bedroomType,
                'number_of_rooms'        => $noSingle + $noDouble,
                'number_of_single_rooms' => $noSingle,
                'number_of_double_rooms' => $noDouble,
                'food_allowed'           => $foodAllowed,
                'note'                   => $faker->optional()->sentence(),
                'state_id'               => $stateId,
                'district_id'            => $faker->randomElement($districtIds),
                'city'                   => $cityName,
                'address'                => $faker->address,
                'pincode'                => $faker->numberBetween(100000, 999999),
                'number_of_adults'       => $faker->numberBetween(1, 6),
                'number_of_children'     => $faker->numberBetween(0, 4),
                'check_in_time'          => now()->format('Y-m-d H:i:s'),
                'check_out_time'         => now()->addDays(1)->format('Y-m-d H:i:s'),
                'area'                   => $faker->randomElement(['Downtown', 'Uptown', 'Suburb']),
                'guest'                  => $faker->numberBetween(1, 6),
                'mountain_view'          => $faker->randomElement(['yes', 'no']),
                // room_image could be the first image path or a default
                'room_image'             => $imageBase . Str::slug($faker->word) . '/800/600',
                'upto_3days_prior'       => $faker->randomElement(['50%', '75%', '100%']),
                'upto_2days_prior'       => $faker->randomElement(['50%', '75%', '100%']),
                '1day_prior'             => $faker->randomElement(['50%', '75%', '100%']),
                'same_day_cancellation'  => $faker->randomElement(['0%', '50%', '100%']),
                'no_show'                => $faker->randomElement(['0%', '50%', '100%']),
                'location'               => $faker->city,
                'price'                  => $faker->numberBetween(800, 5000),
                'is_approved'            => $faker->boolean(70), // 70% chance approved
            ]);

            // Bedding: create 1-4 different bedding items
            $beddingCount = $faker->numberBetween(1, 4);
            $beddingPool  = $faker->randomElements($beddingOptions, $beddingCount);
            foreach ($beddingPool as $bedName) {
                Bedding::create([
                    'name'         => $bedName,
                    'home_stay_id' => $homestay->id,
                ]);
            }

            // Benefits: create 1-4 benefits
            $benefitCount = $faker->numberBetween(1, 4);
            $benefitPool  = $faker->randomElements($benefitOptions, $benefitCount);
            foreach ($benefitPool as $bn) {
                Benefit::create([
                    'name'         => $bn,
                    'home_stay_id' => $homestay->id,
                ]);
            }

            // Common Spaces: create 1-3
            $commonCount = $faker->numberBetween(1, 3);
            $commonPool  = $faker->randomElements($commonSpaceOptions, $commonCount);
            foreach ($commonPool as $cs) {
                CommonSpace::create([
                    'name'         => $cs,
                    'home_stay_id' => $homestay->id,
                ]);
            }

            // Images: create 1-10 images (placeholder URLs)
            $imagesCount = $faker->numberBetween(1, 10);
            for ($img = 0; $img < $imagesCount; $img++) {
                $seed   = urlencode($homestay->id . '-' . $img . '-' . $faker->word);
                $imgUrl = $imageBase . $seed . '/800/600';
                HomeStayImages::create([
                    'image_path'   => $imgUrl,
                    'home_stay_id' => $homestay->id,
                ]);
            }
        } // end for
    }
}
