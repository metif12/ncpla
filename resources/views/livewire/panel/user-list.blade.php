<div>


    <x-section-title>
        <x-slot name="title">لیست کاربران</x-slot>
        <x-slot name="description"></x-slot>
    </x-section-title>

    <p class="p-2 m-2 rounded text-sm font-bold border border-blue-500 bg-blue-200 text-blue-500 text-center">
        غیرفعال سازی کاربران در این صفحه مانع از لاگین مجدد آنها به سیستم میشود.
    </p>

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
                    نام
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    کدملی
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    ایمیل
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    موبایل
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    تاریخ ثبت
                </th>

                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    عملیات
                </th>
                {{--                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">--}}

                {{--                </th>--}}


            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
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
                            {{ $user->id }}
                        </span>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                        <span class="text-gray-700 flex items-center">
                             @if($user->activated_at)
                                <x-icons.happy class="text-green-500 w-6 h-6"></x-icons.happy>
                             @else
                                <x-icons.sad class="text-yellow-500 w-6 h-6"></x-icons.sad>
                             @endif
                            <span class="inline-block w-2"></span>
                            {{ $user->name }}
                        </span>
                    </td>
                    <td class="p-2 border-dashed border-t border-gray-200">
                        <span class="text-gray-700 flex items-center">
                            {{ $user->national_code }}
                        </span>
                    </td>
                    <td class="p-2 border-dashed border-t border-gray-200">
                        <span class="text-gray-700 flex items-center">
                            {{ $user->email }}
                        </span>
                    </td>
                    <td class="p-2 border-dashed border-t border-gray-200">
                        <span class="text-gray-700 flex items-center">
                            {{ $user->mobile }}
                        </span>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                            <span class="text-gray-700 flex items-center">
                                {{ verta($user->cretaed_at) }}
                            </span>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                        @if($user->activated_at)
                        <x-button class="p-2" color="yellow" wire:click="toggleActivation('{{ $user->id }}')">
                            <x-icons.sad class="text-white w-6 h-6"></x-icons.sad>
                        </x-button>
                        @else
                        <x-button class="p-2" color="green" wire:click="toggleActivation('{{ $user->id }}')">
                            <x-icons.happy class="text-white w-6 h-6"></x-icons.happy>
                        </x-button>
                        @endif
                    </td>

                    {{--                    <td class="p-2 border-dashed border-t border-gray-200">--}}
                    {{--                        <x-abutton class="p-2" color="yellow" href="{{ route('panel.user-edit', $user) }}">--}}
                    {{--                            ویرایش--}}
                    {{--                        </x-abutton>--}}
                    {{--                    </td>--}}

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div class="mt-2">{{ $users->links() }}</div>

</div>
