<div>

    <x-section-title>
        <x-slot name="title">ویرایش خط تولید</x-slot>
        <x-slot name="description"></x-slot>
    </x-section-title>

    <div class="pt-2" x-data="{index : (localStorage.edit_line_index ? localStorage.edit_line_index : 1)}">
        <div class="my-2">

            <div class="bg-white shadow rounded-md overflow-hidden">

                <nav class="flex flex-no-wrap overflow-y-auto">
                    <a
                        href="{{ route('panel.lines') }}"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == -1}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        <svg class="w-6 h-6" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em"
                             height="1em"
                             style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                             preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                            <g fill="#626262">
                                <path fill-rule="evenodd"
                                      d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd"
                                      d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"/>
                            </g>
                        </svg>
                    </a>
                    <button
                        @click="index=3;localStorage.setItem('edit_line_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 3}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        ویرایش
                    </button>
                    <button
                        @click="index=1;localStorage.setItem('edit_line_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 1}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        لیست افراد
                    </button>
                    <button
                        @click="index=2;localStorage.setItem('edit_line_index',index);"
                        :class="{'text-blue-500 border-b-2 font-medium border-blue-500' : index == 2}"
                        class="flex-shrink-0 text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                        افزودن فرد
                    </button>

                </nav>
            </div>

            <div x-show="index == 3" class="mt-4 mx-2">
                <x-form-section submit="storeLine">

                    <x-slot name="form">

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="name" value="نام خط"/>
                            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="name"/>
                            <x-input-error for="name" class="mt-2"/>
                        </div>

                        @foreach($attrs as $i => $attr)
                            <hr class="col-start-1 col-span-6 sm:col-span-4">

                            <div class="col-start-1 col-span-6 sm:col-span-4">
                                <x-label for="attrs.{{$i}}.name" value="{{ $i+1 }}. عنوان ویژگی"/>
                                <x-input id="attrs.{{$i}}.name" type="text" class="mt-1 block w-full"
                                         wire:model.lazy="attrs.{{$i}}.name"/>
                                <x-input-error for="attrs.{{$i}}.name" class="mt-2"/>
                            </div>

                            <div class="col-start-1 col-span-6 sm:col-span-3 sm:col-start-1">
                                <x-label for="attrs.{{$i}}.type" value="نوع مقدار"/>
                                <select
                                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    id="attrs.{{$i}}.type" wire:model.lazy="attrs.{{$i}}.type">
                                    @foreach(\App\Models\Product::$types as $type)
                                        <option value="{{ $type['value'] }}">{{ $type['name'] }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="attrs.{{$i}}.type" class="mt-2"/>
                            </div>

                            <div class="col-start-1 col-span-6 sm:col-span-3 sm:col-start-4">
                                <x-label for="attrs.{{$i}}.merge_type" value="نوع ادغام"/>
                                <select
                                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    id="attrs.{{$i}}.merge_type" wire:model.lazy="attrs.{{$i}}.merge_type">
                                    @foreach(\App\Models\Product::$merge_types as $type)
                                        <option value="{{ $type['value'] }}">{{ $type['name'] }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="attrs.{{$i}}.merge_type" class="mt-2"/>
                            </div>

                            <div class="col-start-1 col-span-6 sm:col-span-3 sm:col-start-1">
                                <x-label for="attrs.{{$i}}.unit" value="واحد"/>
                                <x-input id="attrs.{{$i}}.unit" type="text"
                                         class="mt-1 block w-full"
                                         wire:model.lazy="attrs.{{$i}}.unit"/>
                                <x-input-error for="attrs.{{$i}}.unit" class="mt-2"/>
                            </div>

                            <div class="col-start-1 col-span-6 sm:col-span-3 sm:col-start-4">
                                <x-label for="attrs.{{$i}}.default" value="مقدار پیش فرض"/>
                                <x-input id="attrs.{{$i}}.default" type="text" class="mt-1 block w-full"
                                         wire:model.lazy="attrs.{{$i}}.default"/>
                                <x-input-error for="attrs.{{$i}}.default" class="mt-2"/>
                            </div>

                            <div class="col-start-1 col-span-6">
                                <x-button class="p-2" color="red" wire:loading.attr="disabled" type="button"
                                          wire:click="remAttr('{{$i}}')">
                                    حذف
                                </x-button>
                            </div>

                        @endforeach

                        @foreach($materials as $i => $material)
                            <hr class="col-start-1 col-span-6 sm:col-span-4">

                            <div class="col-start-1 col-span-6 sm:col-span-4">
                                <x-label for="materials.{{$i}}" value="{{ $i+1 }}. ماده اولیه"/>
                                <select
                                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    id="materials.{{$i}}" wire:model.lazy="materials.{{$i}}">
                                    @foreach($materials_list as $mat)
                                        <option
                                            value="{{ $mat->id }}"
                                            @if(in_array($mat->id,$materials) && $mat->id!=$material)
                                            disabled
                                            @endif
                                        >{{ $mat->code }} - {{ $mat->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="materials.{{$i}}" class="mt-2"/>
                            </div>

                            <div class="col-start-1 col-span-6">
                                <x-button class="p-2" color="red" wire:loading.attr="disabled" type="button"
                                          wire:click="remMaterial('{{$i}}')">
                                    حذف
                                </x-button>
                            </div>
                        @endforeach

                        @foreach($inputs as $i => $input)
                            <hr class="col-start-1 col-span-6 sm:col-span-4">

                            <div class="col-start-1 col-span-6 sm:col-span-4">
                                <x-label for="inputs.{{$i}}" value="{{ $i+1 }}. ورودی"/>
                                <select
                                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    id="inputs.{{$i}}" wire:model.lazy="inputs.{{$i}}">
                                    @foreach($product_list as $product)
                                        <option
                                            value="{{ $product->id }}"
                                            @if((in_array($product->id,$inputs)||$product->id==$output) && $product->id!=$input)
                                            disabled
                                            @endif
                                        >{{ $product->code }} - {{ $product->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="inputs.{{$i}}" class="mt-2"/>
                            </div>

                            <div class="col-start-1 col-span-6">
                                <x-button class="p-2" color="red" wire:loading.attr="disabled" type="button"
                                          wire:click="remInput('{{$i}}')">
                                    حذف
                                </x-button>
                            </div>
                        @endforeach

                        <hr class="col-start-1 col-span-6 sm:col-span-4">

                        <div class="col-start-1 col-span-6 sm:col-span-4">
                            <x-label for="output" value="خروجی"/>
                            <select
                                class="form-output rounded-md shadow-sm mt-1 block w-full"
                                id="output" wire:model.lazy="output">
                                @foreach($product_list as $product)
                                    <option
                                        value="{{ $product->id }}"
                                        @if(in_array($product->id,$inputs))
                                        disabled
                                        @endif
                                    >{{ $product->code }} - {{ $product->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="output" class="mt-2"/>
                        </div>

                    </x-slot>

                    <x-slot name="actions">

                        <x-action-message class="ml-3" on="saved">
                            ذخیره شد.
                        </x-action-message>

                        <x-button class="px-4 py-2 ml-3" color="pink" wire:loading.attr="disabled" type="button"
                                  wire:click="addMaterial">
                            ماده اولیه
                        </x-button>

                        <x-button class="px-4 py-2 ml-3" color="purple" wire:loading.attr="disabled" type="button"
                                  wire:click="addInput">
                            ورودی
                        </x-button>

                        <x-button class="px-4 py-2 ml-3" color="green" wire:loading.attr="disabled" type="button"
                                  wire:click="addAttr">
                            افزودن ویژگی
                        </x-button>

                        <x-button class="px-4 py-2">
                            ذخیره
                        </x-button>
                    </x-slot>
                </x-form-section>
            </div>

            <div x-show="index == 1" class="mt-4 mx-2">
                <livewire:panel.line-users-list :line="$line" />
            </div>

            <div x-show="index == 2" class="mt-4 mx-2">
                <div class="w-full grid gap-2 grid-cols-6">
                    <div class="col-span-6 sm:col-span-4">
                        <div wire:loading.class="bg-gray-100"
                             wire:target="searchUsers"
                             class="relative rounded-lg shadow overflow-hidden bg-white">
                            <input type="search"
                                   wire:model.debounce.750ms="searchUsers"
                                   wire:loading.attr="disabled"
                                   class="w-full pl-10 pr-4 py-2 bg-transparent rounded-lg focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                   placeholder="جست و جوی افراد ">
                            <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400"
                                     viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <circle cx="10" cy="10" r="7"/>
                                    <line x1="21" y1="21" x2="15" y2="15"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    @foreach($users as $user)
                        <div class="col-span-6 sm:col-span-4">
                            <div class="flex bg-white p-1 rounded shadow cursor-pointer"
                                 wire:click="toggleUser('{{ $user->id }}')">
                                <span class="p-2">
                                    @if(!$user->hasLine($line))
                                        <x-icons.unchecked class="w-6 h-6"></x-icons.unchecked>
                                    @else
                                        <x-icons.checked class="w-6 h-6"></x-icons.checked>
                                    @endif
                                </span>
                                <span class="p-2" wire:loading>
                                    <x-icons.loading class="w-6 h-6"></x-icons.loading>
                                </span>
                                <span class="p-2">{{ $user->name }}</span>
                                <span class="mr-auto p-2">{{ $user->national_code }}</span>
                                <span class="mr-auto p-2">{{ $user->mobile }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
