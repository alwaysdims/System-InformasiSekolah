@extends('landing.layout.main')

@section('title', 'Ekstrakurikuler - SMKN 2 Karanganyar')

@section('content')

    <section id="ekstrakurikuler" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10">Ekstrakurikuler</h2>

            <!-- Grid 2 kolom -->
            <div class="grid md:grid-cols-2 gap-10">

                <!-- OSIS -->
                <div class="flex items-start gap-4 bg-gray-50 p-5 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/image/osis.webp') }}" alt="OSIS"
                            class="w-24 h-24 object-cover rounded-md">
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold">OSIS</h3>
                        <p class="mt-2 text-gray-700">
                            Organisasi Siswa Intra Sekolah SMK N 2 Karanganyar adalah organisasi yang membantu kegiatan
                            sekolah
                            dan menjadi wadah aspirasi siswa. Ada pembina, forum kerja OSIS, dan kolaborasi dengan forum
                            OSIS kabupaten / provinsi.
                        </p><br>
                        <a href="/login"
                            class="text-sm font-semibold bg-blue-500 text-white px-4 py-1 rounded-full shadow hover:bg-blue-600 transition">
                            Selengkapnya
                        </a>
                    </div>
                </div>

                <!-- PMR -->
                <div class="flex items-start gap-4 bg-gray-50 p-5 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/image/pmr.webp') }}" alt="PMR"
                            class="w-24 h-24 object-cover rounded-md">
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold">PMR</h3>
                        <p class="mt-2 text-gray-700">
                            PMR Wira SMK Negeri 2 Karanganyar membina anggota remaja PMI melalui latihan, kegiatan
                            sosial, lomba,
                            jumbara, dan lainnya untuk menanamkan jiwa relawan dan kepedulian kemanusiaan.
                        </p><br>
                        <a href="/login"
                            class="text-sm font-semibold bg-blue-500 text-white px-4 py-1 rounded-full shadow hover:bg-blue-600 transition">
                            Selengkapnya
                        </a>
                    </div>
                </div>

                <!-- Paskibra -->
                <div class="flex items-start gap-4 bg-gray-50 p-5 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/image/paskibra.webp') }}" alt="Paskibra"
                            class="w-24 h-24 object-cover rounded-md">
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold">Paskibra</h3>
                        <p class="mt-2 text-gray-700">
                            Paskibra adalah ekstrakurikuler pengibar bendera yang rutin berlatih kedisiplinan, formasi,
                            pengibaran bendera upacara, dan protokol upacara.
                        </p><br>
                        <a href="/login"
                            class="text-sm font-semibold bg-blue-500 text-white px-4 py-1 rounded-full shadow hover:bg-blue-600 transition">
                            Selengkapnya
                        </a>
                    </div>
                </div>

                <!-- Tambah lagi sampai 6 card -->
                <div class="flex items-start gap-4 bg-gray-50 p-5 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/image/ambalan.webp') }}" alt="Pramuka"
                            class="w-24 h-24 object-cover rounded-md">
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold">Ambalan</h3>
                        <p class="mt-2 text-gray-700">
                            Pramuka melatih kedisiplinan, kebersamaan, dan keterampilan lapangan melalui latihan rutin,
                            perkemahan, dan jambore.
                        </p><br>
                        <a href="/login"
                            class="text-sm font-semibold bg-blue-500 text-white px-4 py-1 rounded-full shadow hover:bg-blue-600 transition">
                            Selengkapnya
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-4 bg-gray-50 p-5 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/image/imapa.webp') }}" alt="Voli"
                            class="w-24 h-24 object-cover rounded-md">
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold">IMAPA</h3>
                        <p class="mt-2 text-gray-700">
                            Ikatan Remaja Pencinta Alam SMK N 2 Karanganyar, merupakan salah satu EkstraKulikuler yang
                            dibentuk atas dasar kecintaan dan kepedulian terhadap alam dan lingkungan hidup
                        </p><br>
                        <a href="/login"
                            class="text-sm font-semibold bg-blue-500 text-white px-4 py-1 rounded-full shadow hover:bg-blue-600 transition">
                            Selengkapnya
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-4 bg-gray-50 p-5 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/image/rohis.webp') }}" alt="Rohis"
                            class="w-24 h-24 object-cover rounded-md">
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold">Rohis</h3>
                        <p class="mt-2 text-gray-700">
                            Rohis adalah ekstrakurikuler keagamaan yang mengadakan kajian, tadarus, dan kegiatan islami
                            lainnya.
                        </p><br>
                        <a href="/login"
                            class="text-sm font-semibold bg-blue-500 text-white px-4 py-1 rounded-full shadow hover:bg-blue-600 transition">
                            Selengkapnya
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

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
