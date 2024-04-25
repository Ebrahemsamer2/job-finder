<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(50)->create();

        User::factory()->create([
            'user_type' => 'employer',
            'avatar' => 'assets/img/user/google.png',
        ]);
        User::factory()->create([
            'user_type' => 'employer',
            'avatar' => 'assets/img/user/amazon.png',
        ]);
        User::factory()->create([
            'user_type' => 'employer',
            'avatar' => 'assets/img/user/booking.png',
        ]);
        User::factory()->create([
            'user_type' => 'employer',
            'avatar' => 'assets/img/user/microsoft.png',
        ]);
        User::factory()->create([
            'user_type' => 'admin'
        ]);
    }
}
