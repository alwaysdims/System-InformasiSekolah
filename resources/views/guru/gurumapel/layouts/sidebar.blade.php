<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden sm:hidden z-40"></div>

<!-- Sidebar -->
<aside id="sidebar" class="w-64 bg-gradient-to-br from-blue-500 to-blue-800 text-white p-5 flex flex-col shadow-2xl sm:rounded-2xl fixed inset-y-0 sm:inset-y-auto sm:top-4 sm:left-4 h-full sm:h-[95%] transform -translate-x-full sm:translate-x-0 transition-transform duration-300 ease z-40">
    <!-- Logo -->
    <div class="flex items-center gap-5 mb-10">
        <img src="../assets/image/logo-smkn2kra.webp" alt="Logo" class="w-16 h-16 mx-auto rounded mb-2" />
        <h1 class="text-sm font-bold leading-tight">
            SYSTEM INFORMASI SKANDAKRA
        </h1>
    </div>

    <!-- Navigasi -->
    <nav class="space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('guru.dashboard') }}"
           class="flex items-center gap-2 p-3 rounded-lg transition {{ Route::is('guru.dashboard') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4 0v-8m-4 0h4" />
            </svg>
            Dashboard
        </a>

        <!-- Forum Diskusi -->
        <a href="#"
           class="flex items-center gap-2 p-3 rounded-lg transition {{ Route::is('guru.forum-diskusi') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c4.418 0 8-1.79 8-4V5a2 2 0 00-2-2h-2.586a1 1 0 01-.707-.293l-1.414-1.414A2 2 0 0011.586 1H8a2 2 0 00-2 2v1" />
                <circle cx="12" cy="10" r="3" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18v-1a4 4 0 014-4h0a4 4 0 014 4v1" />
            </svg>
            Forum Diskusi
        </a>

        <!-- Menu Belajar (Dropdown) -->
        <div>
            <button id="belajarToggle"
                    class="w-full flex items-center justify-between p-3 rounded-lg transition ">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20H6a2 2 0 01-2-2V6a2 2 0 012-2h6m0 0h6a2 2 0 012 2v12a2 2 0 01-2 2h-6m0-16v16" />
                    </svg>
                    Menu Belajar
                </span>
                <svg id="belajarIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform {{ Route::is('guru.materi.*') || Route::is('guru.tugas.*') ? 'rotate-180' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Submenu -->
            <div id="belajarMenu" class="ml-6 mt-2 flex flex-col gap-2 {{ Route::is('guru.materi.*') || Route::is('guru.tugas.*') ? '' : 'hidden' }}">
                <a href="{{ route('guru.materi.index') }}"
                   class="flex items-center gap-2 p-2 rounded-lg transition {{ Route::is('guru.materi.*') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }}">
                    📘 Materi Pelajaran
                </a>
                <a href="{{ route('guru.tugas.index') }}"
                   class="flex items-center gap-2 p-2 rounded-lg transition {{ Route::is('guru.tugas.*') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }}">
                    📝 Tugas Ujian
                </a>
            </div>
        </div>

        <!-- Layanan Aduan (Dropdown) -->
        <div>
            <button id="aduanToggle"
                    class="w-full flex items-center justify-between p-3 rounded-lg transition">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c4.418 0 8-1.79 8-4V5a2 2 0 00-2-2h-2.586a1 1 0 01-.707-.293l-1.414-1.414A2 2 0 0011.586 1H8a2 2 0 00-2 2v1" />
                    </svg>
                    Layanan Aduan
                </span>
                <svg id="aduanIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform {{ Route::is('guru.pengaduan')}}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Submenu -->
            <div id="aduanMenu" class="ml-6 mt-2 flex flex-col gap-2 {{ Route::is('guru.pengaduan')}}">
                <a href="{{ route('guru.pengaduan') }}"
                   class="flex items-center gap-2 p-2 rounded-lg transition {{ Route::is('guru.pengaduan') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }}">
                    📢 Pengaduan
                </a>
                <a href="#}"
                   class="flex items-center gap-2 p-2 rounded-lg transition {{ Route::is('guru.riwayat-tanggapan') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }}">
                    📜 Riwayat Tanggapan
                </a>
            </div>
        </div>

        <!-- Jadwal -->
        <a href="{{ route('guru.jadwal-pelajaran.index') }}"
           class="flex items-center gap-2 p-3 rounded-lg transition {{ Route::is('guru.jadwal') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Jadwal
        </a>

        <!-- Nilai -->
        <a href="#"
           class="flex items-center gap-2 p-3 rounded-lg transition {{ Route::is('guru.nilai') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m4 0v-8a2 2 0 00-2-2h-2m-4 0H7a2 2 0 00-2 2v8" />
            </svg>
            Nilai
        </a>

        <!-- Absensi -->
        <a href="#"
           class="flex items-center gap-2 p-3 rounded-lg transition {{ Route::is('guru.absensi') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-700 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9.969 9.969 0 0112 15c2.21 0 4.236.72 5.879 1.929M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l2 2 4-4" />
            </svg>
            Absensi Siswa
        </a>
    </nav>
</aside>

<!-- JavaScript untuk Toggle Sidebar dan Submenu -->
<script>
    // Toggle Sidebar untuk Mobile
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const toggleButton = document.getElementById('toggleSidebar'); // Asumsi ada tombol untuk toggle sidebar di mobile

    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    if (toggleButton) {
        toggleButton.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    }

    // Toggle Submenu Menu Belajar
    const belajarToggle = document.getElementById('belajarToggle');
    const belajarMenu = document.getElementById('belajarMenu');
    const belajarIcon = document.getElementById('belajarIcon');

    belajarToggle.addEventListener('click', () => {
        belajarMenu.classList.toggle('hidden');
        belajarIcon.classList.toggle('rotate-180');
    });

    // Toggle Submenu Layanan Aduan
    const aduanToggle = document.getElementById('aduanToggle');
    const aduanMenu = document.getElementById('aduanMenu');
    const aduanIcon = document.getElementById('aduanIcon');

    aduanToggle.addEventListener('click', () => {
        aduanMenu.classList.toggle('hidden');
        aduanIcon.classList.toggle('rotate-180');
    });
</script>