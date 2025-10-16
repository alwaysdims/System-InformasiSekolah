<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syschool - {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --accent-blue: #60a5fa;
            --light-blue: #e0f2fe;
            --white-blue: #f5faff;
            --success-green: #22c55e;
            --light-gray: #e5e7eb;
            --dark-gray: #1f2937;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .sidebar {
            background: linear-gradient(180deg, rgba(30, 64, 175, 0.95) 0%, rgba(59, 130, 246, 0.95) 100%);
            backdrop-filter: blur(8px);
            border-radius: 1rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, opacity 0.3s ease;
            will-change: transform;
            backface-visibility: hidden;
            z-index: 50;
        }

        .sidebar-item {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar-item.active {
            background: white;
            color: var(--primary-blue);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transform: scale(1.02);
        }

        .chat-container {
            height: calc(100vh - 200px);
            min-height: 500px;
        }

        .chat-messages {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            border: 1px solid var(--border-color);
        }

        .message-bubble {
            max-width: 70%;
            padding: 0.875rem 1rem;
            border-radius: 1.25rem;
            margin-bottom: 0.75rem;
            position: relative;
            word-wrap: break-word;
            animation: messageSlide 0.3s ease-out;
            backface-visibility: hidden;
        }

        @keyframes messageSlide {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message-student {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            color: var(--text-primary);
            align-self: flex-start;
            border-bottom-left-radius: 0.5rem;
        }

        .message-teacher {
            background: linear-gradient(135deg, var(--accent-blue) 0%, #2563eb 100%);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 0.5rem;
        }

        .contact-item {
            border-radius: 0.75rem;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .contact-item:hover {
            background: linear-gradient(135deg, var(--light-blue) 0%, rgba(59, 130, 246, 0.1) 100%);
            transform: translateX(4px);
        }

        .contact-item.active {
            background: linear-gradient(135deg, var(--accent-blue) 0%, #2563eb 100%);
            color: white;
        }

        .input-modern {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid var(--border-color);
            border-radius: 1.5rem;
            padding: 0.875rem 1.25rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            font-size: 0.875rem;
        }

        .input-modern:focus {
            outline: none;
            border-color: var(--accent-blue);
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .send-btn {
            background: linear-gradient(135deg, var(--success-green) 0%, #059669 100%);
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }

        .send-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.4);
        }

        .mobile-toggle {
            background: linear-gradient(135deg, var(--accent-blue) 0%, #2563eb 100%);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            background: var(--success-green);
            border-radius: 50%;
            position: absolute;
            top: 8px;
            right: 8px;
            border: 2px solid white;
        }

        .overlay {
            transition: opacity 0.3s ease, visibility 0.3 ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                max-width: 16rem;
                transform: translateX(-100%);
                visibility: hidden;
                opacity: 0;
            }

            .sidebar.active {
                transform: translateX(0);
                visibility: visible;
                opacity: 1;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .chat-container {
                height: calc(100vh - 160px);
            }

            .message-bubble {
                max-width: 85%;
                padding: 0.75rem;
                font-size: 0.875rem;
            }

            .send-btn {
                width: 2.5rem;
                height: 2.5rem;
            }

            #chatLeft {
                display: none;
                position: fixed;
                width: 100%;
                max-width: 16rem;
                z-index: 40;
                background: white;
                border-radius: 0;
                visibility: hidden;
                opacity: 0;
                transform: translateX(-100%);
                transition: transform 0.3s ease, opacity 0.3s ease, visibility 0.3s ease;
            }

            #chatLeft.active {
                display: block;
                visibility: visible;
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (min-width: 769px) {
            .sidebar {
                width: 16rem;
                transform: translateX(0);
                visibility: visible;
                opacity: 1;
                left: 1rem;
                top: 1rem;
                height: 95%;
            }

            .main-content {
                margin-left: 17rem;
                padding: 1.5rem;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scrollbar-thin {
            scrollbar-width: thin;
            scrollbar-color: var(--border-color) transparent;
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: var(--text-secondary);
        }

    </style>
</head>

<body class="min-h-screen">

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 overlay"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="sidebar text-white p-5 flex flex-col shadow-2xl fixed inset-y-0 transform -translate-x-full z-50 sm:translate-x-0 sm:left-4 sm:top-4 sm:h-[95%] ">
        <div class="flex items-center gap-4 mb-8">
            <img src="{{ asset('assets/admin/images/logo-smkn2kra.webp') }}" alt="SKANDAKRA Logo"
                class="w-12 h-12 rounded-lg">
            <h1 class="text-sm font-bold leading-tight">SYSTEM INFORMASI SKANDAKRA</h1>
        </div>
        <nav class="space-y-2 flex-1">
            <a href="/admin/dashboard"
                class="sidebar-item @if($title == 'Dashboard') active @endif flex items-center gap-3 text-sm font-medium">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="/admin/dataGuru"
                class="sidebar-item @if($title == 'Data Guru') active @endif flex items-center gap-3 text-sm font-medium">
                <i class="fas fa-chalkboard-teacher"></i> Data Guru
            </a>
            <a href="forum_diskusi.html"
                class="sidebar-item @if($title == 'Forum Diskusi') active @endif flex items-center gap-3 text-sm font-medium">
                <i class="fas fa-user-graduate"></i> Data Siswa
            </a>
            <a href="{{ route('admin.wali_murid.index') }}"
                class="sidebar-item @if($title == 'Daftar Wali Murid') active @endif flex items-center gap-3 text-sm font-medium">
                <i class="fas fa-users"></i> Data Wali Murid
            </a>
            <a href="{{ '/admin/dataAdmin' }}"
                class="sidebar-item @if($title == 'Data Admin') active @endif flex items-center gap-3 text-sm font-medium">
                <i class="fas fa-user-shield"></i> Data Admin
            </a>
            <a href="forum_diskusi.html"
                class="sidebar-item @if($title == 'Forum Diskusi') active @endif flex items-center gap-3 text-sm font-medium">
                <i class="fas fa-book-open"></i> Mata Pelajaran
            </a>
            <a href="{{ route('admin.dataJurusan.index') }}"
                class="sidebar-item @if($title == 'Data Jurusan') active @endif flex items-center gap-3 text-sm font-medium">
                <i class="fas fa-tools"></i> Data Jurusan
            </a>
            <a href="{{ route('admin.dataKelas.index') }}"
                class="sidebar-item @if($title == 'Data Kelas') active @endif flex items-center gap-3 text-sm font-medium">
                <i class="fas fa-school"></i> Kelas
            </a>
        </nav>
    </aside>

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
                        <a href="pengaturan_akun.html"
                            class="block px-4 py-2 hover:bg-blue-50 text-gray-600">Pengaturan</a>
                        <a href="logout.html" class="block px-4 py-2 hover:bg-red-50 text-red-500">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Notification Modal -->
    <div id="notificationModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg mx-4 max-h-[80vh] overflow-y-auto animate-fadeIn">
            <div class="flex justify-between items-center p-4 border-b">
                <h2 class="text-lg font-semibold text-gray-700">Pemberitahuan</h2>
                <button id="closeNotificationModal" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <div class="divide-y">
                <a href="#" class="flex items-start p-4 hover:bg-blue-50">
                    <div
                        class="h-10 w-10 bg-blue-100 text-[var(--primary-blue)] rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Tugas Baru Ditambahkan</p>
                        <p class="text-xs text-gray-500">Tugas Matematika telah ditambahkan.</p>
                        <p class="text-xs text-[var(--secondary-blue)] mt-1">Beberapa detik yang lalu</p>
                    </div>
                </a>
                <a href="#" class="flex items-start p-4 hover:bg-blue-50">
                    <div
                        class="h-10 w-10 bg-blue-100 text-[var(--primary-blue)] rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Nilai Diperbarui</p>
                        <p class="text-xs text-gray-500">Nilai ujian Bahasa Indonesia telah diunggah.</p>
                        <p class="text-xs text-[var(--secondary-blue)] mt-1">1 jam yang lalu</p>
                    </div>
                </a>
                <a href="#" class="flex items-start p-4 hover:bg-blue-50">
                    <div
                        class="h-10 w-10 bg-blue-100 text-[var(--primary-blue)] rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Pengumuman Penting</p>
                        <p class="text-xs text-gray-500">Tidak ada kelas besok karena rapat guru.</p>
                        <p class="text-xs text-[var(--secondary-blue)] mt-1">3 jam yang lalu</p>
                    </div>
                </a>
            </div>
            <div class="p-4 border-t text-center">
                <a href="notifikasi.html" class="text-[var(--secondary-blue)] font-semibold hover:underline">Lihat
                    semua</a>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let currentSubject = 'Fisika';
        let messages = {
            Fisika: [{
                    text: "Halo Pak, boleh minta penjelasan tentang hukum Newton?",
                    role: "student",
                    time: "07:30 PM"
                },
                {
                    text: "Tentu! Hukum Newton pertama menyatakan bahwa benda akan tetap diam atau bergerak lurus beraturan jika tidak ada gaya yang bekerja padanya.",
                    role: "teacher",
                    time: "07:35 PM"
                }
            ],
            Kimia: [],
            Biologi: [],
            Matematika: []
        };
        let isUpdatingChat = false;

        // DOM elements
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleSidebarBtn = document.getElementById('toggleSidebar');
        const toggleChatLeftBtn = document.getElementById('toggleChatLeft');
        const chatLeft = document.getElementById('chatLeft');
        const chatTitle = document.getElementById('chatTitle');
        const chatMessages = document.getElementById('chatMessages');
        const chatInput = document.getElementById('chatInput');
        const sendMessageBtn = document.getElementById('sendMessage');
        const notificationModal = document.getElementById('notificationModal');
        const openNotificationBtn = document.getElementById('openNotificationModal');
        const closeNotificationBtn = document.getElementById('closeNotificationModal');

        // Debounce function to limit rapid updates
        function debounce(func, wait) {
            let timeout;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        // Sidebar functionality
        function toggleSidebar() {
            if (sidebar.classList.contains('active')) {
                sidebar.style.visibility = 'hidden';
                sidebar.style.opacity = '0';
                sidebar.classList.toggle('active');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.toggle('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('active');
                sidebar.style.visibility = 'visible';
                sidebar.style.opacity = '1';
                overlay.classList.remove('hidden');
            }
        }

        overlay.addEventListener('click', () => {
            toggleSidebar();
        });

        toggleSidebarBtn.addEventListener('click', toggleSidebar);

        overlay.addEventListener('click', () => {
            sidebar.style.visibility = 'hidden';
            sidebar.style.opacity = '0';
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('active');
            chatLeft.style.visibility = 'hidden';
            chatLeft.style.opacity = '0';
            chatLeft.classList.add('hidden', '-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Chat left toggle for mobile
        toggleChatLeftBtn.addEventListener('click', () => {
            if (chatLeft.classList.contains('active')) {
                chatLeft.style.visibility = 'hidden';
                chatLeft.style.opacity = '0';
                chatLeft.classList.add('hidden', '-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                chatLeft.classList.remove('hidden', '-translate-x-full');
                chatLeft.classList.add('active');
                chatLeft.style.visibility = 'visible';
                chatLeft.style.opacity = '1';
                overlay.classList.remove('hidden');
            }
        });

        // Subject selection
        document.querySelectorAll('.contact-item').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.contact-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                currentSubject = item.dataset.subject;
                updateChat();
                if (window.innerWidth < 1024) {
                    chatLeft.style.visibility = 'hidden';
                    chatLeft.style.opacity = '0';
                    chatLeft.classList.add('hidden', '-translate-x-full');
                    overlay.classList.add('hidden');
                }
            });
        });

        // Update chat display with document fragment
        const debouncedUpdateChat = debounce(() => {
            if (isUpdatingChat) return;
            isUpdatingChat = true;

            requestAnimationFrame(() => {
                chatTitle.textContent = currentSubject;
                const fragment = document.createDocumentFragment();
                const messagesContainer = document.createElement('div');
                messagesContainer.className = 'flex flex-col space-y-3';

                messages[currentSubject].forEach(msg => {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `message-bubble message-${msg.role}`;
                    messageDiv.innerHTML = `
                        <p class="text-sm leading-relaxed">${msg.text}</p>
                        <p class="text-xs opacity-70 mt-2">${msg.time}</p>
                    `;
                    messagesContainer.appendChild(messageDiv);
                });

                fragment.appendChild(messagesContainer);
                chatMessages.innerHTML = '';
                chatMessages.appendChild(fragment);
                chatMessages.scrollTo({
                    top: chatMessages.scrollHeight,
                    behavior: 'smooth'
                });

                isUpdatingChat = false;
            });
        }, 100);

        function updateChat() {
            debouncedUpdateChat();
        }

        // Send message with typing indicator
        function sendMessageWithTyping() {
            const text = chatInput.value.trim();
            if (!text) return;

            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });

            messages[currentSubject].push({
                text: text,
                role: 'student',
                time: time
            });

            chatInput.value = '';
            chatInput.style.height = 'auto';
            updateChat();

            const typingIndicator = showTypingIndicator();

            setTimeout(() => {
                if (typingIndicator && typingIndicator.parentNode) {
                    typingIndicator.style.opacity = '0';
                    setTimeout(() => typingIndicator.remove(), 300);
                }

                const responses = [
                    "Terima kasih atas pertanyaannya. Saya akan menjelaskan lebih detail.",
                    "Pertanyaan yang bagus! Mari kita bahas bersama-sama.",
                    "Saya akan memberikan penjelasan yang mudah dipahami.",
                    "Baik, saya akan membantu menjelaskan materi ini.",
                    "Silakan simak penjelasan berikut dengan seksama.",
                    "Ini adalah topik yang menarik untuk dibahas."
                ];

                const randomResponse = responses[Math.floor(Math.random() * responses.length)];

                messages[currentSubject].push({
                    text: randomResponse,
                    role: 'teacher',
                    time: new Date().toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit'
                    })
                });

                updateChat();
            }, 1500 + Math.random() * 2000);
        }

        sendMessageBtn.addEventListener('click', sendMessageWithTyping);

        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessageWithTyping();
            }
        });

        // Typing indicator
        function showTypingIndicator() {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message-bubble message-teacher typing-indicator';
            typingDiv.style.transition = 'opacity 0.3s ease';
            typingDiv.innerHTML = `
                <div class="flex items-center space-x-1">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-white/60 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-white/60 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-white/60 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                    <span class="text-xs opacity-70 ml-2">Guru sedang mengetik...</span>
                </div>
            `;

            const messagesContainer = chatMessages.querySelector('.flex.flex-col') || document.createElement('div');
            messagesContainer.className = 'flex flex-col space-y-3';
            messagesContainer.appendChild(typingDiv);
            if (!chatMessages.querySelector('.flex.flex-col')) {
                chatMessages.appendChild(messagesContainer);
            }
            chatMessages.scrollTo({
                top: chatMessages.scrollHeight,
                behavior: 'smooth'
            });

            return typingDiv;
        }

        // Notification modal
        openNotificationBtn.addEventListener('click', () => {
            notificationModal.classList.remove('hidden');
        });

        closeNotificationBtn.addEventListener('click', () => {
            notificationModal.classList.add('hidden');
        });

        notificationModal.addEventListener('click', (e) => {
            if (e.target === notificationModal) {
                notificationModal.classList.add('hidden');
            }
        });

        // Dropdown functionality
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
            document.addEventListener('click', function closeDropdown(e) {
                if (!dropdown.contains(e.target) && !e.target.closest(`[onclick="toggleDropdown('${id}')"]`)) {
                    dropdown.classList.add('hidden');
                    document.removeEventListener('click', closeDropdown);
                }
            });
        }

        // Auto-resize textarea
        chatInput.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            const firstContact = document.querySelector('.contact-item[data-subject="Fisika"]');
            if (firstContact) {
                firstContact.classList.add('active');
            }
            updateChat();
            if (window.innerWidth >= 1024) {
                chatInput.focus();
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                chatLeft.classList.remove('hidden', 'fixed', 'inset-0', 'bg-white', 'z-40',
                '-translate-x-full');
                chatLeft.style.visibility = 'visible';
                chatLeft.style.opacity = '1';
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('active');
                sidebar.style.visibility = 'visible';
                sidebar.style.opacity = '1';
                overlay.classList.add('hidden');
            } else if (!chatLeft.classList.contains('hidden')) {
                chatLeft.classList.add('fixed', 'inset-0', 'bg-white', 'z-40');
            }
        });

        // Add message status indicators
        function addMessageStatus(messageElement, status = 'sent') {
            const statusIcon = document.createElement('span');
            statusIcon.className = 'message-status text-xs opacity-60 ml-2';
            switch (status) {
                case 'sent':
                    statusIcon.innerHTML = '<i class="fas fa-check"></i>';
                    break;
                case 'delivered':
                    statusIcon.innerHTML = '<i class="fas fa-check-double"></i>';
                    break;
                case 'read':
                    statusIcon.innerHTML = '<i class="fas fa-check-double text-blue-400"></i>';
                    break;
            }
            const timeElement = messageElement.querySelector('.text-xs');
            if (timeElement) timeElement.appendChild(statusIcon);
        }

        // Error handling
        function showError(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className =
                'fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 animate-fadeIn';
            errorDiv.textContent = message;
            document.body.appendChild(errorDiv);
            setTimeout(() => errorDiv.remove(), 3000);
        }

        // Connection status
        function updateConnectionStatus(isOnline = true) {
            let statusBar = document.getElementById('connectionStatus');
            if (!statusBar) {
                statusBar = document.createElement('div');
                statusBar.id = 'connectionStatus';
                statusBar.className =
                    'fixed top-0 left-0 right-0 text-center py-2 text-sm font-medium z-50 transition-all duration-300';
                document.body.appendChild(statusBar);
            }
            if (isOnline) {
                statusBar.className = statusBar.className.replace(/bg-\w+-\d+/, 'bg-green-500');
                statusBar.textContent = 'Terhubung';
                statusBar.style.transform = 'translateY(-100%)';
            } else {
                statusBar.className = statusBar.className.replace(/bg-\w+-\d+/, 'bg-red-500');
                statusBar.textContent = 'Tidak ada koneksi internet';
                statusBar.style.transform = 'translateY(0)';
            }
        }

        window.addEventListener('online', () => updateConnectionStatus(true));
        window.addEventListener('offline', () => updateConnectionStatus(false));
        updateConnectionStatus(navigator.onLine);

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                chatInput.focus();
            }
            if (e.key === 'Escape') {
                notificationModal.classList.add('hidden');
                document.getElementById('profileDropdown') ? .classList.add('hidden');
                if (window.innerWidth < 1024) {
                    sidebar.style.visibility = 'hidden';
                    sidebar.style.opacity = '0';
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('active');
                    chatLeft.style.visibility = 'hidden';
                    chatLeft.style.opacity = '0';
                    chatLeft.classList.add('hidden', '-translate-x-full');
                    overlay.classList.add('hidden');
                }
            }
        });

        // Lazy load messages
        function lazyLoadMessages() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        console.log('Loading more messages...');
                    }
                });
            });
            const firstMessage = chatMessages.querySelector('.message-bubble');
            if (firstMessage) observer.observe(firstMessage);
        }

        lazyLoadMessages();

        console.log('Forum Diskusi initialized successfully');
    </script>
</body>

</html>
