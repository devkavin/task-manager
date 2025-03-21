@props(['href' => null])

@if ($href)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition']) }}>
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition']) }}>
        {{ $slot }}
    </button>
@endif
