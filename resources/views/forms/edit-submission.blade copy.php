<x-app-layout>
  <form method="POST" action="{{ route('forms.updateSubmission', $form) }}" id="form"
    class="flex h-full w-full flex-col gap-y-1 font-semibold" x-data="form()" x-init="init()">
    @csrf
    @method('PUT')

    <div class="flex items-center justify-between">
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
          Submission
        </span>
      </div>

      {{-- Right Action --}}
      <div class="ml-4 flex shrink-0 items-center gap-3">

        {{-- Active Users --}}
        <div class="flex -space-x-2">
          <template x-for="(user, index) in activeUsers" :key="index">
            <div x-show="index < 2" class="group relative inline-block hover:z-10">
              <img :src="'https://ui-avatars.com/api/?name=' + encodeURIComponent(user.name) + '&background=random'"
                :alt="user.name"
                class="h-8 w-8 rounded-full border-2 border-white object-cover dark:border-gray-800">

              {{-- Tooltip --}}
              <span x-text="user.name"
                class="invisible absolute left-1/2 top-full z-50 mt-2 -translate-x-1/2 whitespace-nowrap rounded-lg bg-gray-900 px-3 py-1.5 text-xs text-white opacity-0 shadow-lg transition-all duration-200 group-hover:visible group-hover:opacity-100 dark:bg-white dark:text-gray-900">
              </span>
            </div>
          </template>

          {{-- More Users --}}
          <template x-if="activeUsers.length > 2">
            <div class="group relative inline-block hover:z-10">
              <div x-text="`+${activeUsers.length - 2}`"
                class="flex h-8 min-w-8 items-center justify-center rounded-full border-2 border-white bg-gray-100 px-2 text-xs font-medium text-gray-700 dark:border-gray-800 dark:bg-gray-700 dark:text-gray-200">
              </div>

              {{-- Tooltip --}}
              <div
                class="invisible absolute right-0 top-full z-50 mt-2 min-w-[120px] rounded-lg bg-gray-900 px-3 py-2 text-xs text-white opacity-0 shadow-lg transition-all duration-200 group-hover:visible group-hover:opacity-100 dark:bg-white dark:text-gray-900">
                <template x-for="(user, index) in activeUsers" :key="index">
                  <span x-show="index >= 2" x-text="user.name" class="block truncate">
                  </span>
                </template>
              </div>
            </div>
          </template>
        </div>

        {{-- Contact Button --}}
        <button type="button" @click="openContact()"
          class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          Kontak
        </button>
      </div>
    </div>


    {{-- Contact Modal --}}
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
                  alt="{{ $auditee->user->name }}" loading="lazy" class="h-9 w-9 shrink-0 rounded-full object-cover">

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
                  alt="{{ $auditor->user->name }}" loading="lazy" class="h-9 w-9 shrink-0 rounded-full object-cover">

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

    <div class="flex h-[85%] w-full flex-col gap-y-2 overflow-auto">

      <div class="flex justify-between gap-x-2">
        <div class="flex w-full whitespace-nowrap" data-simplebar>
          <ul class="flex">
            <template x-for="category in categories" :key="category.id">
              <li @click.prevent="openTab = category.id" x-text="category.name"
                :class="openTab === category.id ?
                    'border border-primary dark:text-cool-gray-50 text-primary dark:border-cool-gray-50' :
                    'border-2 border-gray-300 text-gray-500 hover:border hover:text-green-400 hover:border-green-400 dark:hover:border-red-500 dark:hover:text-gray-200 dark:border-gray-400 dark:text-gray-400'"
                class="mr-1 flex cursor-pointer items-center gap-x-2 rounded-md  bg-white p-2 dark:bg-gray-700">
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
                      class="ms-2 hidden py-1 text-left text-sm leading-6 text-gray-700 hover:text-gray-900 focus:text-blue-600 focus:outline-none hs-scrollspy-active:text-blue-600 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-blue-500 dark:hs-scrollspy-active:text-blue-500 md:block"></a>
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
                        <table class="w-full ">
                          <thead>
                            <tr
                              class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                              <th class="w-[35%] px-6 py-4">
                                Kompetensi</th>
                              <th class="w-[35%] px-6 py-4">
                                Indikator</th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                            <template x-for="competency in standard.competencies" :key="competency.id">
                              <tr>
                                <td class="px-6 py-5">
                                  <textarea x-model="competency.name" disabled
                                    class="w-full resize-none overflow-hidden border-0 bg-transparent p-0 text-gray-500 focus:ring-0"
                                    style="text-align: justify;" placeholder="Competency Name">
                                                            </textarea>
                                </td>
                                <td class="px-6 py-5">
                                  <template x-for="indicator in competency.indicators" :key="indicator.id">
                                    <div
                                      class="my-4 flex w-full flex-col items-center justify-end gap-x-4 gap-y-1 md:flex-row">
                                      <div x-text="indicator.code"
                                        class="text-sm text-gray-500 dark:border-gray-500 dark:bg-gray-700 dark:text-purple-400">
                                      </div>
                                      <div x-text="indicator.assessment"
                                        class="line-clamp-3 w-full  border-x-transparent border-b-gray-200 border-t-transparent bg-transparent text-sm text-gray-500"
                                        style="text-align: justify;">
                                      </div>
                                      <!-- Modal Content -->
                                      <template
                                        x-if="!indicator.submission_status | !indicator.validation | !indicator.link">
                                        <button type="button" @click="openIndicator(indicator)"
                                          class="text-gray-500 flex items-center hover:text-blue-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500">
                                          <i class="fas fa-marker text-sm mr-1"></i>
                                          <p class="text-sm"> Isi
                                          </p>
                                        </button>
                                      </template>
                                      <template
                                        x-if="indicator.submission_status && indicator.validation && indicator.link">
                                        <button @click="openIndicator(indicator)" type="button"
                                          class="text-blue-600 hover:text-blue-700 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500">
                                          <i class="fa-solid fa-check fa-lg"></i>
                                        </button>
                                      </template>
                                      <div x-show="focusIndicator.id === indicator.id"
                                        class="fixed inset-0 z-50 flex items-end justify-center bg-black bg-opacity-50 sm:items-center sm:px-4">

                                        <!-- Modal -->
                                        <div x-cloak x-show="focusIndicator.id === indicator.id"
                                          @click.away="closeIndicator()" @keydown.escape="closeIndicator()"
                                          x-transition:enter="transition ease-out duration-150"
                                          x-transition:enter-start="opacity-0 transform translate-y-1/2"
                                          x-transition:enter-end="opacity-100"
                                          x-transition:leave="transition ease-in duration-150"
                                          x-transition:leave-start="opacity-100"
                                          x-transition:leave-end="opacity-0 transform translate-y-1/2"
                                          class="flex w-full max-w-2xl flex-col overflow-hidden rounded-t-lg bg-white dark:bg-gray-800 sm:rounded-lg"
                                          :id="'modal-' + indicator.id">

                                          <!-- Header -->
                                          <header
                                            class="flex items-start justify-between border-b border-gray-100 px-5 py-4 dark:border-gray-700">

                                            <div class="min-w-0">
                                              <h3 class="text-base font-semibold text-blue-600 dark:text-gray-200">
                                                Isi Laporan
                                              </h3>

                                              <p class="mt-1 truncate text-sm text-gray-500 dark:text-gray-400">
                                                Indikator:
                                                <span x-text="indicator.code" class="font-medium"></span>
                                              </p>
                                            </div>

                                            <button type="button"
                                              class="ml-4 inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg text-gray-400 transition-colors duration-150 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                              @click="closeIndicator()">

                                              <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                  clip-rule="evenodd" fill-rule="evenodd">
                                                </path>
                                              </svg>
                                            </button>
                                          </header>

                                          <!-- Body -->
                                          <div
                                            class="max-h-[75vh] overflow-y-auto scrollbar-thin dark:scrollbar-track-gray-700 dark:scrollbar-thumb-gray-500">

                                            <!-- Assessment -->
                                            <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-700">


                                              <div class="text-sm leading-6 text-gray-700 dark:text-gray-300"
                                                style="text-align: justify;" x-text="indicator.assessment">
                                              </div>
                                            </div>

                                            <!-- Submission Form -->
                                            <div class="px-5 py-5">

                                              <div class="mb-5 flex items-center gap-2">

                                                <div>
                                                  <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                    Formulir Submission
                                                  </h4>
                                                  <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    Lengkapi laporan indikator. </p>
                                                </div>
                                              </div>

                                              <input type="hidden" :name="'indicators[' + indicator.id + ']'"
                                                x-model="JSON.stringify(indicator)">

                                              <div class="space-y-6">

                                                <!-- Indicator Grade -->
                                                <div class="flex items-center gap-3">

                                                  <svg class="size-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                      d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 4.125 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z">
                                                    </path>
                                                  </svg>

                                                  <select @input="isEditing = true"
                                                    x-model="focusIndicator.submission_status"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                                    <option hidden value="">
                                                      penilaian indikator
                                                    </option>

                                                    @foreach ($statuses as $status)
                                                      <option value="{{ $status->id }}">
                                                        {{ $status->name }}
                                                      </option>
                                                    @endforeach
                                                  </select>
                                                </div>

                                                <!-- Validation -->
                                                <div class="flex items-start gap-3">

                                                  <i
                                                    class="fa-solid fa-chart-column mt-1 w-6 text-center text-gray-500"></i>

                                                  <div class="w-full">

                                                    <!-- Option -->
                                                    <template x-if="indicator.entry === 'Option'">
                                                      <select @input="isEditing = true"
                                                        x-model="focusIndicator.validation"
                                                        class="w-full border-x-0 border-b-2 border-t-0 border-gray-200 bg-transparent px-3 py-2 text-sm focus:border-blue-600 focus:ring-0 dark:border-gray-600 dark:text-gray-200">

                                                        <option hidden value="">
                                                          Choose Validation
                                                        </option>

                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                      </select>
                                                    </template>

                                                    <!-- Digit -->
                                                    <template x-if="indicator.entry === 'Digit'">
                                                      <div>
                                                        <label
                                                          class="mb-1 block text-xs text-gray-500 dark:text-gray-400">
                                                          Digit
                                                        </label>

                                                        <input @input="isEditing = true"
                                                          x-model="focusIndicator.validation" type="number"
                                                          placeholder="Enter some digit"
                                                          class="w-full border-x-0 border-b-2 border-t-0 border-gray-200 bg-transparent px-3 py-2 text-sm focus:border-blue-600 focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500">
                                                      </div>
                                                    </template>

                                                    <!-- Decimal -->
                                                    <template x-if="indicator.entry === 'Decimal'">
                                                      <div>
                                                        <label
                                                          class="mb-1 block text-xs text-gray-500 dark:text-gray-400">
                                                          Decimal
                                                        </label>

                                                        <input @input="isEditing = true"
                                                          x-model="focusIndicator.validation" type="number"
                                                          placeholder="Enter some decimal"
                                                          class="w-full border-x-0 border-b-2 border-t-0 border-gray-200 bg-transparent px-3 py-2 text-sm focus:border-blue-600 focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500">
                                                      </div>
                                                    </template>

                                                    <!-- Cost -->
                                                    <template x-if="indicator.entry === 'Cost'">
                                                      <div>
                                                        <label
                                                          class="mb-1 block text-xs text-gray-500 dark:text-gray-400">
                                                          Rupiah
                                                        </label>

                                                        <input
                                                          @input="isEditing = true; formatCurrency($event.target.value);"
                                                          x-model="focusIndicator.validation"
                                                          placeholder="Enter some Rupiah"
                                                          class="w-full border-x-0 border-b-2 border-t-0 border-gray-200 bg-transparent px-3 py-2 text-sm focus:border-blue-600 focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500">
                                                      </div>
                                                    </template>

                                                    <!-- Activity Data (for non-actual_percentage) -->
                                                    <template
                                                      x-if="indicator.entry === 'Percentage' && indicator.percentage_option !== 'actual_percentage'">
                                                      <div
                                                        class="mb-4 rounded-lg border border-blue-200 bg-blue-50 p-4 dark:border-blue-800 dark:bg-blue-900/20">
                                                        <div class="mb-3 flex items-center gap-2">
                                                          <svg class="size-4 text-blue-600 dark:text-blue-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                          </svg>
                                                          <h5
                                                            class="text-sm font-semibold text-blue-700 dark:text-blue-400">
                                                            Data Aktivitas
                                                          </h5>
                                                        </div>

                                                        <div class="mb-3 grid grid-cols-3 gap-2 text-xs">
                                                          <div class="rounded bg-white p-2 dark:bg-gray-900">
                                                            <p class="text-gray-500 dark:text-gray-400">Kategori</p>
                                                            <p class="font-medium text-gray-900 dark:text-white"
                                                              x-text="indicator.activity_category || '-'"></p>
                                                          </div>
                                                          <div class="rounded bg-white p-2 dark:bg-gray-900">
                                                            <p class="text-gray-500 dark:text-gray-400">Peserta</p>
                                                            <p class="font-medium text-gray-900 dark:text-white"
                                                              x-text="indicator.participant || '-'"></p>
                                                          </div>
                                                          <div class="rounded bg-white p-2 dark:bg-gray-900">
                                                            <p class="text-gray-500 dark:text-gray-400">Tahun</p>
                                                            <p class="font-medium text-gray-900 dark:text-white"
                                                              x-text="indicator.activity_year || '-'"></p>
                                                          </div>
                                                        </div>

                                                        <button @click="fetchActivity(indicator)" type="button"
                                                          class="mb-3 inline-flex items-center gap-1 rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-medium text-white transition-colors hover:bg-blue-500">
                                                          <svg class="size-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                          </svg>
                                                          Muat Data Aktivitas
                                                        </button>

                                                        <div x-show="activityData"
                                                          class="overflow-hidden rounded-lg border border-blue-200 dark:border-blue-800">
                                                          <div class="max-h-60 overflow-auto">
                                                            <table class="w-full text-xs">
                                                              <thead class="bg-blue-100 dark:bg-blue-900/50">
                                                                <tr>
                                                                  <th
                                                                    class="px-3 py-2 text-left font-semibold text-blue-800 dark:text-blue-300">
                                                                    Prodi</th>
                                                                  <th
                                                                    class="px-3 py-2 text-left font-semibold text-blue-800 dark:text-blue-300">
                                                                    Jurusan</th>
                                                                  <th
                                                                    class="px-3 py-2 text-left font-semibold text-blue-800 dark:text-blue-300">
                                                                    Fakultas</th>
                                                                  <th
                                                                    class="px-3 py-2 text-right font-semibold text-blue-800 dark:text-blue-300">
                                                                    Jumlah</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody
                                                                class="divide-y divide-blue-100 dark:divide-blue-800">
                                                                <template
                                                                  x-for="(item, index) in activityData?.data?.items || []"
                                                                  :key="index">
                                                                  <tr class="bg-white dark:bg-gray-900">
                                                                    <td class="px-3 py-2 text-gray-900 dark:text-white"
                                                                      x-text="item.prodi?.nama || '-'"></td>
                                                                    <td
                                                                      class="px-3 py-2 text-gray-600 dark:text-gray-400"
                                                                      x-text="item.jurusan?.nama || '-'"></td>
                                                                    <td
                                                                      class="px-3 py-2 text-gray-600 dark:text-gray-400"
                                                                      x-text="item.fakultas?.nama || '-'"></td>
                                                                    <td
                                                                      class="px-3 py-2 text-right font-medium text-gray-900 dark:text-white"
                                                                      x-text="item.jumlah || 0"></td>
                                                                  </tr>
                                                                </template>
                                                              </tbody>
                                                              <tfoot class="bg-blue-50 dark:bg-blue-900/30">
                                                                <tr>
                                                                  <td colspan="3"
                                                                    class="px-3 py-2 text-right font-semibold text-blue-800 dark:text-blue-300">
                                                                    Total:</td>
                                                                  <td
                                                                    class="px-3 py-2 text-right font-bold text-blue-800 dark:text-blue-300"
                                                                    x-text="activityData?.data?.total || 0"></td>
                                                                </tr>
                                                              </tfoot>
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </template>

                                                    <!-- Percentage -->
                                                    <template
                                                      x-if="indicator.entry === 'Percentage' && indicator.percentage_option === 'actual_percentage'">
                                                      <div class="flex items-end gap-2">
                                                        <div class="w-full">
                                                          <label
                                                            class="mb-1 block text-xs text-gray-500 dark:text-gray-400">
                                                            Percentage
                                                          </label>

                                                          <input @input="isEditing = true"
                                                            x-model="focusIndicator.validation" type="number"
                                                            min="0" max="100"
                                                            placeholder="Enter percentage"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            oninput="if (this.value < 0) this.value = 0; else if (this.value > 100) this.value = 100;">
                                                        </div>

                                                        <span class="pb-2 text-sm font-semibold text-gray-500">
                                                          %
                                                        </span>
                                                      </div>
                                                    </template>


                                                    <template
                                                      x-if="indicator.entry === 'Percentage' && indicator.percentage_option == 'percentage-1'">

                                                      <div>
                                                        <p class="mb-3 text-sm text-gray-600 dark:text-gray-300">
                                                          Beri nilai sesuai tingkat pencapaian indikator
                                                        </p>

                                                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">

                                                          <label
                                                            class="flex cursor-pointer items-center gap-2 text-sm">
                                                            <input type="radio" x-model="focusIndicator.validation"
                                                              value="batas_bawah" @change="isEditing = true"
                                                              class="text-blue-600 focus:ring-blue-500">
                                                            <span>100% Prodi memenuhi "Batas Bawah"</span>
                                                          </label>

                                                          <label
                                                            class="flex cursor-pointer items-center gap-2 text-sm">
                                                            <input type="radio" x-model="focusIndicator.validation"
                                                              value="batas_target" @change="isEditing = true"
                                                              class="text-blue-600 focus:ring-blue-500">
                                                            <span>100% Prodi memenuhi "Batas Target"</span>
                                                          </label>

                                                          <label
                                                            class="flex cursor-pointer items-center gap-2 text-sm">
                                                            <input type="radio" x-model="focusIndicator.validation"
                                                              value="target_maks3" @change="isEditing = true"
                                                              class="text-blue-600 focus:ring-blue-500">
                                                            <span>100% Prodi memenuhi "Batas Target" dan maks 3 Prodi
                                                              tidak memenuhi "Batas Melampaui"</span>
                                                          </label>



                                                        </div>
                                                      </div>
                                                    </template>
                                                    <!-- Rate 1-10 -->
                                                    <template
                                                      x-if="indicator.entry === 'Rate' && (indicator.rate_option === null || indicator.rate_option === '' || indicator.rate_option === '1-10')">
                                                      <div>
                                                        <div
                                                          class="mb-2 flex items-center justify-between text-sm text-gray-600 dark:text-gray-300">
                                                          <span>Rate 1 - 10</span>
                                                          <span class="text-xs text-gray-400">(Replace 5)</span>
                                                        </div>

                                                        <input @input="isEditing = true"
                                                          x-model="focusIndicator.validation" type="range"
                                                          max="10" class="w-full">

                                                        <div
                                                          class="flex w-full justify-between px-1 text-xs text-gray-400">
                                                          @for ($i = 0; $i <= 10; $i++)
                                                            <span>{{ $i }}</span>
                                                          @endfor
                                                        </div>
                                                      </div>
                                                    </template>

                                                    <!-- Rate 1-100 -->
                                                    <template
                                                      x-if="indicator.entry === 'Rate' && indicator.rate_option === '1-100'">
                                                      <div class="flex items-end gap-2">
                                                        <div class="w-full">
                                                          <label
                                                            class="mb-1 block text-xs text-gray-500 dark:text-gray-400">
                                                            Rate
                                                          </label>

                                                          <input @input="isEditing = true"
                                                            x-model="focusIndicator.validation" type="number"
                                                            min="0" max="100" placeholder="Range 1 - 100"
                                                            class="w-full border-x-0 border-b-2 border-t-0 border-gray-200 bg-transparent px-3 py-2 text-sm focus:border-blue-600 focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500">
                                                        </div>

                                                        <span class="pb-2 text-sm text-gray-500">
                                                          /100
                                                        </span>
                                                      </div>
                                                    </template>

                                                    <!-- Researcher Satisfaction -->
                                                    <template
                                                      x-if="indicator.entry === 'Rate' && indicator.rate_option === 'researcher_satisfaction'">
                                                      <div>
                                                        <p class="mb-3 text-sm text-gray-600 dark:text-gray-300">
                                                          Beri nilai sesuai tingkat kepuasan
                                                        </p>

                                                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">

                                                          <label
                                                            class="flex cursor-pointer items-center gap-2 text-sm">
                                                            <input type="radio" x-model="focusIndicator.validation"
                                                              value="kurang" @change="isEditing = true"
                                                              class="text-blue-600 focus:ring-blue-500">
                                                            <span>Kurang</span>
                                                          </label>

                                                          <label
                                                            class="flex cursor-pointer items-center gap-2 text-sm">
                                                            <input type="radio" x-model="focusIndicator.validation"
                                                              value="cukup" @change="isEditing = true"
                                                              class="text-blue-600 focus:ring-blue-500">
                                                            <span>Cukup</span>
                                                          </label>

                                                          <label
                                                            class="flex cursor-pointer items-center gap-2 text-sm">
                                                            <input type="radio" x-model="focusIndicator.validation"
                                                              value="memuaskan" @change="isEditing = true"
                                                              class="text-blue-600 focus:ring-blue-500">
                                                            <span>Memuaskan</span>
                                                          </label>

                                                          <label
                                                            class="flex cursor-pointer items-center gap-2 text-sm">
                                                            <input type="radio" x-model="focusIndicator.validation"
                                                              value="sangat memuaskan" @change="isEditing = true"
                                                              class="text-blue-600 focus:ring-blue-500">
                                                            <span>Sangat Memuaskan</span>
                                                          </label>

                                                        </div>
                                                      </div>
                                                    </template>

                                                  </div>
                                                </div>

                                                <!-- Link -->
                                                <div class="flex items-center gap-3">

                                                  <svg class="size-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                      d="m13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244">
                                                    </path>
                                                  </svg>

                                                  <div class="flex w-full items-center">

                                                    <div class="flex w-full text-sm">

                                                      <span
                                                        class="inline-flex min-w-fit items-center rounded-s-lg border border-e-0 border-gray-200 bg-gray-50 px-3 py-2.5 text-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                                        Link
                                                      </span>

                                                      <input type="text" @input="isEditing = true"
                                                        x-model="focusIndicator.link"
                                                        class="w-full rounded-e-lg border-gray-200 bg-gray-50 px-3 py-2.5 text-blue-600 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-blue-500"
                                                        placeholder="https://www.example.com">

                                                    </div>

                                                    <div class="ml-2 hs-tooltip">
                                                      <svg class="size-5 text-blue-600"
                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z">
                                                        </path>
                                                      </svg>

                                                      <div
                                                        class="hs-tooltip-content invisible absolute z-10 hidden max-w-xs rounded-lg border border-gray-100 bg-white p-3 text-gray-600 opacity-0 shadow-md transition-opacity hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">

                                                        <h3 class="font-semibold text-blue-600">
                                                          Link Verification Info
                                                        </h3>

                                                        <p class="text-sm" x-text="indicator.link_info"></p>

                                                        <p class="text-sm text-gray-500"
                                                          x-show="!indicator.link_info">
                                                          No info available
                                                        </p>

                                                      </div>
                                                    </div>

                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                          </div>

                                          <!-- Footer -->
                                          <footer
                                            class="flex flex-col gap-3 border-t border-gray-100 bg-white px-5 py-3 dark:border-gray-700 dark:bg-gray-800 sm:flex-row sm:justify-end">

                                            <button @click="closeIndicator()" type="button"
                                              class="w-full rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-150 hover:border-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 sm:w-auto">
                                              Batal
                                            </button>

                                            <button @click="submitForm()" type="button"
                                              class="w-full rounded-lg !bg-primary px-5 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:!bg-blue-700 focus:outline-none focus:ring-2 focus:!ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 sm:w-auto">
                                              Simpan
                                            </button>

                                          </footer>

                                        </div>
                                      </div>

                                      <!-- End of modal backdrop -->
                                      <!-- End Modal Content -->
                                    </div>
                                  </template>
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

    <div class="flex justify-between">
      <a href="/forms"
        class="rounded-md bg-gray-500 px-4 py-2 text-xs uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-600 focus:shadow-outline-gray">
        Kembali
      </a>
      @if ($submitAccess)
        <button type="button"
          class="rounded-md !bg-primary px-4 py-2 text-xs uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-blue-800 focus:shadow-outline-blue"
          @click="openConfirm('Yakin ingin mengirim?', 'Data yang dikirim tidak dapat diubah.', () => {
                            document.getElementById('form').submit()
                        });">
          {{ __('Submit') }}
          <input type="hidden" name="action" value="submit">
        </button>
      @endif
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
            class="w-full rounded-lg !bg-primary p-3 tracking-widest text-white transition-colors duration-150 !hover:bg-blue-600 focus:shadow-outline-red sm:w-auto">
            ya, Kirim
          </button>
        </footer>
      </div>
    </div>
  </form>

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
                                code: '{{ $indicator->indicator->code }}',
                                assessment: @json($indicator->indicator->assessment),
                                entry: '{{ $indicator->indicator->entry }}',
                                percentage_option: '{{ $indicator->indicator->percentage_option }}',
                                activity_category: '{{ $indicator->indicator->activity_category }}',
                                participant: '{{ $indicator->indicator->participant }}',
                                activity_year: '{{ $indicator->indicator->activity_year }}',

                                link_info: @json($indicator->indicator->link_info),
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
        focusIndicator: {},
        focusTrap: null,
        isEditing: false,
        isConfirmOpen: false,
        confirmTitle: '',
        confirmText: '',
        confirmAction: null,
        openIndicator(indicator) {
          this.focusIndicator = Object.assign({}, indicator);
          this.activityData = null;
          this.focusTrap = focusTrap(document.querySelector('#modal-' + indicator.id));
        },
        activityData: null,
        formId: {{ $form->id }},
        async fetchActivity(indicator) {
          if (!indicator.activity_category || !indicator.participant || !indicator.activity_year) {
            alert('Kategori, peserta, dan tahun harus diisi terlebih dahulu.');
            return;
          }
          try {
            const response = await fetch(
              `/forms/${this.formId}/get-activity?kategori=${encodeURIComponent(indicator.activity_category)}&peserta=${encodeURIComponent(indicator.participant)}&tahun=${encodeURIComponent(indicator.activity_year)}`
            );
            const data = await response.json();
            this.activityData = data;
          } catch (error) {
            console.error('Error fetching activity:', error);
            alert('Gagal memuat data aktivitas.');
          }
        },
        closeIndicator() {
          if (this.isEditing) {
            // Open confirmation if any changes were made
            this.openConfirm('Yakin ingin membatalkan ?', 'Perubahan tidak akan disimpan.', () => {
              this.focusIndicator = {};
              this.isEditing = false; // Reset flag when closing
            });
          } else {
            // Close without confirmation if no changes
            this.focusIndicator = {};
            this.focusTrap();
          }
        },
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
        formatCurrency(value) {
          const numericValue = parseInt(value.replace(/[^,\d]/g, '')) || 0;
          this.focusIndicator.validation = `Rp. ${numericValue.toLocaleString('id-ID')}`;
        },
        submitForm() {
          if (this.isEditing) {
            const toastContainer = document.getElementById('loading');
            toastContainer.classList.remove('hidden');
            toastContainer.classList.add('flex');
            fetch(`/forms/{{ $form->id }}/submission`, {
                method: 'PUT',
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  indicator: this.focusIndicator
                })
              })
              .then(response => response.json())
              .then(data => {
                this.showToast('success', data.message);
                this.isEditing = false;
                this.closeIndicator();
              })
              .catch(error => {
                this.showToast('danger', 'Terjadi kesalahan');
              })
              .finally(() => {
                toastContainer.classList.remove('flex');
                toastContainer.classList.add('hidden');
              });
          } else {
            this.closeIndicator();
          }
        },
        updateIndicatorData(id, newData) {
          // Loop through categories
          this.categories.forEach(category => {
            category.standards.forEach(standard => {
              standard.competencies.forEach(competency => {
                // Cari indikator dengan ID yang cocok
                competency.indicators.forEach((indicator, index) => {
                  if (indicator.id === id) {
                    competency.indicators[index] = newData;
                  }
                });
              });
            });
          });
        },
        showToast(status, message) {
          let toastContainer;
          if (status === 'success') {
            toastContainer = document.getElementById('toast-success');
          } else if (status === 'danger') {
            toastContainer = document.getElementById('toast-danger');
          } else {
            toastContainer = document.getElementById('toast-warning');
          };

          // Update konten toast dengan message dari server
          toastContainer.querySelector('#message').innerText = message;

          // Pastikan toast terlihat
          toastContainer.classList.add('flex'); // Pastikan toast memiliki kelas flex
          toastContainer.classList.remove('hidden');

          // Sembunyikan toast setelah 3 detik
          setTimeout(() => {
            toastContainer.classList.add('hidden'); // Sembunyikan toast
            toastContainer.classList.remove('flex'); // Kembalikan kelas flex
          }, 10000);
        },
        activeUsers: [],
        updateActiveUsers(users) {
          this.activeUsers = users;
        },
        addActiveUser(user) {
          this.activeUsers.push(user); // Menambahkan pengguna ke daftar aktif
        },
        removeActiveUser(user) {
          this.activeUsers = this.activeUsers.filter(u => u.id !== user
            .id); // Menghapus pengguna dari daftar aktif
        },
        init() {
          Echo.join(`forms.{{ $form->id }}`)
            .here(users => {
              // Menampilkan pengguna yang aktif di channel
              this.updateActiveUsers(users);
            })
            .joining(user => {
              // Memproses pengguna yang baru saja bergabung
              this.addActiveUser(user);
              this.showToast('warning', `${user.name} bergabung ke form`);
            })
            .leaving(user => {
              // Memproses pengguna yang meninggalkan form
              this.removeActiveUser(user);
              this.showToast('warning', `${user.name} meninggalkan form`);
            })
            .listen('FormUpdated', (event) => {
              const updatedData = event.indicatorData;
              this.updateIndicatorData(updatedData.id, updatedData);

              if ('{{ Auth::user()->name }}' !== event.userName) {
                // Lakukan sesuatu hanya jika ID pengguna tidak sama
                const text = `${updatedData.code} diperbarui oleh ${event.userName}`;
                if (this.focusIndicator.id === updatedData.id) {
                  this.showToast('danger', text);
                } else {
                  this.showToast('warning', text);
                }

              }
            });
        },
      }
    }
  </script>
</x-app-layout>
