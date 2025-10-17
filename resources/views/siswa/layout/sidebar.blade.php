<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden sm:hidden z-40"></div>

<!-- Sidebar -->
<aside id="sidebar" class="w-64 bg-gradient-to-br from-blue-500 to-blue-800 text-white p-5 flex flex-col shadow-2xl sm:rounded-2xl fixed inset-y-0 sm:inset-y-auto sm:top-4 sm:left-4 h-full sm:h-[95%] transform -translate-x-full sm:translate-x-0 transition-transform duration-300 ease z-40">
    <!-- Logo -->
    <div class="flex items-center gap-5 mb-10">
        <img src="{{ asset('assets/image/logo-smkn2kra.webp') }}" alt="Logo" class="w-16 h-16 mx-auto rounded mb-2" />
        <h1 class="text-sm font-bold leading-tight">SKANDAKRA</h1>
    </div>

    <!-- Navigasi -->
    <nav class="space-y-2 flex-1">
        <!-- 1. Dashboard -->
        <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-2 {{ Route::is('siswa.dashboard') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }} p-3 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4 0v-8m-4 0h4" />
            </svg>
            Dashboard
        </a>

        <!-- 2. Jadwal Kelas -->
        <a href="{{ route('siswa.jadwal-kelas.index') }}" class="flex items-center gap-2 {{ Route::is('siswa.jadwal-kelas.*') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }} p-3 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Jadwal Kelas
        </a>

        <!-- 3. Tugas/Ujian -->
        <a href="{{ route('siswa.tugas.index') }}" class="flex items-center gap-2 {{ Route::is('siswa.tugas.*') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }} p-3 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Tugas/Ujian
        </a>

        <!-- 4. Pengaduan -->
        <a href="{{ route('siswa.pengaduan.index') }}" class="flex items-center gap-2 {{ Route::is('siswa.pengaduan.*') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }} p-3 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
            </svg>
            Pengaduan
        </a>

        <!-- 5. Ruang Diskusi -->
        <a href="{{ route('siswa.ruang-diskusi.index') }}" class="flex items-center gap-2 {{ Route::is('siswa.ruang-diskusi.*') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }} p-3 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            Ruang Diskusi
        </a>
    </nav>
</aside>
