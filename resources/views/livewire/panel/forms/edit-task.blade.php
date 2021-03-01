<x-form-section submit="updateTask">
    <x-slot name="title">
        ویرایش دستورکار
    </x-slot>

    <x-slot name="description">
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <x-label for="line" value="خط تولید"/>
            <x-input id="line" type="text" disabled class="mt-1 block w-full" value="{{ $line->uname() }}"/>
            <x-input-error for="line" class="mt-2"/>
        </div>

        @foreach($attrs as $i => $attr)

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="attrs.{{$i}}.{{ $attr['name'] }}"
                         value="{{ $attr['name'] }}"/>
                <x-input id="attrs.{{$i}}.{{ $attr['name'] }}" type="{{ $attr['type'] }}" step="any" class="mt-1 block w-full"
                         wire:model.lazy="attrs.{{ $i }}.value"/>
                <x-input-error for="attrs.{{$i}}.{{ $attr['name'] }}" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="attrs.{{$i}}.description"
                         value="{{ $attr['name'] }} - توضیحات"/>
                <x-textarea id="attrs.{{$i}}.description" step="any" class="mt-1 block w-full"
                            wire:model.lazy="attrs.{{ $i }}.description"/>
                <x-input-error for="attrs.{{$i}}.description" class="mt-2"/>
            </div>

        @endforeach

        @foreach($mattrs as $i => $attr)

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="mattrs.{{$i}}.{{ $attr['name'] }}"
                         value="{{ $attr['material'] }} : {{ $attr['name'] }}"/>
                <x-input id="mattrs.{{$i}}.{{ $attr['name'] }}" type="{{ $attr['type'] }}" step="any" class="mt-1 block w-full"
                         wire:model.lazy="mattrs.{{ $i }}.value"/>
                <x-input-error for="mattrs.{{$i}}.{{ $attr['name'] }}" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="mattrs.{{$i}}.description"
                         value="{{ $attr['name'] }} - توضیحات"/>
                <x-textarea id="mattrs.{{$i}}.description }}" step="any" class="mt-1 block w-full"
                            wire:model.lazy="mattrs.{{ $i }}.description"/>
                <x-input-error for="mattrs.{{$i}}.description" class="mt-2"/>
            </div>

        @endforeach

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
