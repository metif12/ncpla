<?php

namespace Database\Seeders;

use App\Models\Line;
use App\Models\LineAttributes;
use App\Models\Material;
use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Shift;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Junges\ACL\Http\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->makePermissions('مدیرکل', 'admin', 'دسترسی کامل به تمام سیستم');

//        $this->makePermissions('مدیرکل','admin','دسترسی کامل به تمام سیستم');
//        $this->makePermissions('مدیرکل','admin','دسترسی کامل به تمام سیستم');


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

        $shift1 = Shift::query()
            ->create([

                'start' => '06:00',
                'end' => '13:45',

                'code' => generateCode(),
            ]);

        $shift2 = Shift::query()
            ->create([

                'start' => '14:00',
                'end' => '23:45',

                'code' => generateCode(),
            ]);

        $shift3 = Shift::query()
            ->create([

                'start' => '00:00',
                'end' => '5:45',

                'code' => generateCode(),
            ]);

        $user = User::query()->create([

            'name' => 'مهدی رمضان زاده',
            'email' => 'metif12@gmail.com',
            'mobile' => '09140041352',
            'national_code' => '1240070748',
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
            'activated_at' => now(),
            'password' => Hash::make('password'),

            'shift_id' => $shift1->id,
        ]);

        $user->assignPermissions('admin');

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

        $line1->materials()->sync([$material1->id, $material2->id]);

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

        DB::table('line_users')
            ->insert([

                'user_id' => $user->id,
                'line_id' => $line1->id,

                'created_at' => now(),
                'updated_at' => now(),
            ]);

        DB::table('line_users')
            ->insert([

                'user_id' => $user->id,
                'line_id' => $line2->id,

                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $task1 = Task::query()
            ->create([

                'line_id' => $line1->id,
                'code' => generateCode(),
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

    protected function makePermissions($name, $slug, $desc)
    {
        return Permission::query()->updateOrCreate(
            [
                'slug' => $slug,
            ],
            [
                'name' => $name,
                'description' => $desc,
            ]
        );
    }
}
