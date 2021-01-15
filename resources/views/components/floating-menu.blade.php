@props(['color'=>'blue'])

<div class="absolute bottom-8 left-4" x-data="{ isOpen: false }">
    <button @click="isOpen = !isOpen" {{ $attributes->merge(['class' => "border border-$color-300 shadow-md p-2 bg-$color-500 h-12 w-12 ml-2 text-white rounded-full"]) }}>
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="white"><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/><circle cx="5" cy="12" r="2"/></g></svg>
    </button>
    <div
        @click.away="isOpen = false"
        x-show.transition.opacity="isOpen"
        class="absolute mb-2 left-0 bottom-12 bg-white border rounded-md shadow-md min-w-max"
    >
        {{ $slot }}
    </div>
</div>
