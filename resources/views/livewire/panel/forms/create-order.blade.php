<x-form-section submit="storeOrder">
    <x-slot name="title">
        ثبت سفارش جدید
    </x-slot>

    <x-slot name="description">

    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="product" value="محصول"/>
            <x-input id="product" type="text" disabled class="mt-1 block w-full" value="{{ $product->code }} - {{ $product->name }}"/>
            <x-input-error for="product" class="mt-2"/>
        </div>

        @foreach($product->attrs as $i => $attr)

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="{{ $attr['name'] }}" value="{{ $attr['name'] }}"/>
                <x-input id="{{ $attr['name'] }}" type="{{ $attr['type'] }}" step="any" class="mt-1 block w-full"
                         wire:model.lazy="attrs.{{ $attr['name'] }}"/>
                <x-input-error for="attrs.{{ $attr['name'] }}" class="mt-2"/>
            </div>

        @endforeach

    </x-slot>

    <x-slot name="actions">

        <x-action-message class="ml-3" on="saved">
            ذخیره شد.
        </x-action-message>

        <x-button>
            ذخیره
        </x-button>
    </x-slot>
</x-form-section>
