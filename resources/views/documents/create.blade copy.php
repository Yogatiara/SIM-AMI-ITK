<x-app-layout>
    <form action="/documents" method="POST" class="flex h-full w-full flex-col gap-y-4">
        @csrf

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
                <span class="font-medium text-gray-900 dark:text-white">Tambah Dokumen</span>
            </div>
            <div class="flex items-center gap-2">
                <input name="document_name" type="text" placeholder="Nama Dokumen" required autofocus
                    value="{{ old('document_name') }}"
                    class="h-9 w-48 rounded-lg border border-gray-200 bg-white px-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            </div>
        </div>

        <!-- Main Content -->
        <div x-data="{
        openTab: 1,
        categories: @json($categories),
        addTab() {
            this.categories.push({ id: 0, name: '', standards: [] });
            this.openTab = this.categories.length;
        },
        removeTab(tabId) {
            let index = this.categories.findIndex(cat => cat.id === tabId);
            this.categories.splice(index, 1);
            if (this.openTab === tabId) {
                this.openTab = this.categories.length < tabId ? this.categories.length : tabId;
            } else if (this.openTab > tabId) {
                this.openTab = this.categories.length;
            }
        },
        addStandard(categoryIndex) {
            this.categories[categoryIndex].standards.push({ id: 0, name: '', competencies: [] });
        },
        removeStandard(categoryIndex, standardIndex) {
            this.categories[categoryIndex].standards.splice(standardIndex, 1);
        },
        addCompetency(categoryIndex, standardIndex) {
            this.categories[categoryIndex].standards[standardIndex].competencies.push({ id: 0, name: '', indicators: [] });
        },
        removeCompetency(categoryIndex, standardIndex, competencyIndex) {
            this.categories[categoryIndex].standards[standardIndex].competencies.splice(competencyIndex, 1);
        },
        addIndicator(categoryIndex, standardIndex, competencyIndex) {
            this.categories[categoryIndex].standards[standardIndex].competencies[competencyIndex].indicators.push({ id: 0, assessment: '', code: '' });
        },
        removeIndicator(categoryIndex, standardIndex, competencyIndex, indicatorIndex) {
            this.categories[categoryIndex].standards[standardIndex].competencies[competencyIndex].indicators.splice(indicatorIndex, 1);
        }
    }" class="flex-1 overflow-auto">

            <!-- Category Tabs -->
            <div class="mb-4 flex gap-1 overflow-x-auto rounded-xl bg-gray-100 p-1 dark:bg-gray-800">
                <template x-for="(category, index) in categories" :key="index">
                    <div @click.prevent="openTab = index + 1" :class="openTab === index + 1 ? 'bg-white text-gray-900 shadow-sm dark:bg-gray-700 dark:text-white' :
                'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                        class="flex cursor-pointer items-center gap-2 whitespace-nowrap rounded-lg px-4 py-2 text-sm font-medium transition-all">
                        <input type="hidden" x-model="category.id" :name="'categories[' + index + '][id]'" />
                        <input type="text" x-model="category.name" :name="'categories[' + index + '][name]'"
                            class="w-24 border-0 bg-transparent text-sm font-medium focus:ring-0"
                            placeholder="Nama Tab" />
                        <button type="button" @click.stop="removeTab(category.id)" x-show="categories.length > 1"
                            class="rounded-full p-0.5 text-gray-400 hover:text-red-500">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </template>
                <button @click="addTab()"
                    class="flex cursor-pointer items-center gap-2 whitespace-nowrap rounded-lg px-4 py-2 text-sm font-medium text-emerald-600 transition-colors hover:bg-emerald-50 dark:text-emerald-400 dark:hover:bg-emerald-900/20">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Tab
                </button>
            </div>

            <!-- Standards Content -->
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
                <template x-for="(category, categoryIndex) in categories" :key="categoryIndex">
                    <div x-show="openTab === categoryIndex + 1" class="space-y-6">
                        <template x-for="(standard, standardIndex) in category.standards" :key="standardIndex">
                            <div>
                                <div class="mb-4 flex items-center gap-2">
                                    <button type="button" @click="removeStandard(categoryIndex, standardIndex)"
                                        class="rounded-full p-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-red-500 dark:hover:bg-gray-800">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <input type="hidden" x-model="standard.id"
                                        :name="'categories[' + categoryIndex + '][standards][' + standardIndex + '][id]'" />
                                    <input type="text" x-model="standard.name"
                                        :name="'categories[' + categoryIndex + '][standards][' + standardIndex + '][name]'"
                                        class="flex-1 border-0 bg-transparent text-lg font-semibold text-gray-900 focus:ring-0 dark:text-white"
                                        placeholder="Masukkan Nama Standar" />
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="w-full">
                                        <thead>
                                            <tr
                                                class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                                                <th class="w-[2%] pb-3"></th>
                                                <th class="w-[44%] pb-3 pr-4">Kompetensi</th>
                                                <th class="w-[44%] pb-3">Indikator</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                                            <template x-for="(competency, competencyIndex) in standard.competencies"
                                                :key="competencyIndex">
                                                <tr>
                                                    <td class="py-4">
                                                        <button type="button"
                                                            @click="removeCompetency(categoryIndex, standardIndex, competencyIndex)"
                                                            class="rounded-full p-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-red-500 dark:hover:bg-gray-800">
                                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </td>
                                                    <td class="py-4 pr-4">
                                                        <input type="hidden" x-model="competency.id" :name="'categories[' + categoryIndex + '][standards][' + standardIndex + '][competencies][' +
                                  competencyIndex + '][id]'" />
                                                        <textarea x-model="competency.name" :name="'categories[' + categoryIndex + '][standards][' + standardIndex + '][competencies][' +
                                  competencyIndex + '][name]'"
                                                            class="w-full resize-none border-0 bg-transparent text-sm font-medium text-gray-900 focus:ring-0 dark:text-white"
                                                            placeholder="Masukkan Nama Kompetensi" rows="1"></textarea>
                                                    </td>
                                                    <td class="py-4">
                                                        <template
                                                            x-for="(indicator, indicatorIndex) in competency.indicators"
                                                            :key="indicatorIndex">
                                                            <div class="mb-4">
                                                                <div class="mb-2 flex items-center gap-2">
                                                                    <button type="button"
                                                                        @click="removeIndicator(categoryIndex, standardIndex, competencyIndex, indicatorIndex)"
                                                                        class="rounded-full p-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-red-500 dark:hover:bg-gray-800">
                                                                        <svg class="h-3.5 w-3.5" fill="none"
                                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M6 18L18 6M6 6l12 12" />
                                                                        </svg>
                                                                    </button>
                                                                    <input type="hidden" x-model="indicator.id" :name="'categories[' + categoryIndex + '][standards][' + standardIndex +
                                        '][competencies][' + competencyIndex + '][indicators][' + indicatorIndex +
                                        '][id]'" />
                                                                    <input type="text" x-model="indicator.code" readonly
                                                                        :name="'categories[' + categoryIndex + '][standards][' + standardIndex +
                                        '][competencies][' + competencyIndex + '][indicators][' + indicatorIndex +
                                        '][code]'" class="w-12 border-0 bg-transparent text-center text-sm font-semibold text-gray-600 focus:ring-0 dark:text-gray-400" />
                                                                </div>
                                                                <textarea x-model="indicator.assessment" :name="'categories[' + categoryIndex + '][standards][' + standardIndex + '][competencies][' +
                                      competencyIndex + '][indicators][' + indicatorIndex + '][assessment]'"
                                                                    class="w-full resize-none border-0 border-b border-gray-200 bg-transparent pb-2 text-sm text-gray-600 focus:border-blue-500 focus:ring-0 dark:border-gray-700 dark:text-gray-400"
                                                                    placeholder="Masukkan Penilaian Indikator"
                                                                    rows="2"></textarea>
                                                            </div>
                                                        </template>
                                                        <button type="button"
                                                            @click="addIndicator(categoryIndex, standardIndex, competencyIndex)"
                                                            class="flex w-full items-center justify-center gap-2 rounded-lg border-2 border-dashed border-gray-200 px-3 py-2 text-sm font-medium text-gray-500 transition-colors hover:border-blue-500 hover:text-blue-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400">
                                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M12 4v16m8-8H4" />
                                                            </svg>
                                                            Tambah Indikator
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                            <tr>
                                                <td colspan="3" class="py-4">
                                                    <button type="button"
                                                        @click="addCompetency(categoryIndex, standardIndex)"
                                                        class="flex w-full items-center justify-center gap-2 rounded-lg border-2 border-dashed border-gray-200 px-3 py-2 text-sm font-medium text-gray-500 transition-colors hover:border-blue-500 hover:text-blue-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Tambah Kompetensi
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>

                        <!-- Add Standard Button -->
                        <button type="button" @click="addStandard(categoryIndex)"
                            class="flex w-full items-center justify-center gap-2 rounded-lg border-2 border-dashed border-gray-200 px-3 py-3 text-sm font-medium text-gray-500 transition-colors hover:border-blue-500 hover:text-blue-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Standar
                        </button>

                        <!-- Empty State -->
                        <div x-show="category.standards.length === 0"
                            class="flex h-32 items-center justify-center text-sm text-gray-500 dark:text-gray-400">
                            Belum ada standar. Klik "Tambah Standar" untuk menambahkan.
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="flex justify-end gap-3">
            <button type="submit" name="action" value="draft"
                class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                Simpan Sebagai Draft
            </button>
            <button type="submit" name="action" value="submit"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
                Simpan
            </button>
        </div>
    </form>
</x-app-layout>
