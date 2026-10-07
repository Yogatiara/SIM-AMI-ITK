<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $title ?? config('app.name') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link rel="icon" href="{{ asset('logo/sim-ami.webp') }}">
</head>

<body>
  <div class="flex min-h-screen items-center p-6"
    style="background-image: url('/images/edit-contact.JPG'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="bg-tranparent mx-auto h-1/3 max-w-7xl flex-1 overflow-hidden rounded-3xl px-16 text-white">
      <div class="flex flex-col justify-center overflow-y-auto md:flex-row">
        <div class="rounded-2xl bg-white p-8 shadow-xl ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
          <!-- Logo -->
          <div class="mb-6 text-center">
            <img src="{{ asset('logo/sim-ami.webp') }}" alt="Logo ITK" class="mx-auto h-20">
            <h1 class="mt-4 text-lg  font-semibold text-gray-900 dark:text-white">
              Sistem Automasi Tertata dan Realisasi Integritas Audit Mutu Internal
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
              Institut Teknologi Kalimantan
            </p>
          </div>

          <!-- Form -->
          <form action="{{ route('contacts.update', ['id' => $user->id]) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
              <label for="contact" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                Nomor WhatsApp
              </label>
              <input type="tel" id="contact" name="contact" value="{{ old('contact', $user->contact) }}" required
                class="w-full rounded-lg border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                placeholder="Masukkan nomor WhatsApp">
              @error('contact')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <button type="submit"
              class="w-full rounded-lg bg-blue-600 px-4 py-3 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus:ring-offset-gray-900">
              Simpan Kontak
            </button>
          </form>

          <!-- Info -->
          <div class="mt-6 rounded-lg bg-blue-50 p-4 dark:bg-blue-900/20">
            <p class="text-xs text-blue-700 dark:text-blue-400">
              <span class="font-semibold">Catatan:</span> Nomor WhatsApp diperlukan untuk komunikasi dan notifikasi
              sistem.
            </p>
          </div>
        </div>
      </div>
    </div>
</body>

</html>
