<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        اطلاعات پروفایل
    </x-slot>

    <x-slot name="description">
        بروزرسانی اطلاعات پروفایل حساب کاربری و آدرس ایمیل شما
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden"
                   wire:model="photo"
                   x-ref="photo"
                   x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            "/>

            <x-label for="photo" value="تصویر"/>

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ url($user->profile_photo ?? 'img/profile.png') }}" alt="{{ $user->name }}"
                     class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
            </div>

            <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                انتخاب تصویر جدید
            </x-secondary-button>

            @if ($user->profile_photo != 'img/profile.png')
                <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                    حذف تصویر
                </x-secondary-button>
            @endif

            <x-input-error for="photo" class="mt-2"/>
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="نام و نام خانوادگی"/>
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="user.name" autocomplete="name"/>
            <x-input-error for="user.name" class="mt-2"/>
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="آدرس ایمیل"/>
            <x-input lang="en" id="email" type="email" class="mt-1 block w-full" wire:model.defer="user.email"/>
            <x-input-error for="user.email" class="mt-2"/>
        </div>

        <!-- National Code -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="national_code" value="کد ملی"/>
            <x-input lang="en" id="national_code" type="text" class="mt-1 block w-full" wire:model.defer="user.national_code"/>
            <x-input-error for="user.national_code" class="mt-2"/>
        </div>

        <!-- Mobile -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="mobile" value="موبایل"/>
            <x-input lang="en" id="mobile" type="text" class="mt-1 block w-full" wire:model.defer="user.mobile"/>
            <x-input-error for="user.mobile" class="mt-2"/>
        </div>

        <!-- Address -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="آدرس"/>
            <x-textarea id="address" class="mt-1 block w-full" wire:model.defer="user.address"/>
            <x-input-error for="user.address" class="mt-2"/>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="ml-3" on="saved">
            ذخیره شد.
        </x-action-message>

        <x-button class="px-4 py-2" wire:loading.attr="disabled" wire:target="photo">
            ذخیره
        </x-button>
    </x-slot>

</x-form-section>
