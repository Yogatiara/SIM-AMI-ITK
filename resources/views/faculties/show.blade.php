<x-app-layout>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
          {{ $faculty->name }}
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Kode: {{ $faculty->code }}
        </p>
      </div>
      <a href="{{ route('faculties.index') }}"
        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
      </a>
    </div>

    <!-- Faculty Info -->
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Informasi Fakultas</h2>
      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
          <p class="text-xs text-gray-500 dark:text-gray-400">Nama Fakultas</p>
          <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $faculty->name }}</p>
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
          <p class="text-xs text-gray-500 dark:text-gray-400">Kode</p>
          <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $faculty->code }}</p>
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
          <p class="text-xs text-gray-500 dark:text-gray-400">Jumlah Jurusan</p>
          <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $faculty->departments->count() }}</p>
        </div>
      </div>
    </div>

    <!-- Departments & Units -->
    <div class="space-y-4">
      <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Jurusan & Program Studi</h2>

      @forelse ($faculty->departments as $department)
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
          <div class="mb-4 flex items-center justify-between">
            <div>
              <h3 class="text-base font-semibold text-gray-900 dark:text-white">{{ $department->name }}</h3>
              <p class="text-xs text-gray-500 dark:text-gray-400">Kode: {{ $department->code }}</p>
            </div>
            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
              {{ $department->units->count() }} Program Studi
            </span>
          </div>

          <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($department->units as $unit)
              <div class="rounded-lg border border-gray-200 p-3 dark:border-gray-700">
                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $unit->name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Kode: {{ $unit->code }}</p>
              </div>
            @empty
              <p class="text-sm text-gray-400 dark:text-gray-500">Belum ada program studi</p>
            @endforelse
          </div>
        </div>
      @empty
        <div class="rounded-2xl bg-white p-6 text-center shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
          <p class="text-sm text-gray-400 dark:text-gray-500">Belum ada jurusan</p>
        </div>
      @endforelse
    </div>
  </div>
</x-app-layout>
