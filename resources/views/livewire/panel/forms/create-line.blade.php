<x-form-section submit="storeLine">
    <x-slot name="title">
        ثبت خط تولید جدید
    </x-slot>

    <x-slot name="description">

    </x-slot>

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
                <x-button class="p-2" color="red" type="button" wire:click="remAttr('{{$i}}')">
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
                <x-button class="p-2" color="red" type="button" wire:click="remMaterial('{{$i}}')">
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
                <x-button class="p-2" color="red" type="button" wire:click="remInput('{{$i}}')">
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
                    >{{ $product->uname() }}</option>
                @endforeach
            </select>
            <x-input-error for="output" class="mt-2"/>
        </div>

        <div class="col-start-1 col-span-6 sm:col-span-4">
            <x-label for="progress_attribute" value="ویژگی برآورد پیشرفت"/>
            <select
                class="form-output rounded-md shadow-sm mt-1 block w-full"
                id="progress_attribute" wire:model.lazy="progress_attribute">
                @foreach($attrs as $attr)
                    @if(!empty($attr['name']) && $attr['type'] == 'number')
                        <option
                            value="{{ $attr['name'] }}"
                        >{{ $attr['name'] }}</option>
                    @endif
                @endforeach
            </select>
            <x-input-error for="progress_attribute" class="mt-2"/>
        </div>

    </x-slot>

    <x-slot name="actions">

        <x-action-message class="ml-3" on="saved">
            ذخیره شد.
        </x-action-message>

        <x-button class="px-4 py-2 ml-3" color="pink" type="button" wire:click="addMaterial">
            ماده اولیه
        </x-button>

        <x-button class="px-4 py-2 ml-3" color="purple" type="button" wire:click="addInput">
            ورودی
        </x-button>

        <x-button class="px-4 py-2 ml-3" color="green" type="button" wire:click="addAttr">
            افزودن ویژگی
        </x-button>

        <x-button class="px-4 py-2">
            ذخیره
        </x-button>
    </x-slot>
</x-form-section>
