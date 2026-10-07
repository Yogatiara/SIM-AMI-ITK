@php
  $hour = now()->hour;
  if ($hour < 11) {
      $greeting = 'Selamat pagi';
  } elseif ($hour < 15) {
      $greeting = 'Selamat siang';
  } elseif ($hour < 19) {
      $greeting = 'Selamat sore';
  } else {
      $greeting = 'Selamat malam';
  }
@endphp

<div
  class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-white shadow-lg dark:from-blue-700 dark:to-blue-800">
  <!-- Decorative Elements -->
  <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10"></div>
  <div class="absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-white/10"></div>
  <div class="absolute right-20 bottom-5 h-16 w-16 rounded-full bg-white/5"></div>

  <div class="relative z-10">
    <div class="flex items-start justify-between">
      <div>
        <h1 class="text-2xl font-semibold">{{ $greeting }}, {{ Auth::user()->name }}!</h1>
        <p class="mt-1 text-sm text-blue-100">
          Selamat datang di Sistem Automasi Tertata dan Realisasi Integritas Audit Mutu Internal Institut Teknologi
          Kalimantan
        </p>
      </div>
      <div class="hidden sm:block">
        <div class="rounded-xl bg-white/10 px-4 py-2 backdrop-blur-sm">
          <p class="text-xs text-blue-100">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
      </div>
    </div>

    <div class="mt-6 flex flex-wrap items-center gap-4">
      <div class="flex items-center gap-2 rounded-lg bg-white/10 px-3 py-1.5 backdrop-blur-sm">
        <svg class="h-4 w-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <span class="text-sm">{{ $userRole }}</span>
      </div>
      <div class="flex items-center gap-2 rounded-lg bg-white/10 px-3 py-1.5 backdrop-blur-sm">
        <svg class="h-4 w-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span class="text-sm">{{ now()->translatedFormat('d F Y') }}</span>
      </div>
    </div>
  </div>
</div>
