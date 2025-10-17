<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Skandakra - Guru')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

    @include('guru.kepalasekolah.layout.sidebar')

    <main class="flex-1 sm:ml-[17rem] p-6">
        <div class="flex sm:relative z-30 justify-between items-center bg-gradient-to-br from-blue-500 to-blue-700 text-white px-6 py-4 rounded-lg shadow mb-6">
            <div class="flex items-center space-x-4">
                <!-- Tombol Hamburger -->
                <button id="toggleSidebar" class="sm:hidden p-2 text-white rounded-lg hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h3 class="text-md sm:text-2xl text-white font-semibold">@yield('page-title', 'Dashboard')</h3>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Profile Dropdown -->
                <div class="relative">
                    <button onclick="toggleDropdown()" class="p-1 rounded-full hover:ring-2 hover:ring-blue-500 transition">
                        <img src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png" alt="Foto Guru" class="h-10 w-10 rounded-full object-cover border-2 border-white shadow" />
                    </button>

                    <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white text-gray-700 rounded-xl shadow-lg hidden z-50">
                        <div class="flex flex-col items-center py-4 px-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png" alt="Foto Guru" class="h-10 w-10 rounded-full object-cover border-2 border-white shadow" />
                            <p class="mt-2 font-semibold text-green-600">Guru Kurikulum</p>
                        </div>
                        <hr class="border-gray-200">
                        <a href="#" class="block px-4 py-2 hover:bg-blue-50 text-center">Edit Profil</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-blue-50 text-center text-red-500">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex">
            @yield('content')
        </div>
    </main>

    <!-- SCRIPT -->
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        // Sidebar Toggle
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Profile Dropdown
        function toggleDropdown() {
            document.getElementById('dropdown-menu').classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        window.addEventListener("click", function (e) {
            const dropdownMenu = document.getElementById("dropdown-menu");
            const profileButton = document.querySelector("button[onclick='toggleDropdown()']");

            if (profileButton && !profileButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add("hidden");
            }

            // Close sidebar on mobile
            if (window.innerWidth < 640 && !sidebar.contains(e.target) && !toggleBtn.contains(e.target) && !sidebar.classList.contains("-translate-x-full")) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
