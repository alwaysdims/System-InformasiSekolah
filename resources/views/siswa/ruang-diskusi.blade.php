
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Pintar - Forum Diskusi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .bg-gradient-secondary { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .bg-gradient-success { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        body.dark { background-color: #0f172a; color: #e2e8f0; }
        body.dark .bg-white { background-color: #1e293b; border-color: #334155; }
        body.dark .bg-gray-100, body.dark .bg-gray-50 { background-color: #0f172a; }
        body.dark .border-gray-200 { border-color: #334155; }
        body.dark .text-gray-700 { color: #cbd5e1; }
        body.dark .text-gray-500 { color: #64748b; }
        .message-bubble { transition: all 0.3s ease; opacity: 0; transform: translateY(10px); animation: fadeInUp 0.4s ease forwards; backdrop-filter: blur(10px); }
        .message-input { transition: all 0.3s ease; border: 2px solid transparent; }
        .message-input:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); transform: translateY(-1px); }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        .message-bubble-container:hover .message-actions { opacity: 1; transform: translateX(0); }
        .message-actions { transform: translateX(10px); transition: all 0.3s ease; }
        .typing-indicator { animation: pulse 1.5s infinite; }
        .subject-btn { transition: all 0.3s ease; position: relative; overflow: hidden; }
        .subject-btn::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); transition: left 0.5s; }
        .subject-btn:hover::before { left: 100%; }
        .glass-effect { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .chat-pattern { background-image: radial-gradient(circle at 25px 25px, rgba(102, 126, 234, 0.05) 2px, transparent 2px), radial-gradient(circle at 75px 75px, rgba(118, 75, 162, 0.05) 2px, transparent 2px); background-size: 100px 100px; }
        .floating-action { position: fixed; bottom: 20px; right: 20px; z-index: 1000; }
        .notification-dot { position: absolute; top: -2px; right: -2px; width: 8px; height: 8px; background: #ef4444; border-radius: 50%; animation: pulse 2s infinite; }
        @media (max-width: 768px) { .sidebar-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 40; } }
        .online-indicator { position: absolute; bottom: 0; right: 0; width: 12px; height: 12px; background: #10b981; border: 2px solid white; border-radius: 50%; }
        .message-time { opacity: 0; transition: opacity 0.3s ease; }
        .message-bubble-container:hover .message-time { opacity: 1; }
    </style>
</head>
<body class="bg-gray-50 h-screen flex overflow-hidden">
    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay" class="sidebar-overlay hidden md:hidden"></div>

    <!-- Sidebar -->
    <aside class="fixed md:relative w-64 h-full bg-white shadow-xl flex flex-col border-r border-gray-200 transition-all duration-300 z-50 transform -translate-x-full md:translate-x-0" id="sidebar">
        <!-- Logo Header -->
        <div class="p-6 border-b border-gray-100 bg-gradient-primary">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                    <img src="{{ asset('images/logo-smkn2kra.webp') }}" alt="Logo Sekolah" class="w-8 h-8 rounded-lg" />
                </div>
                <div class="ml-3">
                    <h1 class="text-white font-bold text-lg">Sekolah Pintar</h1>
                    <p class="text-white/80 text-sm">Forum Diskusi</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto scrollbar-hide p-4">
            <div class="mb-6">
                <h2 class="text-xs uppercase font-semibold text-gray-400 px-3 mb-3 tracking-wider">Mata Pelajaran</h2>
                <ul class="space-y-2">
                    @foreach($forums as $forum)
                    <li>
                        <a href="#{{ $forum->judul }}" class="subject-btn group flex items-center py-3 px-4 rounded-xl {{ $forum->id == $forum->id ? 'bg-gradient-primary text-white shadow-lg' : 'hover:bg-indigo-50 text-gray-700 hover:text-indigo-600' }} transition-all duration-300 hover:shadow-md" data-subject="{{ Str::slug($forum->judul) }}" data-forum-id="{{ $forum->id }}">
                            <div class="w-10 h-10 flex items-center justify-center {{ $forum->id == $forum->id ? 'bg-white/20' : 'bg-indigo-100 group-hover:bg-indigo-200' }} rounded-lg backdrop-blur-sm">
                                <i class="fas fa-{{ $forum->guru_mapel->mata_pelajaran === 'Matematika' ? 'calculator' : ($forum->guru_mapel->mata_pelajaran === 'Fisika' ? 'atom' : 'flask') }} text-lg {{ $forum->id == $forum->id ? '' : 'text-indigo-500' }}"></i>
                            </div>
                            <div class="ml-3">
                                <span class="font-semibold">{{ $forum->judul }}</span>
                                <div class="text-xs {{ $forum->id == $forum->id ? 'opacity-80' : 'text-gray-500' }}">{{ $forum->guru_mapel->mata_pelajaran }}</div>
                            </div>
                            <div class="ml-auto">
                                <div class="notification-dot {{ $forum->id == $forum->id ? 'hidden' : '' }}"></div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="mb-6">
                <h2 class="text-xs uppercase font-semibold text-gray-400 px-3 mb-3 tracking-wider">Aksi Cepat</h2>
                <div class="space-y-2">
                    <button class="w-full flex items-center py-2 px-4 rounded-lg hover:bg-gray-100 text-gray-600 hover:text-indigo-600 transition-all">
                        <i class="fas fa-question-circle w-5"></i>
                        <span class="ml-3 text-sm">Tanya Guru</span>
                    </button>
                    <button class="w-full flex items-center py-2 px-4 rounded-lg hover:bg-gray-100 text-gray-600 hover:text-indigo-600 transition-all">
                        <i class="fas fa-file-alt w-5"></i>
                        <span class="ml-3 text-sm">Materi</span>
                    </button>
                </div>
            </div>
        </nav>

        <!-- User Profile -->
        <div class="p-4 border-t border-gray-100 bg-gray-50/50">
            <div class="flex items-center">
                <div class="relative">
                    <div class="w-12 h-12 rounded-xl bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-user text-gray-600 text-lg"></i>
                    </div>
                    <div class="online-indicator"></div>
                </div>
                <div class="ml-3 flex-1">
                    <div class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ auth()->user()->siswa->kelas->nama_kelas ?? 'Kelas X' }}</div>
                </div>
                <div class="flex items-center space-x-1">
                    <button id="theme-toggle" class="p-2 text-gray-400 hover:text-indigo-500 rounded-lg hover:bg-white transition-all">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-white transition-all">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0">
        <!-- Chat Header -->
        <div class="chat-header p-4 lg:p-6 border-b border-gray-200 bg-white/80 backdrop-blur-sm flex items-center justify-between shadow-sm">
            <div class="flex items-center min-w-0">
                <button id="toggle-sidebar" class="text-gray-500 text-xl mr-4 p-2 hover:bg-gray-100 rounded-lg transition-all md:hidden">
                    <i class="fas fa-bars"></i>
                </button>
                <div id="subject-icon-container" class="w-12 h-12 rounded-xl bg-gradient-primary flex items-center justify-center mr-4 shadow-lg">
                    <i class="fas fa-calculator text-white text-lg"></i>
                </div>
                <div class="min-w-0">
                    <h2 id="subject-title" class="font-bold text-lg text-gray-800 truncate">{{ $forum->judul }}</h2>
                    <div class="text-sm text-gray-500 flex items-center">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                            <span id="participant-count">85 peserta aktif</span>
                        </div>
                        <span class="mx-2">•</span>
                        <div id="typing-indicator" class="typing-indicator text-indigo-500 hidden">
                            <span id="typing-users">3 orang</span> sedang mengetik...
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button class="p-2 text-gray-500 hover:text-indigo-500 hover:bg-indigo-50 rounded-lg transition-all">
                    <i class="fas fa-search"></i>
                </button>
                <button class="p-2 text-gray-500 hover:text-indigo-500 hover:bg-indigo-50 rounded-lg transition-all">
                    <i class="fas fa-video"></i>
                </button>
                <button id="toggle-members-sidebar" class="p-2 text-gray-500 hover:text-indigo-500 hover:bg-indigo-50 rounded-lg transition-all">
                    <i class="fas fa-users"></i>
                </button>
            </div>
        </div>

        <!-- Messages Container -->
        <div id="messages-container" class="messages flex-1 overflow-y-auto p-4 lg:p-6 chat-pattern">
            <div id="message-list" class="max-w-4xl mx-auto space-y-6">
                <!-- Messages will be loaded here -->
            </div>
        </div>

        <!-- Message Input -->
        <div class="p-4 lg:p-6 border-t border-gray-200 bg-white/90 backdrop-blur-sm">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-end space-x-4">
                    <button class="w-12 h-12 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 hover:text-indigo-500 transition-all">
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="flex-1 relative">
                        <div class="flex items-end bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                            <input id="message-input" type="text" placeholder="Ketik pesan Anda..." class="message-input flex-1 px-6 py-4 bg-transparent resize-none border-0 focus:ring-0" />
                            <div class="flex items-center space-x-2 px-4">
                                <button class="text-gray-400 hover:text-indigo-500 transition-colors">
                                    <i class="far fa-smile text-lg"></i>
                                </button>
                                <button class="text-gray-400 hover:text-indigo-500 transition-colors">
                                    <i class="fas fa-paperclip text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button id="send-btn" class="w-12 h-12 rounded-xl bg-gradient-primary hover:shadow-lg flex items-center justify-center text-white transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Members Sidebar -->
    <aside id="members-sidebar" class="hidden lg:block w-80 bg-white border-l border-gray-200 overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-gray-800 text-lg">Anggota Kelas</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">120 siswa</span>
                    <button class="p-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-indigo-100 hover:text-indigo-600 transition-all">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Teachers -->
            <div class="mb-8">
                <h4 class="text-sm font-semibold text-gray-600 mb-4 flex items-center">
                    <i class="fas fa-chalkboard-teacher text-indigo-500 mr-2"></i>
                    Guru Pengampu
                </h4>
                <div class="space-y-3">
                    <div class="flex items-center p-3 rounded-xl hover:bg-gray-50 transition-all cursor-pointer">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-xl bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-user text-gray-600 text-lg"></i>
                            </div>
                            <div class="online-indicator"></div>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm font-semibold text-gray-800">{{ $forum->guruMapel->guru->name ?? 'Guru' }}</div>
                            <div class="text-xs text-gray-500">{{ $forum->guruMapel->mata_pelajaran }}</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-shield-alt text-indigo-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Floating Action Button (Mobile) -->
    <button id="floating-members" class="floating-action lg:hidden w-14 h-14 bg-gradient-primary rounded-full shadow-lg flex items-center justify-center text-white">
        <i class="fas fa-users"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // DOM Elements
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const membersSidebar = document.getElementById('members-sidebar');
            const toggleSidebarBtn = document.getElementById('toggle-sidebar');
            const toggleMembersSidebarBtn = document.getElementById('toggle-members-sidebar');
            const floatingMembersBtn = document.getElementById('floating-members');
            const themeToggleBtn = document.getElementById('theme-toggle');
            const messageList = document.getElementById('message-list');
            const messageInput = document.getElementById('message-input');
            const sendBtn = document.getElementById('send-btn');
            const subjectButtons = document.querySelectorAll('.subject-btn');
            const subjectTitle = document.getElementById('subject-title');
            const subjectIconContainer = document.getElementById('subject-icon-container');
            const participantCountSpan = document.getElementById('participant-count');
            const typingIndicator = document.getElementById('typing-indicator');
            const typingUsersSpan = document.getElementById('typing-users');

            // Current User Data
            const currentUser = {
                name: '{{ auth()->user()->name }}',
                role: '{{ auth()->user()->role ?? "Siswa" }}',
            };

            // Sidebar Toggle Functions
            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }

            function toggleMembersSidebar() {
                membersSidebar.classList.toggle('hidden');
            }

            // Theme Toggle
            function toggleTheme() {
                document.body.classList.toggle('dark');
                const isDark = document.body.classList.contains('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                themeToggleBtn.innerHTML = isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            }

            // Load Messages Function
            async function loadMessages(forumId) {
                messageList.innerHTML = '';
                try {
                    const response = await fetch(`/api/siswa/ruang-diskusi/${forumId}/komentar`, {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token'),
                            'Accept': 'application/json',
                        },
                    });
                    if (!response.ok) throw new Error('Failed to fetch messages');
                    const messages = await response.json();

                    messages.forEach((msg, index) => {
                        setTimeout(() => {
                            const messageHtml = createMessageHTML(msg, index);
                            messageList.innerHTML += messageHtml;
                        }, index * 100);
                    });

                    setTimeout(() => {
                        messageList.scrollTop = messageList.scrollHeight;
                    }, messages.length * 100 + 200);
                } catch (error) {
                    console.error('Error fetching messages:', error);
                    showNotification('Gagal memuat pesan. Silakan coba lagi.', 'error');
                }
            }

            // Send Message Function
            async function sendMessage() {
                const messageText = messageInput.value.trim();
                const forumId = document.querySelector('.subject-btn.text-white').dataset.forumId;

                if (messageText === '' || !forumId) return;

                try {
                    const response = await fetch(`/api/siswa/ruang-diskusi/${forumId}/komentar`, {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token'),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ komentar: messageText }),
                    });

                    if (!response.ok) throw new Error('Failed to send message');

                    const newMessage = await response.json();
                    const messageHtml = createMessageHTML(newMessage, 0);
                    messageList.innerHTML += messageHtml;

                    messageInput.value = '';
                    messageList.scrollTop = messageList.scrollHeight;

                    showTypingIndicator();
                } catch (error) {
                    console.error('Error sending message:', error);
                    showNotification('Gagal mengirim pesan. Silakan coba lagi.', 'error');
                }
            }

            function createMessageHTML(msg, index) {
                const isMe = msg.isMe;
                const sender = msg.sender;
                const bubbleBg = isMe
                    ? 'bg-gradient-primary text-white shadow-lg'
                    : 'bg-white text-gray-800 shadow-md border border-gray-100 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600';
                const alignment = isMe ? 'justify-end' : 'justify-start';
                const messageAlign = isMe ? 'items-end' : 'items-start';
                const roundedClass = isMe
                    ? 'rounded-bl-lg rounded-tl-2xl rounded-tr-2xl rounded-br-2xl'
                    : 'rounded-br-lg rounded-tl-2xl rounded-tr-2xl rounded-bl-2xl';
                const marginClass = isMe ? 'ml-12' : 'mr-12';

                return `
                    <div class="message-bubble-container group ${alignment}" style="animation-delay: ${index * 100}ms">
                        <div class="flex space-x-3 ${messageAlign} ${marginClass}">
                            ${!isMe ? `
                                <div class="flex-shrink-0">
                                    <div class="relative">
                                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-600"></i>
                                        </div>
                                        <div class="online-indicator"></div>
                                    </div>
                                </div>
                            ` : ''}
                            <div class="relative max-w-xs lg:max-w-md">
                                <div class="${bubbleBg} px-4 py-3 ${roundedClass} message-bubble backdrop-blur-sm">
                                    ${!isMe ? `
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="font-semibold text-sm text-indigo-600 dark:text-indigo-400">${sender.name}</span>
                                            <span class="text-xs text-gray-400">${sender.role}</span>
                                        </div>
                                    ` : ''}
                                    <p class="text-sm leading-relaxed">${msg.text}</p>
                                </div>
                                <div class="message-time flex items-center justify-${isMe ? 'end' : 'start'} mt-1 px-1">
                                    <span class="text-xs text-gray-400">${msg.time}</span>
                                    ${isMe ? '<i class="fas fa-check-double text-xs text-blue-500 ml-2"></i>' : ''}
                                </div>
                                <div class="message-actions absolute top-1/2 -translate-y-1/2 ${isMe ? '-left-16' : '-right-16'} flex items-center space-x-2 opacity-0">
                                    <button class="p-2 bg-white dark:bg-gray-700 rounded-full shadow-lg text-gray-400 hover:text-blue-500 reply-btn transition-all hover:scale-110" data-message-id="${msg.id}">
                                        <i class="fas fa-reply text-sm"></i>
                                    </button>
                                    <button class="p-2 bg-white dark:bg-gray-700 rounded-full shadow-lg text-gray-400 hover:text-yellow-500 reaction-btn transition-all hover:scale-110" data-message-id="${msg.id}">
                                        <i class="far fa-smile text-sm"></i>
                                    </button>
                                </div>
                            </div>
                            ${isMe ? `
                                <div class="flex-shrink-0">
                                    <div class="relative">
                                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-600"></i>
                                        </div>
                                        <div class="online-indicator"></div>
                                    </div>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                `;
            }

            // Switch Subject Function
            function switchSubject(subject, forumId) {
                const subjects = {
                    'matematika-trigonometri': {
                        title: 'Matematika - Trigonometri',
                        icon: 'calculator',
                        gradient: 'bg-gradient-primary',
                        active: '85 peserta aktif',
                        hoverClass: 'hover:bg-indigo-50 hover:text-indigo-600'
                    },
                    'fisika-gerak-parabola': {
                        title: 'Fisika - Gerak Parabola',
                        icon: 'atom',
                        gradient: 'bg-gradient-secondary',
                        active: '72 peserta aktif',
                        hoverClass: 'hover:bg-red-50 hover:text-red-600'
                    },
                    'kimia-stoikiometri': {
                        title: 'Kimia - Stoikiometri',
                        icon: 'flask',
                        gradient: 'bg-gradient-success',
                        active: '68 peserta aktif',
                        hoverClass: 'hover:bg-green-50 hover:text-green-600'
                    },
                };

                const subjectData = subjects[subject] || subjects['matematika-trigonometri'];
                subjectTitle.textContent = subjectData.title;
                subjectIconContainer.innerHTML = `<i class="fas fa-${subjectData.icon} text-white text-lg"></i>`;
                subjectIconContainer.className = `w-12 h-12 rounded-xl ${subjectData.gradient} flex items-center justify-center mr-4 shadow-lg`;
                participantCountSpan.textContent = subjectData.active;

                // Update active subject button
                subjectButtons.forEach(btn => {
                    btn.className = `subject-btn group flex items-center py-3 px-4 rounded-xl text-gray-700 transition-all duration-300 hover:shadow-md ${subjects[btn.dataset.subject]?.hoverClass || 'hover:bg-indigo-50 hover:text-indigo-600'}`;
                    if (btn.dataset.subject === subject) {
                        btn.className = `subject-btn group flex items-center py-3 px-4 rounded-xl ${subjectData.gradient} text-white shadow-lg transform hover:scale-105 transition-all duration-300`;
                        btn.innerHTML = btn.innerHTML.replace('notification-dot', 'notification-dot hidden');
                    }
                });

                loadMessages(forumId);
            }

            // Show Notification
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-lg transform translate-x-full transition-all duration-300 ${
                    type === 'success' ? 'bg-green-500 text-white' : type === 'error' ? 'bg-red-500 text-white' : 'bg-blue-500 text-white'
                }`;
                notification.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} text-xl"></i>
                        <span>${message}</span>
                    </div>
                `;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                }, 100);

                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 4000);
            }

            // Show Typing Indicator
            function showTypingIndicator() {
                typingIndicator.classList.remove('hidden');
                const typingCount = Math.floor(Math.random() * 3) + 1;
                typingUsersSpan.textContent = `${typingCount} orang`;

                setTimeout(() => {
                    typingIndicator.classList.add('hidden');
                }, 3000);
            }

            // Event Listeners
            toggleSidebarBtn.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', closeSidebar);
            toggleMembersSidebarBtn.addEventListener('click', toggleMembersSidebar);
            floatingMembersBtn.addEventListener('click', toggleMembersSidebar);
            themeToggleBtn.addEventListener('click', toggleTheme);
            sendBtn.addEventListener('click', sendMessage);

            messageInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            // Auto-resize textarea
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            });

            // Subject button event listeners
            subjectButtons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const subject = btn.dataset.subject;
                    const forumId = btn.dataset.forumId;
                    switchSubject(subject, forumId);
                    if (window.innerWidth < 768) {
                        closeSidebar();
                    }
                });
            });

            // Message actions
            messageList.addEventListener('click', (e) => {
                const replyButton = e.target.closest('.reply-btn');
                if (replyButton) {
                    const messageContainer = replyButton.closest('.message-bubble-container');
                    if (messageContainer) {
                        const messageTextElem = messageContainer.querySelector('p');
                        const senderElem = messageContainer.querySelector('.font-semibold');

                        const messageText = messageTextElem ? messageTextElem.textContent.trim() : '';
                        const senderName = senderElem ? senderElem.textContent.trim() : 'Pesan';

                        const previewText = messageText.length > 50 ? messageText.substring(0, 50) + '...' : messageText;
                        messageInput.value = `💬 Membalas ${senderName}: "${previewText}"\n\n`;
                        messageInput.focus();
                    }
                }

                const reactionButton = e.target.closest('.reaction-btn');
                if (reactionButton) {
                    const reactions = ['👍', '❤️', '😊', '👏', '🔥', '💯'];
                    const randomReaction = reactions[Math.floor(Math.random() * reactions.length)];
                    showNotification(`Anda bereaksi dengan ${randomReaction}`, 'info');
                }
            });

            // Initialize theme
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark');
                themeToggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
            }

            // Periodic typing indicator
            setInterval(() => {
                if (Math.random() > 0.7) {
                    showTypingIndicator();
                }
            }, 10000);

            // Initialize everything
            switchSubject('{{ Str::slug($forum->judul) }}', {{ $forum->id }});

            // Welcome message
            setTimeout(() => {
                showNotification('Selamat datang di Forum Diskusi Sekolah Pintar! 🎓', 'success');
            }, 1000);
        });
    </script>
</body>
</html>
