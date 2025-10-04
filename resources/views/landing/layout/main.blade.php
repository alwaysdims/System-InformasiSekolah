<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SMKN 2 Karanganyar</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@heroicons/vue@2.0.18/24/outline"></script>

    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }

        .counter {
            transition: all 0.3s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes popUpFromLine {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.8);
            }

            50% {
                opacity: 0.6;
                transform: translateY(10px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .card-animate {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        .delay-100 {
            animation-delay: 0.2s;
        }

        .delay-200 {
            animation-delay: 0.4s;
        }

        .delay-300 {
            animation-delay: 0.6s;
        }

        .delay-400 {
            animation-delay: 0.8s;
        }

        /* animasi gambar melayang */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .card-pop {
            opacity: 0;
            transform: translateY(40px) scale(0.9);
            animation: popUpFromLine 0.8s ease forwards;
        }

        .delay-100 {
            animation-delay: 0.2s;
        }

        .delay-200 {
            animation-delay: 0.4s;
        }

        .delay-300 {
            animation-delay: 0.6s;
        }

        .card-animate {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        .delay-100 {
            animation-delay: 0.2s;
        }

        .delay-200 {
            animation-delay: 0.4s;
        }

        .delay-300 {
            animation-delay: 0.6s;
        }

    </style>

</head>

<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4 sticky top-0 z-50">
        <div class="container mx-auto px-5 lg:px-20 flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/admin/images/logo-smkn2kra.webp') }}" alt="Logo SMK Negeri 2 Karanganyar"
                    class="h-12 w-12 object-contain rounded-full" />
                <div class="flex flex-col leading-5">
                    <span class="font-extrabold text-lg text-gray-800 select-none">SMK NEGERI 2 <br>KARANGANYAR</span>
                </div>
            </div>

            <!-- Navigation Links + Buttons (Desktop) -->
            <div class="hidden md:flex items-center space-x-6">
                <ul class="flex space-x-6 font-bold text-gray-700 text-lg relative">
                    <li>
                        <a href="{{ route('landing') }}" class="block hover:text-blue-600 transition">Beranda</a>
                    </li>

                    <!-- Dropdown Profil -->
                    <li class="relative">
                        <button onclick="toggleDropdown('profilDropdown')"
                            class="flex items-center hover:text-blue-600 transition">
                            Profil ▾
                        </button>
                        <ul id="profilDropdown"
                            class="hidden absolute top-full left-0 mt-2 bg-white shadow-lg rounded-md w-56 text-sm text-gray-600 font-normal z-50">
                            <li>
                                <a href="{{ route('sambutan') }}"
                                    class="block px-6 py-3 hover:text-white hover:bg-blue-600 transition rounded-md font-semibold">
                                    Sambutan Kepala Sekolah
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profil') }}"
                                    class="block px-6 py-3 hover:text-white hover:bg-blue-600 transition rounded-md font-semibold">
                                    Profil Sekolah
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sejarah') }}"
                                    class="block px-6 py-3 hover:text-white hover:bg-blue-600 transition rounded-md font-semibold">
                                    Sejarah Sekolah
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ekstrakulikuler') }}"
                                    class="block px-6 py-3 hover:text-white hover:bg-blue-600 transition rounded-md font-semibold">
                                    Ekstrakulikuler
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Dropdown Artikel -->
                    <li class="relative">
                        <button onclick="toggleDropdown('artikelDropdown')"
                            class="flex items-center hover:text-blue-600 transition">
                            Artikel ▾
                        </button>
                        <ul id="artikelDropdown"
                            class="hidden absolute top-full left-0 mt-2 bg-white shadow-lg rounded-md w-56 text-sm text-gray-600 font-normal z-50">
                            <li>
                                <a href="{{ route('artikel') }}"
                                    class="block px-6 py-3 hover:text-white hover:bg-blue-600 transition rounded-md font-semibold">
                                    Artikel Sejarah
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bkk') }}"
                                    class="block px-6 py-3 hover:text-white hover:bg-blue-600 transition rounded-md font-semibold">
                                    Bursa Kerja Khusus
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 border-2 border-blue-600 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white hover:scale-105 transform transition duration-300 shadow-md font-extrabold">
                        Login
                    </a>
                </div>
            </div>
            <!-- Mobile Toggle -->
            <button id="navbar-toggle" class="md:hidden focus:outline-none text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu with Transition -->
        <div id="mobile-menu"
            class="transition-all duration-300 ease-in-out overflow-hidden max-h-0 md:hidden bg-white px-5">
            <ul class="flex flex-col py-3 space-y-3 font-bold text-gray-700 text-lg relative">

                <li>
                    <a href="#home" class="block hover:text-blue-600 transition">Beranda</a>
                </li>

                <li class="group relative">
                    <a href="#profil" class="block hover:text-blue-600 transition">Profil ▾</a>
                    <ul
                        class="hidden group-hover:flex flex-col absolute left-0 mt-2 bg-white shadow-lg rounded-md w-48 text-sm text-gray-600 font-normal z-50">
                        <li><a href="{{ route('profil') }}" class="px-4 py-2 hover:bg-blue-100">Profil Sekolah</a></li>
                        <li><a href="#struktur" class="px-4 py-2 hover:bg-blue-100">Struktur Organisasi</a></li>
                        <li><a href="#guru" class="px-4 py-2 hover:bg-blue-100">Data Guru</a></li>
                    </ul>
                </li>

                <li class="group relative">
                    <a href="#artikel" class="block hover:text-blue-600 transition">Artikel ▾</a>
                    <ul
                        class="hidden group-hover:flex flex-col absolute left-0 mt-2 bg-white shadow-lg rounded-md w-48 text-sm text-gray-600 font-normal z-50">
                        <li><a href="#berita" class="px-4 py-2 hover:bg-blue-100">Berita</a></li>
                        <li><a href="#pengumuman" class="px-4 py-2 hover:bg-blue-100">Pengumuman</a></li>
                        <li><a href="#agenda" class="px-4 py-2 hover:bg-blue-100">Agenda</a></li>
                    </ul>
                </li>

                <li>
                    <div class="flex flex-col gap-2 mt-2">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 w-auto bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-full hover:scale-105 transform transition duration-300 shadow-md text-center font-extrabold">
                            Login
                        </a>
                    </div>
                </li>
            </ul>

        </div>
    </nav>

    @yield('content')

    <!-- Footer Section -->
    <footer class="bg-blue-600 text-white mt-auto rounded-t-3xl">
        <div class="container mx-auto px-5 lg:px-10 py-12 grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <h3 class="font-semibold text-xl text-white mb-4">Lokasi Sekolah</h3>
                <div class="overflow-hidden rounded-lg shadow-lg mb-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126548.37462387834!2d110.84279492421925!3d-7.614450917054266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e654b99ab219bfd%3A0x4e63f4d5cebe448a!2sSMK%20Negeri%202%20Karanganyar!5e0!3m2!1sid!2sid!4v1752927749666!5m2!1sid!2sid"
                        class="w-full h-48 md:h-52 border-0" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div>
                <h3 class="font-semibold text-xl text-white mb-4">Kontak</h3>
                <address class="not-italic space-y-2 text-white">
                    <p>Jl. Yos Sudarso, Jengglong, Bejen, Kec. Karanganyar, Kabupaten Karanganyar, Jawa Tengah 57716</p>
                    <p>Email: <a href="mailto:info@smkn2karanganyar.sch.id"
                            class="hover:text-blue-200 transition">info@smkn2karanganyar.sch.id</a></p>
                    <p>Telp: (0271) 123456</p>
                    <p>Fax: (0271) 654321</p>
                </address>
            </div>
            <div>
                <h3 class="font-semibold text-xl text-white mb-4">Tentang SMKN 2 Karanganyar</h3>
                <p class="text-white leading-relaxed">
                    SMK Negeri 2 Karanganyar adalah sekolah menengah kejuruan yang berfokus pada pendidikan vokasi
                    berkualitas,
                    menyiapkan lulusan siap kerja dan berkompeten di bidangnya.
                </p>
            </div>
        </div>

        <div class="border-t border-blue-300 text-center py-6 text-sm text-blue-100">
            © 2025 SMKN 2 Karanganyar - <br> Pengaduan Masyarakat. skanda.dev
        </div>
    </footer>

    <!-- AOS (Animate On Scroll) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

    </script>

    <script>
        const profilBtn = document.getElementById('profilBtn');
        const profilDropdown = document.getElementById('profilDropdown');

        profilBtn.addEventListener('click', () => {
            const isHidden = profilDropdown.classList.contains('hidden');
            if (isHidden) {
                profilDropdown.classList.remove('hidden');
                profilBtn.setAttribute('aria-expanded', 'true');
            } else {
                profilDropdown.classList.add('hidden');
                profilBtn.setAttribute('aria-expanded', 'false');
            }
        });

        // Optional: Klik di luar dropdown untuk menutup
        document.addEventListener('click', (event) => {
            if (!profilBtn.contains(event.target) && !profilDropdown.contains(event.target)) {
                profilDropdown.classList.add('hidden');
                profilBtn.setAttribute('aria-expanded', 'false');
            }
        });
        // Toggle Mobile Menu
        const toggleBtn = document.getElementById('navbar-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        toggleBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('max-h-0');
            mobileMenu.classList.toggle('max-h-[500px]');
        });

        function animateCounter(counter) {
            const target = +counter.getAttribute('data-target');
            const speed = 200;
            const increment = Math.ceil(target / speed);
            let current = 0;

            const update = () => {
                current += increment;
                if (current < target) {
                    counter.innerText = current;
                    requestAnimationFrame(update);
                } else {
                    counter.innerText = target;
                }
            };

            if (!counter.classList.contains('counted')) {
                counter.classList.add('counted');
                update();
            }
        }

        // Buat observer untuk hanya menjalankan animasi saat elemen terlihat
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                    }
                });
            }, {
                threshold: 0.6
            }
        );

        // Ambil semua elemen counter dan observasi
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => observer.observe(counter));
        });
        // Toggle Dropdown FAQ
        function toggleDropdown(faqId) {
            const content = document.getElementById(faqId);
            const icon = document.getElementById(faqId + '-icon');

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        // Ganti Konten Utama dari Kartu (detail aduan)
        function updateMainCard(card) {
            const title = card.getAttribute('data-title');
            const desc = card.getAttribute('data-description');
            const img = card.getAttribute('data-image');
            const date = card.getAttribute('data-date');
            const status = card.getAttribute('data-status');
            const statusColor = card.getAttribute('data-status-color');
            const detailLink = card.getAttribute('data-detail');

            document.getElementById('main-title').textContent = title;
            document.getElementById('main-description').textContent = desc;
            document.getElementById('main-image').src = img;
            document.getElementById('main-date').textContent = date;
            document.getElementById('main-detail-link').href = detailLink;

            const statusElem = document.getElementById('main-status');
            statusElem.textContent = status;
            statusElem.className = 'text-sm px-3 py-1 rounded-full text-xs font-semibold ' + statusColor;

            const mainCard = document.getElementById('main-card');
            mainCard.classList.remove('animate-fadeIn');
            void mainCard.offsetWidth; // Force reflow
            mainCard.classList.add('animate-fadeIn');
        }

        function toggleDropdown(id) {
            const dropdowns = document.querySelectorAll("ul[id$='Dropdown']");

            dropdowns.forEach(dropdown => {
                if (dropdown.id === id) {
                    dropdown.classList.toggle("hidden");
                } else {
                    dropdown.classList.add("hidden");
                }
            });
        }

        // Klik di luar menu -> tutup semua
        document.addEventListener("click", function (e) {
            const isDropdownButton = e.target.closest("button");
            const isDropdownMenu = e.target.closest("ul[id$='Dropdown']");
            if (!isDropdownButton && !isDropdownMenu) {
                document.querySelectorAll("ul[id$='Dropdown']").forEach(d => d.classList.add("hidden"));
            }
        });

    </script>

</body>

</html>
