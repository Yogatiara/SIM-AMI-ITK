<x-app-layout>
  <form action="/documents" method="POST" class="flex w-full flex-col gap-y-4">
    @csrf

    {{-- Header --}}
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2 text-sm">
        <a href="/documents"
          class="text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          Documents
        </a>

        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>

        <input type="text" name="document_name" value="{{ $draft }}" readonly
          class="w-auto border-0 bg-transparent p-0 text-sm font-medium text-gray-900 focus:ring-0 dark:bg-transparent dark:text-white" />
      </div>

      @if ($errors->any())
        <div id="toast-success"
          class="flex max-w-xs items-center rounded-lg border border-red-200 bg-white px-3 py-2 text-gray-500 shadow-sm dark:border-red-900 dark:bg-gray-800 dark:text-gray-400"
          role="alert">

          <div
            class="inline-flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-500 dark:bg-red-800 dark:text-red-200">
            <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
              viewBox="0 0 20 20">
              <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.5 11.5a1 1 0 0 1-1.414 0L10 11.414l-2.086 2.086A1 1 0 0 1 6.5 12.086L8.586 10 6.5 7.914A1 1 0 0 1 7.914 6.5L10 8.586l2.086-2.086A1 1 0 0 1 13.5 7.914L11.414 10l2.086 2.086A1 1 0 0 1 13.5 12Z" />
            </svg>
          </div>

          <div class="mx-2 text-sm font-medium">
            {{ $errors->first() }}
          </div>

          <button type="button"
            class="ms-auto inline-flex h-7 w-7 items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-700 dark:hover:text-white"
            data-dismiss-target="#toast-success" aria-label="Close">
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
          </button>
        </div>
      @endif
    </div>


    {{-- Main Alpine Editor --}}
    <div class="w-full " x-data="{
        openTab: 1,
    
        categories: [
            @forelse ($categories as $index => $category) {
                    id: {{ $category['id'] }},
                    name: '{{ $category['name'] }}',
                    standards: [
                        @if (isset($standardsByCategory[$category['id']]))
                            @foreach ($standardsByCategory[$category['id']] as $standardIndex => $standard) {
                                id: {{ $standard['id'] }},
                                category_id: '{{ $category['id'] }}',
                                name: '{{ $standard['name'] }}',
                                competencies: [
                                    @if (isset($competenciesByStandard[$standard['id']]))
                                        @foreach ($competenciesByStandard[$standard['id']] as $competency) {
                                            id: {{ $competency['id'] }},
                                            standard_id: '{{ $standard['id'] }}',
                                            name: '{{ str_replace(["\r\n", "\r", "\n"], "\\n", e($competency['name'])) }}',
                                            indicators: [
                                                @if (isset($indicatorsByCompetency[$competency['id']]))
                                                    @foreach ($indicatorsByCompetency[$competency['id']] as $indicator) {
                                                        id: {{ $indicator['id'] }},
                                                        competency_id: '{{ $competency['id'] }}',
                                                        code: '{{ $indicator['code'] }}',
                                                        assessment: '{{ str_replace(["\r\n", "\r", "\n"], "\\n", e($indicator['assessment'])) }}',
                                                        entry: '{{ $indicator['entry'] }}',
                                                        link_info: '{{ str_replace(["\r\n", "\r", "\n"], "\\n", e($indicator['link_info'])) }}',
                                                        rate_option: '{{ $indicator['rate_option'] }}',
                                                    }, @endforeach
                                                @else
                                                    {
                                                        id: 1,
                                                        competency_id: 1,
                                                        code: '',
                                                        assessment: '',
                                                        entry: '',
                                                        link_info: '',
                                                        rate_option: ''
                                                    }
                                                @endif
                                            ]
                                        }, @endforeach
                                    @else
                                        {
                                            id: 1,
                                            standard_id: 1,
                                            name: '',
                                            indicators: []
                                        }
                                    @endif
                                ]
                            }, @endforeach
                        @else
                            {
                                id: 1,
                                category_id: 1,
                                name: '',
                                competencies: []
                            }
                        @endif
                    ]
                }, @empty
                    {
                        id: 1,
                        name: '',
                        standards: []
                    } @endforelse
        ],
    
        updateAllIds() {
            let categoryId = 1,
                standardId = 1,
                competencyId = 1,
                indicatorId = 1;
    
            this.categories.forEach((category) => {
                category.id = categoryId++;
                let indicatorIndex = 1;
    
                category.standards.forEach((standard) => {
                    standard.id = standardId++;
                    standard.category_id = category.id;
    
                    standard.competencies.forEach((competency) => {
                        competency.id = competencyId++;
                        competency.standard_id = standard.id;
    
                        competency.indicators.forEach((indicator) => {
                            indicator.id = indicatorId++;
                            indicator.competency_id = competency.id;
    
                            let categoryLetter =
                                String.fromCharCode(64 + category.id) +
                                '.' +
                                indicatorIndex++;
    
                            indicator.code = categoryLetter;
                        });
                    });
                });
            });
        },
    
        addTab() {
            this.categories.push({
                id: 0,
                name: '',
                standards: []
            });
    
            this.updateAllIds();
            this.openTab = this.categories[this.categories.length - 1].id;
        },
    
        removeTab(tabId) {
            let index = this.categories.findIndex(cat => cat.id === tabId);
    
            this.categories.splice(index, 1);
            this.updateAllIds();
    
            if (this.openTab === tabId) {
                this.openTab = this.categories.length < tabId ?
                    this.categories.length :
                    tabId;
            } else if (this.openTab > tabId) {
                this.openTab = this.categories.length;
            }
        },
    
        addStandard() {
            let category = this.categories.find(
                cat => cat.id === this.openTab
            );
    
            category.standards.push({
                id: 0,
                name: '',
                competencies: []
            });
    
            this.updateAllIds();
        },
    
        removeStandard(standardId) {
            let category = this.categories.find(
                cat => cat.id === this.openTab
            );
    
            category.standards.splice(standardId, 1);
            this.updateAllIds();
        },
    
        addCompetency(standardId) {
            let category = this.categories.find(
                cat => cat.id === this.openTab
            );
    
            category.standards[standardId].competencies.push({
                id: 0,
                name: '',
                indicators: []
            });
    
            this.updateAllIds();
        },
    
        removeCompetency(standardId, competencyId) {
            let category = this.categories.find(
                cat => cat.id === this.openTab
            );
    
            category.standards[standardId].competencies.splice(
                competencyId,
                1
            );
    
            this.updateAllIds();
        },
    
        addIndicator(standardId, competencyId) {
            let category = this.categories.find(
                cat => cat.id === this.openTab
            );
    
            category.standards[standardId]
                .competencies[competencyId]
                .indicators.push({
                    id: 0,
                    assessment: '',
                    code: '',
                    entry: 'Option',
                    link_info: '',
                    rate_option: ''
                });
    
            this.updateAllIds();
        },
    
        removeIndicator(standardId, competencyId, indicatorId) {
            let category = this.categories.find(
                cat => cat.id === this.openTab
            );
    
            category.standards[standardId]
                .competencies[competencyId]
                .indicators.splice(indicatorId, 1);
    
            this.updateAllIds();
        },
    
        initTextareas() {
            function textareaAutoHeight(el, offsetTop = 0) {
                el.style.height = 'auto';
                el.style.height = `${el.scrollHeight + offsetTop}px`;
            }
    
            this.$nextTick(() => {
                document.querySelectorAll('textarea').forEach(textarea => {
                    textareaAutoHeight(textarea, 30);
    
                    textarea.addEventListener('focus', () => {
                        textareaAutoHeight(textarea, 30);
                    });
                });
            });
        },
    
        isOpenTabInvalid() {
            return !this.categories.some(
                category => category.id === this.openTab
            );
        },
    
        isModalOpen: false,
        currentIndicatorId: null,
        trapCleanup: null,
    
        openModal(indicatorId) {
            this.currentIndicatorId = indicatorId;
            this.isModalOpen = true;
    
            this.$nextTick(() => {
                this.trapCleanup = focusTrap(
                    document.querySelector('#modal-' + indicatorId)
                );
            });
        },
    
        closeModal() {
            this.isModalOpen = false;
            this.currentIndicatorId = null;
    
            if (this.trapCleanup) {
                this.trapCleanup();
                this.trapCleanup = null;
            }
        },
    
        setData(event, indicator) {
            indicator.entry = event.target.value;
        }
    }">

      {{-- Category Tabs --}}
      <div class="mb-2 rounded-2xl bg-white p-3 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
        <div class="flex w-full whitespace-nowrap overflow-x-auto scrollbar-thin" data-simplebar>
          <ul class="flex items-center gap-1">
            <template x-for="(category, index) in categories" :key="category.id">
              <li @click.prevent="openTab = category.id"
                :class="openTab === category.id ?
                    'border-blue-800 bg-blue-50 text-blue-800 dark:border-blue-400 dark:bg-blue-900/20 dark:text-blue-400' :
                    'border-gray-200 bg-white text-gray-500 hover:border-blue-300 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:border-blue-500 dark:hover:text-blue-400'"
                class="mr-1 flex cursor-pointer items-center gap-2 rounded-2xl border px-1.5 py-1 transition-colors">

                <input type="hidden" x-model="category.id" :name="'categories[' + index + '][id]'" />

                <input type="text" x-model="category.name" :name="'categories[' + index + '][name]'"
                  class="w-36 rounded-2xl border-0 bg-transparent px-2 py-1 text-sm font-medium text-inherit placeholder-gray-400 focus:ring-0"
                  placeholder="Tab Name" />

                <button type="button" @click.stop="removeTab(category.id)"
                  class="rounded-full p-1 text-gray-400 transition-colors hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-900/20 dark:hover:text-red-400">

                  <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="m15 9-6 6"></path>
                    <path d="m9 9 6 6"></path>
                  </svg>
                </button>
              </li>
            </template>

            <li @click="addTab()"
              class="flex cursor-pointer items-center gap-2 rounded-xl px-4 py-2 text-sm font-medium text-emerald-600 transition-colors hover:bg-emerald-50 dark:text-emerald-400 dark:hover:bg-emerald-900/20">

              <span>Add Tab</span>

              <button type="button" class="rounded-full">

                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <path d="M12 8v8"></path>
                  <path d="M8 12h8"></path>
                </svg>
              </button>
            </li>
          </ul>
        </div>
      </div>


      {{-- Editor --}}
      <div
        class="h-full rounded-2xl border border-gray-200 bg-gray-100 p-3 shadow-sm scrollbar-thin dark:border-gray-700 dark:bg-gray-800">

        <template x-for="(category, index) in categories" :key="category.id">
          <div x-show="openTab === category.id" x-init="initTextareas()">

            <template x-for="(standard, standardIndex) in category.standards" :key="standard.id">

              <div class="mb-5">

                {{-- Standard Header --}}
                <div class="mb-2 flex items-center gap-2">

                  <button type="button" @click="removeStandard(standardIndex)"
                    class="rounded-full p-1 text-gray-400 transition-colors hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-900/20 dark:hover:text-red-400">

                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10"></circle>
                      <path d="m15 9-6 6"></path>
                      <path d="m9 9 6 6"></path>
                    </svg>
                  </button>

                  <input type="hidden" x-model="standard.id"
                    :name="'categories[' + index + '][standards][' + standardIndex + '][id]'" />

                  <input type="hidden" x-model="standard.category_id"
                    :name="'categories[' + index + '][standards][' + standardIndex + '][category_id]'" />

                  <input type="text" x-model="standard.name"
                    :name="'categories[' + index + '][standards][' + standardIndex + '][name]'"
                    class="min-w-52 border-0 bg-transparent p-0 text-lg font-semibold text-gray-900 placeholder-gray-400 focus:ring-0 dark:text-white"
                    x-bind:style="'width: ' + Math.max(standard.name.length + 1, 20) + 'ch;'"
                    placeholder="Enter Standard Name" />
                </div>


                {{-- Standard Card --}}
                <div
                  class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">

                  <table class="w-full">

                    <thead>
                      <tr
                        class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">

                        <th class="w-[3%] px-4 py-4"></th>

                        <th class="w-[44%] px-6 py-4">
                          Kompetensi
                        </th>

                        <th class="px-6 py-4">
                          Indikator
                        </th>

                      </tr>
                    </thead>

                    <tbody>

                      <template x-for="(competency, competencyIndex) in standard.competencies" :key="competency.id">

                        <tr class="border-b border-gray-100 last:border-0 dark:border-gray-800">

                          {{-- Delete Competency --}}
                          <td class="px-4 py-3 align-top">
                            <button type="button" @click="removeCompetency(standardIndex, competencyIndex)"
                              class="rounded-full p-1 text-gray-400 transition-colors hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-900/20 dark:hover:text-red-400">

                              <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="m15 9-6 6"></path>
                                <path d="m9 9 6 6"></path>
                              </svg>
                            </button>
                          </td>


                          {{-- Competency --}}
                          <td class="p-4 align-top">

                            <input type="hidden" x-model="competency.id"
                              :name="'categories[' + index + '][standards][' + standardIndex + '][competencies][' +
                                  competencyIndex + '][id]'" />

                            <input type="hidden" x-model="competency.standard_id"
                              :name="'categories[' + index + '][standards][' + standardIndex + '][competencies][' +
                                  competencyIndex + '][standard_id]'" />

                            <textarea x-model="competency.name"
                              :name="'categories[' + index + '][standards][' + standardIndex + '][competencies][' +
                                  competencyIndex + '][name]'"
                              class="w-full resize-none overflow-hidden border-0 bg-transparent p-0 font-semibold text-gray-800 placeholder-gray-400 focus:ring-0 dark:text-gray-200"
                              rows="1" placeholder="Enter Competency Name" style="text-align: justify;"></textarea>

                          </td>


                          {{-- Indicators --}}
                          <td class="p-4 align-top">

                            <template x-for="(indicator, indicatorIndex) in competency.indicators"
                              :key="indicator.id">

                              <div class="mb-3 flex items-start gap-2">

                                {{-- Delete --}}
                                <button type="button"
                                  @click="removeIndicator(standardIndex, competencyIndex, indicatorIndex)"
                                  class="mt-1 rounded-full p-1 text-gray-400 transition-colors hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-900/20 dark:hover:text-red-400">

                                  <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="m15 9-6 6"></path>
                                    <path d="m9 9 6 6"></path>
                                  </svg>
                                </button>


                                {{-- Indicator Code --}}
                                <input type="hidden" x-model="indicator.id"
                                  :name="'categories[' + index + '][standards][' + standardIndex + '][competencies][' +
                                      competencyIndex + '][indicators][' + indicatorIndex + '][id]'" />

                                <input type="hidden" x-model="indicator.competency_id"
                                  :name="'categories[' + index + '][standards][' + standardIndex + '][competencies][' +
                                      competencyIndex + '][indicators][' + indicatorIndex + '][competency_id]'" />

                                <input type="text" x-model="indicator.code" readonly
                                  :name="'categories[' + index + '][standards][' + standardIndex + '][competencies][' +
                                      competencyIndex + '][indicators][' + indicatorIndex + '][code]'"
                                  class="mt-1 min-w-8 border-0 bg-transparent p-0 text-center text-sm font-semibold text-gray-500 focus:ring-0 dark:text-gray-400"
                                  x-bind:style="'width: ' + Math.max(indicator.code.length + 1, 3) + 'ch;'" />


                                {{-- Assessment --}}
                                <textarea rows="5" x-model="indicator.assessment"
                                  :name="'categories[' + index + '][standards][' + standardIndex + '][competencies][' +
                                      competencyIndex + '][indicators][' + indicatorIndex + '][assessment]'"
                                  class="w-full resize-none overflow-hidden border-0 border-b border-gray-200 bg-transparent px-0 pb-1 text-sm font-semibold text-gray-600 placeholder-gray-400 focus:border-blue-600 focus:ring-0 dark:border-gray-700 dark:text-gray-300"
                                  rows="1" placeholder="Enter Indicator Assessment" style="text-align: justify;"></textarea>


                                {{-- Settings --}}
                                <button type="button" @click="openModal(indicator.id)"
                                  class="mt-1 flex shrink-0 items-center gap-1 rounded-lg px-2 py-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-blue-600 dark:hover:bg-gray-800 dark:hover:text-blue-400">

                                  <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path
                                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0m-9.75 0h9.75" />
                                  </svg>

                                  <span class=" text-xs sm:inline">
                                    Setting
                                  </span>
                                </button>


                                {{-- Modal --}}
                                <div x-show="isModalOpen && currentIndicatorId === indicator.id"
                                  x-transition:enter="transition ease-out duration-150"
                                  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                  x-transition:leave="transition ease-in duration-150"
                                  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                  class="fixed inset-0 z-50 flex items-end justify-center bg-black/50 sm:items-center">

                                  <div x-show="isModalOpen && currentIndicatorId === indicator.id"
                                    x-transition:enter="transition ease-out duration-150"
                                    x-transition:enter-start="translate-y-1/2 opacity-0"
                                    x-transition:enter-end="translate-y-0 opacity-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="translate-y-0 opacity-100"
                                    x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="closeModal()"
                                    @keydown.escape="closeModal()"
                                    class="w-full overflow-hidden rounded-t-2xl bg-white px-6 py-5 text-left shadow-xl dark:bg-gray-900 sm:m-4 sm:max-w-xl sm:rounded-2xl"
                                    role="dialog" :id="'modal-' + indicator.id">

                                    <header class="flex items-center justify-between">

                                      <div>
                                        <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                                          Set Indicator Entry
                                        </h3>

                                        <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                          Indicator
                                          <span class="font-semibold" x-text="indicator.code"></span>
                                        </p>
                                      </div>

                                      <button type="button" @click="closeModal()"
                                        class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-200">

                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                          stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                      </button>

                                    </header>


                                    <div class="mt-6 space-y-6">

                                      {{-- Entry --}}
                                      <div>
                                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                          Input Type
                                        </label>

                                        <select x-model="indicator.entry"
                                          :name="'categories[' + index + '][standards][' + standardIndex + '][competencies][' +
                                              competencyIndex + '][indicators][' + indicatorIndex + '][entry]'"
                                          @change="setData($event, indicator)"
                                          class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

                                          <option value="Option">
                                            Option (Yes / No)
                                          </option>

                                          <option value="Digit">
                                            Digit (#)
                                          </option>

                                          <option value="Decimal">
                                            Decimal (.)
                                          </option>

                                          <option value="Cost">
                                            Cost ($)
                                          </option>

                                          <option value="Percentage">
                                            Percentage (%)
                                          </option>

                                          <option value="Rate">
                                            Rate (*)
                                          </option>

                                        </select>
                                      </div>


                                      {{-- Rate --}}
                                      <template x-if="indicator.entry === 'Rate'">
                                        <div>
                                          <label
                                            class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Rating Scale
                                          </label>

                                          <select x-model="indicator.rate_option"
                                            :name="'categories[' + index + '][standards][' + standardIndex +
                                                '][competencies][' + competencyIndex + '][indicators][' +
                                                indicatorIndex + '][rate_option]'"
                                            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

                                            <option hidden value="">
                                              Choose rating scale
                                            </option>

                                            <option value="1-10">
                                              1 - 10
                                            </option>

                                            <option value="1-100">
                                              1 - 100
                                            </option>

                                          </select>
                                        </div>
                                      </template>


                                      {{-- Link --}}
                                      <div>
                                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                          Verification Information
                                        </label>

                                        <div class="flex">
                                          <span
                                            class="inline-flex items-center rounded-s-lg border border-e-0 border-gray-200 bg-gray-100 px-3 text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">

                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                              stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                                            </svg>

                                          </span>

                                          <input x-model="indicator.link_info"
                                            :name="'categories[' + index + '][standards][' + standardIndex +
                                                '][competencies][' + competencyIndex + '][indicators][' +
                                                indicatorIndex + '][link_info]'"
                                            class="min-w-0 flex-1 rounded-e-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                            placeholder="Enter link verification info">
                                        </div>
                                      </div>

                                    </div>


                                    <footer
                                      class="-mx-6 -mb-5 mt-7 flex justify-end border-t border-gray-100 bg-gray-50 px-6 py-3 dark:border-gray-800 dark:bg-gray-800">

                                      <button type="button" @click="closeModal()"
                                        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                        Save
                                      </button>

                                    </footer>

                                  </div>
                                </div>

                              </div>
                            </template>


                            {{-- Add Indicator --}}
                            <button type="button" @click="addIndicator(standardIndex, competencyIndex)"
                              class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-200 px-3 py-3 text-sm font-medium text-gray-500 transition-colors hover:border-blue-500 hover:text-blue-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400">

                              <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4v16m8-8H4" />
                              </svg>

                              Add Indicator
                            </button>

                          </td>
                        </tr>

                      </template>


                      {{-- Add Competency --}}
                      <tr>
                        <td></td>

                        <td colspan="2" class="p-3">

                          <button type="button" @click="addCompetency(standardIndex)"
                            class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-200 px-3 py-3 text-sm font-medium text-gray-500 transition-colors hover:border-blue-500 hover:text-blue-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400">

                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                            </svg>

                            Add Competency
                          </button>

                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>

              </div>

            </template>


            {{-- Add Standard --}}
            <button type="button" @click="addStandard()" x-show="categories.length > 0 && !isOpenTabInvalid()"
              class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-200 px-3 py-3 text-sm font-medium text-gray-500 transition-colors hover:border-blue-500 hover:text-blue-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400">

              <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>

              Tambah Standar
            </button>

          </div>
        </template>


        {{-- Empty States --}}
        <div x-show="categories.length > 0 && isOpenTabInvalid()"
          class="flex h-full items-center justify-center text-sm text-gray-500">
          Please choose a tab.
        </div>

        <div x-show="categories.length === 0" class="flex h-full items-center justify-center text-sm text-gray-500">
          No categories available. Please add some tab.
        </div>

      </div>

    </div>


    {{-- Footer Actions --}}
    <div class="flex justify-end gap-3 pb-3">

      <button type="submit" name="action" value="draft"
        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
        Simpan pada draft
      </button>

      <button type="submit" name="action" value="submit"
        class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
        Submit
      </button>

    </div>

  </form>

</x-app-layout>
