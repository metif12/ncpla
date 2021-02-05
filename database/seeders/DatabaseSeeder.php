<?php

namespace Database\Seeders;

use App\Models\Line;
use App\Models\LineInputs;
use App\Models\LineMaterials;
use App\Models\LineOutputs;
use App\Models\Material;
use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\Product;
use App\Models\ProductAttribute;
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

        $material1 = Material::query()->create([

            'name' => 'مس',
            'unit' => 'کیلوگرم',
            'code' => strtoupper(dechex(time())),
        ]);

        $material2 = Material::query()->create([

            'name' => 'پلیمر',
            'unit' => 'کیلوگرم',
            'code' => strtoupper(dechex(time())),
        ]);

        $material3 = Material::query()->create([

            'name' => 'قرقره',
            'unit' => 'عدد',
            'code' => strtoupper(dechex(time())),
        ]);

        $product = Product::query()->create([

            'name' => 'کابل شبکه UTP',
            'code' => strtoupper(dechex(time())),
        ]);

        ProductAttribute::query()->create([

            'product_id' => $product->id,
            'name' => 'طول',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        $line = Line::query()->create([

            'name' => 'خط یک',
            'code' => strtoupper(dechex(time())),
        ]);

        LineMaterials::query()->create([

            'line_id' => $line->id,
            'material_id' => $material1->id,
        ]);

        LineMaterials::query()->create([

            'line_id' => $line->id,
            'material_id' => $material2->id,
        ]);

        LineOutputs::query()->create([

            'line_id' => $line->id,
            'product_id' => $product->id,
        ]);

//        LineInputs::query()->create([
//
//            'line_id' => $line->id,
//            'product_id' => $product->id,
//        ]);

        $order = Order::query()->create([

            'product_id' => $product->id,
            'line_id' => $line->id,
            'code' => strtoupper(dechex(time())),
        ]);

        OrderAttribute::query()->create([

            'order_id' => $order->id,
            'name' => 'طول',
            'type' => 'number',
            'value' => 250,
            'product_id' => $product->id,
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
