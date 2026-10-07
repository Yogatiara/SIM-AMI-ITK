@props(['title', 'description', 'icon'])

<div class="flex flex-col gap-1">
  <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
    {{ $title }}
  </h1>
  @if (isset($description))
    <p class="text-sm text-gray-500 dark:text-gray-400">
      {{ $description }}
    </p>
  @endif
</div>
