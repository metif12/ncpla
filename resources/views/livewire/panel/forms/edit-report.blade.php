<x-form-section submit="storeReport">
    <x-slot name="title">
        ویرایش گزارش تولید
    </x-slot>

    <x-slot name="description">

    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="نام خط"/>
            <x-input id="name" type="text" class="bg-gray-100 mt-1 block w-full" value="{{ $task->line->name }}" disabled />
            <x-input-error for="name" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="shift" value="شیفت"/>
            <x-input id="shift" type="text" class="bg-gray-100 mt-1 block w-full" value="{{ $shift->start }} تا {{ $shift->end }}" disabled />
            <x-input-error for="shift" class="mt-2"/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="progress" value=" پیشرفت : {{ $task->line->progress_field }}"/>
            <x-input id="progress" type="number" step="any" class="mt-1 block w-full" wire:model.lazy="progress"/>
            <x-input-error for="progress" class="mt-2"/>
        </div>

        @foreach($materials as $i => $material)
            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="materials.{{$i}}.value" value="{{ $material['name'] }} مصرف شده به {{ $material['unit'] }}"/>
                <x-input id="materials.{{$i}}.value" type="number" step="any" class="mt-1 block w-full" wire:model.lazy="materials.{{$i}}.value"/>
                <x-input-error for="materials.{{$i}}.value" class="mt-2"/>
            </div>
        @endforeach

        @foreach($inputs as $i => $input)
            <hr class="col-start-1 col-span-6 sm:col-span-4">

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="inputs.{{$i}}.product_id" value="{{ $i+1 }}. ورودی"/>
                <select
                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                    id="inputs.{{$i}}.product_id" wire:model.lazy="inputs.{{$i}}.product_id">
                    @foreach($task->line->inputs as $product)
                        <option
                            value="{{ $product->id }}"
                        >{{ $product->code }} - {{ $product->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="inputs.{{$i}}.product_id" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="inputs.{{$i}}.code" value="شماره شناسایی"/>
                <x-input id="inputs.{{$i}}.code" type="text" step="any" class="mt-1 block w-full" wire:model.lazy="inputs.{{$i}}.code"/>
                <x-input-error for="inputs.{{$i}}.code" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6">
                <x-button class="p-2" color="red" wire:loading.attr="disabled" type="button" wire:click="remInput('{{$i}}')">
                    حذف
                </x-button>
            </div>
        @endforeach

        @foreach($outputs as $i => $output)
            <hr class="col-start-1 col-span-6 sm:col-span-4">

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="outputs.{{$i}}.product_id" value="{{ $i+1 }}. خروجی مربوط به ورودی"/>
                <select
                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                    id="outputs.{{$i}}.product_id" wire:model.lazy="outputs.{{$i}}.product_id">
                    <option
                        value="0"
                    >هیچکدام</option>
                    @foreach($inputs as $input)
                        <option
                            value="{{ $input['code'] }}"
                        >{{ $input['code'] }}</option>
                    @endforeach
                </select>
                <x-input-error for="outputs.{{$i}}.product_id" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6 sm:col-span-4">
                <x-label for="outputs.{{$i}}.code" value="شماره شناسایی"/>
                <x-input id="outputs.{{$i}}.code" type="text" step="any" class="mt-1 block w-full" wire:model.lazy="outputs.{{$i}}.code"/>
                <x-input-error for="outputs.{{$i}}.code" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="outputs.{{$i}}.progress" value="پیشرفت"/>
                <x-input id="outputs.{{$i}}.progress" type="number" step="any" class="mt-1 block w-full" wire:model.lazy="outputs.{{$i}}.progress"/>
                <x-input-error for="outputs.{{$i}}.progress" class="mt-2"/>
            </div>

            <div class="col-start-1 col-span-6">
                <x-button class="p-2" color="red" wire:loading.attr="disabled" type="button" wire:click="remOutput('{{$i}}')">
                    حذف
                </x-button>
            </div>
        @endforeach


        <hr class="col-start-1 col-span-6 sm:col-span-4">

        <div class="col-span-6 sm:col-span-4">
            <x-label for="description" value="توضیحات"/>
            <x-textarea id="description" type="number" step="any" class="mt-1 block w-full" wire:model.lazy="description"/>
            <x-input-error for="description" class="mt-2"/>
        </div>

    </x-slot>

    <x-slot name="actions">

        <x-action-message class="ml-3" on="saved">
            ذخیره شد.
        </x-action-message>

        <x-button class="px-4 py-2 ml-3" color="red" wire:loading.attr="disabled" type="button" wire:click="confirm">
            تایید
        </x-button>

        <x-button class="px-4 py-2 ml-3" color="pink" wire:loading.attr="disabled" type="button" wire:click="addOutput">
            خروجی
        </x-button>

        <x-button class="px-4 py-2 ml-3" color="purple" wire:loading.attr="disabled" type="button" wire:click="addInput">
            ورودی
        </x-button>

        <x-button class="px-4 py-2">
            ذخیره
        </x-button>
    </x-slot>
</x-form-section>