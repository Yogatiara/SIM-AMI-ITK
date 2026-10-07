<x-app-layout>
  <div x-data="user()" class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
          Pengguna
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Kelola pengguna sistem audit mutu internal
        </p>
      </div>
      <a href="/users/create"
        class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:bg-emerald-500 dark:hover:bg-emerald-400 dark:focus:ring-offset-gray-900">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Pengguna
      </a>
    </div>

    <!-- Table -->
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      @if ($users->count())
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Pengguna</th>
                <th class="px-6 py-4">Kontak</th>
                <th class="px-6 py-4">Role</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
              @foreach ($users as $user)
                <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                  <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                    {{ $loop->iteration }}
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                      <div class="relative h-9 w-9 shrink-0">
                        <img class="h-full w-full rounded-full object-cover ring-2 ring-white dark:ring-gray-800"
                          src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random" alt="" loading="lazy" />
                      </div>
                      <div class="min-w-0">
                        <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                          {{ $user->name }}{{ Auth::id() === $user->id ? ' (Anda)' : '' }}
                        </p>
                        <p class="truncate text-xs text-gray-500 dark:text-gray-400">
                          {{ $user->email }}
                        </p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ $user->contact }}
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex flex-wrap gap-1">
                      @foreach ($user->getRoleNames() as $role)
                        @if ($role == 'PJM')
                          <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                            {{ $role }}
                          </span>
                        @elseif ($role == 'Auditor')
                          <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">
                            {{ $role }}
                          </span>
                        @elseif ($role == 'Auditee')
                          <span class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-0.5 text-xs font-medium text-rose-700 dark:bg-rose-900/30 dark:text-rose-400">
                            {{ $role }}
                          </span>
                        @else
                          <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                            {{ $role }}
                          </span>
                        @endif
                      @endforeach
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    @if ($user->last_seen && $user->last_seen >= now()->subMinutes(3))
                      <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-600 dark:text-emerald-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Online
                      </span>
                    @elseif ($user->last_seen)
                      <span class="text-xs text-gray-500 dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                      </span>
                    @else
                      <span class="text-xs text-gray-400 dark:text-gray-500">Tidak pernah terlihat</span>
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                      <a href="{{ route('users.edit', $user) }}"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-medium text-amber-700 transition-colors hover:bg-amber-100 dark:bg-amber-900/30 dark:text-amber-400 dark:hover:bg-amber-900/50">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                      </a>

                      <form id="form-{{ $user->id }}" action="/users/{{ $user->id }}" method="POST" class="inline">
                        @method('delete')
                        @csrf
                        <button type="button"
                          class="inline-flex items-center gap-1.5 rounded-lg bg-rose-50 px-3 py-1.5 text-xs font-medium text-rose-700 transition-colors hover:bg-rose-100 dark:bg-rose-900/30 dark:text-rose-400 dark:hover:bg-rose-900/50"
                          @click="openConfirm('Yakin ingin menghapus pengguna?', 'Data dan akses tidak dapat dikembalikan.', () => {
                              document.getElementById('form-{{ $user->id }}').submit()
                          });">
                          <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                          </svg>
                          Hapus
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="flex h-64 items-center justify-center">
          <div class="text-center">
            <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada pengguna</p>
          </div>
        </div>
      @endif
    </div>

    <!-- Confirm Modal -->
    <div x-show="isConfirmOpen" x-cloak
      class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto"
      @keydown.escape.window="closeConfirm()">
      <div x-show="isConfirmOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="closeConfirm()"></div>
      <div x-show="isConfirmOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative z-10 w-full max-w-md transform rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
        role="dialog" aria-modal="true">
        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-rose-100 dark:bg-rose-900/30">
          <svg class="h-6 w-6 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
        </div>
        <div class="text-center">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white" x-text="confirmTitle"></h3>
          <p class="mt-2 text-sm text-gray-500 dark:text-gray-400" x-text="confirmText"></p>
        </div>
        <div class="mt-6 flex gap-3">
          <button type="button" @click="closeConfirm()"
            class="flex-1 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            Batal
          </button>
          <button type="button" @click="confirmAction(); closeConfirm()"
            class="flex-1 rounded-lg bg-rose-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-rose-500 dark:bg-rose-500 dark:hover:bg-rose-400">
            Hapus
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function user() {
      return {
        isConfirmOpen: false,
        confirmTitle: '',
        confirmText: '',
        confirmAction: null,
        openConfirm(title, text, action) {
          this.confirmTitle = title;
          this.confirmText = text;
          this.confirmAction = action;
          this.isConfirmOpen = true;
          this.focusTrap = focusTrap(document.querySelector('#confirm'))
        },
        closeConfirm() {
          this.isConfirmOpen = false
          this.focusTrap();
        },
        confirmAction() {
          this.confirmAction()
          this.closeConfirm()
        },
      };
    }
  </script>
</x-app-layout>
