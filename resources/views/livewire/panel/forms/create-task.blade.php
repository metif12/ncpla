<x-form-section submit="storeTask">
    <x-slot name="title">
        ثبت دستورکار جدید
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
                <x-label for="attr.{{$i}}.{{ $attr['name'] }}"
                         value="{{ $attr['name'] }}"/>
                <x-input id="attr.{{$i}}. $attr['name'] }}" type="{{ $attr['type'] }}" step="any" class="mt-1 block w-full"
                         wire:model.lazy="attrs.{{ $i }}.value"/>
                <x-input-error for="attr.{{$i}}. $attr['name'] }}" class="mt-2"/>
            </div>

        @endforeach

{{--        @foreach($pattrs as $i => $pattr)--}}

{{--            <div class="col-start-1 col-span-6 sm:col-span-4">--}}
{{--                <x-label for="pattr.{{$i}}.{{ $pattr['name'] }}"--}}
{{--                         value="{{ \App\Models\Product::find($i)->uname() }}: {{ $pattr['name'] }}"/>--}}
{{--                <x-input id="pattr.{{$i}}. $pattr['name'] }}" type="{{ $pattr['type'] }}" step="any" class="mt-1 block w-full"--}}
{{--                         wire:model.lazy="pattrs.{{ $i }}.value"/>--}}
{{--                <x-input-error for="pattr.{{$i}}. $pattr['name'] }}" class="mt-2"/>--}}
{{--            </div>--}}

{{--        @endforeach--}}

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
