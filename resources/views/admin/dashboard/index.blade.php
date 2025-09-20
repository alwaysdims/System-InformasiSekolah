<h2 class="text-lg font-semibold text-gray-700 mb-6">Selamat datang admin!</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Card Admin -->
    <div class="flex items-center p-4 bg-white rounded-2xl shadow-md ring-1 ring-gray-100 hover:shadow-lg transition">
        <div class="flex-shrink-0 p-3 rounded-lg bg-gradient-to-br from-red-50 to-red-100">
            <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.29.48 6.121 1.339M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <div class="ml-4 flex-1">
            <p class="text-sm text-gray-500">Jumlah Admin</p>
            <p class="mt-1 text-2xl font-bold text-gray-800">{{ $admin }}</p>
            <p class="text-xs text-gray-400 mt-1">Pengelola sistem</p>
        </div>
    </div>

    <!-- Card Guru -->
    <div class="flex items-center p-4 bg-white rounded-2xl shadow-md ring-1 ring-gray-100 hover:shadow-lg transition">
        <div class="flex-shrink-0 p-3 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100">
            <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 20a8 8 0 0116 0" />
            </svg>
        </div>
        <div class="ml-4 flex-1">
            <p class="text-sm text-gray-500">Jumlah Guru</p>
            <p class="mt-1 text-2xl font-bold text-gray-800">{{ $guru }}</p>
            <p class="text-xs text-gray-400 mt-1">Guru aktif mengajar</p>
        </div>
    </div>

    <!-- Card Siswa -->
    <div class="flex items-center p-4 bg-white rounded-2xl shadow-md ring-1 ring-gray-100 hover:shadow-lg transition">
        <div class="flex-shrink-0 p-3 rounded-lg bg-gradient-to-br from-green-50 to-green-100">
            <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M12 14l6.16-3.422A12.083 12.083 0 0118 20.5H6a12.083 12.083 0 00-.16-9.922L12 14z" />
            </svg>
        </div>
        <div class="ml-4 flex-1">
            <p class="text-sm text-gray-500">Jumlah Siswa</p>
            <p class="mt-1 text-2xl font-bold text-gray-800">{{ $siswa }}</p>
            <p class="text-xs text-gray-400 mt-1">Siswa terdaftar</p>
        </div>
    </div>

    <!-- Card Wali -->
    <div class="flex items-center p-4 bg-white rounded-2xl shadow-md ring-1 ring-gray-100 hover:shadow-lg transition">
        <div class="flex-shrink-0 p-3 rounded-lg bg-gradient-to-br from-yellow-50 to-yellow-100">
            <svg class="w-8 h-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 7v10a2 2 0 002 2h4l3 3 3-3h4a2 2 0 002-2V7L12 3 3 7z" />
            </svg>
        </div>
        <div class="ml-4 flex-1">
            <p class="text-sm text-gray-500">Jumlah Wali</p>
            <p class="mt-1 text-2xl font-bold text-gray-800">{{ $wali }}</p>
            <p class="text-xs text-gray-400 mt-1">Wali murid</p>
        </div>
    </div>
</div>
