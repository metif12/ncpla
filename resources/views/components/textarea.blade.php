@props(['disabled' => false, 'content'=>null])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm']) !!}>{!! $content ?? $slot !!}</textarea>
