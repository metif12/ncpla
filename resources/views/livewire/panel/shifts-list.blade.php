<div>
    <x-section-title>
        <x-slot name="title">لیست شیفت های کاری</x-slot>
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
                    <a href="{{ route('panel.shift-create') }}"
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

    <div>
        @foreach($shifts as $shift)
            <div class="bg-white rounded-md shadow my-1 p-2">
                <div class="md:flex">
                    <span class="text-purple-500 inline-block items-center">
                        #{{ $shift->code }}
                    </span>
                    <span class="hidden md:inline-block md:mx-auto"></span>
                    <span class="text-sm text-blue-400">
                        {{ verta($shift->cretaed_at) }}
                    </span>
                </div>

                <hr class="my-2">
                <p>
                    <span class="text-yellow-600 inline-block items-center">
                        {{ verta($shift->start)->format('H:i') }}
                        </span>
                    تا
                    <span class="text-yellow-600 inline-block items-center">
                        {{ verta($shift->end)->format('H:i') }}
                        </span>
                    به مدت
                    <span class="text-red-600 font-bold inline-block items-center">
                        {{ $shift->length() }}
                            دقیقه
                        </span>
                </p>
                <hr class="my-2">

                <div class="flex flex-row-reverse">
                    <x-abutton class="p-2" color="yellow" href="{{ route('panel.shift-edit', $shift) }}">
                        ویرایش
                    </x-abutton>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $shifts->links() }}
    </div>
</div>
