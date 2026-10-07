@props(['id', 'title', 'message', 'confirmText' => 'Konfirmasi', 'cancelText' => 'Batal'])

<div x-data="{ open: false, action: null }" x-show="open" x-cloak
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
    class="relative z-10 w-full max-w-md transform rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
    role="dialog" aria-modal="true">

    <!-- Icon -->
    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-rose-100 dark:bg-rose-900/30">
      <svg class="h-6 w-6 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
      </svg>
    </div>

    <!-- Content -->
    <div class="text-center">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        {{ $title }}
      </h3>
      <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
        {{ $message }}
      </p>
    </div>

    <!-- Actions -->
    <div class="mt-6 flex gap-3">
      <button type="button" @click="open = false"
        class="flex-1 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
        {{ $cancelText }}
      </button>
      <button type="button" @click="action(); open = false"
        class="flex-1 rounded-lg bg-rose-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-rose-500 dark:bg-rose-500 dark:hover:bg-rose-400">
        {{ $confirmText }}
      </button>
    </div>
  </div>
</div>
