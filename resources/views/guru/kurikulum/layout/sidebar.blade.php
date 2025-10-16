
<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden sm:hidden z-40"></div>

<!-- Sidebar -->
<aside id="sidebar" 
    class="w-64 bg-gradient-to-br from-blue-500 to-blue-800 text-white p-5 flex flex-col shadow-2xl
    sm:rounded-2xl fixed inset-y-0 sm:inset-y-auto sm:top-4 sm:left-4 h-full sm:h-[95%]
    transform -translate-x-full sm:translate-x-0 transition-transform duration-300 ease z-40">

    <!-- Logo -->
    <div class="flex items-center gap-5 mb-10">
        <img src="{{ asset('assets/image/logo-smkn2kra.webp') }}" alt="Logo" 
             class="w-16 h-16 mx-auto rounded mb-2" />
        <h1 class="text-sm font-bold leading-tight">
            SYSTEM INFORMASI SKANDAKRA
        </h1>
    </div>

    <!-- Navigasi -->
    <nav class="space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('waka.kurikulum.dashboard') }}"
            class="flex items-center gap-2 bg-white text-blue-700 font-semibold p-3 rounded-lg shadow ring-2 ring-blue-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4 0v-8m-4 0h4" />
            </svg>
            Dashboard
        </a>

        <!-- Kalender Pendidikan -->
        <a href="{{ route('kurikulum.kalenderPendidikan.index') }}"
            class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-3 rounded-lg transition">
            📅 Kalender Pendidikan
        </a>

        <!-- Pembagian Tugas Guru -->
        <a href="{{ route('kurikulum.pembagianTugasGuru.index') }}"
            class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-3 rounded-lg transition">
            👨‍🏫 Pembagian Tugas Guru
        </a>

        <!-- Pembagian Tugas Siswa -->
        <a href="{{ route('kurikulum.pembagianTugasSiswa.index') }}"
            class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-3 rounded-lg transition">
            👩‍🎓 Pembagian Tugas Siswa
        </a>
    </nav>
</aside>