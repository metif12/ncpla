<li class="block mb-1">
    <a
        href="{{ route($route) }}"
        class="flex items-center border font-medium @if(request()->routeIs($route)) bg-blue-50 border-blue-100 text-blue-400 @else bg-gray-50 text-gray-500 @endif hover:bg-white p-2 space-x-2 rounded-md"
        :class="{'justify-center': !isSidebarOpen}"
    >
        <span>
            {{ $slot }}
        </span>
        <span class="pr-1" :class="{ 'lg:hidden': !isSidebarOpen }">{{ $name }}</span>
    </a>
</li>
