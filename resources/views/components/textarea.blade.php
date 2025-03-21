@props(['rows' => 4])

<textarea rows="{{ $rows }}" {!! $attributes->merge([
    'class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500',
]) !!}>
    {{ $slot }}
</textarea>
