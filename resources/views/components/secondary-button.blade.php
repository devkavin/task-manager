@props(['href' => null])

@if ($href)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition']) }}>
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge(['type' => 'button', 'class' => 'bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition']) }}>
        {{ $slot }}
    </button>
@endif
