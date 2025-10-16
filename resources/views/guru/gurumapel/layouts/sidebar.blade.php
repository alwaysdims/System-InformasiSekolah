<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden sm:hidden z-40"></div>

<aside id="sidebar" 
    class="w-64 bg-gradient-to-br from-blue-500 to-blue-800 text-white p-5 flex flex-col shadow-2xl
    sm:rounded-2xl fixed inset-y-0 sm:inset-y-auto sm:top-4 sm:left-4 h-full sm:h-[95%]
    transform -translate-x-full sm:translate-x-0 transition-transform duration-300 ease z-40">

    <div class="flex items-center gap-5 mb-10">
        <img src="{{ asset('assets/image/logo-smkn2kra.webp') }}" alt="Logo" class="w-16 h-16 mx-auto rounded mb-2" />
        <h1 class="text-sm font-bold leading-tight">
            SYSTEM INFORMASI SKANDAKRA
        </h1>
    </div>

    <nav class="space-y-2">
        <a href="{{ route('waka.kurikulum.dashboard') }}"
           class="flex items-center gap-2 p-3 rounded-lg transition
                  {{ request()->routeIs('waka.kurikulum.dashboard') 
                      ? 'bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400' 
                      : 'hover:bg-blue-700 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4 0v-8m-4 0h4" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('kurikulum.kalenderPendidikan.index') }}"
           class="flex items-center gap-2 p-3 rounded-lg transition
                  {{ request()->routeIs('kurikulum.kalenderPendidikan.*') 
                      ? 'bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400' 
                      : 'hover:bg-blue-700 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M8 7V3m8 4V3m-4 8h.01M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Kalender Pendidikan
        </a>

        <a href="{{ route('kurikulum.pembagianTugasGuru.index') }}"
           class="flex items-center gap-2 p-3 rounded-lg transition
                  {{ request()->routeIs('kurikulum.pembagianTugasGuru.*') 
                      ? 'bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400' 
                      : 'hover:bg-blue-700 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M17 20h-5v-1a1 1 0 00-1-1H9a1 1 0 00-1 1v1H3M17 12V6a2 2 0 00-2-2H9a2 2 0 00-2 2v6m10 0a3 3 0 11-6 0m6 0h-6" />
            </svg>
            Pembagian Tugas Guru
        </a>

        <a href="{{ route('kurikulum.pembagianTugasSiswa.index') }}"
           class="flex items-center gap-2 p-3 rounded-lg transition
                  {{ request()->routeIs('kurikulum.pembagianTugasSiswa.*') 
                      ? 'bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400' 
                      : 'hover:bg-blue-700 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zm-2 9v7a1 1 0 01-1 1H5a1 1 0 01-1-1v-7a3 3 0 003-3h3a3 3 0 003 3z" />
            </svg>
            Pembagian Tugas Siswa
        </a>
    </nav>
</aside>