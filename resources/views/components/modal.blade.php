@props(['id', 'title', 'show' => false])

<div x-data="{ open: @js($show) }" x-show="open" x-cloak
  class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto"
  @keydown.escape.window="open = false">

  <!-- Backdrop -->
  <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="open = false"></div>

  <!-- Modal -->
  <div x-show="open" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100 translate-y-0"
    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
    class="relative z-10 w-full max-w-lg transform rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
    role="dialog" aria-modal="true" aria-labelledby="{{ $id }}-title">

    <!-- Close button -->
    <button type="button" @click="open = false"
      class="absolute right-4 top-4 rounded-lg p-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-800 dark:hover:text-gray-300">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>

    <!-- Header -->
    <div class="mb-4">
      <h3 id="{{ $id }}-title" class="text-lg font-semibold text-gray-900 dark:text-white">
        {{ $title }}
      </h3>
    </div>

    <!-- Content -->
    <div class="space-y-4">
      {{ $slot }}
    </div>
  </div>
</div>
