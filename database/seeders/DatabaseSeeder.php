<?php

namespace Database\Seeders;

use App\Models\Interrupt;
use App\Models\Line;
use App\Models\LineAttributes;
use App\Models\Material;
use App\Models\MaterialAttribute;
use App\Models\Order;
use App\Models\OrderAttribute;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Shift;
use App\Models\Task;
use App\Models\TaskAttribute;
use App\Models\TaskMaterial;
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


//        $material1 = Material::query()->create([
//
//            'name' => 'مس',
//            'unit' => 'کیلوگرم',
//            'code' => 'm1',
//        ]);

        $pvc = Material::query()->create([

            'name' => 'PVC',
            'unit' => 'کیلوگرم',
            'code' => 'm2',
        ]);

        $pvcAttr = MaterialAttribute::query()->create([

            'material_id' => $pvc->id,

            'name' => 'color',
            'type' => 'text',
            'unit' => '',
            'default' => 'white',
            'merge_type' => 'merge',
        ]);

        $lszh = Material::query()->create([

            'name' => 'LSZH',
            'unit' => 'کیلوگرم',
            'code' => 'm3',
        ]);

        $pe = Material::query()->create([

            'name' => 'PE',
            'unit' => 'کیلوگرم',
            'code' => 'm4',
        ]);

        $polyEster = Material::query()->create([

            'name' => 'نوار پلی استر',
            'unit' => 'کیلوگرم',
            'code' => 'm5',
        ]);

        $polyEsterAttr = MaterialAttribute::query()->create([

            'material_id' => $polyEster->id,

            'name' => 'قطر',
            'type' => 'text',
            'unit' => '',
            'default' => '45e-6',
            'merge_type' => 'merge',
        ]);

        $aluminumFoil = Material::query()->create([

            'name' => 'فویل آلومینیومی',
            'unit' => 'کیلوگرم',
            'code' => 'm6',
        ]);

        $aluminumFoilAttr = MaterialAttribute::query()->create([

            'material_id' => $aluminumFoil->id,

            'name' => 'قطر',
            'type' => 'text',
            'unit' => '',
            'default' => '75e-6',
            'merge_type' => 'merge',
        ]);

        $aluminumMaftol = Material::query()->create([

            'name' => 'مفتول آلومینیومی',
            'unit' => 'کیلوگرم',
            'code' => 'm7',
        ]);

        $aluminumMaftolAttr = MaterialAttribute::query()->create([

            'material_id' => $aluminumMaftol->id,

            'name' => 'قطر',
            'type' => 'text',
            'unit' => '',
            'default' => '13e-1',
            'merge_type' => 'merge',
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

        $metif12 = User::query()->create([

            'name' => 'مهدی رمضان زاده',
            'email' => 'metif12@gmail.com',
            'mobile' => '09140041352',
            'national_code' => '1240070748',
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
            'activated_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $metif12->assignPermissions('admin');

        $doctor = User::query()->create([

            'name' => 'سید مجتبی صباغ جعفری',
            'email' => 'mojtaba.sabbagh@vru.ac.ir',
            'mobile' => '09133913037',
            'national_code' => '1240070749',
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
            'activated_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $doctor->assignPermissions('admin');

        $utp = Product::query()->create([

            'name' => 'Cat6/UTP',
            'code' => 'cat61',
        ]);

        $ftp = Product::query()->create([

            'name' => 'Cat6/FTP',
            'code' => 'cat62',
        ]);

        $sftp = Product::query()->create([

            'name' => 'Cat6/SFTP',
            'code' => 'cat63',
        ]);

        $cable = Product::query()->create([

            'name' => 'cable',
            'code' => 'cable',
        ]);

        $twisted_pair = Product::query()->create([

            'name' => 'twisted-pair',
            'code' => 'twisted-pair',
        ]);

        $quad_pair = Product::query()->create([

            'name' => 'quad-pair',
            'code' => 'quad-pair',
        ]);

        $shielded_cable = Product::query()->create([

            'name' => 'shielded-cable',
            'code' => 'shielded-cable',
        ]);

        ProductAttribute::query()->create([

            'product_id' => $cable->id,
            'name' => 'color',
            'type' => 'text',
            'merge_type' => 'skip',
            'unit' => '',
            'default' => '',
        ]);

        ProductAttribute::query()->create([

            'product_id' => $utp->id,
            'name' => 'stamp',
            'type' => 'text',
            'merge_type' => 'skip',
            'unit' => '',
            'default' => '',
        ]);

        ProductAttribute::query()->create([

            'product_id' => $utp->id,
            'name' => 'color',
            'type' => 'text',
            'merge_type' => 'skip',
            'unit' => '',
            'default' => '',
        ]);

        ProductAttribute::query()->create([

            'product_id' => $sftp->id,
            'name' => 'stamp',
            'type' => 'text',
            'merge_type' => 'skip',
            'unit' => '',
            'default' => '',
        ]);

        ProductAttribute::query()->create([

            'product_id' => $sftp->id,
            'name' => 'color',
            'type' => 'text',
            'merge_type' => 'skip',
            'unit' => '',
            'default' => '',
        ]);

        ProductAttribute::query()->create([

            'product_id' => $ftp->id,
            'name' => 'stamp',
            'type' => 'text',
            'merge_type' => 'skip',
            'unit' => '',
            'default' => '',
        ]);

        ProductAttribute::query()->create([

            'product_id' => $ftp->id,
            'name' => 'color',
            'type' => 'text',
            'merge_type' => 'skip',
            'unit' => '',
            'default' => '',
        ]);

        $line1 = Line::query()->create([

            'name' => 'خط عایق کننده',
            'progress_attribute' => 'طول کلی',
            'code' => 'line1',

            'product_id' => $cable->id,
        ]);

        $line1->materials()->sync([$aluminumMaftol->id, $pvc->id]);

        LineAttributes::query()->create([

            'line_id' => $line1->id,
            'name' => 'طول کلی',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line1->id,
            'name' => 'طول هر قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line1->id,
            'name' => 'تعداد قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'عدد',
            'default' => '100',
        ]);

        $line2 = Line::query()->create([

            'name' => 'خط گروه کننده',
            'progress_attribute' => 'طول کلی',
            'code' => 'line2',

            'product_id' => $twisted_pair->id,
        ]);

        $line2->inputs()->sync([$cable->id]);

        LineAttributes::query()->create([

            'line_id' => $line2->id,
            'name' => 'طول کلی',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line2->id,
            'name' => 'طول هر قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line2->id,
            'name' => 'تعداد قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'عدد',
            'default' => '100',
        ]);

        $line3 = Line::query()->create([

            'name' => 'خط کواد کننده',
            'progress_attribute' => 'طول کلی',
            'code' => 'line3',

            'product_id' => $quad_pair->id,
        ]);

        $line3->inputs()->sync([$twisted_pair->id]);
        $line3->materials()->sync([$polyEster->id]);

        LineAttributes::query()->create([

            'line_id' => $line3->id,
            'name' => 'طول کلی',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line3->id,
            'name' => 'طول هر قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line3->id,
            'name' => 'تعداد قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'عدد',
            'default' => '100',
        ]);

        $line4 = Line::query()->create([

            'name' => 'خط نوارپیچ کننده',
            'progress_attribute' => 'طول کلی',
            'code' => 'line4',

            'product_id' => $shielded_cable->id,
        ]);

        $line4->inputs()->sync([$quad_pair->id]);
        $line4->materials()->sync([$aluminumFoil->id]);

        LineAttributes::query()->create([

            'line_id' => $line4->id,
            'name' => 'طول کلی',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line4->id,
            'name' => 'طول هر قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line4->id,
            'name' => 'تعداد قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'عدد',
            'default' => '100',
        ]);

        $line5 = Line::query()->create([

            'name' => 'خط روکش کننده (sftp)',
            'progress_attribute' => 'طول کلی',
            'code' => 'line5',

            'product_id' => $sftp->id,
        ]);

        $line5->inputs()->sync([$shielded_cable->id]);
        $line5->materials()->sync([$pvc->id]);

        LineAttributes::query()->create([

            'line_id' => $line5->id,
            'name' => 'طول کلی',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line5->id,
            'name' => 'طول هر قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line5->id,
            'name' => 'تعداد قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'عدد',
            'default' => '100',
        ]);

        $line6 = Line::query()->create([

            'name' => 'خط روکش کننده (utp)',
            'progress_attribute' => 'طول کلی',
            'code' => 'line6',

            'product_id' => $utp->id,
        ]);

        $line6->inputs()->sync([$quad_pair->id]);
        $line6->materials()->sync([$pvc->id]);

        LineAttributes::query()->create([

            'line_id' => $line6->id,
            'name' => 'طول کلی',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line6->id,
            'name' => 'طول هر قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'متر',
            'default' => '100',
        ]);

        LineAttributes::query()->create([

            'line_id' => $line6->id,
            'name' => 'تعداد قرقره',
            'type' => 'number',
            'merge_type' => 'sum',
            'unit' => 'عدد',
            'default' => '100',
        ]);

        $line1->users()->attach([1, 2]);
        $line2->users()->attach([1, 2]);
        $line3->users()->attach([1, 2]);
        $line4->users()->attach([1, 2]);
        $line5->users()->attach([1, 2]);
        $line6->users()->attach([1, 2]);

        //todo

        $task1 = Task::query()
            ->create([

                'line_id' => $line1->id,
                'code' => generateCode(),
            ]);

        $data = array_merge($pvcAttr->toArray(), [
            'task_id' => $task1->id,
            'line_id' => $line1->id,
            'value' => $pvcAttr['default'],
        ]);

        $data['id'] = null;
        TaskMaterial::query()->create($data);

        $data = array_merge($aluminumMaftolAttr->toArray(), [
            'task_id' => $task1->id,
            'line_id' => $line1->id,
            'value' => $aluminumMaftolAttr['default'],
        ]);

        $data['id'] = null;
        TaskMaterial::query()->create($data);

        TaskAttribute::query()
            ->create([

                'task_id' => $task1->id,
                'line_id' => $line1->id,

                'name' => 'طول کلی',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '10000',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task1->id,
                'line_id' => $line1->id,

                'name' => 'طول هر قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '250',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task1->id,
                'line_id' => $line1->id,

                'name' => 'تعداد قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'عدد',
                'value' => '40',
            ]);

        $task2 = Task::query()
            ->create([

                'line_id' => $line2->id,
                'code' => generateCode(),
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task2->id,
                'line_id' => $line2->id,

                'name' => 'طول کلی',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '10000',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task2->id,
                'line_id' => $line2->id,

                'name' => 'طول هر قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '250',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task2->id,
                'line_id' => $line2->id,

                'name' => 'تعداد قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'عدد',
                'value' => '40',
            ]);

        $task3 = Task::query()
            ->create([

                'line_id' => $line3->id,
                'code' => generateCode(),
            ]);

        $daat = array_merge($polyEsterAttr->toArray(), [
            'task_id' => $task3->id,
            'line_id' => $line3->id,
            'value' => $polyEsterAttr['default'],
        ]);

        $data['id'] = null;
        TaskMaterial::query()->create($data);

        TaskAttribute::query()
            ->create([

                'task_id' => $task3->id,
                'line_id' => $line3->id,

                'name' => 'طول کلی',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '10000',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task3->id,
                'line_id' => $line3->id,

                'name' => 'طول هر قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '250',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task3->id,
                'line_id' => $line3->id,

                'name' => 'تعداد قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'عدد',
                'value' => '40',
            ]);

        $task4 = Task::query()
            ->create([

                'line_id' => $line4->id,
                'code' => generateCode(),
            ]);

        $data = array_merge($aluminumFoilAttr->toArray(), [
            'task_id' => $task4->id,
            'line_id' => $line4->id,
            'value' => $aluminumFoilAttr['default'],
        ]);
        $data['id'] = null;
        TaskMaterial::query()->create($data);

        TaskAttribute::query()
            ->create([

                'task_id' => $task4->id,
                'line_id' => $line4->id,

                'name' => 'طول کلی',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '5000',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task4->id,
                'line_id' => $line4->id,

                'name' => 'طول هر قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '250',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task4->id,
                'line_id' => $line4->id,

                'name' => 'تعداد قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'عدد',
                'value' => '20',
            ]);

        $task5 = Task::query()
            ->create([

                'line_id' => $line5->id,
                'code' => generateCode(),
            ]);

        $data = array_merge($pvcAttr->toArray(), [
            'task_id' => $task5->id,
            'line_id' => $line5->id,
            'value' => $pvcAttr['default'],
        ]);
        $data['id'] = null;
        TaskMaterial::query()->create($data);

        TaskAttribute::query()
            ->create([

                'task_id' => $task5->id,
                'line_id' => $line5->id,

                'name' => 'طول کلی',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '5000',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task5->id,
                'line_id' => $line5->id,

                'name' => 'طول هر قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '250',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task5->id,
                'line_id' => $line5->id,

                'name' => 'تعداد قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'عدد',
                'value' => '20',
            ]);

        $task6 = Task::query()
            ->create([

                'line_id' => $line6->id,
                'code' => generateCode(),
            ]);

        $data = array_merge($pvcAttr->toArray(), [
            'task_id' => $task6->id,
            'line_id' => $line6->id,
            'value' => $pvcAttr['default'],
        ]);
        $data['id'] = null;
        TaskMaterial::query()->create($data);

        TaskAttribute::query()
            ->create([

                'task_id' => $task6->id,
                'line_id' => $line6->id,

                'name' => 'طول کلی',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '5000',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task6->id,
                'line_id' => $line6->id,

                'name' => 'طول هر قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'متر',
                'value' => '250',
            ]);

        TaskAttribute::query()
            ->create([

                'task_id' => $task6->id,
                'line_id' => $line6->id,

                'name' => 'تعداد قرقره',
                'type' => 'number',
                'merge_type' => 'sum',
                'unit' => 'عدد',
                'value' => '20',
            ]);

        $order1 = Order::query()->create([

            'product_id' => $utp->id,
            'line_id' => $line6->id,
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

            'order_id' => $order1->id,
            'name' => 'color',
            'type' => 'text',
            'merge_type' => 'skip',
            'value' => 'white',
        ]);

        $order2 = Order::query()->create([

            'product_id' => $sftp->id,
            'line_id' => $line5->id,
            'code' => generateCode(),
        ]);

        OrderAttribute::query()->create([

            'order_id' => $order2->id,
            'name' => 'stamp',
            'type' => 'text',
            'merge_type' => 'skip',
            'value' => 'MY AWESOME SFTP CABLE',
        ]);

        OrderAttribute::query()->create([

            'order_id' => $order2->id,
            'name' => 'color',
            'type' => 'text',
            'merge_type' => 'skip',
            'value' => 'white',
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
