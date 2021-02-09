<aside
    x-transition:enter="transition transform duration-300"
    x-transition:enter-start="-translate-x-full opacity-30  ease-in"
    x-transition:enter-end="translate-x-0 opacity-100 ease-out"
    x-transition:leave="transition transform duration-300"
    x-transition:leave-start="translate-x-0 opacity-100 ease-out"
    x-transition:leave-end="-translate-x-full opacity-0 ease-in"
    class="fixed bg-white inset-y-0 z-10 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-white border-l shadow-lg lg:z-auto lg:static lg:shadow-none"
    :class="{'translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen}"
>
    <!-- sidebar header -->
    <div class="flex items-center justify-between flex-shrink-0 p-2"
         :class="{'lg:justify-center': !isSidebarOpen}">
                    <span
                        class="p-2 w-full text-center inline-block text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
<button @click="toggleSidbarMenu()" class="p-2 rounded-md focus:outline-none focus:ring hidden lg:inline">
                <svg
                    class="w-4 h-4 text-gray-600"
                    :class="{'transform transition-transform -rotate-180': !isSidebarOpen}"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                </svg>
            </button>
                        <x-logo class="h-8 lg:hidden" />
                    </span>
        <button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
            <svg
                class="w-6 h-6 text-gray-600"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <!-- Sidebar links -->
    <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
        <ul class="p-2 overflow-hidden">
            <x-sidebar-item route="panel.dashboard" name="داشبورد">
                <svg
                    class="w-6 h-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                    />
                </svg>
            </x-sidebar-item>

            <x-sidebar-item route="panel.orders" name="سفارش ها">
                <x-icons.order class="w-6 h-6"/>
            </x-sidebar-item>
            <x-sidebar-item route="panel.tasks" name="دستور کارها">
                <x-icons.tasks class="w-6 h-6"/>
            </x-sidebar-item>

            <x-sidebar-item route="panel.products" name="محصولات">
                <x-icons.product class="w-6 h-6"/>
            </x-sidebar-item>

            <x-sidebar-item route="panel.lines" name="خطوط تولید">
                <x-icons.line class="w-6 h-6"/>
            </x-sidebar-item>

            <x-sidebar-item route="panel.materials" name="مواد اولیه">
                <x-icons.material class="w-6 h-6"/>
            </x-sidebar-item>

            <x-sidebar-item route="panel.users" name="افراد">
                <x-icons.users class="w-6 h-6"/>
            </x-sidebar-item>
            <x-sidebar-item route="panel.groups" name="گروه ها">
                <x-icons.groups class="w-6 h-6"/>
            </x-sidebar-item>
            <x-sidebar-item route="panel.permissions" name="مجوزها">
                <x-icons.permissions class="w-6 h-6"/>
            </x-sidebar-item>
        </ul>
    </nav>
    <!-- Sidebar footer -->
    <div class="flex-shrink-0 p-2 max-h-14">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button
                type="submit"
                class="flex items-center justify-center bg-gray-100 text-red-500 w-full px-2 py-1 space-x-1 font-medium  shadow-m border border-red-200 hover:bg-red-300 rounded-md focus:outline-none focus:ring"
            >
            <span>
              <svg
                  class="w-6 h-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
              >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                />
              </svg>
            </span>
                <span class="pr-1" :class="{'lg:hidden': !isSidebarOpen}">خروج</span>
            </button>
        </form>
    </div>
</aside>
