<?php
namespace Database\Seeders;

use App\Models\UserRegister;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // HOW MANY BOOKINGS YOU WANT TO GENERATE
        $totalRecords = 300;

        for ($i = 0; $i < $totalRecords; $i++) {

            // Generate check-in date (today + 0 to 10 days)
            $checkIn = Carbon::now()->addDays(rand(0, 10))->startOfDay();

            // Checkout = check-in + 1 to 4 days
            $checkOut = (clone $checkIn)->addDays(rand(1, 4));

            UserRegister::create([
                'name'           => $faker->name,
                'phone'          => $faker->numerify('##########'), // 10-digit phone
                'email'          => $faker->unique()->safeEmail,
                'check_in_time'  => $checkIn->format('Y-m-d'),
                'check_out_time' => $checkOut->format('Y-m-d'),
                'address'        => $faker->address,
                'home_stay_id'   => rand(1, 151), // homestay id range
            ]);
        }
    }
}
