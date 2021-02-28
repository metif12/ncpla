@extends('panel.layout')

@push('head-end')
    <style>
        @import url(https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css);
    </style>
@endpush

@section('content')

    {{--    <div class="w-full">--}}
    {{--        <div class="-mx-2 md:flex">--}}
    {{--            <div class="w-full md:w-1/4 px-2">--}}
    {{--                <div class="rounded-lg mb-4">--}}
    {{--                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">--}}
    {{--                        <div class="px-3 pt-8 pb-10 text-center relative z-10">--}}
    {{--                            <h4 class="text-sm uppercase text-gray-500 leading-tight">Users</h4>--}}
    {{--                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">3,682</h3>--}}
    {{--                            <p class="text-xs text-green-500 leading-tight">▲ 57.1%</p>--}}
    {{--                        </div>--}}
    {{--                        <div class="absolute bottom-0 inset-x-0">--}}
    {{--                            <canvas id="chart1" height="70"></canvas>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="w-full md:w-1/4 px-2">--}}
    {{--                <div class="rounded-lg mb-4">--}}
    {{--                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">--}}
    {{--                        <div class="px-3 pt-8 pb-10 text-center relative z-10">--}}
    {{--                            <h4 class="text-sm uppercase text-gray-500 leading-tight">Subscribers</h4>--}}
    {{--                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">11,427</h3>--}}
    {{--                            <p class="text-xs text-red-500 leading-tight">▼ 42.8%</p>--}}
    {{--                        </div>--}}
    {{--                        <div class="absolute bottom-0 inset-x-0">--}}
    {{--                            <canvas id="chart2" height="70"></canvas>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="w-full md:w-1/4 px-2">--}}
    {{--                <div class="rounded-lg mb-4">--}}
    {{--                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">--}}
    {{--                        <div class="px-3 pt-8 pb-10 text-center relative z-10">--}}
    {{--                            <h4 class="text-sm uppercase text-gray-500 leading-tight">Comments</h4>--}}
    {{--                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">8,028</h3>--}}
    {{--                            <p class="text-xs text-green-500 leading-tight">▲ 8.2%</p>--}}
    {{--                        </div>--}}
    {{--                        <div class="absolute bottom-0 inset-x-0">--}}
    {{--                            <canvas id="chart3" height="70"></canvas>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="w-full md:w-1/4 px-2">--}}
    {{--                <div class="rounded-lg mb-4">--}}
    {{--                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">--}}
    {{--                        <div class="px-3 pt-8 pb-10 text-center relative z-10">--}}
    {{--                            <h4 class="text-sm uppercase text-gray-500 leading-tight">SomeThing</h4>--}}
    {{--                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">8,028</h3>--}}
    {{--                            <p class="text-xs text-green-500 leading-tight">▲ 8.2%</p>--}}
    {{--                        </div>--}}
    {{--                        <div class="absolute bottom-0 inset-x-0">--}}
    {{--                            <canvas id="chart4" height="70"></canvas>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="block md:flex">
        <div class="bg-white ml-auto shadow-lg md:shadow-xl rounded-md p-2 flex justify-center items-center"
             style="width: 100%">
            <canvas id="product" style="width: 100%; height: 40vh;"></canvas>
        </div>

        <div class="h-4 w-4"></div>

        <div class="bg-white mr-auto shadow-lg md:shadow-xl rounded-md p-2 flex justify-center items-center"
             style="width: 100%">
            <canvas id="material" style="width: 100%; height: 40vh;"></canvas>
        </div>
    </div>

    <div class="h-4 w-4"></div>

    <div class="block md:flex">
        <div class="bg-white ml-auto shadow-lg md:shadow-xl rounded-md p-2 flex justify-center items-center"
             style="width: 100%">
            <canvas id="interrupt" style="width: 100%; height: 40vh;"></canvas>
        </div>

        <div class="h-4 w-4"></div>

        <div class="bg-white mr-auto shadow-lg md:shadow-xl rounded-md p-2 flex justify-center items-center"
             style="width: 100%">
            <canvas id="progress" style="width: 100%; height: 40vh;"></canvas>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        window.onload = function () {

            Chart.defaults.global.defaultFontFamily = 'Vazir';

            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

            let product_datasets = [];
            let material_datasets = [];
            let interrupt_datasets = [];
            let progress_datasets = [];

            @foreach(\App\Models\Product::all() as $product)
            product_datasets.push({
                label: '{{ $product->name }}',
                backgroundColor: getRandomColor(),
                stack: '{{ $product->name }}',
                data: [
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,1,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,2,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,2,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,3,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,3,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,4,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,4,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,5,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,5,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,6,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,6,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,7,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,7,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,8,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,8,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,9,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,9,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,10,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,10,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,11,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,11,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,12,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->where('product_id', $product->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,12,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,1,1)->datetime()])->sum('progress') }},
                ]
            });
            @endforeach

            @foreach(\App\Models\Material::all() as $material)
            material_datasets.push({
                label: '{{ $material->name }}',
                backgroundColor: getRandomColor(),
                stack: '{{ $material->name }}',
                data: [
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,1,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,2,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,2,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,3,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,3,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,4,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,4,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,5,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,5,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,6,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,6,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,7,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,7,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,8,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,8,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,9,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,9,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,10,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,10,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,11,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,11,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,12,1)->datetime()])->sum('value') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_materials')->where('material_id', $material->id)->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,12,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,1,1)->datetime()])->sum('value') }},
                ]
            });
            @endforeach

            interrupt_datasets.push({
                label: 'وقفه',
                backgroundColor: getRandomColor(),
                stack: 'وقفه',
                data: [
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,1,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,2,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,2,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,3,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,3,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,4,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,4,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,5,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,5,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,6,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,6,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,7,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,7,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,8,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,8,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,9,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,9,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,10,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,10,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,11,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,11,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,12,1)->datetime()])->sum('length') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_interrupts')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,12,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,1,1)->datetime()])->sum('length') }},
                ]
            });

            progress_datasets.push({
                label: 'عملکرد',
                backgroundColor: getRandomColor(),
                stack: 'عملکرد',
                data: [
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,1,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,2,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,2,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,3,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,3,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,4,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,4,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,5,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,5,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,6,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,6,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,7,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,7,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,8,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,8,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,9,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,9,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,10,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,10,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,11,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,11,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,12,1)->datetime()])->sum('progress') }},
                    {{ \Illuminate\Support\Facades\DB::table('report_outputs')->whereBetween('created_at',[ \Hekmatinasser\Verta\Verta::createJalali(null,12,1)->datetime(), \Hekmatinasser\Verta\Verta::createJalali(null,1,1)->datetime()])->sum('progress') }},
                ]
            });

            var barChartData1 = {
                labels: ['فرودین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'],
                datasets: product_datasets,
            };

            var ctx5 = document.getElementById('product').getContext('2d');
            window.product = new Chart(ctx5, {
                type: 'bar',
                data: barChartData1,
                options: {
                    title: {
                        display: true,
                        text: 'تولیدات امسال'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });

            var barChartData2 = {
                labels: ['فرودین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'],
                datasets: material_datasets,
            };
            var ctx6 = document.getElementById('material').getContext('2d');
            window.product = new Chart(ctx6, {
                type: 'bar',
                data: barChartData2,
                options: {
                    title: {
                        display: true,
                        text: 'مصرف مواد اولیه امسال'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });

            var barChartData3 = {
                labels: ['فرودین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'],
                datasets: interrupt_datasets,
            };
            var ctx7 = document.getElementById('interrupt').getContext('2d');
            window.interrupt = new Chart(ctx7, {
                type: 'bar',
                data: barChartData3,
                options: {
                    title: {
                        display: true,
                        text: 'وقفه های امسال'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });

            var barChartData4 = {
                labels: ['فرودین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'],
                datasets: interrupt_datasets,
            };
            var ctx8 = document.getElementById('progress').getContext('2d');
            window.progress = new Chart(ctx8, {
                type: 'bar',
                data: barChartData4,
                options: {
                    title: {
                        display: true,
                        text: 'عملکرد امسال'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });
        }
    </script>
@endpush
