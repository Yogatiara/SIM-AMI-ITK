<x-app-layout>
  <form id="form" action="{{ route('forms.updatePlanning', $form) }}" method="POST"
    class="flex h-full w-full flex-col gap-y-1 font-semibold" x-data="form()" x-init="init()">
    @csrf
    @method('PUT')

    <div class="flex items-center justify-between">
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
          Planning
        </span>
      </div>

      <div class="flex items-center gap-x-2">

        <div class="flex -space-x-2 text-xs text-white dark:text-gray-800">
          <!-- Display up to 2 users as avatars -->
          <template x-for="(user, index) in activeUsers" :key="index">
            <div x-show="index < 2" class="group relative inline-block hover:z-10">
              <img :src="'https://ui-avatars.com/api/?name=' + user.name + '&background=random'" alt="user"
                class="size-[28px] rounded-full ring-1 ring-neutral-900">
              <!-- Tooltip -->
              <span x-text="user.name"
                class="invisible absolute left-1/2 top-full mt-1 -translate-x-1/2 transform truncate whitespace-nowrap rounded bg-gray-900 px-2.5 py-1.5 opacity-0 transition-opacity duration-300 group-hover:visible group-hover:opacity-100 dark:bg-white"
                style="max-width: 8rem;">
              </span>
            </div>
          </template>

          <!-- Button to show the count of extra users if more than 2 -->
          <template x-if="activeUsers.length > 2">
            <div class="group relative hover:z-10">
              <div x-text="`+${activeUsers.length - 2}`"
                class="flex rounded-full bg-white px-1 py-0.5 text-gray-800 ring-1 ring-neutral-900">
              </div>
              <!-- Tooltip -->
              <div
                class="absolute left-1/2 top-full mt-1 -translate-x-1/2 transform whitespace-nowrap rounded bg-gray-900 px-2.5 py-1.5 opacity-0 transition-opacity duration-300 group-hover:visible group-hover:opacity-100 dark:bg-white">
                <template x-for="(user, index) in activeUsers" :key="index">
                  <span x-show="index >= 2" x-text="user.name" class="block truncate" style="max-width: 8rem;"></span>
                </template>
              </div>
            </div>
          </template>
        </div>

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
                      class="bg-white  text-left mb-2  dark:border-gray-500 dark:bg-gray-700 dark:text-purple-400 sm:text-md border rounded-2xl p-2">
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
                              <th class=" px-6 py-4">
                                Indikator</th>
                            </tr>
                          </thead>
                          <tbody>
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
                                      <div class="flex w-full flex-col gap-y-1">
                                        <div x-text="indicator.assessment"
                                          class="line-clamp-3 w-full  border-x-transparent border-b-gray-200 border-t-transparent bg-transparent text-sm text-gray-500"
                                          style="text-align: justify;">
                                        </div>
                                        <div class="flex items-center gap-x-3">
                                          <template
                                            x-if="parseInt(indicator.submission_status) < parseInt(indicator.assessment_status)">
                                            <div class="text-green-400 dark:text-neutral-500 dark:focus:text-blue-500">
                                              <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18">
                                                </path>
                                              </svg>
                                            </div>
                                          </template>
                                          <template
                                            x-if="parseInt(indicator.submission_status) === parseInt(indicator.assessment_status)">
                                            <div
                                              class="text-yellow-300 dark:text-neutral-500 dark:focus:text-blue-500">
                                              <svg class="size-6" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3.75 9h16.5m-16.5 6.75h16.5">
                                                </path>
                                              </svg>
                                            </div>
                                          </template>
                                          <template
                                            x-if="parseInt(indicator.submission_status) > parseInt(indicator.assessment_status)">
                                            <div class="text-red-500 dark:text-neutral-500 dark:focus:text-blue-500">
                                              <svg class="size-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3">
                                                </path>
                                              </svg>
                                            </div>
                                          </template>
                                          <template x-if="indicator.feedback == '0'">
                                            <div class="text-red-500 dark:text-neutral-500 dark:focus:text-blue-500">
                                              <i class="fas fa-user-times"></i>
                                            </div>
                                          </template>
                                          <template x-if="indicator.feedback == '1'">
                                            <div class="text-green-400 dark:text-neutral-500 dark:focus:text-blue-500">
                                              <i class="fas fa-user-check"></i>
                                            </div>
                                          </template>
                                          <template x-if="indicator.validation_status == 1">
                                            <div class="text-red-500 dark:text-neutral-500 dark:focus:text-blue-500">
                                              <i class="fa-solid fa-d"></i>
                                            </div>
                                          </template>
                                          <template x-if="indicator.validation_status == 2">
                                            <div
                                              class="text-yellow-300 dark:text-neutral-500 dark:focus:text-blue-500">
                                              <i class="fa-solid fa-c"></i>
                                            </div>
                                          </template>
                                          <template x-if="indicator.validation_status == 3">
                                            <div class="text-green-400 dark:text-neutral-500 dark:focus:text-blue-500">
                                              <i class="fa-solid fa-b"></i>
                                            </div>
                                          </template>
                                          <template x-if="indicator.validation_status == 4">
                                            <div class="text-blue-500 dark:text-neutral-500 dark:focus:text-blue-500">
                                              <i class="fa-solid fa-a"></i>
                                            </div>
                                          </template>
                                        </div>
                                      </div>
                                      <!-- Modal Content -->
                                      <template x-if="!indicator.planning">
                                        <button type="button" @click="openIndicator(indicator)"
                                          class="text-gray-500 hover:text-blue-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500">
                                          <i class="fas fa-marker"></i>
                                      </template>
                                      <template x-if="indicator.planning">
                                        <button @click="openIndicator(indicator)" type="button"
                                          class="text-blue-600 hover:text-gray-500 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500">
                                          <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path
                                              d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12">
                                            </path>
                                          </svg>
                                        </button>
                                      </template>

                                      {{-- modal --}}

                                      <div x-cloak x-show="focusIndicator.id === indicator.id"
                                        class="fixed inset-0 z-40 flex items-end justify-center bg-black/50 sm:items-center">

                                        <div x-show="focusIndicator.id === indicator.id"
                                          @keydown.escape="closeIndicator()"
                                          x-transition:enter="transition ease-out duration-150"
                                          x-transition:enter-start="opacity-0 translate-y-1/2"
                                          x-transition:enter-end="opacity-100 translate-y-0"
                                          x-transition:leave="transition ease-in duration-150"
                                          x-transition:leave-start="opacity-100 translate-y-0"
                                          x-transition:leave-end="opacity-0 translate-y-1/2"
                                          class="flex w-full max-w-4xl flex-col gap-2 overflow-hidden rounded-t-2xl bg-white p-6 shadow-xl dark:bg-gray-900 sm:rounded-2xl"
                                          :id="'modal-' + indicator.id">

                                          {{-- Header Modal --}}
                                          <header class="mb-2 flex items-start justify-between gap-4">

                                            <div class="min-w-0">

                                              <h3
                                                class="flex items-center text-xl font-semibold text-gray-900 dark:text-white">
                                                <i class="fa-solid fa-clipboard-check mr-2 text-primary"></i>
                                                Set Final Decision
                                                <span class="ml-1" x-text="indicator.code"></span>
                                              </h3>

                                              <p class="mt-2 max-h-20 overflow-y-auto text-sm leading-6 text-gray-600 dark:text-gray-400"
                                                style="text-align: justify;" x-text="indicator.assessment">
                                              </p>

                                            </div>

                                            <button type="button" @click="closeIndicator()"
                                              class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg text-gray-400 transition hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-800 dark:hover:text-gray-300">

                                              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                                              </svg>

                                            </button>

                                          </header>


                                          {{-- Modal Body --}}
                                          <div class="mt-2 max-h-[55vh] w-full overflow-y-auto px-1">

                                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                                              {{-- ============================= --}}
                                              {{-- VALIDATION FORM --}}
                                              {{-- ============================= --}}

                                              <div>

                                                <span
                                                  class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                                  Validation Form
                                                </span>

                                                <div
                                                  class="mt-4 rounded-xl border border-gray-100 bg-gray-50/50 p-5 dark:border-gray-800 dark:bg-gray-800/30">

                                                  {{-- Indicator Grade --}}
                                                  <div>

                                                    <div
                                                      class="mb-2 flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">

                                                      <i class="fa-solid fa-chart-column text-gray-400"></i>

                                                      Indicator Grade

                                                    </div>

                                                    <input type="hidden" :name="'indicators[' + indicator.id + ']'"
                                                      x-model="JSON.stringify(indicator)">

                                                    <select disabled x-model="indicator.validation_status"
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


                                                  {{-- Final Conclusion --}}
                                                  <div class="mt-6">

                                                    <label
                                                      class="mb-2 flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">

                                                      <i class="fa-regular fa-comment-dots text-gray-400"></i>

                                                      Final Conclusion

                                                    </label>

                                                    <textarea disabled rows="5" x-model="indicator.conclusion" placeholder="Final conclusion"
                                                      class="block w-full rounded-lg border border-gray-200 bg-white p-3 text-sm leading-6 text-gray-700 focus:border-primary focus:ring-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                                      style="text-align: justify;">
              </textarea>

                                                  </div>

                                                </div>

                                              </div>


                                              {{-- ============================= --}}
                                              {{-- PLANNING FORM --}}
                                              {{-- ============================= --}}

                                              <div>

                                                <span
                                                  class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                                                  Planning Form
                                                </span>

                                                <div
                                                  class="mt-4 rounded-xl border border-gray-100 bg-gray-50/50 p-5 dark:border-gray-800 dark:bg-gray-800/30">

                                                  {{-- Follow Up Plan --}}
                                                  <div>

                                                    <label
                                                      class="mb-2 flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">

                                                      <i class="fa-regular fa-calendar-check text-gray-400"></i>

                                                      Follow Up Plan

                                                    </label>

                                                    <textarea @input="isEditing = true" x-model="focusIndicator.planning" rows="8"
                                                      placeholder="Enter follow up plan"
                                                      class="block w-full rounded-lg border border-gray-200 bg-white p-3 text-sm leading-6 text-gray-700 focus:border-primary focus:ring-primary dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                                      style="text-align: justify;">
              </textarea>

                                                  </div>

                                                </div>

                                              </div>

                                            </div>

                                          </div>


                                          {{-- Footer --}}
                                          <footer
                                            class="flex justify-end border-t border-gray-100 pt-4 dark:border-gray-800">

                                            <button @click="submitForm()" type="button"
                                              class="inline-flex items-center gap-2 rounded-lg !bg-primary px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:!bg-blue-500 focus:outline-none focus:ring-2 focus:!ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">

                                              <i class="fa-solid fa-check"></i>

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
          class="rounded-md !bg-primary px-4 py-2 text-xs uppercase tracking-widest text-white transition duration-150 ease-in-out hover:!bg-blue-800 focus:shadow-outline-blue"
          @click="openConfirm('Yakin ingin mengirim?', 'Data yang dikirim tidak dapat diubah.', () => {
                            document.getElementById('form').submit()
                        });">
          Submit
          <input type="hidden" name="action" value="submit">
        </button>
      @endif
    </div>

    <div x-show="isConfirmOpen" x-cloak
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
        </div>
        <footer
          class="-m-4 flex flex-col items-center space-y-4 px-6 py-3 text-sm dark:bg-gray-800 sm:flex-row sm:justify-end sm:space-x-6 sm:space-y-0">
          <button type="button" @click="closeConfirm"
            class="w-full rounded-lg border border-gray-300 p-3 tracking-widest text-gray-600 transition-colors duration-150 hover:border-gray-500 focus:border-gray-500 focus:shadow-outline-gray dark:text-white sm:w-auto">
            Batal
          </button>
          <button type="button" @click="confirmAction(); closeConfirm()"
            class="w-full rounded-lg !bg-primary p-3 tracking-widest text-white transition-colors duration-150 hover:!bg-blue-600 focus:shadow-outline-red sm:w-auto">
            Ya, kirim
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
                                submission_status: '{{ $indicator->submission_status ?? '0' }}',
                                validation: '{{ $indicator->validation }}',
                                link: '{{ $indicator->link }}',
                                assessment_status: '{{ $indicator->assessment_status }}',
                                description: @json($indicator->description),
                                feedback: '{{ $indicator->feedback }}',
                                comment: @json($indicator->comment),
                                validation_status: '{{ $indicator->validation_status }}',
                                conclusion: @json($indicator->conclusion),
                                planning: @json($indicator->planning),
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
        focusIndicator: {},
        focusTrap: null,
        isEditing: false,
        isConfirmOpen: false,
        confirmTitle: '',
        confirmText: '',
        confirmAction: null,
        openIndicator(indicator) {
          this.focusIndicator = Object.assign({}, indicator);
          this.focusTrap = focusTrap(document.querySelector('#modal-' + indicator.id));
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
        submitForm() {
          if (this.isEditing) {
            const toastContainer = document.getElementById('loading');
            toastContainer.classList.remove('hidden');
            toastContainer.classList.add('flex');
            fetch(`/forms/{{ $form->id }}/planning`, {
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
