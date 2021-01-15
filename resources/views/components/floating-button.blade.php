@props(['color'=>'blue'])
<div class="absolute bottom-8 left-4">
    <button {{ $attributes->merge(['class' => "border border-$color-300 shadow-md p-2 bg-$color-500 h-12 w-12 ml-2 text-white rounded-full"]) }}>
        {{ $slot }}</button>
</div>
