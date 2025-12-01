<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Avoid duplicate seeding
        $email = 'admin@example.com';

        $admin = Admin::firstWhere('email', $email);
        if (! $admin) {
            Admin::create([
                'name' => 'Super Admin',
                'email' => $email,
                'password' => Hash::make('Admin@1234'), // choose a secure password
            ]);
        } else {
            // ensure password is hashed (optional)
            if (! \Illuminate\Support\Str::startsWith($admin->password, '$2y$')) {
                $admin->password = Hash::make('Admin@1234');
                $admin->save();
            }
        }
    }
}
