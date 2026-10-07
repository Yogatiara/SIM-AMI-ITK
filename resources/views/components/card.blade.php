@props(['padding' => 'p-6'])

<div {{ $attributes->merge(['class' => "rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800 {$padding}"]) }}>
  {{ $slot }}
</div>
