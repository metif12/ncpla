<x-form-section submit="storeProduct">
    <x-slot name="title">
        ویرایش محصول
    </x-slot>

    <x-slot name="description">

    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="نام محصول"/>
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="name"/>
            <x-input-error for="name" class="mt-2"/>
        </div>

        @foreach($attrs as $i => $attr)
            <hr class="col-start-1 col-span-6 sm:col-span-4">

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="attrs.{{$i}}.name" value="{{ $i+1 }}. عنوان ویژگی"/>
                <x-input id="attrs.{{$i}}.name" type="text" class="mt-1 block w-full"
                         wire:model.lazy="attrs.{{$i}}.name"/>
                <x-input-error for="attrs.{{$i}}.name" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-3 sm:col-start-1">
                <x-label for="attrs.{{$i}}.type" value="نوع مقدار"/>
                <select
                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                    id="attrs.{{$i}}.type" wire:model.lazy="attrs.{{$i}}.type">
                    @foreach(\App\Models\Product::$types as $type)
                        <option value="{{ $type['value'] }}">{{ $type['name'] }}</option>
                    @endforeach
                </select>
                <x-input-error for="attrs.{{$i}}.type" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-3 sm:col-start-4">
                <x-label for="attrs.{{$i}}.merge_type" value="نوع ادغام"/>
                <select
                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                    id="attrs.{{$i}}.merge_type" wire:model.lazy="attrs.{{$i}}.merge_type">
                    @foreach(\App\Models\Product::$merge_types as $type)
                        <option value="{{ $type['value'] }}">{{ $type['name'] }}</option>
                    @endforeach
                </select>
                <x-input-error for="attrs.{{$i}}.merge_type" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-3 sm:col-start-1">
                <x-label for="attrs.{{$i}}.unit" value="واحد"/>
                <x-input id="attrs.{{$i}}.unit" type="text"
                         class="mt-1 block w-full"
                         wire:model.lazy="attrs.{{$i}}.unit"/>
                <x-input-error for="attrs.{{$i}}.unit" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-3 sm:col-start-4">
                <x-label for="attrs.{{$i}}.default" value="مقدار پیش فرض"/>
                <x-input id="attrs.{{$i}}.default" type="text" class="mt-1 block w-full"
                         wire:model.lazy="attrs.{{$i}}.default"/>
                <x-input-error for="attrs.{{$i}}.default" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6">
                <x-button class="p-2" color="red" wire:loading.attr="disabled" class="" type="button" wire:click="remAttr('{{$i}}')">
                    حذف
                </x-button>
            </div>

        @endforeach

    </x-slot>

    <x-slot name="actions">

        <x-action-message class="ml-3" on="saved">
            ذخیره شد.
        </x-action-message>

        <x-button class="px-4 py-2" color="green" wire:loading.attr="disabled" class="ml-3" type="button" wire:click="addAttr">
            افزودن ویژگی
        </x-button>

        <x-button class="px-4 py-2">
            ذخیره
        </x-button>
    </x-slot>
</x-form-section>
