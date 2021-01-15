@extends('panel.layout')

@section('content')
    <livewire:panel.products-list/>
    <x-floating-button @click="window.location = '{{ route('panel.product-create') }}'" wire:loading.attr="disabled">
        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             aria-hidden="true" focusable="false" width="1em" height="1em"
             style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
             preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
            <g fill="white">
                <path fill-rule="evenodd"
                      d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
            </g>
        </svg>
    </x-floating-button>
@endsection
