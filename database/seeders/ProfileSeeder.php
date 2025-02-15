<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $profiles = [
            [
                'user_id' => 1,
                'phone_number' => '123-456-7890',
                'address' => '123 Main St',
                'profile_picture' => 'default.jpg',
                'date_of_birth' => '1990-01-01',
                'institution' => 'Example University',
                'bio' => 'Student at Example University',
            ],
            [
                'user_id' => 2,
                'phone_number' => '987-654-3210',
                'address' => '456 Elm St',
                'profile_picture' => 'default.jpg',
                'date_of_birth' => '1985-05-15',
                'institution' => 'Example College',
                'bio' => 'Lecturer specializing in Computer Science',
            ],
            [
                'user_id' => 3,
                'phone_number' => '555-555-5555',
                'address' => '789 Oak St',
                'profile_picture' => 'default.jpg',
                'date_of_birth' => '1980-08-25',
                'institution' => 'Admin Institute',
                'bio' => 'Administrator of the system',
            ],
            [
                'user_id' => 4,
                'phone_number' => '000-000-0000',
                'address' => '999 Birch St',
                'profile_picture' => 'default.jpg',
                'date_of_birth' => '1975-12-12',
                'institution' => 'System Management',
                'bio' => 'Super Admin with full control',
            ],
        ];

        foreach ($profiles as $profile) {
            Profile::create($profile);
        }
    }
}
