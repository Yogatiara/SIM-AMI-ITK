<x-app-layout>
  <form action="/documents" method="POST" class="flex h-full w-full flex-col gap-y-4">
    @csrf

    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2 text-sm">
        <a href="/documents"
          class="text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          Daftar Dokumen
        </a>
        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="font-medium text-gray-900 dark:text-white">Tambah Dokumen</span>
      </div>
      <div class="flex items-center gap-2">
        <input name="document_name" type="text" placeholder="Nama Dokumen" required autofocus
          value="{{ old('document_name') }}"
          class="h-9 w-48 rounded-lg border border-gray-200 bg-white px-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
      </div>
    </div>

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
                                                percentage_options: [],

                                            }, @endforeach
                                        @else
                                            { id: 1, competency_id: 1, code: '', assessment: '',  entry: '', link_info: '', rate_option: '' }
                                        @endif
                                    ]
                                }, @endforeach
                            @else
                                { id: 1, standard_id: 1, name: '', indicators: [] }
                            @endif
                            ]
                        }, @endforeach
                    @else
                        { id: 1, category_id: 1, name: '', competencies: [] }
                    @endif
                    ]
                }, @empty
                { id: 1, name: '', standards: [] } @endforelse
        ],
    
        updateAllIds() {
            let categoryId = 1,
                standardId = 1,
                competencyId = 1,
                indicatorId = 1;
    
            this.categories.forEach((category) => {
                category.id = categoryId++;
                let indicatorIndex = 1
    
                category.standards.forEach((standard) => {
                    standard.id = standardId++;
                    standard.category_id = category.id; // Assign the parent category id
    
                    standard.competencies.forEach((competency) => {
                        competency.id = competencyId++;
                        competency.standard_id = standard.id; // Assign the parent standard id
    
                        competency.indicators.forEach((indicator) => {
                            indicator.id = indicatorId++;
                            indicator.competency_id = competency.id; // Assign the parent competency id
    
                            // Generate the indicator code based on category.id and indicator.id
                            let categoryLetter = String.fromCharCode(64 + category.id) + '.' + indicatorIndex++; // Convert category.id to a letter (A, B, C, ...)
                            indicator.code = categoryLetter;
                        });
                    });
                });
            });
        },
        addTab() {
            this.categories.push({ id: 0, name: '', standards: [] });
            this.updateAllIds();
            this.openTab = this.categories[this.categories.length - 1].id;
        },
        removeTab(tabId) {
            let index = this.categories.findIndex(cat => cat.id === tabId);
            this.categories.splice(index, 1);
            this.updateAllIds();
            if (this.openTab === tabId) {
                this.openTab = this.categories.length < tabId ? this.categories.length : tabId;
            } else if (this.openTab > tabId) {
                this.openTab = this.categories.length;
            }
        },
        addStandard() {
            let category = this.categories.find(cat => cat.id === this.openTab);
            category.standards.push({
                id: 0,
                name: '',
                competencies: []
            });
            this.updateAllIds();
        },
        removeStandard(standardId) {
            let category = this.categories.find(cat => cat.id === this.openTab);
            category.standards.splice(standardId, 1);
            this.updateAllIds();
        },
        addCompetency(standardId) {
            let category = this.categories.find(cat => cat.id === this.openTab);
            category.standards[standardId].competencies.push({
                id: 0,
                name: '',
                indicators: []
            });
            this.updateAllIds();
        },
        removeCompetency(standardId, competencyId) {
            let category = this.categories.find(cat => cat.id === this.openTab);
            category.standards[standardId].competencies.splice(competencyId, 1);
            this.updateAllIds();
        },
        addIndicator(standardId, competencyId) {
            let category = this.categories.find(cat => cat.id === this.openTab);
    
            // Hitung ID baru untuk indikator
            let newIndicatorId = category.standards[standardId].competencies[competencyId].indicators.length + 1
            category.standards[standardId].competencies[competencyId].indicators.push({
                id: 0,
                assessment: '',
                code: ''
    
            });
            this.updateAllIds();
        },
        removeIndicator(standardId, competencyId, indicatorId) {
            let category = this.categories.find(cat => cat.id === this.openTab);
            category.standards[standardId].competencies[competencyId].indicators.splice(indicatorId, 1);
            this.updateAllIds();
        },
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
        isOpenTabInvalid() {
            return !this.categories.some(category => category.id === this.openTab);
        },
        isModalOpen: false,
        currentIndicatorId: null,
        trapCleanup: null,
        openModal(indicatorId) {
            this.currentIndicatorId = indicatorId;
            this.isModalOpen = true;
            this.trapCleanup = focusTrap(document.querySelector('#modal-' + indicatorId));
        },
        closeModal() {
            this.isModalOpen = false;
            this.currentIndicatorId = null;
            this.trapCleanup();
        },
        setData(event, indicator) {
            indicator = event.target.value;
        }
    }">

      <div class="rounded-2xl bg-white p-3 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800 mb-2">
        <div class="flex w-full whitespace-nowrap" data-simplebar>
          <ul class=" flex">
            <template x-for="(category, index) in categories" :key="category.id">
              <li @click.prevent="openTab = category.id"
                :class="openTab === category.id ?
                    ' dark:text-purple-400 border border-primary !rounded-2xl  dark:border-gray-500' :
                    'border-2 border-gray-200 text-gray-500 dark:text-gray-400  hover:text-green-400 dark:hover:text-gray-200 hover:border hover:border-primary dark:hover:border-purple-500 !rounded-2xl'"
                class="mr-1 flex cursor-pointer items-center gap-x-2 rounded bg-white p-1 dark:bg-gray-700">
                <input type="hidden" x-model="category.id" :name="'categories[' + index + '][id]'" />
                <input type="text" x-model="category.name" :name="'categories[' + index + '][name]'"
                  class="w-36 border-0 border-primary bg-white rounded-2xl  text-primary focus:ring-0 dark:border-gray-500 dark:bg-gray-700 dark:text-purple-400"
                  placeholder=" Nama Tab" />
                <button type="button" @click.stop="removeTab(category.id)"
                  class="rounded-full text-gray-500 hover:text-red-600 dark:text-neutral-600 dark:hover:text-blue-500 dark:focus:text-blue-500">
                  <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="m15 9-6 6"></path>
                    <path d="m9 9 6 6"></path>
                  </svg>
                </button>
              </li>
            </template>
            <li @click="addTab()"
              class="flex cursor-pointer items-center gap-2 whitespace-nowrap rounded-lg px-4 py-2 text-sm font-medium text-emerald-600 transition-colors hover:bg-emerald-50 dark:text-emerald-400 dark:hover:bg-emerald-900/20">
              <span>Tambah Tab</span>
              <button type="button"
                class="rounded-full dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500">
                <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <path d="M12 8v8"></path>
                  <path d="M8 12h8"></path>
                </svg>
              </button>
            </li>
          </ul>
        </div>

      </div>

      <div
        class="shadow-xs h-[90%] w-full overflow-y-auto rounded-2xl  border border-gray-200 bg-gray-100 p-3 text-center scrollbar-thin dark:border-gray-500 dark:bg-gray-700 dark:scrollbar-track-gray-500 dark:scrollbar-thumb-gray-800">
        <template x-for="(category, index) in categories" :key="category.id">
          <div x-show="openTab === category.id, initTextareas()">
            <template x-for="(standard, standardIndex) in category.standards" :key="standard.id">
              <div class="mb-5">
                <div class="flex items-center gap-x-2">
                  <button type="button" @click="removeStandard(standardIndex)"
                    class="rounded-full p-1 text-gray-500 hover:text-red-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500">
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"></circle>
                      <path d="m15 9-6 6"></path>
                      <path d="m9 9 6 6"></path>
                    </svg>
                  </button>
                  <input type="hidden" x-model="standard.id "
                    :name="'categories[' + index + '][standards][' + standardIndex + '][id]'" />
                  <input type="hidden" x-model="standard.category_id"
                    :name="'categories[' + index + '][standards][' + standardIndex + '][category_id]'" />
                  <input type="text" x-model="standard.name"
                    :name="'categories[' + index + '][standards][' + standardIndex + '][name]'"
                    class="min-w-52 border-0 border-primary bg-gray-100 p-0 text-lg font-semibold  focus:ring-0 dark:border-gray-500 dark:bg-gray-700 dark:text-purple-400"
                    x-bind:style="'width: ' + (standard.name.length + 1) + 'ch;'" placeholder="Masukan Nama Standar" />
                </div>
                <div
                  class="rounded-2xl bg-gray-wihite shadow-sm mt-2 bg-white ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
                  <table class="w-full overflow-hidden">
                    <thead>
                      <tr
                        class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                        <th class="px-6 py-4"></th>
                        <th class="px-6 py-4">
                          Kompetensi</th>
                        <th class="px-6 py-4">
                          Indikator</th>
                      </tr>
                    </thead>
                    <tbody>
                      <template x-for="(competency, competencyIndex) in standard.competencies" :key="competency.id">
                        <tr class="border-b ">
                          <td>
                            <button type="button" @click="removeCompetency(standardIndex, competencyIndex)"
                              class="rounded-full text-gray-500 hover:text-red-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500">
                              <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="m15 9-6 6"></path>
                                <path d="m9 9 6 6"></path>
                              </svg>
                            </button>
                          </td>
                          <td class="  p-2 dark:border-gray-500 dark:text-white">
                            <input type="hidden" x-model="competency.id"
                              :name="'categories[' + index + '][standards][' + standardIndex +
                                  '][competencies][' + competencyIndex + '][id]'" />
                            <input type="hidden" x-model="competency.standard_id"
                              :name="'categories[' + index + '][standards][' + standardIndex +
                                  '][competencies][' + competencyIndex + '][standard_id]'" />
                            <textarea x-model="competency.name"
                              :name="'categories[' + index + '][standards][' + standardIndex +
                                  '][competencies][' + competencyIndex + '][name]'"
                              class="w-full resize-none overflow-hidden border-0 bg-transparent font-semibold focus:ring-0"
                              placeholder="Masukkan Nama Kompetensi" style="text-align: justify;">
                                                    </textarea>
                          </td>
                          <td class="  p-2 dark:border-gray-500 dark:text-white">
                            <template x-for="(indicator, indicatorIndex) in competency.indicators"
                              :key="indicator.id">
                              <div class="mb-4 items-center justify-between gap-x-2 md:flex">
                                <button type="button"
                                  @click="removeIndicator(standardIndex, competencyIndex, indicatorIndex)"
                                  class="rounded-full text-gray-500 hover:text-red-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500">
                                  <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10">
                                    </circle>
                                    <path d="m15 9-6 6"></path>
                                    <path d="m9 9 6 6"></path>
                                  </svg>
                                </button>
                                <input type="hidden" x-model="indicator.id"
                                  :name="'categories[' + index + '][standards][' +
                                      standardIndex + '][competencies][' +
                                      competencyIndex + '][indicators][' +
                                      indicatorIndex + '][id]'" />
                                <input type="hidden" x-model="indicator.competency_id"
                                  :name="'categories[' + index + '][standards][' +
                                      standardIndex + '][competencies][' +
                                      competencyIndex + '][indicators][' +
                                      indicatorIndex + '][competency_id]'" />
                                <input type="text" x-model="indicator.code" readonly
                                  :name="'categories[' + index + '][standards][' +
                                      standardIndex + '][competencies][' +
                                      competencyIndex + '][indicators][' +
                                      indicatorIndex + '][code]'"
                                  class="min-w-8 border-0 border-primary bg-transparent p-0 text-center text-sm font-semibold text-gray-600 focus:ring-0 dark:border-gray-500 dark:bg-gray-700 dark:text-purple-400"
                                  x-bind:style="'width: ' + (indicator.code.length + 1) + 'ch;'" />
                                <textarea x-model="indicator.assessment" @keydown.enter.prevent
                                  :name="'categories[' + index + '][standards][' +
                                      standardIndex + '][competencies][' +
                                      competencyIndex + '][indicators][' +
                                      indicatorIndex + '][assessment]'"
                                  class="w-[90%] resize-none overflow-hidden border-b-1 border-x-transparent border-b-gray-200 border-t-transparent bg-transparent pb-0 text-sm font-semibold text-gray-500 focus:border-x-transparent focus:border-b-primaryDark focus:border-t-transparent focus:ring-0"
                                  rows="1" placeholder="Masukkan penilaian indikator" style="text-align: justify;">
                                                            </textarea>

                                <!-- Modal Content -->
                                <button type="button" @click="openModal(indicator.id)"
                                  class="flex items-center text-gray-500 hover:text-primaryDark dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500">
                                  <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75">
                                    </path>
                                  </svg>
                                  <p class="text-xs">
                                    setting

                                  </p>
                                </button>

                                <!-- Modal backdrop. This what you want to place close to the closing body tag -->
                                <div x-show="isModalOpen && currentIndicatorId === indicator.id"
                                  x-transition:enter="transition ease-out duration-150"
                                  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                  x-transition:leave="transition ease-in duration-150"
                                  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                  class="fixed inset-0 z-50 flex items-end justify-center bg-black bg-opacity-50 sm:items-center">
                                  <!-- Modal -->
                                  <div x-show="isModalOpen && currentIndicatorId === indicator.id"
                                    x-transition:enter="transition ease-out duration-150"
                                    x-transition:enter-start="opacity-0 transform translate-y-1/2"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0  transform translate-y-1/2"
                                    @click.away="closeModal()" @keydown.escape="closeModal()"
                                    class="w-full overflow-hidden rounded-t-lg bg-white px-6 py-4 text-left dark:bg-gray-800 sm:m-4 sm:max-w-xl sm:rounded-lg"
                                    role="dialog" :id="'modal-' + indicator.id">
                                    <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                                    <header class="flex justify-between">
                                      <h3 class="text-md font-semibold  dark:text-gray-300">
                                        Atur Jenis Masukan Indikator
                                        <span x-text="indicator.code"></span>
                                      </h3>
                                      <button type="button"
                                        class="inline-flex h-6 w-6 items-center justify-center rounded text-gray-400 transition-colors duration-150 hover:text-gray-700 dark:hover:text-gray-200"
                                        aria-label="close" @click="closeModal()">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" role="img"
                                          aria-hidden="true">
                                          <path
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                      </button>
                                    </header>
                                    <!-- Modal body -->

                                    <div class="mt-6 flex flex-col gap-y-8 text-gray-500">

                                      <div class="flex flex-col ">
                                        <!-- Modal form -->
                                        <div class=" items-center gap-x-3">
                                          <div class="flex items-center mb-2">
                                            {{-- <svg class="size-3 mr-2 " xmlns="http://www.w3.org/2000/svg"
                                              width="24" height="24" viewBox="0 0 24 24" fill="none"
                                              stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round">
                                              <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12a7.5 7.5 0 0 0 15 0m-15 0a7.5 7.5 0 1 1 15 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077 1.41-.513m14.095-5.13 1.41-.513M5.106 17.785l1.15-.964m11.49-9.642 1.149-.964M7.501 19.795l.75-1.3m7.5-12.99.75-1.3m-6.063 16.658.26-1.477m2.605-14.772.26-1.477m0 17.726-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205 12 12m6.894 5.785-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495">
                                              </path>
                                            </svg> --}}

                                            <p>
                                              Pilih jenis inputan
                                            </p>

                                          </div>

                                          <select x-model="indicator.entry"
                                            :name="'categories[' + index +
                                                '][standards][' +
                                                standardIndex +
                                                '][competencies][' +
                                                competencyIndex +
                                                '][indicators][' +
                                                indicatorIndex + '][entry]'"
                                            @change="setData($event, indicator)"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="Option">Option
                                              ( Yes/No )
                                            </option>
                                            <option value="Digit">Digit ( # )
                                            </option>
                                            <option value="Decimal">Decimal ( .
                                              )
                                            </option>
                                            <option value="Cost">Cost ( $ )
                                            </option>
                                            <option value="Percentage">
                                              Percentage ( % )</option>
                                            <option value="Rate">
                                              Rate ( * )</option>

                                          </select>
                                        </div>

                                        <div class="flex items-center justify-end gap-x-3">
                                          <template x-if="indicator.entry === 'Rate'">
                                            <select x-model="indicator.rate_option"
                                              :name="'categories[' + index +
                                                  '][standards][' +
                                                  standardIndex +
                                                  '][competencies][' +
                                                  competencyIndex +
                                                  '][indicators][' +
                                                  indicatorIndex +
                                                  '][rate_option]'"
                                              class=" bg-gray-50 border mt-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                              <option hidden value="1-10">
                                                Pilih skala penilaian</option>
                                              <option value="1-10">1-10
                                              </option>
                                              <option value="1-100">1-100
                                              </option>

                                              <option value="researcherSatisfaction">
                                                Tingkat Kepuasan (label)</option>
                                            </select>
                                          </template>


                                          <template x-if="indicator.entry === 'Percentage'">
                                            <select x-model="indicator.rate_option"
                                              :name="'categories[' + index +
                                                  '][standards][' +
                                                  standardIndex +
                                                  '][competencies][' +
                                                  competencyIndex +
                                                  '][indicators][' +
                                                  indicatorIndex +
                                                  '][rate_option]'"
                                              class=" bg-gray-50 border mt-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                              <option hidden value="1-10">
                                                Pilih jenis inputan persentase</option>
                                              <option value="actualPercentage">Presentase Aktual
                                              </option>

                                              <option value="categoricalPercentage">Presentase Kategorikal
                                              </option>
                                              Tingkat Kepuasan (label)</option>
                                            </select>
                                          </template>



                                        </div>

                                        <div class="mt-6">
                                          <div class="flex w-full">
                                            <span
                                              class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                              <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                  stroke-linejoin="round" stroke-width="2"
                                                  d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                                              </svg>

                                            </span>
                                            <input x-model="indicator.link_info" @keydown.enter.prevent
                                              :name="'categories[' + index +
                                                  '][standards][' +
                                                  standardIndex +
                                                  '][competencies][' +
                                                  competencyIndex +
                                                  '][indicators][' +
                                                  indicatorIndex +
                                                  '][link_info]'"
                                              class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                              placeholder="Masukan link info verifikasi">
                                          </div>



                                          {{-- <input type="text" id="website-admin"
                                          class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="elonmusk"> --}}
                                        </div>

                                        {{-- <form class="mx-auto mt-6 w-full">
                                          <label for="activity_category"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                            Kategori Kegiatan (opsional)
                                          </label>

                                          <select id="activity_category" x-model="indicator.activity_category"
                                            @change="setData($event, indicator)"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">

                                            <option value="">Pilih kategori kegiatan</option>
                                            <option value="penelitian">Penelitian</option>
                                            <option value="pengmas">Pengmas</option>
                                          </select>
                                        </form>


                                        <template
                                          x-if="
    indicator.activity_category === 'penelitian' ||
    indicator.activity_category === 'pengmas'
">
                                          <div class="mx-auto mt-6 w-full">

                                            <label for="participant"
                                              class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                              Peserta
                                            </label>

                                            <select id="participant" x-model="indicator.participant"
                                              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">

                                              <option value="">Pilih jenis peserta</option>
                                              <option value="mahasiswa">Mahasiswa</option>
                                              <option value="tendik">Tendik</option>
                                              <option value="mitra">Mitra</option>
                                              <option value="eksternal">Eksternal</option>

                                            </select>

                                          </div>
                                        </template> --}}




                                      </div>




                                    </div>

                                    <footer
                                      class="-mx-6 -mb-4 flex flex-row items-center justify-end space-x-6 space-y-0 bg-gray-50 px-6 py-3 dark:bg-gray-800">
                                      <button type="button" @click="closeModal"
                                        class="bg-blue-500 rounded-md px-4 py-2 text-sm font-semibold text-white hover:bg-primaryDark">
                                        Simpan
                                      </button>
                                    </footer>
                                  </div>
                                </div>
                                <!-- End of modal backdrop -->
                                <!-- End Modal Content -->

                              </div>
                            </template>
                            <button type="button" @click="addIndicator(standardIndex, competencyIndex)"
                              class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-200 px-3 py-3 text-sm font-medium text-gray-500 transition-colors hover:border-green-600 hover:text-green-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400">
                              <i class="far fa-plus-square mr-2"></i>

                              Tambah Indikator
                            </button>
                          </td>
                        </tr>
                      </template>
                      <tr>
                        <td class="w-[2%]"></td>
                        <td colspan="3" class="  p-2 text-center dark:border-gray-500 dark:text-white">
                          <button type="button" @click="addCompetency(standardIndex)"
                            class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-200 px-3 py-3 text-sm font-medium text-gray-500 transition-colors hover:border-green-600 hover:text-green-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400">
                            <i class="far fa-plus-square mr-2"></i>

                            Tambah Kompetensi
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>


              </div>
            </template>
          </div>
        </template>
        <button type="button" @click="addStandard()" x-show="categories.length > 0 && !isOpenTabInvalid()"
          class="flex w-full items-center justify-center gap-2 rounded-xl border-2 border-dashed border-gray-200 px-3 py-3 text-sm font-medium text-gray-500 transition-colors hover:border-green-600 hover:text-green-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400"></i>
          Tambah Standar
        </button>
        <div x-show="categories.length > 0 && isOpenTabInvalid()"
          class="flex h-full items-center justify-center text-gray-500">
          Tidak ada tab yang dipilih atau tab belum diberi nama.
        </div>
        <div x-show="categories.length === 0" class="flex h-full items-center justify-center text-gray-500">
          Tidak ada kategori yang tersedia. Silakan tambahkan beberapa tab.
        </div>

      </div>

      <div class="flex justify-end gap-3 mt-2">
        <button type="submit" name="action" value="draft"
          class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
          Simpan Sebagai Draft
        </button>
        <button type="submit" name="action" value="submit"
          class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
          Simpan
        </button>
      </div>
    </div>


  </form>

</x-app-layout>
