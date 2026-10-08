<x-app-layout>
  @php
    $stageColors = [
        ['number' => 'bg-blue-500 text-white', 'title' => 'text-blue-600 dark:text-blue-400'],
        ['number' => 'bg-sky-500 text-white', 'title' => 'text-sky-600 dark:text-sky-400'],
        ['number' => 'bg-teal-500 text-white', 'title' => 'text-teal-600 dark:text-teal-400'],
        ['number' => 'bg-violet-500 text-white', 'title' => 'text-violet-600 dark:text-violet-400'],
        ['number' => 'bg-rose-500 text-white', 'title' => 'text-rose-600 dark:text-rose-400'],
        ['number' => 'bg-amber-500 text-white', 'title' => 'text-amber-600 dark:text-amber-400'],
        ['number' => 'bg-emerald-500 text-white', 'title' => 'text-emerald-600 dark:text-emerald-400'],
        ['number' => 'bg-blue-500 text-white', 'title' => 'text-blue-600 dark:text-blue-400'],
    ];
  @endphp

  <div class="space-y-8">
    <!-- Welcome Banner -->
    <x-welcome-banner />

    <!-- Page Header -->
    <div class="flex flex-col gap-1">
      <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
        Tahapan AMI
      </h1>
      <p class="text-sm text-gray-500 dark:text-gray-400">
        Pantau progres audit mutu internal institusi Anda
      </p>
    </div>

    <!-- Stage Timeline -->
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <!-- Mobile: Vertical Timeline -->
      <div class="flex flex-col gap-5 md:hidden">
        @foreach ($stages as $stage)
          @php
            $color = $stageColors[$loop->index];
          @endphp

          <div class="relative flex gap-4">
            @if (!$loop->last)
              <div class="absolute left-[19px] top-12 h-[calc(100%-24px)] w-px bg-gray-200 dark:bg-gray-700"></div>
            @endif

            <div
              class="{{ $color['number'] }} relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-sm font-semibold shadow-sm">
              {{ $loop->index + 1 }}
            </div>

            <div class="min-w-0 flex-1">
              <h3 class="mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                {{ $stage->name }}
              </h3>

              <form action="{{ route('stages.update', $stage->id) }}" method="POST"
                class="w-full rounded-xl border border-gray-200 bg-gray-50 p-3 transition-all duration-200 hover:border-gray-300 hover:bg-white dark:border-gray-700 dark:bg-gray-800 dark:hover:border-gray-600 dark:hover:bg-gray-700/50">
                @csrf
                @method('PUT')

                @if ($userRole === 'PJM')
                  <textarea name="description" rows="3"
                    class="w-full resize-none border-0 bg-transparent text-sm leading-relaxed text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0 dark:text-gray-300"
                    placeholder="Deskripsi Tahapan Audit">{{ $stage->description }}</textarea>

                  <div class="mt-2 flex justify-end">
                    <button type="submit"
                      class="rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-medium text-white transition-colors hover:bg-emerald-500 dark:bg-emerald-500 dark:hover:bg-emerald-400">
                      Simpan
                    </button>
                  </div>
                @else
                  <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-400">
                    {{ $stage->description ?: 'Belum ada deskripsi' }}
                  </p>
                @endif
              </form>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Desktop: Horizontal Stepper -->
      <div class="hidden md:block">
        <!-- Top row: 1-4 -->
        <div class="relative">
          <div class="absolute left-0 right-0 top-5 h-px bg-gray-200 dark:bg-gray-700"></div>
          <div class="relative z-10 flex justify-between gap-4">
            @foreach ($stages->take(4) as $stage)
              @php
                $color = $stageColors[$loop->index];
              @endphp

              <div class="flex flex-1 flex-col items-center">
                <div
                  class="{{ $color['number'] }} flex h-10 w-10 items-center justify-center rounded-full text-sm font-semibold shadow-sm">
                  {{ $loop->index + 1 }}
                </div>
                <h3 class="mt-3 text-sm font-semibold text-gray-900 dark:text-white">
                  {{ $stage->name }}
                </h3>

                <form action="{{ route('stages.update', $stage->id) }}" method="POST"
                  class="mt-3 w-full max-w-56 rounded-xl border border-gray-200 bg-gray-50 p-3 transition-all duration-200 hover:border-gray-300 hover:bg-white hover:shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:hover:border-gray-600">
                  @csrf
                  @method('PUT')

                  @if ($userRole === 'PJM')
                    <textarea name="description" rows="3"
                      class="w-full resize-none border-0 bg-transparent text-sm leading-relaxed text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0 dark:text-gray-300"
                      placeholder="Deskripsi Tahapan Audit">{{ $stage->description }}</textarea>
                    <div class="mt-2 flex justify-end">
                      <button type="submit"
                        class="rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-medium text-white transition-colors hover:bg-blue-500 dark:bg-blue-500 dark:hover:bg-blue-400">
                        Simpan
                      </button>
                    </div>
                  @else
                    <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-400">
                      {{ $stage->description ?: 'Belum ada deskripsi' }}
                    </p>
                  @endif
                </form>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Bottom row: 5-8 -->


        <div class="relative mt-10">
          @if ($stages->count() > 4)
            <div class="absolute left-0 right-0 top-5 h-px bg-gray-200 dark:bg-gray-700"></div>
          @endif
          <div class="relative z-10 flex justify-between gap-4">
            @foreach ($stages->skip(4) as $stage)
              @php
                $stageIndex = $stages->search(fn($item) => $item->id === $stage->id);
                $color = $stageColors[$stageIndex];
              @endphp

              <div class="flex flex-1 flex-col items-center">
                <div
                  class="{{ $color['number'] }} flex h-10 w-10 items-center justify-center rounded-full text-sm font-semibold shadow-sm">
                  {{ $stageIndex + 1 }}
                </div>
                <h3 class="mt-3 text-sm font-semibold text-gray-900 dark:text-white">
                  {{ $stage->name }}
                </h3>

                <form action="{{ route('stages.update', $stage->id) }}" method="POST"
                  class="mt-3 w-full max-w-56 rounded-xl border border-gray-200 bg-gray-50 p-3 transition-all duration-200 hover:border-gray-300 hover:bg-white hover:shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:hover:border-gray-600">
                  @csrf
                  @method('PUT')

                  @if ($userRole === 'PJM')
                    <textarea name="description" rows="3"
                      class="w-full resize-none border-0 bg-transparent text-sm leading-relaxed text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0 dark:text-gray-300"
                      placeholder="Deskripsi Tahapan Audit">{{ $stage->description }}</textarea>
                    <div class="mt-2 flex justify-end">
                      <button type="submit"
                        class="rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-medium text-white transition-colors hover:bg-blue-500 dark:bg-blue-500 dark:hover:bg-blue-400">
                        Simpan
                      </button>
                    </div>
                  @else
                    <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-400">
                      {{ $stage->description ?: 'Belum ada deskripsi' }}
                    </p>
                  @endif
                </form>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <!-- Users Section -->
    @if ($userRole == 'PJM' || $userRole == 'Admin')
      <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
        <div class="mb-5 flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
              Pengguna Online
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
              {{ $users->count() }} pengguna aktif dalam 3 menit terakhir
            </p>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr
                class="border-b border-gray-100 text-left text-xs font-medium uppercase tracking-wider text-gray-400 dark:border-gray-800 dark:text-gray-500">
                <th class="pb-3 pr-4">Pengguna</th>
                <th class="pb-3 pr-4">Kontak</th>
                <th class="pb-3 pr-4">Role</th>
                <th class="pb-3">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
              @foreach ($users as $user)
                <tr class="group transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                  <td class="py-3 pr-4">
                    <div class="flex items-center gap-3">
                      <div class="relative h-9 w-9 shrink-0">
                        <img class="h-full w-full rounded-full object-cover ring-2 ring-white dark:ring-gray-800"
                          src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random" alt=""
                          loading="lazy" />
                      </div>
                      <div class="min-w-0">
                        <p class="truncate text-sm font-medium text-gray-900 dark:text-white">
                          {{ $user->name }}{{ Auth::id() === $user->id ? ' (Anda)' : '' }}
                        </p>
                        <p class="truncate text-xs text-gray-500 dark:text-gray-400">
                          {{ $user->email }}
                        </p>
                      </div>
                    </div>
                  </td>
                  <td class="py-3 pr-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ $user->contact }}
                  </td>
                  <td class="py-3 pr-4">
                    <div class="flex flex-wrap gap-1">
                      @foreach ($user->getRoleNames() as $role)
                        @if ($role == 'PJM')
                          <span
                            class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                            {{ $role }}
                          </span>
                        @elseif ($role == 'Auditor')
                          <span
                            class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">
                            {{ $role }}
                          </span>
                        @elseif ($role == 'Auditee')
                          <span
                            class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-0.5 text-xs font-medium text-rose-700 dark:bg-rose-900/30 dark:text-rose-400">
                            {{ $role }}
                          </span>
                        @else
                          <span
                            class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                            {{ $role }}
                          </span>
                        @endif
                      @endforeach
                    </div>
                  </td>
                  <td class="py-3">
                    @if ($user->last_seen && $user->last_seen >= now()->subMinutes(3))
                      <span
                        class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-600 dark:text-emerald-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Online
                      </span>
                    @elseif ($user->last_seen)
                      <span class="text-xs text-gray-500 dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                      </span>
                    @else
                      <span class="text-xs text-gray-400 dark:text-gray-500">Tidak pernah terlihat</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endif

    <!-- Charts Section -->
    <div class="space-y-4">
      <div>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
          Analitik
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Ringkasan performa audit mutu internal
        </p>
      </div>

      <div class="grid gap-6 md:grid-cols-2">
        <!-- Doughnut Chart -->
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
          <h4 class="mb-4 text-sm font-semibold text-gray-900 dark:text-white">
            Ketepatan Waktu Pengumpulan
          </h4>
          <div class="relative mx-auto h-48 w-48">
            <canvas id="pie"></canvas>
          </div>
          <div class="mt-4 flex justify-center gap-6 text-sm">
            <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
              <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
              <span>Tepat waktu</span>
            </div>
            <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
              <span class="h-2.5 w-2.5 rounded-full bg-rose-400"></span>
              <span>Tidak tepat waktu</span>
            </div>
          </div>
        </div>

        <!-- Bar Chart -->
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
          <h4 class="mb-4 text-sm font-semibold text-gray-900 dark:text-white">
            Ketercapaian Standar
          </h4>
          <div class="relative h-48">
            <canvas id="bars"></canvas>
          </div>
          <div class="mt-4 flex justify-center gap-6 text-sm">
            <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
              <span class="h-2.5 w-2.5 rounded-full bg-blue-500"></span>
              <span>Total Standar</span>
            </div>
            <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
              <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
              <span>Tercapai</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const panes = document.querySelectorAll('.pane');
    let activePaneIndex = 0;

    panes.forEach((pane, index) => {
      pane.addEventListener('click', () => {
        const previousInput = panes[activePaneIndex].querySelector('textarea');
        const previousStage = panes[activePaneIndex].querySelector('#stage');
        const previousTitle = panes[activePaneIndex].querySelector('#title');
        previousInput.classList.add('hidden');
        previousStage.classList.remove('left-0', 'ml-3');
        previousTitle.classList.add('hidden');
        previousTitle.classList.remove('flex');

        panes[activePaneIndex].classList.remove('active');

        activePaneIndex = index;

        const currentInput = pane.querySelector('textarea');
        const currentStage = pane.querySelector('#stage');
        const currentTitle = pane.querySelector('#title');
        currentInput.classList.remove('hidden');
        currentStage.classList.add('left-0', 'ml-3');
        currentTitle.classList.remove('hidden');
        currentTitle.classList.add('flex');

        pane.classList.add('active');
      });
    });
  </script>

  <!-- Chart Data -->
  <script>
    window.chartData = {
      tepatWaktu: {{ $tepatWaktu }},
      tidakTepatWaktu: {{ $tidakTepatWaktu }}
    };
    var categoryPercentages = @json(array_values($categoryPercentages));
  </script>

  <!-- Chart Scripts -->
  <script src="{{ asset('js/charts-pie.js') }}" defer></script>
  <script src="{{ asset('js/charts-bars.js') }}" defer></script>
</x-app-layout>
