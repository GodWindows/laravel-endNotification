@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 darke:border-indigo-600 text-left text-base font-medium text-indigo-700 darke:text-indigo-300 bg-indigo-50 darke:bg-indigo-900/50 focus:outline-none focus:text-indigo-800 darke:focus:text-indigo-200 focus:bg-indigo-100 darke:focus:bg-indigo-900 focus:border-indigo-700 darke:focus:border-indigo-300 transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 darke:text-gray-400 hover:text-gray-800 darke:hover:text-gray-200 hover:bg-gray-50 darke:hover:bg-gray-700 hover:border-gray-300 darke:hover:border-gray-600 focus:outline-none focus:text-gray-800 darke:focus:text-gray-200 focus:bg-gray-50 darke:focus:bg-gray-700 focus:border-gray-300 darke:focus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
