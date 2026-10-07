<x-app-layout>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
          Edit Pengguna
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Ubah informasi pengguna
        </p>
      </div>
      <a href="{{ route('users.index') }}"
        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
      </a>
    </div>

    <!-- Edit Form -->
    <div class="rounded-2xl bg-white p-10 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <form action="{{ route('users.update', $user) }}" method="POST" class=" w-full">
        @csrf
        @method('PUT')

        {{-- Informasi User --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

          {{-- Nama --}}
          <div>
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
              Nama Lengkap
            </label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
              class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
              placeholder="Masukkan nama lengkap">
            @error('name')
              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
          </div>

          {{-- Username --}}
          <div>
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
              Username
            </label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" required
              class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
              placeholder="Masukkan username">
            @error('username')
              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
          </div>

          {{-- Email --}}
          <div>
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
              Email
            </label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
              class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
              placeholder="Masukkan email">
            @error('email')
              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
          </div>

          {{-- Kontak --}}
          <div>
            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
              Kontak
            </label>
            <input type="text" name="contact" value="{{ old('contact', $user->contact) }}"
              class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
              placeholder="Masukkan nomor kontak">
            @error('contact')
              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
          </div>

        </div>

        {{-- Role --}}
        <div class="mt-6">
          <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Role
          </label>

          <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($roles as $role)
              <label
                class="flex cursor-pointer items-center gap-3 rounded-lg border border-gray-200 p-3 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                  {{ $user->hasRole($role->name) ? 'checked' : '' }}
                  class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">

                <span class="text-sm font-medium text-gray-900 dark:text-white">
                  {{ $role->name }}
                </span>
              </label>
            @endforeach
          </div>

          @error('roles')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        {{-- Password --}}
        <div class="mt-8 border-t border-gray-100 pt-6 dark:border-gray-800">
          <h3 class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">
            Ubah Password
          </h3>

          <p class="mb-5 text-xs text-gray-500 dark:text-gray-400">
            Kosongkan jika tidak ingin mengubah password
          </p>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- Password Baru --}}
            <div>
              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Password Baru
              </label>

              <input type="password" name="password"
                class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                placeholder="Masukkan password baru (min. 8 karakter)">

              @error('password')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Konfirmasi Password
              </label>

              <input type="password" name="password_confirmation"
                class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                placeholder="Konfirmasi password baru">
            </div>

          </div>
        </div>

        {{-- Action --}}
        <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6 dark:border-gray-800">
          <a href="{{ route('users.index') }}"
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
  </div>
</x-app-layout>
