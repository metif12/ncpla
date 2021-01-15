<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([

            'name' => 'مهدی رمضان زاده',
            'email' => 'metif12@gmail.com',
            'mobile' => '09140041352',
            'national_code' => '1240070748',
            'password' => Hash::make('password'),
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
