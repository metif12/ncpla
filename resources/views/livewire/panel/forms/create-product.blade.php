<x-form-section submit="storeProduct">
    <x-slot name="title">
        ثبت محصول جدید
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
                <x-label for="attrs.{{$i}}.name" value="عنوان ویژگی"/>
                <x-input id="attrs.{{$i}}.name" type="text" class="mt-1 block w-full"
                         wire:model.lazy="attrs.{{$i}}.name"/>
                <x-input-error for="attrs.{{$i}}.name" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-2 sm:col-start-1">
                <x-label for="attrs.{{$i}}.type" value="نوع مقدار"/>
                <select
                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                    id="attrs.{{$i}}.type" wire:model.lazy="attrs.{{$i}}.type">
                    @foreach($types as $type)
                        <option value="{{ $type['value'] }}">{{ $type['name'] }}</option>
                    @endforeach
                </select>
                <x-input-error for="attrs.{{$i}}.type" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-2 sm:col-start-3">
                <x-label for="attrs.{{$i}}.unit" value="واحد"/>
                <x-input id="attrs.{{$i}}.unit" type="text"
                         class="mt-1 block w-full"
                         wire:model.lazy="attrs.{{$i}}.unit"/>
                <x-input-error for="attrs.{{$i}}.unit" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-2 sm:col-start-5">
                <x-label for="attrs.{{$i}}.default" value="مقدار پیش فرض"/>
                <x-input id="attrs.{{$i}}.default" type="text" class="mt-1 block w-full"
                         wire:model.lazy="attrs.{{$i}}.default"/>
                <x-input-error for="attrs.{{$i}}.default" class="mt-2"/>
            </div>

        @endforeach

    </x-slot>

    <x-slot name="actions">

        <x-action-message class="ml-3" on="saved">
            ذخیره شد.
        </x-action-message>

        <x-button color="green" wire:loading.attr="disabled" class="ml-3" type="button" wire:click="addAttr">
            افزودن ویژگی
        </x-button>

        <x-button>
            ذخیره
        </x-button>
    </x-slot>
</x-form-section>
