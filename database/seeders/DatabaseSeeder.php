<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\Attendance;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Attendance::factory(20)->create();

        User::factory()->create([
            'name' => 'Tri Kusuma Atmaja',
            'email' => 'trie168@gmail.com',
            'password' => Hash::make('123456')
        ]);

        Company::create([
            'name' => 'PT. XYZ',
            'email' => 'admin@xyz.id',
            'address' => 'Jl. Jendral Sudirman No. 1',
            'latitude' => '-6.2087634',
            'longitude' => '106.845599',
            'radius_km' => '0.5',
            'phone' => '081234567890',
            'tlp' => '0211234567', // 'phone' => '081234567890', 'tlp' => '0211234567
            'time_in' => '09:00',
            'time_out' => '17:00',
        ]);


    }
}
