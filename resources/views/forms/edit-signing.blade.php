<x-app-layout>
  <form x-data="user()" id="form" action="{{ route('forms.updateSigning', $form) }}"
    enctype="multipart/form-data" method="POST" class="flex h-full w-full flex-col gap-y-1 font-semibold">
    @csrf
    @method('PUT')

    <div class="flex items-center justify-between py-1 text-blue-700 dark:text-cool-gray-50 md:text-lg">
      {{-- Breadcrumb --}}
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
          signing
        </span>
      </div>

      <div class="flex items-center gap-x-2">



        <button type="button" @click="openContact()"
          class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          Kontak
        </button>

        <div x-show="isContactOpen" x-cloak
          class="fixed inset-0 z-50 flex items-end bg-black/50 p-0 sm:items-center sm:justify-center sm:p-4">

          <div x-show="isContactOpen" @click.away="closeContact()" @keydown.escape.window="closeContact()"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="translate-y-4 opacity-0 sm:scale-95"
            x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave-end="translate-y-4 opacity-0 sm:scale-95"
            class="w-full overflow-hidden rounded-t-xl bg-white shadow-xl dark:bg-gray-800 sm:max-w-xl sm:rounded-xl">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4 dark:border-gray-700">

              <div>
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                  Kontak User
                </h3>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                  Daftar auditee dan auditor yang terkait
                </p>
              </div>

              <button type="button" @click="closeContact()"
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-gray-200">

                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                </svg>
              </button>
            </div>

            {{-- Column Header --}}
            <div
              class="grid grid-cols-2  border-gray-100  px-5 py-3 text-xs font-semibold text-gray-600 dark:border-gray-700 dark:bg-gray-900/50 dark:text-gray-300">
              <div>
                Auditee
              </div>
              <div>
                Auditor
              </div>
            </div>

            {{-- Body --}}
            <div class="grid max-h-[55vh] grid-cols-2 overflow-y-auto">

              {{-- Auditee --}}
              <div class="flex flex-col gap-4  border-gray-100 p-5 dark:border-gray-700">

                @forelse ($auditees as $auditee)
                  <div class="flex items-center gap-3">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode($auditee->user->name) }}&background=random"
                      alt="{{ $auditee->user->name }}" loading="lazy"
                      class="h-9 w-9 shrink-0 rounded-full object-cover">

                    <div class="min-w-0 flex-1">
                      <div class="truncate text-sm font-medium text-gray-900 dark:text-white">
                        {{ $auditee->user->name }}
                      </div>

                      <div class="truncate text-xs text-gray-500 dark:text-gray-400">
                        {{ $auditee->position }}
                      </div>

                      <div class="truncate text-xs text-gray-500 dark:text-gray-400">
                        {{ $auditee->user->contact }}
                      </div>
                    </div>

                  </div>
                @empty
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                    Tidak ada auditee.
                  </p>
                @endforelse

              </div>

              {{-- Auditor --}}
              <div class="flex flex-col gap-4 p-5">

                @forelse ($auditors as $auditor)
                  <div class="flex items-center gap-3">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode($auditor->user->name) }}&background=random"
                      alt="{{ $auditor->user->name }}" loading="lazy"
                      class="h-9 w-9 shrink-0 rounded-full object-cover">

                    <div class="min-w-0 flex-1">
                      <div class="truncate text-sm font-medium text-gray-900 dark:text-white">
                        {{ $auditor->user->name }}
                      </div>

                      <div class="truncate text-xs text-gray-500 dark:text-gray-400">
                        {{ $auditor->position }}
                      </div>

                      <div class="truncate text-xs text-gray-500 dark:text-gray-400">
                        {{ $auditor->user->contact }}
                      </div>
                    </div>

                  </div>
                @empty
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                    Tidak ada auditor.
                  </p>
                @endforelse

              </div>

            </div>

            {{-- Footer --}}
            <div class="flex justify-end border-t border-gray-100 px-5 py-4 dark:border-gray-700">

              <button @click="closeContact()" type="button"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-800">
                Tutup
              </button>

            </div>

          </div>
        </div>
      </div>
    </div>

    <div
      class="flex h-[85%] flex-col items-center gap-8 overflow-y-auto rounded-2xl bg-white px-4 pt-24 shadow-md scrollbar-thin dark:bg-gray-900 dark:scrollbar-track-gray-500 dark:scrollbar-thumb-gray-800">

      <header class="text-center">
        <h2 class="text-lg text-gray-900 dark:text-white">
          {{ __('Lampirkan Laporan Hasil Audit') }}
        </h2>

        <p class="text-sm text-gray-600 dark:text-gray-300">
          {{ __('Export Hasil dan Unggah Laporan yang telah ditandatangani') }}
        </p>
      </header>

      <div class="mx-auto max-w-4xl">
        <div class="flex grid-cols-2 gap-6">
          <!-- Export -->
          <div class="space-y-1 text-sm">
            <label for="time" class="text-gray-900 dark:text-white">{{ __('Export') }}</label>
            <div class="flex flex-col gap-2">
              <a href="{{ route('forms.export', $form) }}"
                class="w-full inline-block text-center rounded-md border border-red-600 p-2.5 text-sm font-medium text-red-600 transition hover:bg-red-600 hover:text-white">
                {{-- <i class="fa-solid fa-file-word fa-xl"></i> --}}
                <i class="fas fa-file-pdf fa-xl"></i>
              </a>
            </div>
            @if ($errors->has('time'))
              <p class="text-red-500">{{ $errors->first('time') }}</p>
            @endif
          </div>
          <!-- Document -->
          <div class="space-y-1 text-sm">
            <label for="document" class="text-gray-900 dark:text-white">Unggah Dokumen</label>
            <input
              class="w-full cursor-pointer rounded-md border pr-4 border-gray-300 bg-gray-50 text-sm text-gray-900 shadow-sm focus:border-blue-800 focus:outline-none focus:ring-blue-800 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500"
              id="document" name="document" type="file">
            @if ($errors->has('document'))
              <p class="text-red-500">{{ $errors->first('document') }}</p>
            @endif
          </div>
        </div>
      </div>
      @if (session('error'))
        <div
          class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-800 dark:bg-red-900/20 dark:text-red-400">
          <div class="flex items-center gap-2"> <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
          </div>
        </div>
      @endif
      <div class="flex justify-center py-2 gap-8">
        <a href="/forms"
          class="rounded-md bg-gray-500 px-4 py-2 text-xs uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:shadow-outline-gray">
          Kembali
        </a>
        <button type="button"
          class="rounded-md !bg-primary px-4 py-2 text-xs uppercase tracking-widest text-white transition duration-150 ease-in-out hover:!bg-blue-700 focus:shadow-outline-blue"
          @click="openConfirm('Yakin ingin mengirim?', 'Pastikan data sudah benar.', () => {
                            document.getElementById('form').submit()
                        });">
          Submit
        </button>
      </div>
    </div>



    <div x-show="isConfirmOpen"
      class="fixed inset-0 z-50 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
      <!-- Modal -->
      <div x-cloak x-show="isConfirmOpen" @click.away="closeConfirm()" @keydown.escape="closeConfirm()"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform translate-y-1/2"
        class="w-full space-y-4 overflow-hidden rounded-t-lg bg-white p-4 dark:bg-gray-800 sm:max-w-xl sm:rounded-lg"
        id="confirm">
        <header class="flex justify-end">
          <button type="button"
            class="inline-flex h-6 w-6 items-center justify-center rounded text-gray-400 transition-colors duration-150 hover:text-gray-700 dark:hover:text-gray-100"
            @click="closeConfirm()">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
              <path
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z">
              </path>
            </svg>
          </button>
        </header>
        <!-- Modal body -->
        <div class="m-4 space-y-2 text-gray-700 dark:text-gray-300">
          <!-- Modal title -->
          <p x-text="confirmTitle" class="text-lg"></p>
          <!-- Modal description -->
          <p x-text="confirmText"></p>
        </div>
        <footer
          class="-m-4 flex flex-col items-center space-y-4 px-6 py-3 text-sm dark:bg-gray-800 sm:flex-row sm:justify-end sm:space-x-6 sm:space-y-0">
          <button type="button" @click="closeConfirm"
            class="w-full rounded-lg border border-gray-300 p-3 tracking-widest text-gray-600 transition-colors duration-150 hover:border-gray-500 focus:border-gray-500 focus:shadow-outline-gray dark:text-white sm:w-auto">
            Batal
          </button>
          <button type="button" @click="confirmAction(); closeConfirm()"
            class="w-full rounded-lg !bg-primary p-3 tracking-widest text-white transition-colors duration-150 hover:!bg-blue-600 focus:shadow-outline-red sm:w-auto">
            Ya, sudah benar
          </button>
        </footer>
      </div>
    </div>
  </form>

  <script>
    function user() {
      return {
        keyword: '', // Keyword input pengguna
        results: [], // Data hasil pencarian
        message: '', // Pesan error atau status

        // Fungsi untuk melakukan pencarian
        search() {
          if (this.keyword.length > 2) {
            fetch(`/getUser?keyword=${encodeURIComponent(this.keyword)}`)
              .then(response => {
                if (!response.ok) throw new Error('Failed to fetch data');
                return response.json();
              })
              .then(data => {
                this.results = data.data || [];
                this.message = this.results.length === 0 ? 'No results found' : '';
              })
              .catch(error => {
                console.error(error);
                this.message = 'Error fetching data';
                this.results = [];
              });
          } else {
            this.results = [];
            this.message = '';
          }
        },

        // Fungsi untuk memilih user dari hasil pencarian
        selectUser(item) {
          document.getElementById('name').value = item.PE_Nama;
          document.getElementById('username').value = item.PE_Nip;
          document.getElementById('email').value = item.PE_Email;
          this.clearResults();
        },

        // Fungsi untuk menghapus hasil pencarian
        clearResults() {
          this.results = [];
          this.message = '';
          this.keyword = '';
        },
        isContactOpen: false,
        openContact() {
          this.isContactOpen = true;
          this.focusTrap = focusTrap(document.querySelector('#modal-contact'));
        },
        closeContact() {
          this.isContactOpen = false
          this.focusTrap();
        },
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
