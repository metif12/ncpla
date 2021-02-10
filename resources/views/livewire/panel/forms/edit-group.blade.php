<div>

    <x-section-title>
        <x-slot name="title">ویرایش گروه</x-slot>
        <x-slot name="description"></x-slot>
    </x-section-title>

    <div class="pt-2" x-data="{index : (localStorage.edit_group_index ? localStorage.edit_group_index : 1)}">
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
                        @click="index=3;localStorage.setItem('edit_group_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 3}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        ویرایش
                    </button>
                    <button
                        @click="index=1;localStorage.setItem('edit_group_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 1}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        لیست افراد
                    </button>
                    <button
                        @click="index=5;localStorage.setItem('edit_group_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 5}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        لیست مجوزها
                    </button>
                    <button
                        @click="index=2;localStorage.setItem('edit_group_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 2}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        افزودن فرد
                    </button>
                    <button
                        @click="index=4;localStorage.setItem('edit_group_index',index);"
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
                <livewire:panel.group-users-list :group="$group" />
            </div>
            <div x-show="index == 5" class="mt-4 mx-2">
                <livewire:panel.group-permissions-list :group="$group" />
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
                                 wire:click="toggleUser('{{ $user->id }}')">
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
