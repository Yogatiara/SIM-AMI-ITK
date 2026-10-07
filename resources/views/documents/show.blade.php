<x-app-layout>
  <div class="flex h-full w-full flex-col gap-y-4">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2 text-sm">
        <a href="/documents"
          class="text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          Daftar Dokumen
        </a>
        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="font-medium text-gray-900 dark:text-white">{{ $document->name }}</span>
      </div>
    </div>

    <!-- Main Content -->
    <div
      class="flex-1 overflow-auto rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <div x-data="{
          openTab: {{ $categories->isNotEmpty() ? $categories->first()->id : 1 }},
          categories: [
              @foreach ($categories as $index => $category)
              {
                  id: {{ $category['id'] }},
                  name: @js($category['name']),
                  standards: [
                      @if (isset($standardsByCategory[$category['id']]))
                          @foreach ($standardsByCategory[$category['id']] as $standardIndex => $standard)
                          {
                              id: {{ $standard['id'] }},
                              category_id: {{ $category['id'] }},
                              name: @js($standard['name']),
                              competencies: [
                                  @if (isset($competenciesByStandard[$standard['id']]))
                                      @foreach ($competenciesByStandard[$standard['id']] as $competency)
                                      {
                                          id: {{ $competency['id'] }},
                                          standard_id: {{ $standard['id'] }},
                                          name: @js($competency['name']),
                                          indicators: [
                                              @if (isset($indicatorsByCompetency[$competency['id']]))
                                                  @foreach ($indicatorsByCompetency[$competency['id']] as $indicator)
                                                  {
                                                      id: {{ $indicator['id'] }},
                                                      competency_id: {{ $competency['id'] }},
                                                      code: @js($indicator['code']),
                                                      assessment: @js($indicator['assessment']),
                                                      entry: @js($indicator['entry']),
                                                      link_info: @js($indicator['link_info']),
                                                      rate_option: @js($indicator['rate_option']),
                                                      isDisabled: false
                                                  }, @endforeach
              @endif
          ]
      },
      @endforeach
      @endif
      ]
      },
      @endforeach
      @endif
      ]
      },
      @endforeach
      ]
      }">

        <!-- Category Tabs -->
        <div class="mb-6 flex gap-1 overflow-x-auto rounded-xl bg-gray-100 p-1 dark:bg-gray-800">
          <template x-for="(category, index) in categories" :key="category.id">
            <button @click.prevent="openTab = category.id"
              :class="openTab === category.id ? 'bg-white text-gray-900 shadow-sm dark:bg-gray-700 dark:text-white' :
                  'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
              class="flex-1 whitespace-nowrap rounded-lg px-4 py-2 text-sm font-medium transition-all"
              x-text="category.name"></button>
          </template>
        </div>

        <!-- Standards Content -->
        <template x-for="(category, index) in categories" :key="category.id">
          <div x-show="openTab === category.id" class="space-y-6">
            <template x-for="(standard, standardIndex) in category.standards" :key="standard.id">
              <div>
                <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white" x-text="standard.name"></h3>
                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
                  <table class="w-full">
                    <thead>
                      <tr
                        class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                        <th class="px-6 py-4">Kompetensi</th>
                        <th class="px-6 py-4">Indikator</th>
                        <th class="px-6 py-4">Validasi</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                      <template x-for="(competency, competencyIndex) in standard.competencies" :key="competency.id">
                        <tr>
                          <td class="px-6 py-4">
                            <p class="text-sm text-gray-700 dark:text-gray-300" x-text="competency.name"></p>
                          </td>
                          <td class="px-6 py-4">
                            <template x-for="(indicator, indicatorIndex) in competency.indicators"
                              :key="indicator.id">
                              <div class="mb-4">
                                <div class="mb-2 flex items-center gap-2">
                                  <span class="text-sm font-medium text-gray-900 dark:text-white"
                                    x-text="indicator.code"></span>
                                  <span
                                    class="inline-flex items-center rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                    <span x-text="indicator.entry"></span>


                                  </span>

                                  <div class="hs-tooltip hidden items-center justify-center [--trigger:hover] md:flex">
                                    <div class="hs-tooltip-toggle">
                                      <button type="button"
                                        class="text-gray-500 flex items-center hover:text-indigo-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500">
                                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24"
                                          height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z">
                                          </path>
                                        </svg>
                                        Info link
                                      </button>
                                      <div
                                        class="hs-tooltip-content invisible absolute z-50 hidden max-w-xs rounded-lg border border-gray-100 bg-white text-start opacity-0 shadow-md transition-opacity hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:border-neutral-700 dark:bg-neutral-800"
                                        role="tooltip">
                                        <span class="px-4 pt-3 text-lg font-bold text-gray-800 dark:text-white">
                                          Informasi verifikasi link</span>
                                        <div
                                          class="flex flex-col gap-2 px-4 py-3 text-sm text-gray-600 dark:text-neutral-400">
                                          <p class="md:hidden" x-text="indicator.entry">
                                          </p>
                                          <p x-text="indicator.link_info">
                                          </p>
                                          <p x-show="!indicator.link_info" class="text-base">
                                            Link tidak tersedia
                                          </p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400" x-text="indicator.assessment"></p>
                              </div>
                            </template>

                          </td>
                          <td class="px-6 py-4">

                            <template x-for="(indicator, indicatorIndex) in competency.indicators"
                              :key="indicator.id">
                              <div>
                                <span
                                  class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                  <span
                                    x-text="indicator.entry === 'Option' ? 'Yes/No' : indicator.entry === 'Digit' ? 'Digit' : indicator.entry === 'Decimal' ? 'Decimal' : indicator.entry === 'Cost' ? 'Cost' : indicator.entry === 'Percentage' ? 'Percentage' : 'Rate'"></span>
                                </span>
                              </div>



                            </template>

                          </td>
                        </tr>
                      </template>
                    </tbody>
                  </table>
                </div>
              </div>
            </template>

            <!-- Empty State -->
            <div x-show="categories.length === 0 || (categories.length === 1 && categories[0].name === '')"
              class="flex h-64 flex-col items-center justify-center gap-4 text-gray-500">
              <svg class="h-12 w-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
              <p class="text-sm">Belum ada dokumen tersedia</p>
              <a href="/documents/create"
                class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-emerald-500">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Dokumen
              </a>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>
</x-app-layout>
