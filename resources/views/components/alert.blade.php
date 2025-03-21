@props(['type' => 'success'])

@php
    $baseClass = 'px-4 py-3 rounded mb-4 border';
    $types = [
        'success' => 'bg-green-100 text-green-700 border-green-400',
        'error' => 'bg-red-100 text-red-700 border-red-400',
    ];
@endphp

@if (session($type))
    <div class="{{ $baseClass . ' ' . ($types[$type] ?? $types['success']) }}">
        {{ session($type) }}
    </div>
@endif
