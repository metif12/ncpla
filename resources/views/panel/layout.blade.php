@extends('layouts.base')

@section('body')
    <div class="h-screen overflow-hidden flex items-center justify-center">
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
                <main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
                    <!-- Main content header -->
                    <div
                        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row"
                    >
                        <h1 class="text-2xl font-semibold whitespace-nowrap">Dashboard</h1>
                        <div class="space-x-2">
                            <a
                                href="https://github.com/Kamona-WD/starter-dashboard-layout"
                                target="_blank"
                                class="inline-flex items-center justify-center px-4 py-1 space-x-1 bg-gray-200 rounded-md shadow hover:bg-opacity-20"
                            >
              <span>
                <svg class="w-4 h-4 text-gray-500" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                  <path
                      fill-rule="evenodd"
                      d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"
                  ></path>
                </svg>
              </span>
                <span>View on Github</span>
                </a>
                <a
                    href="https://kamona-wd.github.io/starter-dashboard-layout/"
                    target="_blank"
                    class="inline-flex items-center justify-center px-4 py-1 space-x-1 bg-red-500 text-white rounded-md shadow hover:bg-red-600"
                >
              <span>
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
              </span>
                                <span>View with Charts</span>
                            </a>
                        </div>
                    </div>

                    <!-- Start Content -->
                    <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4">
                        <template x-for="i in 4" :key="i">
                            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                                <div class="flex items-start justify-between">
                                    <div class="flex flex-col space-y-2">
                                        <span class="text-gray-400">Total Users</span>
                                        <span class="text-lg font-semibold">100,221</span>
                                    </div>
                                    <div class="p-10 bg-gray-200 rounded-md"></div>
                                </div>
                                <div>
                                    <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                                    <span>from 2019</span>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Table see (https://tailwindui.com/components/application-ui/lists/tables) -->
                    <h3 class="mt-6 text-xl">Users</h3>
                    <div class="flex flex-col mt-6">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                                    <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            >
                                                Name
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            >
                                                Title
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            >
                                                Status
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                                            >
                                                Role
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <template x-for="i in 10" :key="i">
                                            <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 w-10 h-10">
                                                            <img
                                                                class="w-10 h-10 rounded-full"
                                                                src="{{ url('img/profile.png') }}"
                                                                alt=""
                                                            />
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">Ahmed Kamel
                                                            </div>
                                                            <div class="text-sm text-gray-500">ahmed.kamel@example.com
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Regional Paradigm Technician
                                                    </div>
                                                    <div class="text-sm text-gray-500">Optimization</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                            >
                              Active
                            </span>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">Admin</td>
                                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                            </tr>
                                        </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <!-- Setting panel button -->
            <div>
                <button
                    @click="isSettingsPanelOpen = true"
                    class="fixed left-0 px-4 py-2 text-sm font-medium text-white uppercase transform rotate-90 -translate-x-8 bg-gray-600 top-1/2 rounded-t-md"
                >
                    Settings
                </button>
            </div>

            <!-- Settings panel -->
            <div
                x-show="isSettingsPanelOpen"
                @click.away="isSettingsPanelOpen = false"
                x-transition:enter="transition transform duration-300"
                x-transition:enter-start="translate-x-0 opacity-30 ease-in"
                x-transition:enter-end="translate-x-full opacity-100 ease-out"
                x-transition:leave="transition transform duration-300"
                x-transition:leave-start="translate-x-full opacity-100 ease-out"
                x-transition:leave-end="translate-x-0 opacity-0 ease-in"
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
