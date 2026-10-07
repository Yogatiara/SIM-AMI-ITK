<x-app-layout>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
          Daftar Dokumen
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Kelola dokumen audit mutu internal
        </p>
      </div>
      <a href="/documents/create"
        class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:bg-emerald-500 dark:hover:bg-emerald-400 dark:focus:ring-offset-gray-900">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Dokumen
      </a>
    </div>

    <!-- Tabs -->
    <div x-data="{ openTab: window.location.hash ? window.location.hash.substring(1) : '' }"
      x-init="openTab = window.location.hash ? window.location.hash.substring(1) : '';
      window.addEventListener('hashchange', () => {
          openTab = window.location.hash ? window.location.hash.substring(1) : '';
      });">
      <div class="flex gap-1 rounded-xl bg-gray-100 p-1 dark:bg-gray-800">
        <button @click.prevent="openTab = ''; window.location.hash = ''"
          :class="openTab === '' ? 'bg-white text-gray-900 shadow-sm dark:bg-gray-700 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
          class="flex-1 rounded-lg px-4 py-2 text-sm font-medium transition-all">
          Dokumen
        </button>
        <button @click.prevent="openTab = 'drafts'; window.location.hash = 'drafts'"
          :class="openTab === 'drafts' ? 'bg-white text-gray-900 shadow-sm dark:bg-gray-700 dark:text-white' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
          class="flex-1 rounded-lg px-4 py-2 text-sm font-medium transition-all">
          Draft
        </button>
      </div>

      <!-- Documents Table -->
      <div class="mt-4 rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
        <div x-show="openTab === ''" class="overflow-x-auto">
          @if ($documents->count())
            <table class="w-full">
              <thead>
                <tr class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                  <th class="px-6 py-4">No</th>
                  <th class="px-6 py-4">Nama Dokumen</th>
                  <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                @foreach ($documents as $document)
                  <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                      {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                      <span class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ $document->name }}
                      </span>
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('documents.show', $document) }}"
                          class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700 transition-colors hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50">
                          <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                          </svg>
                          Buka
                        </a>
                        @if ($document->can_be_deleted)
                          <form action="{{ route('documents.destroy', $document) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');"
                              class="inline-flex items-center gap-1.5 rounded-lg bg-rose-50 px-3 py-1.5 text-xs font-medium text-rose-700 transition-colors hover:bg-rose-100 dark:bg-rose-900/30 dark:text-rose-400 dark:hover:bg-rose-900/50">
                              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                              </svg>
                              Hapus
                            </button>
                          </form>
                        @else
                          <span class="text-xs text-gray-400 dark:text-gray-500">Tidak dapat dihapus</span>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <div class="flex h-64 items-center justify-center">
              <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada dokumen</p>
              </div>
            </div>
          @endif
        </div>

        <!-- Drafts Table -->
        <div x-show="openTab === 'drafts'" class="overflow-x-auto">
          @if ($drafts->count())
            <table class="w-full">
              <thead>
                <tr class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                  <th class="px-6 py-4">No</th>
                  <th class="px-6 py-4">Nama Dokumen</th>
                  <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                @foreach ($drafts as $draft)
                  <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                      {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                      <span class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ $draft }}
                      </span>
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('documents.editDraft', $draft) }}"
                          class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-medium text-amber-700 transition-colors hover:bg-amber-100 dark:bg-amber-900/30 dark:text-amber-400 dark:hover:bg-amber-900/50">
                          <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                          </svg>
                          Ubah
                        </a>
                        <form action="{{ route('documents.destroyDraft', $draft) }}" method="POST" class="inline">
                          @method('delete')
                          @csrf
                          <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-rose-50 px-3 py-1.5 text-xs font-medium text-rose-700 transition-colors hover:bg-rose-100 dark:bg-rose-900/30 dark:text-rose-400 dark:hover:bg-rose-900/50">
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
          @else
            <div class="flex h-64 items-center justify-center">
              <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada draft</p>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
