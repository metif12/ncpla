<div>
    <x-form-section submit="storeGroup">
    <x-slot name="title">
        ایجاد گروه
    </x-slot>

    <x-slot name="description">

    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="نام گروه"/>
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name"/>
            <x-input-error for="name" class="mt-2"/>
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
</div>
