 <div class="relative min-h-screen bg-gray-100 text-gray-900 flex justify-center">

   <div class=" max-w-screen-xl  m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">

     <div class=" lg:w-1/2 xl:w-5/12 p-6 sm:p-12 my-auto">

       <div>
         <img src="{{ asset('images/Logo-ITK-with-Text.webp') }}" class="w-56 mx-auto" />
       </div>
       <div class="flex flex-col items-center">

         <div class="mb-8 mt-4 text-center">
           <div
             class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2">
             Sistem Informasi Manajemen Audit Mutu Internal
             Institut Teknologi Kalimantan </div>
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
           <form wire:submit="login">
             <input
               class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white {{ $errors->has('email') ? 'border-red-500' : '' }}"
               type="email" placeholder="Email" wire:model="email" />
             @error('email')
               <span
                 class="bg-red-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-lg dark:bg-gray-700 dark:text-red-400 border border-red-400 mt-2 ">
                 <svg class="w-[15px] h-[15px] mr-1 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                   width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                   <path fill-rule="evenodd"
                     d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                     clip-rule="evenodd" />
                 </svg> {{ $message }}
               </span>
             @enderror
             <input
               class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5 {{ $errors->has('password') ? 'border-red-500' : '' }}"
               type="password" placeholder="Password" wire:model="password" />

             @error('password')
               <span
                 class="bg-red-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-lg dark:bg-gray-700 dark:text-red-400 border border-red-400 mt-2 ">
                 <svg class="w-[15px] h-[15px] mr-1 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                   width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                   <path fill-rule="evenodd"
                     d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                     clip-rule="evenodd" />
                 </svg> {{ $message }}
               </span>
             @enderror

             <button
               class="mt-5 tracking-wide font-semibold bg-primary text-white-500 w-full py-4 rounded-lg hover:bg-primaryDark transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none text-white"
               wire:loading.attr="disabled" wire:target="login">


               <span wire:loading.remove wire:target="login">
                 Masuk
               </span>

               <span wire:loading.flex wire:target="login"
                 class="inline-flex flex-row items-center justify-center whitespace-nowrap">
                 <svg class="mr-2 h-5 w-5 shrink-0 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                   viewBox="0 0 24 24">
                   <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                     stroke-width="4" />

                   <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                 </svg>

                 <span>Memproses...</span>


               </span>
             </button>
           </form>


           <a class="flex  mt-2 justify-end text-sm  text-blue-700 hover:underline" href="/forgot-password">
             Lupa Password?
           </a>

         </div>
       </div>
     </div>
     <div class="flex-1 hidden lg:flex">
       <div class=" w-full bg-cover bg-center sm:rounded-r-lg" style="background-image: url('/images/login.jpg');">
       </div>
     </div>
   </div>
 </div>
