<x-form-section submit="storeMaterial">
    <x-slot name="title">
        ویرایش مواد اولیه
    </x-slot>

    <x-slot name="description">

    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="نام ماده"/>
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="name"/>
            <x-input-error for="name" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="unit" value="واحد اندازه گیری"/>
            <x-input id="unit" type="text" class="mt-1 block w-full" wire:model.lazy="unit"/>
            <x-input-error for="unit" class="mt-2"/>
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
