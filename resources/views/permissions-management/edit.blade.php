<x-app-layout>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
          Edit Permission
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Ubah permission {{ $permission->name }}
        </p>
      </div>
      <a href="{{ route('permissions-management.index') }}"
        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
      </a>
    </div>

    <!-- Edit Form -->
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <form action="{{ route('permissions-management.update', $permission) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
          <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Permission</label>
          <input type="text" name="name" value="{{ old('name', $permission->name) }}" required
            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
            placeholder="Masukkan nama permission">
          @error('name')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @error
        </div>

        <div class="mb-6">
          <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
          <textarea name="description" rows="3"
            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
            placeholder="Masukkan deskripsi permission">{{ old('description', $permission->description) }}</textarea>
          @error('description')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @error
        </div>

        <div class="mb-6">
          <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-300">Digunakan oleh Role</label>
          <div class="flex flex-wrap gap-2">
            @foreach ($permission->roles as $role)
              <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                {{ $role->name }}
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </span>
            @endforeach
            @if ($permission->roles->count() === 0)
              <span class="text-sm text-gray-400 dark:text-gray-500">Belum digunakan oleh role manapun</span>
            @endif
          </div>
        </div>

        <div class="flex justify-end gap-3">
          <a href="{{ route('permissions-management.index') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            Batal
          </a>
          <button type="submit"
            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>

    <!-- Permission Info -->
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Informasi Permission</h2>
      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
          <p class="text-xs text-gray-500 dark:text-gray-400">Jumlah Role</p>
          <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $permission->roles->count() }}</p>
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
          <p class="text-xs text-gray-500 dark:text-gray-400">Dibuat Pada</p>
          <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $permission->created_at->translatedFormat('d F Y') }}</p>
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
          <p class="text-xs text-gray-500 dark:text-gray-400">Terakhir Diubah</p>
          <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $permission->updated_at->translatedFormat('d F Y') }}</p>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
