<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden sm:hidden z-40"></div>

<aside id="sidebar" class="w-64 bg-gradient-to-br from-blue-500 to-blue-800 text-white p-5 flex flex-col shadow-2xl
sm:rounded-2xl fixed inset-y-0 sm:inset-y-auto sm:top-4 sm:left-4 h-full sm:h-[95%]
transform -translate-x-full sm:translate-x-0 transition-transform duration-300 ease z-40">

    <div class="flex items-center gap-5 mb-10">
        <img src="{{ asset('assets/image/logo-smkn2kra.webp') }}" alt="Logo" class="w-16 h-16 mx-auto rounded mb-2" />
        <h1 class="text-sm font-bold leading-tight">SKANDAKRA</h1>
    </div>

    <nav class="space-y-2 flex-1">
        <a href="{{ route('kepala.dashboard') }}"
            class="flex items-center gap-2 p-3 rounded-lg transition
            @if(request()->routeIs('kepala.dashboard'))
                bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400
            @else
                hover:bg-blue-700 hover:text-white
            @endif">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4 0v-8m-4 0h4" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('kepala.laporan_siswa') }}"
            class="flex items-center gap-2 p-3 rounded-lg transition
            @if(request()->routeIs('kepala.laporan_siswa'))
                bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400
            @else
                hover:bg-blue-700 hover:text-white
            @endif">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Laporan Siswa
        </a>

        <a href="{{ route('kepala.laporan_guru') }}"
            class="flex items-center gap-2 p-3 rounded-lg transition
            @if(request()->routeIs('kepala.laporan_guru'))
                bg-white text-blue-700 font-semibold shadow ring-2 ring-blue-400
            @else
                hover:bg-blue-700 hover:text-white
            @endif">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.656-.126-1.283-.356-1.857M9 20H4v-2a3 3 0 015-2.236M9 20a4.486 4.486 0 00.842-.047m0 0a1.987 1.987 0 00-.842-.047M9 20v-2a3 3 0 013-3m0 0a3.003 3.003 0 01.842-.047M12 20a4.486 4.486 0 00.842-.047M12 14c2.21 0 4-1.343 4-3S14.21 8 12 8s-4 1.343-4 3 1.79 3 4 3z" />
            </svg>
            Laporan Guru
        </a>
    </nav>
</aside>