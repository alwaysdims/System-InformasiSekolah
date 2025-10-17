<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    @include('guru.gurumapel.layouts.sidebar')

    <main class="flex-1 sm:ml-[17rem] p-6">
        <div class="flex sm:relative z-30 justify-between items-center bg-gradient-to-br from-blue-500 to-blue-700 text-white px-6 py-4 rounded-lg shadow mb-6">
            <div class="flex items-center space-x-4">
                <button id="toggleSidebar" class="sm:hidden p-2 text-white rounded-lg hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="items-center">
                    <h3 class="text-md sm:text-2xl text-white font-semibold">@yield('title')</h3>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Dropdown Notifikasi -->
                <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="relative inline-flex items-center text-sm font-medium text-center text-gray-100 hover:text-gray-100 focus:outline-none light:hover:text-white light:text-gray-400" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <div class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 light:border-gray-900"></div>
                </button>

                <div id="dropdownNotification" class="z-50 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow-xl light:bg-gray-800 light:divide-gray-700" aria-labelledby="dropdownNotificationButton">
                    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 light:bg-gray-800 light:text-white">
                        Notifikasi
                    </div>
                    <div class="divide-y divide-gray-100 light:divide-gray-700">
                        <a href="detail-riwayat-pending.html" class="flex px-4 py-3 hover:bg-gray-100 light:hover:bg-gray-700">
                            <div class="shrink-0 relative">
                                <img class="rounded-full object-cover w-11 h-11" src="https://mm.feb.uncen.ac.id/wp-content/uploads/2016/01/tutor-8.jpg" alt="Dimas Prakoso" />
                                <div class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-yellow-500 border border-white rounded-full light:border-gray-800">
                                    <svg class="w-2 h-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <circle cx="9" cy="9" r="8" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full ps-3">
                                <div class="text-gray-500 text-sm light:text-gray-400">
                                    <span class="font-semibold text-gray-900 light:text-white">Dimas Prakoso</span> • Ruang Multimedia
                                </div>
                                <span class="text-gray-400 text-xs light:text-white">Beberapa komputer tidak menyala, mohon segera diperbaiki.</span>
                                <div class="text-xs text-yellow-500 font-medium mt-1">17 Juli 2025, 10:20</div>
                            </div>
                        </a>
                        <a href="detail-riwayat-selesai.html" class="flex px-4 py-3 hover:bg-gray-100 light:hover:bg-gray-700">
                            <div class="shrink-0 relative">
                                <img class="rounded-full object-cover w-11 h-11" src="https://mm.feb.uncen.ac.id/wp-content/uploads/2016/01/tutor-8.jpg" alt="Siti Aminah" />
                                <div class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-500 border border-white rounded-full light:border-gray-800">
                                    <svg class="w-2 h-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <circle cx="9" cy="9" r="8" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full ps-3">
                                <div class="text-gray-500 text-sm light:text-gray-400">
                                    <span class="font-semibold text-gray-900 light:text-white">Siti Aminah</span> • Toilet Gedung B
                                </div>
                                <span class="text-gray-400 text-xs light:text-white">Toilet rusak sudah diperbaiki. Terima kasih.</span>
                                <div class="text-xs text-blue-500 font-medium mt-1">16 Juli 2025, 08:10</div>
                            </div>
                        </a>
                        <a href="detail-riwayat-ditolak.html" class="flex px-4 py-3 hover:bg-gray-100 light:hover:bg-gray-700">
                            <div class="shrink-0 relative">
                                <img class="rounded-full object-cover w-11 h-11" src="https://mm.feb.uncen.ac.id/wp-content/uploads/2016/01/tutor-8.jpg" alt="Rina Maulida" />
                                <div class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-red-500 border border-white rounded-full light:border-gray-800">
                                    <svg class="w-2 h-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <circle cx="9" cy="9" r="8" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full ps-3">
                                <div class="text-gray-500 text-sm light:text-gray-400">
                                    <span class="font-semibold text-gray-900 light:text-white">Rina Maulida</span> • Gerbang Utama
                                </div>
                                <span class="text-gray-400 text-xs light:text-white">Pintu gerbang rusak, tidak bisa dikunci.</span>
                                <div class="text-xs text-red-500 font-medium mt-1">18 Juli 2025, 07:45</div>
                            </div>
                        </a>
                    </div>
                    <a href="notifikasi.html" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 light:bg-gray-800 light:hover:bg-gray-700 light:text-white">
                        <div class="inline-flex items-center">
                            <svg class="w-4 h-4 me-2 text-gray-500 light:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                            </svg>
                            Lihat Semua
                        </div>
                    </a>
                </div>

                <!-- Dropdown Profil -->
                <div class="relative">
                    <button id="dropdownProfileButton" data-dropdown-toggle="dropdownProfile" class="p-1 rounded-full hover:ring-2 hover:ring-blue-500 transition">
                        <img src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png" alt="Foto Guru" class="h-10 w-10 rounded-full object-cover border-2 border-white shadow" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3135/3135715.png'" />
                    </button>
                    <div id="dropdownProfile" class="z-50 hidden w-48 bg-white text-gray-700 rounded-xl mr-16 shadow-lg light:bg-gray-800 light:text-white" aria-labelledby="dropdownProfileButton">
                        <div class="flex flex-col items-center py-4 px-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png" alt="Foto Guru" class="h-10 w-10 rounded-full object-cover border-2 border-white shadow" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3135/3135715.png'" />
                            <p class="mt-2 font-semibold text-green-600">{{ Auth::user()->username }}</p>
                        </div>
                        <hr class="border-gray-200 light:border-gray-700" />
                        <a href="{{ url('guru/edit-profil') }}" class="block px-4 py-2 hover:bg-blue-50 light:hover:bg-gray-700 text-center">Edit Profil</a>
                        <form action="{{ route('logout') }}" method="POST" class="block w-full">
                            @csrf
                            <button type="submit" class="block px-4 py-2 w-full text-center hover:bg-red-50 text-red-500 light:hover:bg-gray-700 light:text-red-400">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex">
            @yield('content')
        </div>
    </main>

    @include('guru.gurumapel.layouts.footer')

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Hapus toggleDropdown manual karena menggunakan Flowbite
        window.addEventListener("click", function (e) {
            const sidebar = document.getElementById("sidebar");
            const toggleBtn = document.getElementById("toggleSidebar");
            // Hanya tangani sidebar untuk layar kecil
            if (window.innerWidth < 640 && sidebar && !sidebar.contains(e.target) && !toggleBtn.contains(e.target) && !sidebar.classList.contains("-translate-x-full")) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        });
    </script>
</body>
</html>