@props(['href' => null, 'type' => 'button'])

@if ($href)
  <a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 rounded-lg bg-rose-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 dark:bg-rose-500 dark:hover:bg-rose-400 dark:focus:ring-offset-gray-900']) }}>
    {{ $slot }}
  </a>
@else
  <button type="{{ $type }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 rounded-lg bg-rose-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 dark:bg-rose-500 dark:hover:bg-rose-400 dark:focus:ring-offset-gray-900']) }}>
    {{ $slot }}
  </button>
@endif
