<?php

namespace Database\Seeders;

use App\Models\Interrupt;
use App\Models\Line;
use App\Models\LineAttributes;
use App\Models\Material;
use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Shift;
use App\Models\Task;
use App\Models\TaskAttribute;
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
            'code' => 'm1',
        ]);

        $material2 = Material::query()->create([

            'name' => 'PVC',
            'unit' => 'کیلوگرم',
            'code' => 'm2',
        ]);

        $material3 = Material::query()->create([

            'name' => 'LSZH',
            'unit' => 'کیلوگرم',
            'code' => 'm3',
        ]);

        $material4 = Material::query()->create([

            'name' => 'PE',
            'unit' => 'کیلوگرم',
            'code' => 'm4',
        ]);

        $material5 = Material::query()->create([

            'name' => 'نوار پلی استر 45 میکرون',
            'unit' => 'کیلوگرم',
            'code' => 'm5',
        ]);

        $material6 = Material::query()->create([

            'name' => 'فویل آلومینیومی 75 میکرون',
            'unit' => 'کیلوگرم',
            'code' => 'm6',
        ]);

        $material7 = Material::query()->create([

            'name' => 'مفتول آلومینیومی 0.13',
            'unit' => 'کیلوگرم',
            'code' => 'm7',
        ]);

        $shift1 = Shift::query()
            ->create([

                'start' => '06:00',
                'end' => '13:45',

                'code' => 101,
            ]);

        $shift2 = Shift::query()
            ->create([

                'start' => '14:00',
                'end' => '23:45',

                'code' => 102,
            ]);

        $shift3 = Shift::query()
            ->create([

                'start' => '00:00',
                'end' => '5:45',

                'code' => 103,
            ]);

        $interrupt1 = Interrupt::query()
            ->create([
                'name' => 'مکانیکی',
                'code' => 'i1',
            ]);
        $interrupt2 = Interrupt::query()
            ->create([
                'name' => 'کیفیتی',
                'code' => 'i2',
            ]);
        $interrupt3 = Interrupt::query()
            ->create([
                'name' => 'برقی',
                'code' => 'i3',
            ]);
        $interrupt4 = Interrupt::query()
            ->create([
                'name' => 'تولیدی',
                'code' => 'i4',
            ]);
        $interrupt5 = Interrupt::query()
            ->create([
                'name' => 'کمبود قرقره',
                'code' => 'i5',
            ]);
        $interrupt6 = Interrupt::query()
            ->create([
                'name' => 'کمبود نیرو',
                'code' => 'i6',
            ]);
        $interrupt7 = Interrupt::query()
            ->create([
                'name' => 'کمبود مواد اولیه',
                'code' => 'i7',
            ]);
        $interrupt8 = Interrupt::query()
            ->create([
                'name' => 'نبود برنامه',
                'code' => 'i8',
            ]);

        $user1 = User::query()->create([

            'name' => 'مهدی رمضان زاده',
            'email' => 'metif12@gmail.com',
            'mobile' => '09140041352',
            'national_code' => '1240070748',
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
            'activated_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $user1->assignPermissions('admin');

        $user2 = User::query()->create([

            'name' => 'سید مجتبی صباغ جعفری',
            'email' => 'mojtaba.sabbagh@vru.ac.ir',
            'mobile' => '09133913037',
            'national_code' => '1240070749',
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
            'activated_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $user2->assignPermissions('admin');

        $product1 = Product::query()->create([

            'name' => 'Cat6/UTP',
            'code' => 'cat61',
        ]);

        $product2 = Product::query()->create([

            'name' => 'Cat6/FTP',
            'code' => 'cat62',
        ]);

        $product2 = Product::query()->create([

            'name' => 'Cat6/SFTP',
            'code' => 'cat63',
        ]);

        //todo

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
            'progress_attribute' => 'طول',
            'code' => generateCode(),

            'product_id' => $product1->id,
        ]);

        $line1->materials()->sync([$material1->id, $material2->id]);

        $line2 = Line::query()->create([

            'name' => 'خط STP',
            'progress_attribute' => 'طول',
            'code' => generateCode(),

            'product_id' => $product2->id,
        ]);

        $line2->inputs()->sync([$product1->id]);

        LineAttributes::query()->create([

            'line_id' => $line1->id,
            'name' => 'طول',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

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

                'user_id' => $user1->id,
                'line_id' => $line1->id,

                'created_at' => now(),
                'updated_at' => now(),
            ]);

        DB::table('line_users')
            ->insert([

                'user_id' => $user1->id,
                'line_id' => $line2->id,

                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $task1 = Task::query()
            ->create([

                'line_id' => $line1->id,
                'code' => generateCode(),
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task1->id,
                'line_id' => $line1->id,

                'name' => 'طول',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '250',
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
