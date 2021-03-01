<x-form-section submit="store">
    <x-slot name="title">
        ویرایش وقفه اولیه
    </x-slot>

    <x-slot name="description">

    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="نام"/>
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="name"/>
            <x-input-error for="name" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="code" value="کد"/>
            <x-input id="code" type="text" class="mt-1 block w-full" wire:model.lazy="code"/>
            <x-input-error for="code" class="mt-2"/>
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
