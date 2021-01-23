@props(['color'=>'blue'])
<a {{ $attributes->merge(['class' => "inline-flex items-center px-4 py-2 bg-$color-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-$color-700 active:bg-$color-900 focus:outline-none focus:border-$color-900 focus:shadow-outline-$color disabled:opacity-25 transition ease-in-out duration-150"]) }}>
    {{ $slot }}
</a>
