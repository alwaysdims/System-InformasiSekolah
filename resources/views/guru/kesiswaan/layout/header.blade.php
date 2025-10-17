<!-- Main Content -->
<main class="main-content p-4 lg:p-6">
    <div
        class="flex justify-between items-center bg-gradient-to-br from-[var(--primary-blue)] to-[var(--secondary-blue)] text-white px-6 py-4 rounded-lg shadow-lg mb-6">
        <div class="flex items-center space-x-4">
            <button id="toggleSidebar" class="sm:hidden p-2 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-bars h-6 w-6"></i>
            </button>
            <h3 class="text-lg sm:text-2xl font-semibold">{{ $title }}</h3>
        </div>
        <div class="flex items-center space-x-4">
            <button id="openNotificationModal" class="relative inline-flex items-center p-2">
                <i class="fas fa-bell h-6 w-6"></i>
                <span
                    class="absolute -top-1 -right-1 w-5 h-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full flex items-center justify-center">2</span>
            </button>
            <div class="relative z-30">
                <button onclick="toggleDropdown('profileDropdown')"
                    class="p-1 rounded-full hover:ring-2 hover:ring-blue-500">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                        class="h-10 w-10 rounded-full border-2 border-white">
                </button>
                <div id="profileDropdown"
                    class="hidden absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-lg z-50 border border-gray-200">
                    <div class="flex flex-col items-center py-4 px-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                            class="h-12 w-12 rounded-full mb-2">
                        <p class="font-semibold text-gray-800">Nama Siswa</p>
                        <p class="text-sm text-gray-500">XII IPA 1</p>
                    </div>
                    <hr>
                    <a href="profile.html" class="block px-4 py-2 hover:bg-blue-50 text-gray-600">Profil</a>
                    <a href="pengaturan_akun.html" class="block px-4 py-2 hover:bg-blue-50 text-gray-600">Pengaturan</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="block px-4 py-2 w-full text-left hover:bg-red-50 text-red-500">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
