<x-app-layout>
  <div class="flex h-full w-full flex-col gap-y-4">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2 text-sm">
        <a href="/forms" class="text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          Formulir
        </a>
        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="font-medium text-gray-900 dark:text-white">{{ $form->unit->name }}</span>
        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="font-medium text-gray-900 dark:text-white">{{ $form->document->name }}</span>
      </div>
    </div>

    <!-- Stepper -->
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <!-- Stepper Nav -->
      <div class="mx-auto flex w-2/3 gap-x-2">
        <!-- Step 1 -->
        <div class="group flex flex-1 items-center gap-x-2" data-hs-stepper-nav-item='{ "index": 1}'>
          <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-medium text-white">
            1
          </span>
          <span class="text-sm font-medium text-gray-900 dark:text-white">Identitas</span>
          <div class="h-px flex-1 bg-gray-200 group-last:hidden dark:bg-gray-700"></div>
        </div>
        <!-- Step 2 -->
        <div class="group flex flex-1 items-center gap-x-2" data-hs-stepper-nav-item='{"index": 2}'>
          <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gray-200 text-sm font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-400">
            2
          </span>
          <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Akses</span>
          <div class="h-px flex-1 bg-gray-200 group-last:hidden dark:bg-gray-700"></div>
        </div>
        <!-- Step 3 -->
        <div class="group flex flex-1 items-center gap-x-2" data-hs-stepper-nav-item='{"index": 3}'>
          <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gray-200 text-sm font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-400">
            3
          </span>
          <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Formulir</span>
        </div>
      </div>
    </div>

    <!-- Stepper Content -->
    <form action="/forms/{{ $form->id }}" method="POST" class="flex-1">
      @csrf
      @method('PUT')

      <div x-data="script()" class="flex h-full flex-col">
        <!-- Step 1: Identity -->
        <div class="h-full w-full" data-hs-stepper-content-item='{"index": 1}'>
          <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
            <div class="mb-6 text-center">
              <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $form->unit->name }}</h2>
              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tentukan Unit Deadline, Auditor, dan Unit Kerja</p>
            </div>

            <div class="mx-auto max-w-md space-y-4">
              <!-- Deadline -->
              <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Tentukan Deadline</label>
                <input name="deadline" type="datetime-local" value="{{ old('deadline', $form->formTime->submission_deadline ?? '') }}"
                  class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
              </div>
            </div>

            <!-- Access Table -->
            <div class="mt-6 overflow-x-auto">
              <table class="w-full">
                <thead>
                  <tr class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                    <th class="pb-3 pr-4">Unit Kerja</th>
                    <th class="pb-3">Auditor</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                  <tr>
                    <td class="py-4 pr-4">
                      <div class="space-y-3">
                        <input value="Pimpinan" readonly name="positions[]"
                          class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-center text-sm font-medium text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        <input value="PIC" readonly name="positions[]"
                          class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-center text-sm font-medium text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        <template x-for="(item, itemIndex) in auditees || []" :key="item">
                          <div class="flex items-center gap-2">
                            <input type="text" :value="'PIC ' + item.id" readonly name="positions[]"
                              class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-center text-sm font-medium text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                            <button type="button" @click="removeItem('auditees', itemIndex)"
                              class="rounded-lg p-1.5 text-gray-400 transition-colors hover:bg-gray-100 hover:text-red-500 dark:hover:bg-gray-800">
                              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                              </svg>
                            </button>
                          </div>
                        </template>
                        <button type="button" @click="addItem('auditees')"
                          class="flex w-full items-center justify-center gap-2 rounded-lg border-2 border-dashed border-gray-200 px-3 py-2 text-sm font-medium text-gray-500 transition-colors hover:border-blue-500 hover:text-blue-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400">
                          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                          </svg>
                          Tambah Auditee
                        </button>
                      </div>
                    </td>
                    <td class="py-4">
                      <div class="space-y-3">
                        <input value="Ketua" readonly name="positions[]"
                          class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-center text-sm font-medium text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        <input value="Anggota" readonly name="positions[]"
                          class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-center text-sm font-medium text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        <template x-for="(item, itemIndex) in auditors || []" :key="item">
                          <div class="flex items-center gap-2">
                            <input type="text" :value="'Anggota ' + item.id" readonly name="positions[]"
                              class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-center text-sm font-medium text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                            <button type="button" @click="removeItem('auditors', itemIndex)"
                              class="rounded-lg p-1.5 text-gray-400 transition-colors hover:bg-gray-100 hover:text-red-500 dark:hover:bg-gray-800">
                              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                              </svg>
                            </button>
                          </div>
                        </template>
                        <button type="button" @click="addItem('auditors')"
                          class="flex w-full items-center justify-center gap-2 rounded-lg border-2 border-dashed border-gray-200 px-3 py-2 text-sm font-medium text-gray-500 transition-colors hover:border-blue-500 hover:text-blue-600 dark:border-gray-700 dark:text-gray-400 dark:hover:border-blue-400 dark:hover:text-blue-400">
                          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                          </svg>
                          Tambah Auditor
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Step 2: Access (Empty) -->
        <div class="h-full w-full" data-hs-stepper-content-item='{"index": 2}' style="display: none;">
          <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
            <p class="text-sm text-gray-500 dark:text-gray-400">Konten langkah 2 akan segera tersedia.</p>
          </div>
        </div>

        <!-- Step 3: Forms -->
        <div class="h-full w-full p-2" data-hs-stepper-content-item='{"index": 3}' style="display: none;">
          <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
            <div class="mb-4 text-center">
              <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Konfigurasi Formulir</h2>
              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Atur kategori, standar, kompetensi, dan indikator</p>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Fitur ini akan segera tersedia.</p>
          </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="mt-4 flex justify-between">
          <button type="button" @click="previousStep()"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Sebelumnya
          </button>
          <div class="flex gap-2">
            <button type="submit"
              class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
              Simpan
            </button>
            <button type="button" @click="nextStep()"
              class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
              Selanjutnya
              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <script>
    function script() {
      return {
        auditees: @json($auditees ?? []),
        auditors: @json($auditors ?? []),
        currentStep: 1,
        addItem(type) {
          this[type].push({ id: Date.now() });
        },
        removeItem(type, index) {
          this[type].splice(index, 1);
        },
        nextStep() {
          if (this.currentStep < 3) {
            this.currentStep++;
            this.updateStepper();
          }
        },
        previousStep() {
          if (this.currentStep > 1) {
            this.currentStep--;
            this.updateStepper();
          }
        },
        updateStepper() {
          document.querySelectorAll('[data-hs-stepper-content-item]').forEach(el => {
            el.style.display = 'none';
          });
          const currentContent = document.querySelector(`[data-hs-stepper-content-item='{"index": ${this.currentStep}}']`);
          if (currentContent) currentContent.style.display = 'block';
        }
      }
    }
  </script>
</x-app-layout>
