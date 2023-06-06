@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 darke:border-gray-700 darke:bg-gray-900 darke:text-gray-300 focus:border-indigo-500 darke:focus:border-indigo-600 focus:ring-indigo-500 darke:focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
