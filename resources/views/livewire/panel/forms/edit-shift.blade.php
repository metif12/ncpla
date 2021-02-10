<x-form-section submit="storeShift">
    <x-slot name="title">
        ویرایش شیفت کاری
    </x-slot>

    <x-slot name="description">

    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="start" value="ساعت شروع"/>
            <x-input id="start" type="time" pattern="[0-9]{2}:[0-9]{2}" class="mt-1 block w-full" wire:model.lazy="start" style="direction: ltr" />
            <x-input-error for="start" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="end" value="ساعت پایان"/>
            <x-input id="end" type="time" pattern="[0-9]{2}:[0-9]{2}" class="mt-1 block w-full" wire:model.lazy="end" style="direction: ltr" />
            <x-input-error for="end" class="mt-2"/>
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
