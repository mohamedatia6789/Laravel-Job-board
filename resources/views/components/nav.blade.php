@php
    $current = "bg-gray-950 px-3 py-2 text-sm font-medium text-white";
    $default = "text-gray-300 hover:bg-white/5 hover:text-white";
@endphp

<a aria-current="page" class="rounded-md {{$action ? $current : $default }}" {{ $attributes }}>
{{ $slot }}</a>
