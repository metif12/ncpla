<x-form-section submit="storeLine">
    <x-slot name="title">
        ویرایش خط تولید
    </x-slot>

    <x-slot name="description">

    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="نام خط"/>
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="name"/>
            <x-input-error for="name" class="mt-2"/>
        </div>

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
                            @if((in_array($product->id,$inputs)||in_array($product->id,$outputs)) && $product->id!=$input)
                            disabled
                            @endif
                        >{{ $product->code }} - {{ $product->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="inputs.{{$i}}" class="mt-2"/>
            </div>
        @endforeach

        @foreach($outputs as $i => $output)
            <hr class="col-start-1 col-span-6 sm:col-span-4">

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="outputs.{{$i}}" value="{{ $i+1 }}. خروجی"/>
                <select
                    class="form-output rounded-md shadow-sm mt-1 block w-full"
                    id="outputs.{{$i}}" wire:model.lazy="outputs.{{$i}}">
                    @foreach($product_list as $product)
                        <option
                            value="{{ $product->id }}"
                            @if((in_array($product->id,$inputs)||in_array($product->id,$outputs)) && $product->id!=$output)
                            disabled
                            @endif
                        >{{ $product->code }} - {{ $product->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="outputs.{{$i}}" class="mt-2"/>
            </div>
        @endforeach

    </x-slot>

    <x-slot name="actions">

        <x-action-message class="ml-3" on="saved">
            ذخیره شد.
        </x-action-message>

        <x-button color="pink" wire:loading.attr="disabled" class="ml-3" type="button" wire:click="addMaterial">
            ماده اولیه
        </x-button>

        <x-button color="purple" wire:loading.attr="disabled" class="ml-3" type="button" wire:click="addInput">
            ورودی
        </x-button>

        <x-button color="red" wire:loading.attr="disabled" class="ml-3" type="button" wire:click="addOutput">
            خروجی
        </x-button>

        <x-button>
            ذخیره
        </x-button>
    </x-slot>
</x-form-section>
