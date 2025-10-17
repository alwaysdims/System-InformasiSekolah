<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi - {{ $forum->guruMapel->mapel->nama_mapel ?? 'N/A' }}</title>
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
                                <a href="{{ route('guru.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kelbali</a>
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
                        @forelse ($forums as $f)
                            <a href="{{ route('siswa.ruang-diskusi.show', $f->id) }}"
                               class="room-card p-4 m-2 rounded-xl {{ $f->id == $forum->id ? 'bg-indigo-50 border-l-4 border-indigo-500 shadow-md' : 'hover:bg-gray-50 border border-gray-100' }} transition-all duration-300 hover-lift cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ strtoupper(substr($f->guruMapel->mapel->nama_mapel ?? 'N/A', 0, 1)) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <p class="font-semibold text-gray-800">{{ $f->guruMapel->mapel->nama_mapel ?? 'N/A' }}</p>
                                            <span class="text-xs text-gray-400">
                                                {{ \Carbon\Carbon::parse($forum->dibuat_pada)->format('H:i') }}
                                            </span>

                                        </div>
                                        <p class="text-sm text-gray-500 truncate">
                                            {{ $f->komentar->last()->komentar ?? 'Belum ada komentar' }}
                                        </p>
                                        <div class="flex items-center mt-1">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                            <span class="text-xs text-gray-400">{{ rand(5, 20) }} online</span>
                                        </div>
                                    </div>
                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $f->komentar->count() }}</span>
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
                        <!-- Chat Header -->
                        <div class="flex items-center justify-between p-6 border-b border-gray-200">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                    {{ strtoupper(substr($forum->guruMapel->mapel->nama_mapel ?? 'N/A', 0, 1)) }}
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">{{ $forum->guruMapel->mapel->nama_mapel ?? 'N/A' }}</h2>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                        <p class="text-sm text-gray-500">{{ rand(5, 20) }} anggota online</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Messages -->
                        <div class="flex-1 overflow-y-auto custom-scrollbar p-6 space-y-6" id="messagesContainer">
                            @forelse ($forum->komentar as $komentar)
                                <div class="flex items-end {{ $komentar->user_id == Auth::id() ? 'justify-end' : '' }} space-x-3 message-bubble">
                                    @if ($komentar->user_id != Auth::id())
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-400 to-orange-500 text-white flex items-center justify-center text-sm font-bold shadow-lg">
                                            {{ strtoupper(substr($komentar->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="max-w-sm">
                                        <div class="{{ $komentar->user_id == Auth::id() ? 'bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-br-md' : 'bg-white rounded-bl-md border border-gray-100' }} rounded-2xl p-4 shadow-lg">
                                            @if ($komentar->user_id != Auth::id())
                                                <p class="text-sm font-semibold text-gray-800 mb-1">{{ $komentar->user->name }}</p>
                                            @endif
                                            <p class="{{ $komentar->user_id == Auth::id() ? 'text-indigo-100' : 'text-gray-700' }}">{{ $komentar->komentar }}</p>
                                        </div>
                                        <div class="flex items-center {{ $komentar->user_id == Auth::id() ? 'justify-end' : '' }} mt-2 space-x-2">
                                            <span class="text-xs text-gray-400">{{ $komentar->dibuat_pada->diffForHumans() }}</span>
                                            @if ($komentar->user_id != Auth::id())
                                                <button class="text-xs text-gray-400 hover:text-indigo-600 reply-btn" data-id="{{ $komentar->id }}">
                                                    <i class="fas fa-reply mr-1"></i>Reply
                                                </button>
                                            @else
                                                <i class="fas fa-check-double text-blue-500 text-xs"></i>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($komentar->user_id == Auth::id())
                                        <div class="w-10 h-10 online-indicator">
                                            <img src="{{ $komentar->user->avatar ?? asset('images/default.png') }}" alt="Profile" class="rounded-full w-full h-full object-cover shadow-lg">
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <p class="text-center text-gray-500">Belum ada komentar di forum ini.</p>
                            @endforelse
                        </div>

                        <!-- Message Input -->
                        <div class="p-6 border-t border-gray-200">
                            <form class="flex items-end space-x-4" id="messageForm" action="{{ route('siswa.ruang-diskusi.komentar', $forum->id) }}" method="POST">
                                @csrf
                                <div class="flex-1 relative">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <button type="button" class="p-2 rounded-lg hover:bg-gray-100 transition-colors" title="Attach File" id="btnFile">
                                            <i class="fas fa-paperclip text-gray-500"></i>
                                        </button>
                                        <input type="file" id="inputFile" class="hidden">
                                        <button type="button" id="emojiBtn" class="p-2 rounded-lg hover:bg-gray-100 transition-colors" title="Emoji">
                                            <i class="fas fa-smile text-gray-500"></i>
                                        </button>
                                    </div>
                                    <div class="emoji-picker" id="emojiPicker">
                                        <div class="grid grid-cols-6 gap-2">
                                            <button type="button" class="p-2 hover:bg-gray-100 rounded text-lg">😊</button>
                                            <button type="button" class="p-2 hover:bg-gray-100 rounded text-lg">😂</button>
                                            <button type="button" class="p-2 hover:bg-gray-100 rounded text-lg">🤔</button>
                                            <button type="button" class="p-2 hover:bg-gray-100 rounded text-lg">👍</button>
                                            <button type="button" class="p-2 hover:bg-gray-100 rounded text-lg">❤️</button>
                                            <button type="button" class="p-2 hover:bg-gray-100 rounded text-lg">🎉</button>
                                        </div>
                                    </div>
                                    <textarea id="messageInput" name="komentar" placeholder="Ketik pesan Anda..." rows="1" class="message-input w-full p-4 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none" required></textarea>
                                    @error('komentar')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="p-4 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-2xl hover:from-indigo-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar and profile dropdown JavaScript
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        const messageInput = document.getElementById('messageInput');
        const messageForm = document.getElementById('messageForm');
        const messagesContainer = document.getElementById('messagesContainer');
        const emojiBtn = document.getElementById('emojiBtn');
        const emojiPicker = document.getElementById('emojiPicker');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && e.target !== sidebarToggle) {
                sidebar.classList.remove('active');
            }
            profileDropdown.classList.add('hidden');
            emojiPicker.classList.remove('show');
        });

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });

        // Auto-resize textarea
        messageInput.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        // Emoji picker
        emojiBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            emojiPicker.classList.toggle('show');
        });

        emojiPicker.addEventListener('click', (e) => {
            e.stopPropagation();
            if (e.target.tagName === 'BUTTON') {
                messageInput.value += e.target.textContent;
                messageInput.focus();
            }
        });

        // Form submission via AJAX
        messageForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(messageForm);
            try {
                const response = await fetch(messageForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                });
                const data = await response.json();
                if (response.ok) {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'flex items-end justify-end space-x-3 message-bubble';
                    messageDiv.innerHTML = `
                        <div class="max-w-sm">
                            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-2xl rounded-br-md p-4 shadow-lg">
                                <p class="text-indigo-100">${data.komentar.komentar}</p>
                            </div>
                            <div class="flex items-center justify-end mt-2 space-x-2">
                                <span class="text-xs text-gray-400">${data.komentar.dibuat_pada}</span>
                                <i class="fas fa-check-double text-blue-500 text-xs"></i>
                            </div>
                        </div>
                        <div class="w-10 h-10 online-indicator">
                            <img src="${data.komentar.user.avatar}" alt="Profile" class="rounded-full w-full h-full object-cover shadow-lg">
                        </div>
                    `;
                    messagesContainer.appendChild(messageDiv);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    messageInput.value = '';
                    messageInput.style.height = 'auto';
                } else {
                    alert(data.message || 'Gagal menambahkan komentar.');
                }
            } catch (error) {
                alert('Terjadi kesalahan: ' + error.message);
            }
        });

        // Smooth scroll to bottom on new messages
        const observer = new MutationObserver(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        });
        observer.observe(messagesContainer, { childList: true });

        // File input handling
        document.getElementById('btnFile').addEventListener('click', () => {
            document.getElementById('inputFile').click();
        });

        document.getElementById('inputFile').addEventListener('change', function () {
            if (this.files.length > 0) {
                console.log('File dipilih:', this.files[0].name);
            }
        });
    </script>
</body>
</html>
