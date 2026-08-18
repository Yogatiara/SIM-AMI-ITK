<x-auth-layout>
  {{--
  <div class="flex min-h-screen items-center bg-blue-700 p-6">
    <div class="mx-auto h-1/3 max-w-4xl flex-1 overflow-hidden rounded-3xl bg-white shadow-xl">
      <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="hidden w-1/2 md:block">
          <img aria-hidden="true" class="h-full w-full object-cover" src="{{ asset('images/role.JPG') }}" alt="Office" />
        </div>
        <div class="flex w-full flex-col items-center justify-center p-8 md:w-1/2">
          <img src="{{ asset('images/Logo ITK with Text.png') }}" alt="Logo ITK" class="mx-auto h-24">
          <h1 class="mt-5 text-center text-[16px] font-semibold text-gray-700">
            Sistem Informasi Manajemen Audit Mutu Internal
          </h1>
          <h2 class="mb-5 text-center text-[16px] font-semibold text-gray-700">
            Institut Teknologi Kalimantan
          </h2>

          <form action="/roles" method="POST" class="flex w-full flex-col gap-y-2">
            @csrf
            <label for="role" class="text-sm">Choose Role</label>
            <!-- Select -->
            <select name="role" id="role"
              data-hs-select='{
                                "placeholder": "Choose Role...",
                                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                "dropdownClasses": "mt-2 z-50 w-full max-h-32 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                     }'
              class="hidden">

              @foreach ($roles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
              @endforeach
            </select>
            <!-- End Select -->

            <button
              class="mt-5 block w-full rounded-lg border border-transparent bg-blue-700 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-800 focus:outline-none focus:shadow-outline-indigo"
              type="submit">
              Login
            </button>
          </form>

          <hr class="my-5 w-full border-gray-300" />
        </div>
      </div>
    </div>
  </div> --}}

  <div class="relative min-h-screen bg-gray-100 text-gray-900 flex justify-center">

    <div class=" max-w-screen-xl  m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
      <div class="flex-1 hidden lg:flex">
        <div class=" w-full bg-cover bg-center sm:rounded-l-lg" style="background-image: url('/images/role.jpg');">
        </div>
      </div>
      <div class=" lg:w-1/2 xl:w-5/12 p-6 sm:p-12 my-auto">

        <div>
          <img src="{{ asset('images/Logo-ITK-with-Text.webp') }}" class="w-56 mx-auto" />
        </div>
        <div class="flex flex-col items-center">

          <div class="mb-8 mt-4 text-center">
            <div
              class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2">
              Silakan pilih hak akses sesuai dengan tugas dan tanggung jawab Anda dalam pelaksanaan Audit Mutu Internal.
            </div>
          </div>
          @if (session()->has('message'))
            <span
              class="bg-red-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-lg dark:bg-gray-700 dark:text-red-400 border border-red-400 my-2 ">
              <svg class="w-[15px] h-[15px] mr-1 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                  d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                  clip-rule="evenodd" />
              </svg>{{ session('message') }}
            </span>
          @endif

          @if (session()->has('error'))
            <span
              class="bg-red-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-lg dark:bg-gray-700 dark:text-red-400 border border-red-400 my-2 ">
              <svg class="w-[15px] h-[15px] mr-1 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                  d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                  clip-rule="evenodd" />
              </svg>{{ session('error') }}
            </span>
          @endif

          @if (session()->has('warning'))
            <<span
              class="bg-yellow-100 text-yellow-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-lg dark:bg-gray-700 dark:text-yellow-400 border border-yellow-400 my-2 ">
              <svg class="w-[15px] h-[15px] mr-1 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                  d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                  clip-rule="evenodd" />
              </svg> {{ session('warning') }}
              </span>
          @endif
          <div class="mx-auto max-w-xs">
            <form action="/roles" method="POST" class="flex w-full flex-col gap-y-2">
              @csrf


              <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Peran
                Untuk Sistem</label>
              <select i id="role" name="role" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Pilih Peran</option>
                @foreach ($roles as $role)
                  <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
              </select>
              @error('role')
                <span
                  class="bg-red-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-lg dark:bg-gray-700 dark:text-red-400 border border-red-400 mt-2 ">
                  <svg class="w-[15px] h-[15px] mr-1 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                      d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                      clip-rule="evenodd" />
                  </svg> {{ $message }}
                </span>
              @enderror
              <button
                class="mt-2  tracking-wide font-semibold bg-primary text-white-500 w-full py-4 rounded-lg hover:bg-primaryDark transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none text-white"
                type="submit">
                Selanjutnya <span><svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 12H5m14 0-4 4m4-4-4-4" />
                  </svg>
                </span>
              </button>
            </form>


          </div>
        </div>
      </div>

    </div>
  </div>

</x-auth-layout>
