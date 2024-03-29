<div>
    <x-section-title>
        <x-slot name="title">لیست گزارشات خطوط تولید</x-slot>
        <x-slot name="description"></x-slot>
    </x-section-title>

    <div class="mb-4 mt-5 flex justify-between items-center">
        <div class="flex-1 pl-4">
            <div wire:loading.class="bg-gray-100"
                 wire:target="search"
                 class="relative rounded-lg shadow overflow-hidden bg-white md:w-1/3">
                <input type="search"
                       wire:model.debounce.750ms="search"
                       wire:loading.attr="disabled"
                       class="w-full pl-10 pr-4 py-2 bg-transparent rounded-lg focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                       placeholder="جست و جو ..">
                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <circle cx="10" cy="10" r="7"/>
                        <line x1="21" y1="21" x2="15" y2="15"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
         style="max-height: 75vh;">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
            <tr class="text-right">

                <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                    <label
                        class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                        <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline">
                    </label>
                </th>

                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    #
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    خط تولید
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    شیفت
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    کاربر
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    عملکرد (در دقیقه)
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    جمع وقفه ها (دقیقه)
                </th>
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    تاریخ ثبت
                </th>

                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-2 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    عملیات
                </th>

            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                <tr class="">
                    <td class="p-2 border-dashed border-t border-gray-200 px-3">
                        <label
                            class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                            <input type="checkbox"
                                   class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline">
                        </label>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                            <span class="text-gray-700 flex items-center">
                                {{ $report->code }}
                            </span>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                        <a href="{{ route('panel.line-edit', $report->line) }}"
                           class="text-gray-700 flex items-center">
                            {{ $report->line->name }}
                        </a>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                        <span class="text-gray-700 flex items-center">
                            {{ $report->shift->start }}
                        </span>
                        تا
                        <span class="text-gray-700 flex items-center">
                            {{ $report->shift->end }}
                        </span>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                        <a href="{{ route('panel.user-edit', $report->user) }}"
                           class="text-gray-700 flex items-center">
                            {{ $report->user->name }}
                        </a>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                        <span class="text-green-700 flex items-center">
                            {{ round($report->performance(),2) }} {{ \Illuminate\Support\Facades\DB::table('line_attributes')->where('line_id', $report->line_id)->where('name', $report->line->progress_attribute)->value('unit') }}
                        </span>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                        <span class="text-green-700 flex items-center">
                            {{ $report->interrupt() }}
                        </span>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                            <span class="text-gray-700 flex items-center">
                                {{ verta($report->cretaed_at) }}
                            </span>
                    </td>

                    <td class="p-2 border-dashed border-t border-gray-200">
                        <x-abutton class="p-2" color="yellow" href="{{ route('panel.report-edit', $report) }}">
                            ویرایش
                        </x-abutton>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reports->links() }}
    </div>
</div>
