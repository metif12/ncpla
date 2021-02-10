<li class="block mb-2">
    <a
        href="{{ route($route) }}"
        class="flex items-center border shadow-md font-medium @if(request()->routeIs($route)) bg-blue-100 border-blue-200 text-blue-500 @else bg-gray-100 text-gray-500 border-gray-200 @endif hover:bg-gray-200 px-2 py-1 space-x-2 rounded-md"
        :class="{'justify-center': !isSidebarOpen}"
    >
        <span>
            {{ $slot }}
        </span>
        <span class="pr-3" :class="{ 'lg:hidden': !isSidebarOpen }">{{ $name }}</span>
    </a>
</li>
