<div>
    <x-section-title>
        <x-slot name="title">لیست محصولات</x-slot>
        <x-slot name="description"></x-slot>
    </x-section-title>

    <div class="mb-4 mt-5 flex justify-between items-center">
        <div class="flex-1 pl-4">
            <div wire:loading.class="bg-gray-100"
                 wire:target="search"
                 class="relative rounded-lg shadow overflow-hidden bg-white md:w-1/3">
                <input type="search"
                       wire:model.debounce.750ms="search"
                       wire:loading.attr="disabled"
                       class="w-full pl-10 pr-4 py-2 bg-transparent rounded-lg focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                       placeholder="جست و جو ..">
                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <circle cx="10" cy="10" r="7"/>
                        <line x1="21" y1="21" x2="15" y2="15"/>
                    </svg>
                </div>
            </div>
        </div>
        <div>
            <div class="flex">
                <div class="shadow rounded-lg relative">
                    <a href="{{ route('panel.product-create') }}"
                       class="rounded-lg inline-flex items-center bg-white hover:text-green-500 focus:outline-none focus:shadow-outline text-gray-500 font-semibold py-2 px-2 md:px-4">
                        <span class="hidden md:block">افزودن</span>
                        <svg class="w-5 h-5 md:mr-2" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             focusable="false" width="1em" height="1em"
                             stroke="currentColor"
                             style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                             preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                            <g fill="black">
                                <path fill-rule="evenodd"
                                      d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                                <path fill-rule="evenodd"
                                      d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
         style="max-height: 75vh;">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
            <tr class="text-right">

                <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                    <label
                        class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                        <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline">
                    </label>
                </th>

                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    #
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    نام محصول
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    تاریخ ثبت
                </th>

                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    عملیات
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">

                </th>

            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr class="">
                    <td class="p-2 border-dashed border-t border-gray-200 px-3">
                        <label
                            class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                            <input type="checkbox"
                                   class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline">
                        </label>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                            <span class="text-gray-700 flex items-center">
                                {{ $product->code }}
                            </span>
                    </td>
                    <td class="p-2 border-dashed border-t border-gray-200">
                        <a href="{{ route('panel.product-edit', $product) }}"
                           class="text-gray-700 flex items-center">                                {{ $product->name }}
                        </a>
                    </td>
                    <td class="p-2 border-dashed border-t border-gray-200">
                            <span class="text-gray-700 flex items-center">
                                {{ verta($product->cretaed_at) }}
                            </span>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                        @if($product->lines->count() > 0)
                            <x-abutton href="{{ route('panel.order-create', $product) }}">
                                ثبت سفارش
                            </x-abutton>
                        @else
                            خط تولید تعریف نشده است!
                        @endif
                    </td>
                    <td class="p-2 border-dashed border-t border-gray-200">
                        <x-abutton color="yellow" href="{{ route('panel.product-edit', $product) }}">
                            ویرایش
                        </x-abutton>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
