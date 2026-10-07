<x-app-layout>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
          Edit Role: {{ $role->name }}
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Atur permission untuk role ini
        </p>
      </div>
      <a href="{{ route('roles-management.index') }}"
        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
      </a>
    </div>

    <!-- Edit Form -->
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <form action="{{ route('roles-management.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
          <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Role</label>
          <input type="text" value="{{ $role->name }}" readonly
            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
        </div>

        <div class="mb-6">
          <label class="mb-3 block text-sm font-medium text-gray-700 dark:text-gray-300">Permissions</label>
          <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($permissions as $permission)
              <label
                class="flex cursor-pointer items-center gap-3 rounded-lg border border-gray-200 p-3 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                  {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                  class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <div>
                  <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $permission->name }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">{{ $permission->description ?? 'Tidak ada deskripsi' }}</p>
                </div>
              </label>
            @endforeach
          </div>
        </div>

        <div class="flex justify-end gap-3">
          <a href="{{ route('roles-management.index') }}"
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

    <!-- Role Info -->
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Informasi Role</h2>
      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
          <p class="text-xs text-gray-500 dark:text-gray-400">Jumlah Pengguna</p>
          <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $role->users->count() }}</p>
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
          <p class="text-xs text-gray-500 dark:text-gray-400">Jumlah Permission</p>
          <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $role->permissions->count() }}</p>
        </div>
        <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800">
          <p class="text-xs text-gray-500 dark:text-gray-400">Dibuat Pada</p>
          <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $role->created_at->translatedFormat('d F Y') }}</p>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
