<x-app-layout>
  <form x-data="user()" id="form" action="{{ route('forms.updateSigningVerification', $form) }}"
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

    {{-- <embed src="{{ Storage::url($form->rtm_link) }}" type="application/pdf" width="100%" height="600px"> --}}

    @if ($form->signing && Storage::exists('public/' . $form->signing))
      <iframe class="rounded-2xl" src="{{ Storage::url($form->signing) }}#toolbar=0" type="application/pdf"
        width="100%" height="650px"></iframe>
    @else
      <div
        class="h-[85%] w-full overflow-y-auto scrollbar-thin dark:scrollbar-track-gray-500 dark:scrollbar-thumb-gray-800">
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
      <div class="flex items-center justify-center gap-5">
        <input type="hidden" name="action" id="action-input">
        <button type="button"
          class="rounded-md bg-red-600 px-4 py-2 text-xs uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-700 focus:shadow-outline-blue"
          @click="openConfirm('decline', 'Yakin ingin menolak?', 'Auditee akan diminta untuk mengubah Laporan Audit.', () => {
                            document.getElementById('form').submit()
                        },);">
          Tolak
        </button>
        <button type="button"
          class="rounded-md !bg-primary px-4 py-2 text-xs uppercase tracking-widest text-white transition duration-150 ease-in-out hover:!bg-blue-500 focus:shadow-outline-blue"
          @click="openConfirm('accept', 'Yakin ingin mengirim?', 'Verifikasi yang dikirim tidak dapat diubah.', () => {
                            document.getElementById('form').submit()
                        });">
          Terima
        </button>
      </div>
    </div>

    <div x-cloak x-show="isConfirmOpen"
      class="fixed inset-0 z-50 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
      <!-- Modal -->
      <div x-show="isConfirmOpen" @click.away="closeConfirm()" @keydown.escape="closeConfirm()"
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
          <textarea x-show="showTextarea" name="verification_info"
            class="border-1 w-full resize-none overflow-hidden bg-transparent p-2 text-gray-900 focus:ring-0"
            style="text-align: justify;" placeholder="Berikan info penolakan">{{ $form->verification_info ?? '' }}</textarea>
        </div>
        <footer
          class="-m-4 flex flex-col items-center space-y-4 px-6 py-3 text-sm dark:bg-gray-800 sm:flex-row sm:justify-end sm:space-x-6 sm:space-y-0">
          <button type="button" @click="closeConfirm"
            class="w-full rounded-lg border border-gray-300 p-3 tracking-widest text-gray-600 transition-colors duration-150 hover:border-gray-500 focus:border-gray-500 focus:shadow-outline-gray dark:text-white sm:w-auto">
            Batal
          </button>
          <button type="button" @click="confirmAction(); closeConfirm()"
            class="w-full rounded-lg !bg-primary p-3 tracking-widest text-white transition-colors duration-150 hover:!bg-blue-600 focus:shadow-outline-red sm:w-auto">
            Ya, Yakin
          </button>
        </footer>
      </div>
    </div>
  </form>

  <script>
    function user() {
      return {
        isContactOpen: false,
        openContact() {
          this.isContactOpen = true;
          this.focusTrap = focusTrap(document.querySelector('#modal-contact'));
        },
        closeContact() {
          this.isContactOpen = false
          this.focusTrap();
        },
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
        showTextarea: false,
        isConfirmOpen: false,
        confirmTitle: '',
        confirmText: '',
        confirmAction: null,
        openConfirm(submitAction, title, text, action) {
          document.querySelector('#action-input').value = submitAction;
          this.confirmTitle = title;
          this.confirmText = text;
          this.confirmAction = action;
          this.showTextarea = submitAction === 'decline';
          this.isConfirmOpen = true;
          this.focusTrap = focusTrap(document.querySelector('#confirm'))
        },
        closeConfirm() {
          this.isConfirmOpen = false
          this.showTextarea = false;
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
