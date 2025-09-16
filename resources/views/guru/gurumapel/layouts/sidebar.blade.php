    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden sm:hidden z-40"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-gradient-to-br from-blue-500 to-blue-800 text-white p-5 flex flex-col shadow-2xl
    sm:rounded-2xl fixed inset-y-0 sm:inset-y-auto sm:top-4 sm:left-4 h-full sm:h-[95%]
    transform -translate-x-full sm:translate-x-0 transition-transform duration-300 ease z-40">

        <!-- Logo -->
        <div class="flex items-center gap-5 mb-10">
            <img src="{{ asset('assets/image/logo-smkn2kra.webp') }}" alt="Logo" class="w-16 h-16 mx-auto rounded mb-2" />
            <h1 class="text-sm font-bold leading-tight">
                SYSTEM INFORMASI SKANDAKRA
            </h1>
        </div>

        <!-- Navigasi -->
        <nav class="space-y-2">
            <!-- Dashboard -->
            <a href="index.html"
                class="flex items-center gap-2 bg-white text-blue-700 font-semibold p-3 rounded-lg shadow ring-2 ring-blue-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4 0v-8m-4 0h4" />
                </svg>
                Dashboard
            </a>

            <!-- Forum Diskusi -->
            <a href="forum-diskusi.html"
                class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-3 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14c4.418 0 8-1.79 8-4V5a2 2 0 00-2-2h-2.586a1 1 0 01-.707-.293l-1.414-1.414A2 2 0 0011.586 1H8a2 2 0 00-2 2v1" />
                    <circle cx="12" cy="10" r="3" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18v-1a4 4 0 014-4h0a4 4 0 014 4v1" />
                </svg>
                Forum Diskusi
            </a>

            <!-- Menu Belajar (Dropdown) -->
            <div>
                <button id="belajarToggle"
                    class="w-full flex items-center justify-between hover:bg-blue-700 hover:text-white p-3 rounded-lg transition">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 20H6a2 2 0 01-2-2V6a2 2 0 012-2h6m0 0h6a2 2 0 012 2v12a2 2 0 01-2 2h-6m0-16v16" />
                        </svg>
                        Menu Belajar
                    </span>
                    <svg id="belajarIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Submenu -->
                <div id="belajarMenu" class="hidden ml-6 mt-2 flex flex-col gap-2">
                    <a href="materi_pelajaran.html"
                        class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-2 rounded-lg transition">
                        📘 Materi Pelajaran
                    </a>
                    <a href="tugas-ujian.html"
                        class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-2 rounded-lg transition">
                        📝 Tugas Ujian
                    </a>
                </div>
            </div>

            <!-- Layanan Aduan (Dropdown) -->
            <div>
                <button id="aduanToggle"
                    class="w-full flex items-center justify-between hover:bg-blue-700 hover:text-white p-3 rounded-lg transition">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14c4.418 0 8-1.79 8-4V5a2 2 0 00-2-2h-2.586a1 1 0 01-.707-.293l-1.414-1.414A2 2 0 0011.586 1H8a2 2 0 00-2 2v1" />
                        </svg>
                        Layanan Aduan
                    </span>
                    <svg id="aduanIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Submenu -->
                <div id="aduanMenu" class="hidden ml-6 mt-2 flex flex-col gap-2">
                    <a href="pengaduan.html"
                        class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-2 rounded-lg transition">
                        📢 Pengaduan
                    </a>
                    <a href="riwayat-tanggapan.html"
                        class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-2 rounded-lg transition">
                        📜 Riwayat Tanggapan
                    </a>
                </div>
            </div>

            <!-- Jadwal -->
            <a href="jadwal.html"
                class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-3 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Jadwal
            </a>

            <!-- Nilai -->
            <a href="nilai.html"
                class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-3 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m4 0v-8a2 2 0 00-2-2h-2m-4 0H7a2 2 0 00-2 2v8" />
                </svg>
                Nilai
            </a>
            <a href="absensi.html"
                class="flex items-center gap-2 hover:bg-blue-700 hover:text-white p-3 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <!-- Icon User -->
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A9.969 9.969 0 0112 15c2.21 0 4.236.72 5.879 1.929M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    <!-- Icon Check -->
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l2 2 4-4" />
                </svg>
                Absensi Siswa
            </a>

        </nav>
    </aside>
