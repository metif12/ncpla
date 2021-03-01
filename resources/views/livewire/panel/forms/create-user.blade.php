<x-form-section submit="storeUser">
    <x-slot name="title">
        ثبت فرد جدید
    </x-slot>

    <x-slot name="description">

    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="نام و نام خانوادگی"/>
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="name"/>
            <x-input-error for="name" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="ایمیل"/>
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.lazy="email"/>
            <x-input-error for="email" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="national_code" value="کدملی"/>
            <x-input id="national_code" type="text" class="mt-1 block w-full" wire:model.lazy="national_code"/>
            <x-input-error for="national_code" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="mobile" value="موبایل"/>
            <x-input id="mobile" type="text" class="mt-1 block w-full" wire:model.lazy="mobile"/>
            <x-input-error for="mobile" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="آدرس"/>
            <x-textarea id="address" class="mt-1 block w-full" wire:model.lazy="address"/>
            <x-input-error for="address" class="mt-2"/>
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
