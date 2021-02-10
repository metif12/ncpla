<div>
    <x-section-title>
        <x-slot name="title">لیست دستور کارها</x-slot>
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
    </div>

    <div>
        @foreach($tasks as $task)
            <div class="bg-white rounded-md shadow my-1 p-2">
                <div class="md:flex">
                    <p>
                        <span class="text-purple-500 inline-block items-center">
                            #{{ $task->code }}
                        </span>
                        <span class="text-gray-900 inline-block items-center">
                        {{ $task->line->name }}
                    </span>
                    </p>
                    <p class="hidden md:inline-block md:mx-auto"></p>
                    <p class="text-sm text-blue-400">
                        {{ verta($task->cretaed_at) }}
                    </p>
                </div>
                @if($task->task_attributes->count()>0)
                    <hr class="my-2">
                    <h3 class="">پارامتر های خط تولید:</h3>
                    @foreach($task->task_attributes as $attr)
                        <div class="md:flex my-1 p-2 border border-dashed border-gray-400 rounded-md">
                            <p class="px-1 inline-block text-gray-900">#{{ $loop->index+1 }}</p>
                            <p class="px-1 inline-block text-gray-900">{{ $attr->name }}</p>
                            <p class="px-1 inline-block text-green-700">{{ $attr->value }}</p>
                            <p class="px-1 inline-block text-green-700">{{ $attr->unit }}</p>
                            <p class="hidden md:inline-block mx-auto"></p>
                            <p class="px-1 text-red-500">{{ $attr->description }}</p>
                        </div>
                    @endforeach
                @endif
                <hr class="my-2">
                <div class="flex flex-row-reverse">
                    <x-abutton class="p-2" color="yellow" href="{{ route('panel.task-edit', $task) }}">
                        ویرایش
                    </x-abutton>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
</div>
