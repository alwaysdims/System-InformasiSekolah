</main>

<!-- Notification Modal -->
<div id="notificationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
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
        return function(...args) {
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
    chatInput.addEventListener('input', function() {
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
            chatLeft.classList.remove('hidden', 'fixed', 'inset-0', 'bg-white', 'z-40', '-translate-x-full');
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
            document.getElementById('profileDropdown')?.classList.add('hidden');
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
