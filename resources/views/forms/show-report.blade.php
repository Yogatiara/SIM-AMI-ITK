<x-app-layout>
  <div x-data="user()" class="flex h-full w-full flex-col gap-y-1 font-semibold">
    <div class="flex items-center justify-between">
      <div class="flex min-w-0 items-center gap-2 text-sm">
        <a href="/forms"
          class="shrink-0 text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          Daftar Formulir
        </a>

        <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>

        <span class="max-w-[8rem] truncate font-medium text-gray-900 dark:text-white">
          {{ $form->document->name }}
        </span>

        <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>

        <span class="hidden max-w-[12rem] truncate font-medium text-gray-900 dark:text-white sm:block">
          {{ $form->unit->name }}
        </span>

        <svg class="hidden h-4 w-4 shrink-0 text-gray-400 sm:block" fill="none" stroke="currentColor"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>

        <span class="hidden font-medium text-gray-900 dark:text-white lg:block">
          Report
        </span>
      </div>
    </div>

    @if ($form->signing && Storage::exists('public/' . $form->signing))
      <embed class="rounded-2xl mt-2" src="{{ Storage::url($form->signing) }}#toolbar=0" type="application/pdf"
        width="100%" height="650px" class="rounded-lg border">
    @else
      <div
        class="w-full h-[85%] overflow-y-auto scrollbar-thin dark:scrollbar-track-gray-500 dark:scrollbar-thumb-gray-800">
        <div class="flex h-full items-center justify-center">
          <p class="font-semibold text-red-500">File tidak ditemukan.</p>
        </div>
      </div>
    @endif

    <div class="flex justify-between py-2">
      <a href="/forms"
        class="rounded-md bg-gray-500 px-4 py-2 text-xs uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:shadow-outline-gray">
        Kembali
      </a>
    </div>
  </div>
</x-app-layout>
