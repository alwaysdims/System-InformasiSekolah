<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi - Akademi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Same CSS as provided in the original HTML */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        /* ... Include all the CSS styles from the original HTML ... */
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->


        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="glass-effect sticky top-0 z-40 shadow-lg">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-4">
                        <button id="sidebarToggle" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-bars text-xl text-gray-600"></i>
                        </button>
                        <div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Forum Diskusi</h1>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <div id="profileBtn" class="w-10 h-10 online-indicator cursor-pointer">
                                <img src="{{ Auth::user()->avatar ?? asset('images/default.png') }}" alt="Profile" class="rounded-full w-full h-full object-cover">
                            </div>
                            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                                <div class="flex items-center px-4 py-3">
                                    <img src="{{ Auth::user()->avatar ?? asset('images/default.png') }}" alt="Profile" class="w-10 h-10 rounded-full object-cover mr-3">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                        <p class="text-sm text-green-500">Siswa</p>
                                    </div>
                                </div>
                                <hr class="my-1">
                                <a href="{{ route('guru.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex flex-1 overflow-hidden">
                <!-- Room List -->
                <div class="w-1/4 bg-white/80 backdrop-blur-sm border-r border-gray-200 hidden md:flex flex-col">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800">Ruang Diskusi</h3>
                    </div>
                    <div class="flex-1 overflow-y-auto custom-scrollbar p-2">
                        @forelse ($forums as $forum)
                            <a href="{{ route('siswa.ruang-diskusi.show', $forum->id) }}"
                               class="room-card p-4 m-2 rounded-xl hover:bg-gray-50 transition-all duration-300 hover-lift cursor-pointer border border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ strtoupper(substr($forum->guruMapel->mapel->nama_mapel ?? 'N/A', 0, 1)) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <p class="font-semibold text-gray-800">{{ $forum->guruMapel->mapel->nama_mapel ?? 'N/A' }}</p>
                                            <span class="text-xs text-gray-400">
                                                {{ \Carbon\Carbon::parse($forum->dibuat_pada)->format('H:i') }}
                                            </span>
                                        </div>

                                        <p class="text-sm text-gray-500 truncate">
                                            {{ $forum->komentar->last()->komentar ?? 'Belum ada komentar' }}
                                        </p>
                                        <div class="flex items-center mt-1">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                            <span class="text-xs text-gray-400">{{ rand(5, 20) }} online</span>
                                        </div>
                                    </div>
                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $forum->komentar->count() }}</span>
                                </div>
                            </a>
                        @empty
                            <p class="p-4 text-gray-500">Belum ada ruang diskusi.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="flex-1 flex flex-col">
                    <div class="glass-effect m-4 rounded-2xl shadow-xl flex-1 flex flex-col overflow-hidden">
                        <div class="p-6 text-center">
                            <h2 class="text-xl font-bold text-gray-800">Pilih Ruang Diskusi</h2>
                            <p class="text-sm text-gray-500">Silakan pilih ruang diskusi dari daftar di sebelah kiri.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle and other JavaScript remains the same
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && e.target !== sidebarToggle) {
                sidebar.classList.remove('active');
            }
        });

        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', () => {
            profileDropdown.classList.add('hidden');
        });
    </script>
</body>
</html>
