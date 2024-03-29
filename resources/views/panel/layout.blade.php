@extends('layouts.base')

@section('body')
    <div class="h-screen overflow-hidden flex items-center justify-center bg-gray-100">
        <div class="flex h-screen w-screen overflow-y-hidden" x-data="setup()"
             x-init="$refs.loading.classList.add('hidden')">
            <!-- Loading screen -->
            <div
                x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-white bg-black bg-opacity-50"
                style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
            >
                Loading.....
            </div>

            <!-- Sidebar backdrop -->
            <div
                x-show.in.out.opacity="isSidebarOpen"
                class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
                style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
            ></div>

            <!-- Sidebar -->
            @include('panel.sidebar')

            <div class="flex flex-col flex-1 h-full overflow-hidden">
                <!-- Navbar -->
                @include('panel.navbar')
                <!-- Main content -->
                <main class="flex-1 h-full p-6 overflow-hidden overflow-y-auto bg-gray-100">
                    @yield('content')

                    @isset($slot)
                        {{ $slot }}
                    @endisset

                    <div class="h-6"></div>
                </main>
            </div>

            <!-- Setting panel button -->
            <div>
                <button
                    @click="isSettingsPanelOpen = true"
                    class="hidden fixed left-0 px-4 py-1 md:py-2 text-sm font-medium text-white uppercase rotate-90 transform -translate-x-5 bg-gray-600 top-1/2 rounded-t-md"
                >
                    تنظیمات
                </button>
            </div>

            <!-- Settings panel -->
            <div
                x-show="isSettingsPanelOpen"
                @click.away="isSettingsPanelOpen = false"
                x-transition:enter="transition transform duration-300"
                x-transition:enter-start="translate-x-64 opacity-30 ease-in"
                x-transition:enter-end="translate-x-0 opacity-100 ease-out"
                x-transition:leave="transition transform duration-300"
                x-transition:leave-start="translate-x-0 opacity-100 ease-out"
                x-transition:leave-end="translate-x-64 opacity-0 ease-in"
                class="fixed inset-y-0 left-0 flex flex-col bg-white shadow-lg w-80"
                style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
            >
                <div class="flex items-center justify-between flex-shrink-0 p-2">
                    <h6 class="p-2 text-lg">Settings</h6>
                    <button @click="isSettingsPanelOpen = false" class="p-2 rounded-md focus:outline-none focus:ring">
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
                <div class="flex-1 max-h-full p-4 overflow-hidden hover:overflow-y-scroll">
                    <span>Settings Content</span>
                    <!-- Settings Panel Content ... -->
                </div>
            </div>
        </div>
        <script>
            const setup = () => {
                return {
                    loading: true,
                    isSidebarOpen: false,
                    toggleSidbarMenu() {
                        this.isSidebarOpen = !this.isSidebarOpen
                    },
                    isSettingsPanelOpen: false,
                    isSearchBoxOpen: false,
                }
            }
        </script>
@endsection
