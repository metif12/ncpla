<div>

    <x-section-title>
        <x-slot name="title">ویرایش گروه</x-slot>
        <x-slot name="description"></x-slot>
    </x-section-title>

    <div class="pt-2" x-data="{index : (localStorage.dashboard_index ? localStorage.dashboard_index : 1)}">
        <div class="my-2">

            <div class="bg-white shadow rounded-md overflow-hidden">

                <nav class="flex flex-no-wrap overflow-y-auto">
                    <a
                        href="{{ route('panel.groups') }}"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == -1}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        <svg class="w-6 h-6" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em"
                             height="1em"
                             style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                             preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                            <g fill="#626262">
                                <path fill-rule="evenodd"
                                      d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd"
                                      d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"/>
                            </g>
                        </svg>
                    </a>
                    <button
                        @click="index=3;localStorage.setItem('dashboard_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 3}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        ویرایش
                    </button>
                    <button
                        @click="index=1;localStorage.setItem('dashboard_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 1}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        لیست افراد
                    </button>
                    <button
                        @click="index=5;localStorage.setItem('dashboard_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 5}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        لیست مجوزها
                    </button>
                    <button
                        @click="index=2;localStorage.setItem('dashboard_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 2}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        افزودن فرد
                    </button>
                    <button
                        @click="index=4;localStorage.setItem('dashboard_index',index);"
                        :class="{'text-blue-500 border-b-4 font-medium border-blue-500' : index == 4}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        افزودن مجوز
                    </button>
                </nav>
            </div>

            <div x-show="index == 3" class="mt-4 mx-2">
                <x-form-section submit="storeGroup">

                    <x-slot name="form">
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="name" value="نام گروه"/>
                            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="name"/>
                            <x-input-error for="name" class="mt-2"/>
                        </div>
                    </x-slot>

                    <x-slot name="actions">

                        <x-action-message class="ml-3" on="saved">
                            ذخیره شد.
                        </x-action-message>

                        <x-button class="px-4 py-2">
                            ذخیره
                        </x-button>
                    </x-slot>
                </x-form-section>
            </div>

            <div x-show="index == 1" class="mt-4 mx-2">

                <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
                     style="max-height: 60vh;">
                    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                        <thead>
                        <tr class="text-right">

                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                                <label
                                    class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    <input type="checkbox"
                                           class="form-checkbox focus:outline-none focus:shadow-outline">
                                </label>
                            </th>

                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                نام
                            </th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                موبایل
                            </th>

                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                عملیات
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $admin)
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
                                {{ $admin->name }}
                            </span>
                                </td>

                                <td class="p-2 border-dashed border-t border-gray-200">
                            <span class="text-gray-700 flex items-center">
                                {{ $admin->mobile }}
                            </span>
                                </td>

                                <td class="p-2 border-dashed border-t border-gray-200">
                                    <x-button class="p-2" color=red type="button" wire:click="delete('{{$admin->id}}')">
                                        حذف
                                    </x-button>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $members->links() }}
                </div>
            </div>
            <div x-show="index == 5" class="mt-4 mx-2">

{{--                <div class="mb-4 mt-5 flex justify-between items-center">--}}
{{--                    <div class="flex-1 pl-4">--}}
{{--                        <div wire:loading.class="bg-gray-100"--}}
{{--                             wire:target="searchPermissionList"--}}
{{--                             class="relative rounded-lg shadow overflow-hidden bg-white md:w-1/3">--}}
{{--                            <input type="search"--}}
{{--                                   wire:model.debounce.750ms="searchPermissionList"--}}
{{--                                   wire:loading.attr="disabled"--}}
{{--                                   class="w-full pl-10 pr-4 py-2 bg-transparent rounded-lg focus:outline-none focus:shadow-outline text-gray-600 font-medium"--}}
{{--                                   placeholder="جست و جو ..">--}}
{{--                            <div class="absolute top-0 left-0 inline-flex items-center p-2">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"--}}
{{--                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"--}}
{{--                                     stroke-linejoin="round">--}}
{{--                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>--}}
{{--                                    <circle cx="10" cy="10" r="7"/>--}}
{{--                                    <line x1="21" y1="21" x2="15" y2="15"/>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
                     style="max-height: 60vh;">
                    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                        <thead>
                        <tr class="text-right">

                            <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                                <label
                                    class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    <input type="checkbox"
                                           class="form-checkbox focus:outline-none focus:shadow-outline">
                                </label>
                            </th>

                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                نام
                            </th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">

                            </th>

                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                عملیات
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($granted as $per)
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
                                {{ $per->name }}
                            </span>
                                </td>

                                <td class="p-2 border-dashed border-t border-gray-200">
                            <span class="text-gray-700 flex items-center">
                                {{ $per->description }}
                            </span>
                                </td>

                                <td class="p-2 border-dashed border-t border-gray-200">
                                    <x-button class="p-2" color=red type="button" wire:click="revoke('{{$per->slug}}')">
                                        لغو
                                    </x-button>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $granted->links() }}
                </div>
            </div>

            <div x-show="index==2" class="mt-4 mx-2">
                <div class="w-full grid gap-2 grid-cols-6">
                    <div class="col-span-6 sm:col-span-4">
                        <div wire:loading.class="bg-gray-100"
                             wire:target="searchUsers"
                             class="relative rounded-lg shadow overflow-hidden bg-white">
                            <input type="search"
                                   wire:model.debounce.750ms="searchUsers"
                                   wire:loading.attr="disabled"
                                   class="w-full pl-10 pr-4 py-2 bg-transparent rounded-lg focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                   placeholder="جست و جوی ادمین ها">
                            <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400"
                                     viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <circle cx="10" cy="10" r="7"/>
                                    <line x1="21" y1="21" x2="15" y2="15"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    @foreach($users as $user)
                        <div class="col-span-6 sm:col-span-4">
                            <div class="flex bg-white p-1 rounded shadow cursor-pointer"
                                 wire:click="toggleAdmin('{{ $user->id }}')">
                                <span class="p-2">
                                    @if(!$user->hasGroup($group))
                                        <x-icons.unchecked class="w-6 h-6"></x-icons.unchecked>
                                    @else
                                        <x-icons.checked class="w-6 h-6"></x-icons.checked>
                                    @endif
                                </span>
                                <span class="p-2" wire:loading>
                                    <x-icons.loading class="w-6 h-6"></x-icons.loading>
                                </span>
                                <span class="p-2">{{ $user->name }}</span>
                                <span class="mr-auto p-2">{{ $user->national_code }}</span>
                                <span class="mr-auto p-2">{{ $user->mobile }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div x-show="index==4" class="mt-4 mx-2">
                <div class="w-full grid gap-2 grid-cols-6">
                    <div class="col-span-6 sm:col-span-4">
                        <div wire:loading.class="bg-gray-100"
                             wire:target="searchPermissions"
                             class="relative rounded-lg shadow overflow-hidden bg-white">
                            <input type="search"
                                   wire:model.debounce.750ms="searchPermissions"
                                   wire:loading.attr="disabled"
                                   class="w-full pl-10 pr-4 py-2 bg-transparent rounded-lg focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                   placeholder="جست و جوی مجوز ها">
                            <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400"
                                     viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <circle cx="10" cy="10" r="7"/>
                                    <line x1="21" y1="21" x2="15" y2="15"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    @foreach($permissions as $per)
                        <div class="col-span-6 sm:col-span-4">
                            <div class="flex bg-white p-1 rounded shadow cursor-pointer"
                                 wire:click="togglePermission('{{ $per->slug }}')">
                                <span class="p-2">
                                    @if(!$group->hasPermission($per))
                                        <x-icons.unchecked class="w-6 h-6"></x-icons.unchecked>
                                    @else
                                        <x-icons.checked class="w-6 h-6"></x-icons.checked>
                                    @endif
                                </span>
                                <span class="p-2" wire:loading>
                                    <x-icons.loading class="w-6 h-6"></x-icons.loading>
                                </span>
                                <span class="p-2">{{ $per->name }}</span>
                                <span class="mr-auto p-2">{{ $per->description }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
