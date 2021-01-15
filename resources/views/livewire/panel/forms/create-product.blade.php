<x-form-section submit="storeProduct">
    <x-slot name="title">
        ثبت محصول جدید
    </x-slot>

    <x-slot name="description">

    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="نام محصول" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name"/>
            <x-input-error for="name" class="mt-2" />
        </div>
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
