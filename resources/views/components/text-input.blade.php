@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '!bg-white text-gray-900 border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm']) !!}>
