<x-app-layout>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
          Tambah Stage Baru
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Buat tahapan audit mutu internal baru
        </p>
      </div>
      <a href="{{ route('stages-management.index') }}"
        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
      </a>
    </div>

    <!-- Create Form -->
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <form action="{{ route('stages-management.store') }}" method="POST">
        @csrf

        <div class="mb-6">
          <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Stage</label>
          <input type="text" name="name" value="{{ old('name') }}" required
            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
            placeholder="Masukkan nama stage">
          @error('name')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
          <textarea name="description" rows="4"
            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
            placeholder="Masukkan deskripsi stage">{{ old('description') }}</textarea>
          @error('description')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- <div class="mb-6">
          <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Urutan</label>
          <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
            placeholder="Masukkan urutan stage">
          @error('order')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div> --}}

        <div class="mb-6">
          <label class="flex cursor-pointer items-center gap-3">
            <input type="checkbox" name="is_active" value="1" checked
              class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <div>
              <p class="text-sm font-medium text-gray-900 dark:text-white">Stage Aktif</p>
              <p class="text-xs text-gray-500 dark:text-gray-400">Stage akan diterapkan jika diaktifkan</p>
            </div>
          </label>
        </div>

        <div class="flex justify-end gap-3">
          <a href="{{ route('stages-management.index') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            Batal
          </a>
          <button type="submit"
            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
            Simpan Stage
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
