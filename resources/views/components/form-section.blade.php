@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-4 md:gap-6']) }}>

    @isset($title)
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        @isset($description)
        <x-slot name="description">{{ $description }}</x-slot>
        @endisset
    </x-section-title>
    @endisset

    <div class="mt-5 md:mt-0  md:col-span-3 md:col-start-1">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-7 gap-6">
                        {{ $form }}
                    </div>
                </div>

                @if (isset($actions))
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        {{ $actions }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
