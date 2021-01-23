<?php

namespace Database\Seeders;

use App\Models\Material;
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

        Material::query()->create([

            'name' => 'مس',
            'unit' => 'کیلوگرم',
            'code' => strtoupper(dechex(time())),
        ]);

        Material::query()->create([

            'name' => 'پلیمر',
            'unit' => 'کیلوگرم',
            'code' => strtoupper(dechex(time())),
        ]);

        Material::query()->create([

            'name' => 'قرقره',
            'unit' => 'عدد',
            'code' => strtoupper(dechex(time())),
        ]);


        // \App\Models\User::factory(10)->create();
    }
}
