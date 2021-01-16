<x-form-section submit="updatePassword">
    <x-slot name="title">
        تغییر رمز عبور
    </x-slot>

    <x-slot name="description">
        رمز عبور طولانی و تصادفی امنیت حساب شما را افزایش میدهد.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="رمز عبور فعلی" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="رمز عبور جدید" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="تکرار رمز عبور جدید" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
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
