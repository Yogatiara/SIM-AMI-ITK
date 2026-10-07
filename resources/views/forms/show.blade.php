{{-- <x-app-layout>
  <div x-data="form()" class="flex h-full w-full flex-col gap-y-4">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2 text-sm">
        <a href="/forms"
          class="text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          Daftar Formulir
        </a>
        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="font-medium text-gray-900 dark:text-white">{{ $form->document->name }}</span>
        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="font-medium text-gray-900 dark:text-white">{{ $form->unit->name }}</span>
      </div>
      <button type="button" @click="openContact()"
        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        Kontak
      </button>
    </div>

    <!-- Contact Modal -->
    <div x-cloak x-show="isContactOpen" class="fixed inset-0 z-40 flex items-center justify-center">
      <div x-show="isContactOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="closeContact()">
      </div>
      <div x-show="isContactOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative z-10 w-full max-w-2xl transform rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
        role="dialog" aria-modal="true">
        <div class="mb-4 flex items-center justify-between">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kontak Pengguna</h3>
          <button type="button" @click="closeContact()"
            class="rounded-lg p-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-800 dark:hover:text-gray-300">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="grid grid-cols-2 gap-6">
          <div>
            <h4 class="mb-3 text-sm font-medium text-gray-500 dark:text-gray-400">Auditee</h4>
            <div class="space-y-3">
              @foreach ($auditees as $auditee)
                <div class="flex items-center gap-3">
                  <img class="h-9 w-9 rounded-full object-cover"
                    src="https://ui-avatars.com/api/?name={{ $auditee->user->name }}&background=random"
                    alt="" />
                  <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $auditee->user->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $auditee->user->contact }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
          <div>
            <h4 class="mb-3 text-sm font-medium text-gray-500 dark:text-gray-400">Auditor</h4>
            <div class="space-y-3">
              @foreach ($auditors as $auditor)
                <div class="flex items-center gap-3">
                  <img class="h-9 w-9 rounded-full object-cover"
                    src="https://ui-avatars.com/api/?name={{ $auditor->user->name }}&background=random"
                    alt="" />
                  <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $auditor->user->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $auditor->user->contact }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="mt-6 flex justify-end">
          <button @click="closeContact()" type="button"
            class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            Tutup
          </button>
        </div>
      </div>
    </div>

    <!-- Back Button -->
    <a href="/forms"
      class="inline-flex w-fit items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
      <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Kembali
    </a>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
      <!-- Category Tabs -->
      <div class="mb-4 flex gap-1 overflow-x-auto rounded-xl bg-gray-100 p-1 dark:bg-gray-800">
        @foreach ($categories as $category)
          <button @click.prevent="openTab = {{ $category['id'] }}"
            :class="openTab === {{ $category['id'] }} ? 'bg-white text-gray-900 shadow-sm dark:bg-gray-700 dark:text-white' :
                'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
            class="flex-1 whitespace-nowrap rounded-lg px-4 py-2 text-sm font-medium transition-all">
            {{ $category['name'] }}
          </button>
        @endforeach
      </div>

      <!-- Standards Content -->
      <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
        @foreach ($categories as $category)
          <div x-show="openTab === {{ $category['id'] }}" class="space-y-6">
            @foreach ($category['standards'] as $standard)
              <div>
                <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">{{ $standard['name'] }}</h3>
                <div class="overflow-x-auto">
                  <table class="w-full">
                    <thead>
                      <tr
                        class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                        <th class="pb-3 pr-4">Kompetensi</th>
                        <th class="pb-3">Indikator</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                      @foreach ($standard['competencies'] as $competency)
                        <tr>
                          <td class="py-4 pr-4">
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $competency['name'] }}</p>
                          </td>
                          <td class="py-4">
                            @foreach ($competency['indicators'] as $indicator)
                              <div class="mb-4">
                                <div class="mb-2 flex items-center gap-2">
                                  <span
                                    class="text-sm font-medium text-gray-900 dark:text-white">{{ $indicator['code'] }}</span>
                                  <span
                                    class="inline-flex items-center rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                    {{ $indicator['assessment_status'] }}
                                  </span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $indicator['assessment'] }}</p>
                                <button @click="openIndicator({{ $indicator['id'] }})" type="button"
                                  class="mt-2 inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700 transition-colors hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50">
                                  <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                  </svg>
                                  Lihat Detail
                                </button>
                              </div>
                            @endforeach
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            @endforeach
          </div>
        @endforeach

        <!-- Empty State -->
        @if (empty($categories))
          <div class="flex h-64 flex-col items-center justify-center gap-4 text-gray-500">
            <svg class="h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <p class="text-sm">Belum ada data</p>
          </div>
        @endif
      </div>
    </div>

    <!-- Indicator Detail Modal -->
    <div x-cloak x-show="focusIndicatorId !== null" class="fixed inset-0 z-40 flex items-center justify-center">
      <div x-show="focusIndicatorId !== null" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 backdrop-blur-sm"
        @click="closeIndicator()"></div>
      <div x-show="focusIndicatorId !== null" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative z-10 w-full max-w-3xl transform rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
        role="dialog" aria-modal="true">
        <div class="mb-4 flex items-center justify-between">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Detail Indikator
          </h3>
          <button type="button" @click="closeIndicator()"
            class="rounded-lg p-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-800 dark:hover:text-gray-300">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="space-y-4">
          <div>
            <label class="mb-1 block text-sm font-medium text-gray-500 dark:text-gray-400">Kode Indikator</label>
            <p class="text-sm text-gray-900 dark:text-white" x-text="focusIndicator?.code"></p>
          </div>
          <div>
            <label class="mb-1 block text-sm font-medium text-gray-500 dark:text-gray-400">Penilaian</label>
            <p class="text-sm text-gray-900 dark:text-white" x-text="focusIndicator?.assessment"></p>
          </div>
          <div>
            <label class="mb-1 block text-sm font-medium text-gray-500 dark:text-gray-400">Status Pengajuan</label>
            <p class="text-sm text-gray-900 dark:text-white" x-text="focusIndicator?.submission_status"></p>
          </div>
          <div>
            <label class="mb-1 block text-sm font-medium text-gray-500 dark:text-gray-400">Status Penilaian</label>
            <p class="text-sm text-gray-900 dark:text-white" x-text="focusIndicator?.assessment_status"></p>
          </div>
        </div>
        <div class="mt-6 flex justify-end">
          <button @click="closeIndicator()" type="button"
            class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            Tutup
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function form() {
      return {
        openTab: {{ !empty($categories) ? $categories[0]['id'] : 1 }},
        categories: @json($categories),
        isContactOpen: false,
        focusIndicatorId: null,
        focusIndicator: null,
        openContact() {
          this.isContactOpen = true;
        },
        closeContact() {
          this.isContactOpen = false;
        },
        openIndicator(id) {
          this.focusIndicatorId = id;
          // Find indicator data
          for (let cat of this.categories) {
            for (let std of cat.standards) {
              for (let comp of std.competencies) {
                for (let ind of comp.indicators) {
                  if (ind.id === id) {
                    this.focusIndicator = ind;
                    return;
                  }
                }
              }
            }
          }
        },
        closeIndicator() {
          this.focusIndicatorId = null;
          this.focusIndicator = null;
        }
      }
    }
  </script>
</x-app-layout> --}}


<x-app-layout>
  <div x-data="form()" class="flex h-full w-full flex-col gap-y-1 font-semibold">

    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2 text-sm">
        <a href="/forms"
          class="text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          Daftar Formulir
        </a>
        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="font-medium text-gray-900 dark:text-white">{{ $form->document->name }}</span>
        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="font-medium text-gray-900 dark:text-white">{{ $form->unit->name }}</span>
      </div>
      <button type="button" @click="openContact()"
        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        Kontak
      </button>
    </div>

    <div x-cloak x-show="isContactOpen" class="fixed inset-0 z-40 flex items-center justify-center">
      <div x-show="isContactOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="closeContact()">
      </div>
      <div x-show="isContactOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative z-10 w-full max-w-2xl transform rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
        role="dialog" aria-modal="true">
        <div class="mb-4 flex items-center justify-between">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kontak Pengguna</h3>
          <button type="button" @click="closeContact()"
            class="rounded-lg p-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-800 dark:hover:text-gray-300">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="grid grid-cols-2 gap-6">
          <div>
            <h4 class="mb-3 text-sm font-medium text-gray-500 dark:text-gray-400">Auditee</h4>
            <div class="space-y-3">
              @foreach ($auditees as $auditee)
                <div class="flex items-center gap-3">
                  <img class="h-9 w-9 rounded-full object-cover"
                    src="https://ui-avatars.com/api/?name={{ $auditee->user->name }}&background=random"
                    alt="" />
                  <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $auditee->user->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $auditee->user->contact }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
          <div>
            <h4 class="mb-3 text-sm font-medium text-gray-500 dark:text-gray-400">Auditor</h4>
            <div class="space-y-3">
              @foreach ($auditors as $auditor)
                <div class="flex items-center gap-3">
                  <img class="h-9 w-9 rounded-full object-cover"
                    src="https://ui-avatars.com/api/?name={{ $auditor->user->name }}&background=random"
                    alt="" />
                  <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $auditor->user->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $auditor->user->contact }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="mt-6 flex justify-end">
          <button @click="closeContact()" type="button"
            class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            Tutup
          </button>
        </div>
      </div>
    </div>



    <div class="flex h-[85%] w-full flex-col gap-y-2 overflow-auto">

      <div class="flex justify-between gap-x-2">
        <div class="flex w-full whitespace-nowrap" data-simplebar>
          <ul class="flex">
            <template x-for="category in categories" :key="category.id">
              <li @click.prevent="openTab = category.id" x-text="category.name"
                :class="openTab === category.id ?
                    ' dark:text-cool-gray-50 text-primary bold dark:border-cool-gray-50' :
                    'border-2 border-gray-300 text-gray-500 hover:border hover:text-green-400 hover:border-green-400 dark:hover:border-red-500 dark:hover:text-gray-200 dark:border-gray-400 dark:text-gray-400'"
                class="mr-1 flex cursor-pointer items-center gap-x-2 rounded-md bg-white border p-2 dark:bg-gray-700">
              </li>
            </template>
          </ul>
        </div>
      </div>

      <div id="scrollspy-scrollable-parent-2"
        class="shadow-xs h-[90%] w-full overflow-y-auto rounded-2xl border p-3 border-gray-200 bg-gray-100 scrollbar-thin dark:border-gray-300 dark:bg-gray-700 dark:scrollbar-track-gray-500 dark:scrollbar-thumb-gray-800">
        <template x-for="category in categories" :key="category.id">
          <div x-show="openTab === category.id, initTextareas()" class="grid grid-cols-7 gap-4">
            <div class="col-span-1">
              <ul
                class="sticky top-0 max-h-[463px] overflow-y-auto scrollbar-thin dark:scrollbar-track-gray-500 dark:scrollbar-thumb-gray-800"
                data-hs-scrollspy="#scrollspy-2" data-hs-scrollspy-scrollable-parent="#scrollspy-scrollable-parent-2">
                <template x-for="standard in category.standards" :key="standard.id">
                  <li data-hs-scrollspy-group="">
                    <a :href="'#standard-' + standard.id" x-text="standard.name"
                      class=" hidden py-1 text-left text-sm leading-6 text-gray-700 hover:text-gray-900 focus:text-blue-600 focus:outline-none hs-scrollspy-active:text-blue-600 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-blue-500 dark:hs-scrollspy-active:text-blue-500 md:block"></a>
                    <template x-for="competency in standard.competencies" :key="competency.id">
                      <ul>
                        <template x-for="indicator in competency.indicators" :key="indicator.id">
                          <li class="xl:ms-6">
                            <a x-text="indicator.code" :href="'#standard-' + standard.id"
                              class="group flex items-center gap-x-2 text-sm leading-6 text-gray-700 hover:text-gray-800 focus:text-blue-600 focus:outline-none hs-scrollspy-active:text-blue-600 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-blue-500 dark:hs-scrollspy-active:text-blue-500">
                            </a>
                          </li>
                        </template>
                      </ul>
                    </template>
                  </li>
                </template>
              </ul>
            </div>

            <div class="col-span-6">
              <div class="flex flex-col gap-y-5 py-2">
                <template x-for="standard in category.standards" :key="standard.id">
                  <div>
                    <div x-text="standard.name" :id="'standard-' + standard.id"
                      class="bg-white  text-left  dark:border-gray-500 dark:bg-gray-700 dark:text-purple-400 sm:text-md border rounded-2xl p-2">
                    </div>
                    <div
                      class="rounded-2xl mt-1 bg-white  shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
                      <div class="overflow-x-auto">
                        <table class="w-full">
                          <thead>
                            <tr
                              class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                              <th class="w-[35%] px-6 py-4">
                                Kompetensi
                              </th>
                              <th class="px-6 py-4">
                                Indikator
                              </th>
                            </tr>
                          </thead>

                          <tbody class="divide-y divide-gray-50 dark:divide-gray-800">

                            <template x-for="competency in standard.competencies" :key="competency.id">
                              <tr>

                                {{-- Kompetensi --}}
                                <td class="px-6 py-5 align-top">
                                  <textarea x-model="competency.name" disabled
                                    class="w-full resize-none overflow-hidden border-0 bg-transparent p-0 text-sm font-medium leading-6 text-gray-900 focus:ring-0 dark:text-white"
                                    style="text-align: justify;" placeholder="Competency Name"></textarea>
                                </td>

                                {{-- Indikator --}}
                                <td class="px-6 py-5">
                                  <div class="space-y-5">

                                    <template x-for="indicator in competency.indicators" :key="indicator.id">
                                      <div class="group">

                                        {{-- Indicator --}}
                                        <div class="flex w-full flex-col gap-2 md:flex-row md:items-start">

                                          {{-- Code --}}
                                          <div x-text="indicator.code"
                                            class="min-w-[70px] pt-0.5 text-xs font-semibold text-gray-400 dark:text-gray-500">
                                          </div>

                                          {{-- Content --}}
                                          <div class="min-w-0 flex-1">

                                            {{-- Assessment --}}
                                            <div x-text="indicator.assessment"
                                              class="border-b border-gray-100 pb-3 text-sm leading-6 text-gray-700 dark:border-gray-800 dark:text-gray-300"
                                              style="text-align: justify;"></div>

                                            {{-- Status --}}
                                            <div class="mt-3 flex flex-wrap items-center gap-3">

                                              {{-- Submission < Assessment --}}
                                              <template
                                                x-if="parseInt(indicator.submission_status) < parseInt(indicator.assessment_status)">
                                                <div class="text-green-500">
                                                  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                                  </svg>
                                                </div>
                                              </template>

                                              {{-- Submission = Assessment --}}
                                              <template
                                                x-if="parseInt(indicator.submission_status) === parseInt(indicator.assessment_status)">
                                                <div class="text-yellow-500">
                                                  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3.75 9h16.5m-16.5 6.75h16.5" />
                                                  </svg>
                                                </div>
                                              </template>

                                              {{-- Submission > Assessment --}}
                                              <template
                                                x-if="parseInt(indicator.submission_status) > parseInt(indicator.assessment_status)">
                                                <div class="text-red-500">
                                                  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                                  </svg>
                                                </div>
                                              </template>

                                              {{-- Feedback --}}
                                              <template x-if="indicator.feedback == '0'">
                                                <div class="text-red-500">
                                                  <i class="fas fa-user-times"></i>
                                                </div>
                                              </template>

                                              <template x-if="indicator.feedback == '1'">
                                                <div class="text-green-500">
                                                  <i class="fas fa-user-check"></i>
                                                </div>
                                              </template>

                                              {{-- Validation --}}
                                              <template x-if="indicator.validation_status == 1">
                                                <div class="text-red-500">
                                                  <i class="fa-solid fa-d"></i>
                                                </div>
                                              </template>

                                              <template x-if="indicator.validation_status == 2">
                                                <div class="text-yellow-500">
                                                  <i class="fa-solid fa-c"></i>
                                                </div>
                                              </template>

                                              <template x-if="indicator.validation_status == 3">
                                                <div class="text-green-500">
                                                  <i class="fa-solid fa-b"></i>
                                                </div>
                                              </template>

                                              <template x-if="indicator.validation_status == 4">
                                                <div class="text-blue-500">
                                                  <i class="fa-solid fa-a"></i>
                                                </div>
                                              </template>

                                            </div>

                                            {{-- Detail Button --}}
                                            <div class="mt-3">
                                              <button @click="openIndicator(indicator.id)" type="button"
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700 transition-colors hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                                  viewBox="0 0 24 24">
                                                  <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                  <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>

                                                Lihat Detail
                                              </button>
                                            </div>

                                          </div>
                                        </div>

                                        {{-- Modal --}}
                                        <div x-cloak x-show="focusIndicatorId === indicator.id"
                                          class="fixed inset-0 z-40 flex items-end justify-center bg-black/50 sm:items-center">
                                          <div x-show="focusIndicatorId === indicator.id"
                                            @keydown.escape="closeIndicator()"
                                            x-transition:enter="transition ease-out duration-150"
                                            x-transition:enter-start="opacity-0 translate-y-1/2"
                                            x-transition:enter-end="opacity-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100"
                                            x-transition:leave-end="opacity-0 translate-y-1/2"
                                            class="flex w-full max-w-7xl flex-col gap-2 overflow-hidden rounded-t-2xl bg-white p-6 shadow-xl dark:bg-gray-900 sm:rounded-2xl"
                                            :id="'modal-' + indicator.id">

                                            {{-- Header Modal --}}
                                            <header class="mb-2 flex items-start justify-between">
                                              <div>
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                  <i class="fa-solid fa-clipboard mr-2 text-primary"></i>
                                                  Audit
                                                  <span x-text="indicator.code"></span>
                                                </h3>

                                                <h2
                                                  class="mt-2 max-h-20 overflow-y-auto text-sm leading-6 text-gray-600 dark:text-gray-400"
                                                  style="text-align: justify;" x-text="indicator.assessment"></h2>
                                              </div>

                                              <button type="button" @click="closeIndicator()"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                                                </svg>
                                              </button>
                                            </header>

                                            {{-- Modal Body --}}
                                            <div class="mt-2 max-h-[55vh] w-full overflow-y-auto px-1">

                                              {{-- ============================= --}}
                                              {{-- PENGAJUAN --}}
                                              {{-- ============================= --}}

                                              <div class="mb-6">
                                                <span
                                                  class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                                  Pengajuan
                                                </span>

                                                <div
                                                  class="mt-4 rounded-xl border border-gray-100 bg-gray-50/50 p-5 dark:border-gray-800 dark:bg-gray-800/30">

                                                  {{-- Nilai --}}
                                                  <div>
                                                    <div
                                                      class="mb-2 flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                                      <i class="fa-solid fa-chart-column text-gray-400"></i>
                                                      Nilai Indikator
                                                    </div>

                                                    <select x-model="indicator.submission_status" disabled
                                                      class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-2 text-sm text-gray-700 focus:border-primary focus:ring-0 dark:border-gray-700 dark:text-gray-300">
                                                      <option hidden value="">
                                                        Indicator Grade
                                                      </option>

                                                      @foreach ($statuses as $status)
                                                        <option value="{{ $status->id }}">
                                                          {{ $status->name }}
                                                        </option>
                                                      @endforeach
                                                    </select>
                                                  </div>

                                                  {{-- Validation --}}
                                                  <div class="mt-5">
                                                    <div
                                                      class="mb-2 flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                                      <i class="fa-solid fa-check-circle text-gray-400"></i>
                                                      Validasi
                                                    </div>

                                                    {{-- Pertahankan semua template entry Anda di sini --}}
                                                    {{-- Option --}}
                                                    <template x-if="indicator.entry === 'Option'">
                                                      <select disabled x-model="indicator.validation"
                                                        class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-2 text-sm focus:border-primary focus:ring-0 dark:border-gray-700 dark:text-gray-300">
                                                        <option hidden value="">Validation</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                      </select>
                                                    </template>

                                                    {{-- Digit --}}
                                                    <template x-if="indicator.entry === 'Digit'">
                                                      <input disabled x-model="indicator.validation"
                                                        placeholder="Digit"
                                                        class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-2 text-sm text-gray-700 focus:border-primary focus:ring-0 dark:border-gray-700 dark:text-white" />
                                                    </template>

                                                    {{-- Decimal --}}
                                                    <template x-if="indicator.entry === 'Decimal'">
                                                      <input disabled x-model="indicator.validation"
                                                        placeholder="Decimal"
                                                        class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-2 text-sm text-gray-700 focus:border-primary focus:ring-0 dark:border-gray-700 dark:text-white" />
                                                    </template>

                                                    {{-- Cost --}}
                                                    <template x-if="indicator.entry === 'Cost'">
                                                      <input disabled x-model="indicator.validation"
                                                        placeholder="Rupiah"
                                                        class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-2 text-sm text-gray-700 focus:border-primary focus:ring-0 dark:border-gray-700 dark:text-white" />
                                                    </template>

                                                    {{-- Percentage --}}
                                                    <template x-if="indicator.entry === 'Percentage'">
                                                      <div class="flex items-center gap-2">
                                                        <input disabled x-model="indicator.validation"
                                                          placeholder="Percentage"
                                                          class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-2 text-sm text-gray-700 focus:border-primary focus:ring-0 dark:border-gray-700 dark:text-white" />
                                                        <span class="text-sm text-gray-400">%</span>
                                                      </div>
                                                    </template>

                                                    {{-- Rate --}}
                                                    <template
                                                      x-if="indicator.entry === 'Rate' && (indicator.rate_option === null || indicator.rate_option === '' || indicator.rate_option === '1-10')">
                                                      <div>
                                                        <div class="mb-2 text-xs text-gray-500">
                                                          Rate 1 - 10
                                                        </div>

                                                        <input disabled x-model="indicator.validation" type="range"
                                                          max="10" class="w-full" />

                                                        <div class="mt-1 flex justify-between text-xs text-gray-400">
                                                          @for ($i = 0; $i <= 10; $i++)
                                                            <span>{{ $i }}</span>
                                                          @endfor
                                                        </div>
                                                      </div>
                                                    </template>

                                                    {{-- Rate 1-100 --}}
                                                    <template
                                                      x-if="indicator.entry === 'Rate' && indicator.rate_option === '1-100'">
                                                      <div class="flex items-center gap-2">
                                                        <input disabled x-model="indicator.validation"
                                                          placeholder="Range 1 - 100"
                                                          class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-2 text-sm text-gray-700 focus:border-primary focus:ring-0 dark:border-gray-700 dark:text-white" />

                                                        <span class="text-sm text-gray-400">/100</span>
                                                      </div>
                                                    </template>

                                                    {{-- Researcher Satisfaction --}}
                                                    <template
                                                      x-if="indicator.entry === 'Rate' && indicator.rate_option === 'researcherSatisfaction'">
                                                      <div>
                                                        <p class="mb-3 text-sm text-gray-500">
                                                          Beri nilai sesuai tingkat kepuasan
                                                        </p>

                                                        <div class="flex flex-wrap gap-5 text-sm text-gray-500">
                                                          <label class="flex items-center gap-2">
                                                            <input disabled type="radio"
                                                              x-model="indicator.validation" value="kurang">
                                                            <span>Kurang</span>
                                                          </label>

                                                          <label class="flex items-center gap-2">
                                                            <input disabled type="radio"
                                                              x-model="indicator.validation" value="cukup">
                                                            <span>Cukup</span>
                                                          </label>

                                                          <label class="flex items-center gap-2">
                                                            <input disabled type="radio"
                                                              x-model="indicator.validation" value="memuaskan">
                                                            <span>Memuaskan</span>
                                                          </label>

                                                          <label class="flex items-center gap-2">
                                                            <input disabled type="radio"
                                                              x-model="indicator.validation" value="sangat memuaskan">
                                                            <span>Sangat Memuaskan</span>
                                                          </label>
                                                        </div>
                                                      </div>
                                                    </template>
                                                  </div>

                                                  {{-- Link --}}
                                                  <div class="mt-5">
                                                    <div
                                                      class="mb-2 flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                                      <i class="fa-solid fa-link text-gray-400"></i>
                                                      Link
                                                    </div>

                                                    <a :href="indicator.link" target="_blank"
                                                      class="block truncate text-sm text-blue-600 hover:underline dark:text-blue-400"
                                                      x-text="indicator.link"></a>
                                                  </div>

                                                </div>
                                              </div>


                                              {{-- ============================= --}}
                                              {{-- PEMERIKSAAN --}}
                                              {{-- ============================= --}}

                                              {{-- <div class="mb-6">
                                                <span
                                                  class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                                                  Pemeriksaan
                                                </span>

                                                <div
                                                  class="mt-4 rounded-xl border border-gray-100 bg-gray-50/50 p-5 dark:border-gray-800 dark:bg-gray-800/30">

                                                  <div>
                                                    <div
                                                      class="mb-2 flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                                      <i class="fa-solid fa-chart-column text-gray-400"></i>
                                                      Nilai Indikator
                                                    </div>

                                                    <select disabled x-model="indicator.assessment_status"
                                                      class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-2 text-sm focus:border-primary focus:ring-0 dark:border-gray-700 dark:text-gray-300">
                                                      <option hidden value="">
                                                        Nilai Indikator
                                                      </option>

                                                      @foreach ($statuses as $status)
                                                        <option value="{{ $status->id }}">
                                                          {{ $status->name }}
                                                        </option>
                                                      @endforeach
                                                    </select>
                                                  </div>

                                                  <div class="mt-5">
                                                    <label
                                                      class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                      <i class="fa-regular fa-comment-dots mr-2 text-gray-400"></i>
                                                      Pesan Penilaian
                                                    </label>

                                                    <textarea disabled rows="4" x-model="indicator.description"
                                                      class="block w-full rounded-lg border border-gray-200 bg-white p-3 text-sm text-gray-700 focus:border-primary focus:ring-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"></textarea>
                                                  </div>

                                                  <div class="mt-6 border-t border-gray-100 pt-5 dark:border-gray-800">

                                                    <div class="mb-3">
                                                      <span
                                                        class="text-xs font-medium uppercase tracking-wider text-gray-400">
                                                        Feedback Auditee
                                                      </span>
                                                    </div>

                                                    <select disabled x-model="indicator.feedback"
                                                      class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-2 text-sm focus:border-primary focus:ring-0 dark:border-gray-700 dark:text-gray-300">
                                                      <option hidden value="">
                                                        Feedback Auditee
                                                      </option>
                                                      <option value="1">Agree</option>
                                                      <option value="0">Disagree</option>
                                                    </select>

                                                    <label
                                                      class="mt-5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                      <i class="fa-regular fa-comment-dots mr-2 text-gray-400"></i>
                                                      Pesan Auditee
                                                    </label>

                                                    <textarea disabled rows="4" x-model="indicator.comment"
                                                      class="mt-2 block w-full rounded-lg border border-gray-200 bg-white p-3 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"></textarea>
                                                  </div>

                                                  <div class="mt-6 border-t border-gray-100 pt-5 dark:border-gray-800">

                                                    <div class="mb-3">
                                                      <span
                                                        class="text-xs font-medium uppercase tracking-wider text-gray-400">
                                                        Formulir Validasi
                                                      </span>
                                                    </div>

                                                    <select disabled x-model="indicator.validation_status"
                                                      class="w-full border-0 border-b border-gray-200 bg-transparent px-0 py-2 text-sm focus:border-primary focus:ring-0 dark:border-gray-700 dark:text-gray-300">
                                                      <option hidden value="">
                                                        Nilai Indikator
                                                      </option>

                                                      @foreach ($statuses as $status)
                                                        <option value="{{ $status->id }}">
                                                          {{ $status->name }}
                                                        </option>
                                                      @endforeach
                                                    </select>

                                                    <label
                                                      class="mt-5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                      <i class="fa-regular fa-comment-dots mr-2 text-gray-400"></i>
                                                      Kesimpulan Final
                                                    </label>

                                                    <textarea disabled rows="4" x-model="indicator.conclusion"
                                                      class="mt-2 block w-full rounded-lg border border-gray-200 bg-white p-3 text-sm text-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"></textarea>
                                                  </div>

                                                </div>
                                              </div> --}}

                                            </div>

                                            {{-- Footer --}}
                                            <footer
                                              class="flex justify-end border-t border-gray-100 pt-4 dark:border-gray-800">
                                              <button @click="closeIndicator()" type="button"
                                                class="inline-flex items-center rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                                Tutup
                                              </button>
                                            </footer>

                                          </div>
                                        </div>

                                      </div>
                                    </template>

                                  </div>
                                </td>
                              </tr>
                            </template>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </template>
              </div>
            </div>
          </div>
        </template>
      </div>

    </div>


  </div>

  <script>
    function form() {
      return {
        categories: [
          @foreach ($grouped as $index => $category)
            {
              id: '{{ $index }}',
              name: @json($category->first()->indicator->competency->standard->category->name),
              standards: [
                @foreach ($category->groupBy('indicator.competency.standard.id') as $standardIndex => $standard)
                  {
                    id: '{{ $standardIndex }}',
                    name: @json($standard->first()->indicator->competency->standard->name),
                    competencies: [
                      @foreach ($standard->groupBy('indicator.competency.id') as $competencyIndex => $indicators)
                        {
                          id: '{{ $competencyIndex }}',
                          name: @json($indicators->first()->indicator->competency->name),
                          indicators: [
                            @foreach ($indicators as $indicator)
                              {
                                id: '{{ $indicator->id }}',
                                submission_status: '{{ $indicator->submission_status }}',
                                validation: '{{ $indicator->validation }}',
                                link: '{{ $indicator->link }}',
                                assessment_status: '{{ $indicator->assessment_status }}',
                                description: @json($indicator->description),
                                feedback: '{{ $indicator->feedback }}',
                                comment: @json($indicator->comment),
                                validation_status: '{{ $indicator->validation_status }}',
                                conclusion: @json($indicator->conclusion),
                                code: '{{ $indicator->indicator->code }}',
                                assessment: @json($indicator->indicator->assessment),
                                entry: '{{ $indicator->indicator->entry }}',
                                rate_option: '{{ $indicator->indicator->rate_option }}',
                              },
                            @endforeach
                          ]
                        },
                      @endforeach
                    ]
                  },
                @endforeach
              ]
            },
          @endforeach
        ],
        openTab: '{{ $grouped->isNotEmpty() ? $grouped->keys()->first() : '' }}',
        initTextareas() {
          function textareaAutoHeight(el, offsetTop = 0) {
            el.style.height = 'auto';
            el.style.height = `${el.scrollHeight + offsetTop}px`;
          }

          this.$nextTick(() => {
            document.querySelectorAll('textarea').forEach(textarea => {
              textarea.addEventListener('focus', () => textareaAutoHeight(textarea, 30));
              textareaAutoHeight(textarea, 30); // Initial call
            });
          });

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
        focusIndicatorId: null,
        focusTrap: null,
        openIndicator(indicatorId) {
          this.focusIndicatorId = indicatorId;
          this.focusTrap = focusTrap(document.querySelector('#modal-' + indicatorId));
        },
        closeIndicator() {
          // Close without confirmation if no changes
          this.focusIndicatorId = null;
          this.focusTrap();
        },
      }
    }
  </script>

</x-app-layout>
