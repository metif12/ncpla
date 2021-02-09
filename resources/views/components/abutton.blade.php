@props(['color'=>'blue'])
<a {{ $attributes->merge(['class' => "inline-flex items-center bg-$color-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-$color-300 active:bg-$color-700 focus:outline-none focus:border-$color-200 focus:shadow-outline-$color disabled:opacity-25 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</a>
