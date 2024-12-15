<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'title' => 'Mr.',
            'surname' => 'Admin',
            'firstname' => 'Super',
            'email' => 'admin@coop8692.com',
            'phone_number' => '08012345678',
            'password' => Hash::make('password'),
            'member_no' => 'COOP00001',
            'is_admin' => true,
            'is_approved' => true,
            'state_id' => 1,
            'lga_id' => 1,
        ]);
    }
}
