<?php

namespace Database\Seeders;

use App\Models\Line;
use App\Models\LineAttributes;
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
            'code' => generateCode(),
        ]);

        $material2 = Material::query()->create([

            'name' => 'پلیمر',
            'unit' => 'کیلوگرم',
            'code' => generateCode(),
        ]);

        $material3 = Material::query()->create([

            'name' => 'قرقره',
            'unit' => 'عدد',
            'code' => generateCode(),
        ]);

        $product1 = Product::query()->create([

            'name' => 'کابل شبکه UTP',
            'code' => generateCode(),
        ]);

        $product2 = Product::query()->create([

            'name' => 'کابل شبکه STP',
            'code' => generateCode(),
        ]);

        ProductAttribute::query()->create([

            'product_id' => $product1->id,
            'name' => 'stamp',
            'type' => 'text',
            'merge_type' => 'skip',
            'unit' => '',
            'default' => '',
        ]);

        ProductAttribute::query()->create([

            'product_id' => $product2->id,
            'name' => 'stamp',
            'type' => 'text',
            'merge_type' => 'skip',
            'unit' => '',
            'default' => '',
        ]);

        $line1 = Line::query()->create([

            'name' => 'خط UTP',
            'code' => generateCode(),

            'product_id' => $product1->id,
        ]);

        $line1->materials()->sync([$material1->id,$material2->id]);

        $line2 = Line::query()->create([

            'name' => 'خط STP',
            'code' => generateCode(),

            'product_id' => $product2->id,
        ]);

        $line2->inputs()->sync([$product1->id]);

        LineAttributes::query()->create([

            'line_id' => $line2->id,
            'name' => 'طول',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        $order1 = Order::query()->create([

            'product_id' => $product1->id,
            'line_id' => $line1->id,
            'code' => generateCode(),
        ]);

        $order2 = Order::query()->create([

            'product_id' => $product2->id,
            'line_id' => $line2->id,
            'code' => generateCode(),
        ]);

        OrderAttribute::query()->create([

            'order_id' => $order1->id,
            'name' => 'stamp',
            'type' => 'text',
            'merge_type' => 'skip',
            'value' => 'MY AMAZING UTP CABLE',
        ]);

        OrderAttribute::query()->create([

            'order_id' => $order2->id,
            'name' => 'stamp',
            'type' => 'text',
            'merge_type' => 'skip',
            'value' => 'MY AWESOME STP CABLE',
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
