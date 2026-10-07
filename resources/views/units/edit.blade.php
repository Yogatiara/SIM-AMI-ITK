<x-app-layout>
  <div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
      <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
          Edit Unit
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Ubah informasi unit kerja
        </p>
      </div>
      <a href="{{ route('units.index') }}"
        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
      </a>
    </div>

    <!-- Form -->
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
      <form action="{{ route('units.update', $unit) }}" method="POST" class="mx-auto max-w-xl">
        @csrf
        @method('PUT')

        <div class="mb-6">
          <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Unit</label>
          <input type="text" name="name" value="{{ old('name', $unit->name) }}" required
            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
            placeholder="Masukkan nama unit">
          @error('name')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Kode</label>
          <input type="text" name="code" id="code" value="{{ old('code', $unit->code) }}" required
            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
            placeholder="Masukkan kode/singkatan unit">
          @error('code')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6" id="faculty" style="display: none;">
          <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Fakultas</label>
          <select name="faculty" id="faculty"
            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
            <option value="" disabled selected>Pilih Fakultas</option>
            @foreach ($faculties as $faculty)
              <option value="{{ $faculty->id }}"
                {{ old('faculty', $unit->faculty_id) == $faculty->id ? 'selected' : '' }}>
                {{ $faculty->name }}
              </option>
            @endforeach
          </select>
          @error('faculty')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <div class="flex justify-end gap-3">
          <a href="{{ route('units.index') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            Batal
          </a>
          <button type="submit"
            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const codeInput = document.getElementById('code');
      const facultyDiv = document.getElementById('faculty');

      function checkFacultyVisibility() {
        if (codeInput.value && codeInput.value.charAt(0).match(/\d/)) {
          facultyDiv.style.display = 'block';
        } else {
          facultyDiv.style.display = 'none';
        }
      }

      checkFacultyVisibility();

      codeInput.addEventListener('input', function() {
        checkFacultyVisibility();
      });
    });
  </script>
</x-app-layout>
