<x-app-layout>
  <div class="space-y-8 font-semibold">
    <div>
      <h2 class="text-2xl font-semibold text-blue-800 dark:text-gray-200">
        Tahapan AMI
      </h2>



      @php
        $stageColors = [
            [
                'number' => 'bg-blue-500 text-white',
                'title' => 'text-blue-600',
                'card' => 'bg-blue-500 border-blue-700',
                'description' => 'text-white',
            ],
            [
                'number' => 'bg-emerald-500 text-white',
                'title' => 'text-emerald-600',
                'card' => 'bg-emerald-500 border-emerald-700',
                'description' => 'text-white',
            ],
            [
                'number' => 'bg-violet-500 text-white',
                'title' => 'text-violet-600',
                'card' => 'bg-violet-500 border-violet-700',
                'description' => 'text-white',
            ],
            [
                'number' => 'bg-orange-500 text-white',
                'title' => 'text-orange-600',
                'card' => 'bg-orange-500 border-orange-700',
                'description' => 'text-white',
            ],
            [
                'number' => 'bg-rose-500 text-white',
                'title' => 'text-rose-600',
                'card' => 'bg-rose-500 border-rose-700',
                'description' => 'text-white',
            ],
            [
                'number' => 'bg-cyan-500 text-white',
                'title' => 'text-cyan-600',
                'card' => 'bg-cyan-500 border-cyan-700',
                'description' => 'text-white',
            ],
            [
                'number' => 'bg-amber-500 text-white',
                'title' => 'text-amber-600',
                'card' => 'bg-amber-500 border-amber-700',
                'description' => 'text-white',
            ],
            [
                'number' => 'bg-indigo-500 text-white',
                'title' => 'text-indigo-600',
                'card' => 'bg-indigo-500 border-indigo-700',
                'description' => 'text-white',
            ],
        ];
      @endphp


      <div class="relative mt-6 w-full">

        {{-- ========================= --}}
        {{-- MOBILE : 1 - 8 --}}
        {{-- ========================= --}}
        <div class="flex flex-col gap-6 md:hidden">

          @foreach ($stages as $stage)
            @php
              $color = $stageColors[$loop->index];
            @endphp

            <div class="relative flex gap-4">

              {{-- Garis timeline --}}
              @if (!$loop->last)
                <div class="absolute left-5 top-10 h-full w-0.5 bg-gray-300"></div>
              @endif

              {{-- Nomor --}}
              <div
                class="{{ $color['number'] }}
                           relative z-10 flex h-10 w-10 min-h-10 min-w-10
                           items-center justify-center rounded-full
                           font-semibold shadow-sm">
                {{ $loop->index + 1 }}
              </div>

              {{-- Content --}}
              <div class="min-w-0 flex-1">

                <h1 class="{{ $color['title'] }} mb-2 font-semibold">
                  {{ $stage->name }}
                </h1>

                <div
                  class="{{ $color['card'] }}
                               w-full rounded-xl border p-3 shadow-sm
                               transition-all duration-300
                               hover:shadow-lg">
                  <p class="{{ $color['description'] }} text-sm leading-5">
                    {{ $stage->description }}
                  </p>
                </div>

              </div>

            </div>
          @endforeach

        </div>


        {{-- ========================= --}}
        {{-- DESKTOP : 1 - 4 --}}
        {{-- ========================= --}}
        <div class="relative hidden md:block">

          <div class="relative z-10 flex w-full justify-between gap-5">

            @foreach ($stages->take(4) as $stage)
              @php
                $color = $stageColors[$loop->index];
              @endphp

              <div class="min-w-0 flex-1">

                {{-- Nama + Nomor --}}
                <div class="flex flex-col-reverse">

                  {{-- Nomor --}}
                  <div
                    class="{{ $color['number'] }}
                                   flex h-10 w-10 items-center justify-center
                                   rounded-full font-semibold shadow-sm">
                    {{ $loop->index + 1 }}
                  </div>

                  {{-- Nama --}}
                  <div class="mb-2">
                    <h1 class="{{ $color['title'] }} font-semibold">
                      {{ $stage->name }}
                    </h1>
                  </div>

                </div>

                {{-- Card --}}
                <div
                  class="{{ $color['card'] }}
                               mt-3 w-full max-w-56 rounded-xl border p-3
                               shadow-sm transition-all duration-300
                               ease-in-out hover:scale-105 hover:shadow-lg">
                  <p class="{{ $color['description'] }} text-sm leading-5">
                    {{ $stage->description }}
                  </p>
                </div>

              </div>
            @endforeach

          </div>


          {{-- ========================= --}}
          {{-- GARIS DESKTOP --}}
          {{-- ========================= --}}
          <div
            class="absolute left-1 top-[10%] -z-10
                   h-[59%] w-[100%] xl:top-[12%] xl:h-[60%] xl:w-[90%]
                   rounded-r-full
                   border-b-2 border-r-2 border-t-2
                   border-gray-400">
          </div>


          {{-- ========================= --}}
          {{-- DESKTOP : 5 - 8 --}}
          {{-- ========================= --}}
          <div class="relative z-10 mt-16 flex w-full justify-between gap-5">

            @foreach ($stages->skip(4)->reverse() as $stage)
              @php
                $stageIndex = $stages->search(fn($item) => $item->id === $stage->id);

                $color = $stageColors[$stageIndex];
              @endphp

              <div class="min-w-0 flex-1">

                {{-- Nama + Nomor --}}
                <div class="flex flex-col-reverse">

                  {{-- Nomor --}}
                  <div
                    class="{{ $color['number'] }}
                                   flex h-10 w-10 items-center justify-center
                                   rounded-full font-semibold shadow-sm">
                    {{ $stageIndex + 1 }}
                  </div>

                  {{-- Nama --}}
                  <div class="mb-2">
                    <h1 class="{{ $color['title'] }} font-semibold">
                      {{ $stage->name }}
                    </h1>
                  </div>

                </div>

                {{-- Card --}}
                <div
                  class="{{ $color['card'] }}
                               mt-3 w-full max-w-56 rounded-xl border p-3
                               shadow-sm transition-all duration-300
                               ease-in-out hover:scale-105 hover:shadow-lg">
                  <p class="{{ $color['description'] }} text-sm leading-5">
                    {{ $stage->description }}
                  </p>
                </div>

              </div>
            @endforeach

          </div>

        </div>

      </div>

    </div>
  </div>

  @if ($userRole == 'PJM')
    <div>
      <h2 class="text-2xl font-semibold text-blue-800 dark:text-gray-200">
        Users
      </h2>
      <div
        class="max-h-56 w-full overflow-y-auto rounded-sm scrollbar-thin dark:scrollbar-track-gray-500 dark:scrollbar-thumb-gray-800">
        <table class="h-full w-full bg-white dark:bg-gray-800">
          <thead class="sticky top-0 z-10">
            <tr class="border-b bg-blue-800 text-cool-gray-50">
              <th class="py-2">#</th>
              <th>User</th>
              <th>Contact</th>
              <th>Role</th>
              <th>Last seen</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr class="border-b text-sm hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                <td class="px-2 text-center">{{ $loop->iteration . '.' }}</td>
                <td class="whitespace-nowrap p-3">
                  <div class="flex items-center gap-3">
                    <div class="relative h-10 w-10">
                      <img class="h-full w-full rounded-full object-cover"
                        src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random" alt=""
                        loading="lazy" />
                      <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                      </div>
                    </div>
                    <div>
                      <h1>{{ $user->name }}{{ Auth::id() === $user->id ? ' (Anda)' : '' }}
                      </h1>
                      <p class="text-gray-600 dark:text-gray-400">
                        {{ $user->email }}
                      </p>
                    </div>
                  </div>
                </td>
                <td class="text-center">{{ $user->contact }}</td>
                <td>
                  <div class="flex flex-wrap items-center justify-center gap-1 py-2 text-xs">
                    @foreach ($user->getRoleNames() as $role)
                      @if ($role == 'PJM')
                        <span
                          class="rounded-full bg-green-200 px-3 py-1 leading-tight text-green-700 dark:bg-green-700 dark:text-green-200">
                          {{ $role }}
                        </span>
                      @elseif ($role == 'Auditor')
                        <span
                          class="rounded-full bg-yellow-200 px-3 py-1 leading-tight text-yellow-500 dark:bg-yellow-400 dark:text-yellow-200">
                          {{ $role }}
                        </span>
                      @elseif ($role == 'Auditee')
                        <span
                          class="rounded-full bg-red-200 px-3 py-1 leading-tight text-red-700 dark:bg-red-700 dark:text-red-200">
                          {{ $role }}
                        </span>
                      @else
                        <span
                          class="rounded-full bg-gray-200 px-3 py-1 leading-tight text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                          {{ $role }}
                        </span>
                      @endif
                    @endforeach
                  </div>
                </td>
                <td class="p-2 text-center">
                  @if ($user->last_seen && $user->last_seen >= now()->subMinutes(3))
                    <span class="rounded-full bg-teal-200 px-3 py-1 text-teal-500 dark:bg-teal-400 dark:text-teal-100">
                      Online
                    </span>
                  @elseif ($user->last_seen)
                    {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                  @else
                    <span class="text-gray-600 dark:text-gray-400">Tidak pernah terlihat</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif

  <!-- Charts -->
  <div>
    <h2 class="text-2xl font-semibold text-blue-800 dark:text-gray-200">
      Charts
    </h2>
    <div class="mb-8 grid gap-6 md:grid-cols-2">
      <!-- Doughnut/Pie chart -->
      <div class="shadow-xs min-w-0 rounded-lg bg-white p-4 dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
          Ketepatan Waktu Pengumpulan Ketercapaian Standar
        </h4>
        <canvas id="pie"></canvas>
        <div class="mt-4 flex justify-center space-x-3 text-sm text-gray-600 dark:text-gray-400">
          <!-- Chart legend -->
          <div class="flex items-center">
            <span class="mr-1 inline-block h-3 w-3 rounded-full bg-red-500"></span>
            <span>Tidak tepat waktu</span>
          </div>
          <div class="flex items-center">
            <span class="mr-1 inline-block h-3 w-3 rounded-full bg-cyan-500"></span>
            <span>Tepat waktu</span>
          </div>
        </div>
      </div>
      <!-- Lines chart -->
      {{-- <div class="shadow-xs min-w-0 rounded-lg bg-white p-4 dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                        Lines
                    </h4>
                    <canvas id="line"></canvas>
                    <div class="mt-4 flex justify-center space-x-3 text-sm text-gray-600 dark:text-gray-400">
                        <!-- Chart legend -->
                        <div class="flex items-center">
                            <span class="mr-1 inline-block h-3 w-3 rounded-full bg-teal-500"></span>
                            <span>Organic</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-1 inline-block h-3 w-3 rounded-full bg-purple-600"></span>
                            <span>Paid</span>
                        </div>
                    </div>
                </div> --}}
      <!-- Bars chart -->
      <div class="shadow-xs min-w-0 rounded-lg bg-white p-4 dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
          Ketercapaian standar
        </h4>
        <canvas id="bars"></canvas>
        <div class="mt-4 flex justify-center space-x-3 text-sm text-gray-600 dark:text-gray-400">
          <!-- Chart legend -->
          <div class="flex items-center">
            <span class="mr-1 inline-block h-3 w-3 rounded-full bg-teal-500"></span>
            <span>Standar</span>
          </div>
          <div class="flex items-center">
            <span class="mr-1 inline-block h-3 w-3 rounded-full bg-purple-600"></span>
            <span>Tercapai</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script>
    const panes = document.querySelectorAll('.pane');
    let activePaneIndex = 0; // Track index of currently active pane

    panes.forEach((pane, index) => {
      pane.addEventListener('click', () => {
        // Ambil input dari pane yang sedang aktif sebelumnya dan sembunyikan
        const previousInput = panes[activePaneIndex].querySelector('textarea');
        const previousStage = panes[activePaneIndex].querySelector('#stage');
        const previousTitle = panes[activePaneIndex].querySelector('#title');
        previousInput.classList.add('hidden'); // Sembunyikan input dari pane sebelumnya
        previousStage.classList.remove('left-0', 'ml-3'); // Sembunyikan input dari pane sebelumnya
        previousTitle.classList.add('hidden'); // Sembunyikan input dari pane sebelumnya
        previousTitle.classList.remove('flex');

        // Hapus class 'active' dari pane sebelumnya
        panes[activePaneIndex].classList.remove('active');

        // Set pane yang diklik sebagai pane aktif yang baru
        activePaneIndex = index;

        // Tampilkan input dari pane yang baru diklik
        const currentInput = pane.querySelector('textarea');
        const currentStage = pane.querySelector('#stage');
        const currentTitle = pane.querySelector('#title');
        currentInput.classList.remove('hidden'); // Tampilkan input dari pane yang diklik
        currentStage.classList.add('left-0', 'ml-3'); // Tampilkan input dari pane yang diklik
        currentTitle.classList.remove('hidden'); // Tampilkan input dari pane yang diklik
        currentTitle.classList.add('flex');

        // Tambahkan class 'active' ke pane yang baru diklik
        pane.classList.add('active');
      });
    });
  </script>
</x-app-layout>
<script src="{{ asset('js/charts-lines.js') }}" defer></script>
<script src="{{ asset('js/charts-pie.js') }}" defer></script>
<script src="{{ asset('js/charts-bars.js') }}" defer></script>
<script>
  window.chartData = {
    tepatWaktu: {{ $tepatWaktu }},
    tidakTepatWaktu: {{ $tidakTepatWaktu }}
  };

  var categoryPercentages = @json(array_values($categoryPercentages));
</script>
