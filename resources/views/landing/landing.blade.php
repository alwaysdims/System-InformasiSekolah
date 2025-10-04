@extends('landing.layout.main')

@section('title', 'Landing - SMKN 2 Karanganyar')

@section('content')

    <!-- Home Section -->
    <section id="home" class="relative bg-gradient-to-b from-blue-50 to-white py-16 px-6 lg:px-20">
        <div class="container mx-auto flex flex-col-reverse md:flex-row items-center gap-12">

            <!-- Text Content -->
            <div class="flex-1 space-y-6 text-center md:text-left" data-aos="fade-right">
                <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight text-gray-800">
                    Selamat Datang di <span class="text-blue-600"><br>SMK Negeri 2 Karanganyar</span>
                </h1>
                <p class="text-lg text-gray-600 max-w-xl mx-auto md:mx-0 leading-relaxed">
                    Mewujudkan pelajar yang <b>berprestasi</b>, <b>berkarakter</b>,
                    <b>berakhlak sopan santun</b>, dan <b>lulusan siap kerja</b>
                    dengan kompetensi unggul.
                </p>
                <div class="flex justify-center md:justify-start gap-4">
                    <a href="{{ route('login') }}">
                        <button
                            class="px-6 py-3 text-lg font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full shadow-lg hover:scale-105 transform transition duration-300">
                            Adukan Masalah
                        </button>
                    </a>
                    <a href="{{ route('profil') }}">
                        <button
                            class="px-6 py-3 text-lg font-semibold border-2 border-blue-600 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition duration-300">
                            Lihat Profil
                        </button>
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="flex justify-center items-center py-10 relative">
                <!-- Glow belakang -->
                <div class="absolute w-96 h-96 bg-gradient-to-tr from-blue-200 via-indigo-200 to-white 
                    rounded-full blur-3xl opacity-50"></div>

                <!-- Gambar utama -->
                <img src="{{ asset('assets/image/kejuruan2.png') }}" alt="Program Kejuruan SMK Negeri 2 Karanganyar"
                    class="relative z-10 w-full max-w-7xl object-contain drop-shadow-2xl animate-float ml-[-80px]"
                    onerror="this.onerror=null;this.src='https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/15a53732-4230-439b-aaf5-4a53e6388bab.png';" />
            </div>
        </div>
    </section>

    <section id="elearning" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-20 text-center">

            <!-- Judul -->
            <h1 class="text-3xl font-bold text-gray-800 inline-block relative pb-2">
                E-Learning
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-12">
                Tingkatkan wawasan dan pengetahuan dengan materi pembelajaran digital.
                Akses buku mata pelajaran secara mudah dan praktis di mana saja.
            </p>

            <!-- Card Buku -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Card 1 - Matematika -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135706.png" alt="Buku Matematika"
                        class="w-full h-56 object-contain bg-gray-100 p-6">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Matematika</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Buku ini membahas konsep dasar hingga lanjutan matematika untuk mendukung pemahaman logika
                            dan perhitungan.
                        </p><br>
                        <a href="{{ route('login') }}">
                            <button
                                class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-md hover:scale-105 transform transition duration-300">
                                Baca Selengkapnya
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Card 2 - Bahasa Indonesia -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135692.png" alt="Buku Bahasa Indonesia"
                        class="w-full h-56 object-contain bg-gray-100 p-6">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Bahasa Indonesia</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Materi pelajaran bahasa Indonesia untuk melatih keterampilan membaca, menulis, dan memahami
                            teks.
                        </p><br>
                        <a href="{{ route('login') }}">
                            <button
                                class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-md hover:scale-105 transform transition duration-300">
                                Baca Selengkapnya
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Card 3 - Bahasa Inggris -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Buku Bahasa Inggris"
                        class="w-full h-56 object-contain bg-gray-100 p-6">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Bahasa Inggris</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Buku panduan bahasa Inggris untuk meningkatkan kemampuan komunikasi global siswa.
                        </p><br>
                        <a href="{{ route('login') }}">
                            <button
                                class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-md hover:scale-105 transform transition duration-300">
                                Baca Selengkapnya
                            </button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-gradient-to-r from-gray-50 to-blue-50 py-20" id="forum">
        <div class="max-w-6xl mx-auto px-6 text-center">

            <!-- Judul -->
            <h2 class="text-4xl font-extrabold text-gray-800 relative inline-block">
                Forum Diskusi
                <span class="block w-20 h-1 bg-blue-600 mx-auto mt-3 rounded-full"></span>
            </h2>
            <p class="mt-5 text-lg text-gray-600 max-w-2xl mx-auto">
                Temukan jawaban, bagikan pengalaman, dan terhubung dengan ribuan pengguna aktif setiap hari.
            </p>

            <!-- Konten List -->
            <div class="mt-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-3">

                <!-- Item 1 -->
                <div
                    class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-8 flex flex-col items-center text-center space-y-4 transition duration-300 transform hover:-translate-y-2">
                    <div
                        class="bg-red-100 text-red-600 p-5 rounded-full group-hover:bg-red-500 group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 11V9a4 4 0 118 0v2h1a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2h1" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Topik Terpopuler</h3>
                    <p class="text-gray-600">Persiapan ujian lebih seru kalau bareng, ayo gabung diskusi sekarang!</p>
                    <span class="text-sm font-semibold bg-red-500 text-white px-4 py-1 rounded-full shadow">
                        120 Balasan
                    </span>
                </div>

                <!-- Item 2 -->
                <div
                    class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-8 flex flex-col items-center text-center space-y-4 transition duration-300 transform hover:-translate-y-2">
                    <div
                        class="bg-blue-100 text-blue-600 p-5 rounded-full group-hover:bg-blue-500 group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 9h16M4 15h16" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Diskusi Baru</h3>
                    <p class="text-gray-600">Ayo gabung, diskusi update terbaru bareng komunitas!</p>
                    <span class="text-sm font-semibold bg-blue-500 text-white px-4 py-1 rounded-full shadow">
                        45 Balasan
                    </span>
                </div>

                <!-- Item 3 -->
                <div
                    class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-8 flex flex-col items-center text-center space-y-4 transition duration-300 transform hover:-translate-y-2">
                    <div
                        class="bg-green-100 text-green-600 p-5 rounded-full group-hover:bg-green-500 group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5V10H2v10h5m10 0V10m0 10a2 2 0 11-4 0m0-10a2 2 0 114 0" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Komunitas Aktif</h3>
                    <p class="text-gray-600">Bergabung dengan ribuan pengguna aktif setiap harinya.</p>
                    <span class="text-sm font-semibold bg-green-500 text-white px-4 py-1 rounded-full shadow">
                        1200 Anggota
                    </span>
                </div>
            </div>

            <!-- Tombol -->
            <a href="{{ route('login') }}"
                class="mt-16 inline-flex items-center gap-3 bg-blue-600 text-white font-semibold px-10 py-4 rounded-full shadow-lg hover:bg-blue-700 hover:shadow-xl transform hover:-translate-y-1 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
                Masuk Sekarang
            </a>
        </div>
    </section>


    <section class="px-6 py-12 lg:px-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-20">
            <div class="text-center mb-10" data-aos="fade-down">
                <h2 class="text-3xl font-bold text-gray-800 inline-block relative pb-2">
                    Statistik Sekolah
                    <span
                        class="absolute left-1/2 -bottom-1 transform -translate-x-1/2 w-16 h-1 bg-blue-500 rounded"></span>
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Card 1 - Mapel -->
                <div class="card-pop delay-100 bg-white rounded-3xl shadow-xl border border-gray-200 hover:border-blue-500 hover:shadow-2xl transition-all duration-500 group transform hover:-translate-y-2"
                    data-aos="fade-right" data-aos-delay="100" data-aos-duration="800">
                    <div class="flex flex-col items-center text-center p-8 space-y-4">
                        <div
                            class="w-20 h-20 flex items-center justify-center rounded-full bg-gradient-to-tr from-blue-400 to-blue-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 20h9M16.5 3.5l4 4-11 11H5.5v-4l11-11z" />
                            </svg>
                        </div>
                        <div>
                            <div class="counter text-6xl md:text-7xl font-black text-blue-600"
                                {{-- data-target="{{ $jumlah_mapel }}" --}}
                                >0</div>
                            <p class="mt-2 text-lg font-semibold text-gray-700 uppercase tracking-wide">
                                Mata Pelajaran
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 - Siswa -->
                <div class="card-pop delay-100 bg-white rounded-3xl shadow-xl border border-gray-200 hover:border-green-500 hover:shadow-2xl transition-all duration-500 group transform hover:-translate-y-2"
                    data-aos="fade-right" data-aos-delay="200" data-aos-duration="800">
                    <div class="flex flex-col items-center text-center p-8 space-y-4">
                        <div
                            class="w-20 h-20 flex items-center justify-center rounded-full bg-gradient-to-tr from-green-400 to-green-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m4-4a4 4 0 110-8 4 4 0 010 8zm6 4a4 4 0 10-8 0 4 4 0 008 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="counter text-6xl md:text-7xl font-black text-green-600"
                                {{-- data-target="{{ $jumlah_siswa }}" --}}
                                >0</div>
                            <p class="mt-2 text-lg font-semibold text-gray-700 uppercase tracking-wide">
                                Jumlah Siswa
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="card-pop delay-100 bg-white rounded-3xl shadow-xl border border-gray-200 hover:border-indigo-500 hover:shadow-2xl transition-all duration-500 group transform hover:-translate-y-2"
                    data-aos="fade-right" data-aos-delay="300" data-aos-duration="800">

                    <div class="flex flex-col items-center text-center p-8 space-y-4">
                        <div
                            class="w-20 h-20 flex items-center justify-center rounded-full bg-gradient-to-tr from-indigo-400 to-indigo-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 14v-4a4 4 0 118 0v4M6 20h12M4 20v-2a4 4 0 014-4h8a4 4 0 014 4v2" />
                            </svg>
                        </div>
                        <div>
                            <div class="counter text-6xl md:text-7xl font-black text-indigo-600"
                                {{-- data-target="{{ $jumlah_guru }}"--}}
                                >0</div> 
                            <p class="mt-2 text-lg font-semibold text-gray-700 uppercase tracking-wide">
                                Jumlah Guru
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 px-6 bg-white">
        <div class="text-center mb-10" data-aos="fade-down">
            <h2 class="text-3xl font-bold text-gray-800 inline-block relative pb-2">
                Kompetensi Keahlian
                <span
                    class="absolute left-1/2 -bottom-1 transform -translate-x-1/2 w-16 h-1 bg-blue-500 rounded"></span>
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 max-w-7xl mx-auto ">
            <!-- Teknik Pemesinan -->
            <div id="main-card"
                class="card-animate delay-100 bg-blue-500/90 backdrop-blur-lg rounded-3xl shadow-xl p-8 flex flex-col items-center text-center border border-white/20 hover:shadow-blue-500/40 hover:-translate-y-3 transition-all duration-500"
                data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/image/3d-mesin.webp') }}" alt="Mesin"
                    class="w-32 h-32 mb-6 drop-shadow-xl animate-float">
                <h3 class="text-2xl font-bold text-white">Teknik Pemesinan</h3>
            </div>

            <!-- Teknik Pembuatan Kain -->
            <div id="main-card"
                class="card-animate delay-200 bg-yellow-400/90 backdrop-blur-lg rounded-3xl shadow-xl p-8 flex flex-col items-center text-center border border-white/20 hover:shadow-yellow-500/40 hover:-translate-y-3 transition-all duration-500"
                data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/image/3d-tekstil.webp') }}" alt="Kain"
                    class="w-32 h-32 mb-6 drop-shadow-xl animate-float">
                <h3 class="text-2xl font-bold text-white">Teknik Pembuatan Kain</h3>
            </div>

            <!-- Teknik Ototronik -->
            <div id="main-card"
                class="card-animate delay-300 bg-red-400/90 backdrop-blur-lg rounded-3xl shadow-xl p-8 flex flex-col items-center text-center border border-white/20 hover:shadow-red-500/40 hover:-translate-y-3 transition-all duration-500"
                data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('assets/image/3d-oto.webp') }}" alt="Ototronik"
                    class="w-32 h-32 mb-6 drop-shadow-xl animate-float">
                <h3 class="text-2xl font-bold text-white">Teknik Ototronik</h3>
            </div>

            <!-- Rekayasa Perangkat Lunak -->
            <div id="main-card"
                class="card-animate delay-400 bg-green-500/90 backdrop-blur-lg rounded-3xl shadow-xl p-8 flex flex-col items-center text-center border border-white/20 hover:shadow-green-500/40 hover:-translate-y-3 transition-all duration-500"
                data-aos="fade-up" data-aos-delay="400">
                <img src="{{ asset('assets/image/3d-rpl.webp') }}" alt="RPL"
                    class="w-32 h-32 mb-6 drop-shadow-xl animate-float">
                <h3 class="text-2xl font-bold text-white">Rekayasa Perangkat Lunak</h3>
            </div>
        </div>
    </section>

    <section class="px-6 py-12 lg:px-20 bg-white">
        <div class="text-center mb-10" data-aos="fade-down">
            <p class="text-sm text-blue-500 font-semibold uppercase">Aduan Terbaru</p>
            <h2 class="text-3xl font-bold text-gray-800">Cek Pengaduan <span class="text-blue-500">Terbaru</span></h2>
        </div>

        <div class="grid lg:grid-cols-3 gap-10 items-start">
            <!-- Kartu utama besar (kiri) -->
            <article id="main-card"
                class="lg:col-span-2 bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row"
                data-aos="fade-right" data-aos-delay="100">
                <img id="main-image" src="assets/image/kantin.jpg" alt="Ilustrasi Aduan"
                    class="w-full md:w-1/2 h-60 md:h-auto object-cover">
                <div class="p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span id="main-status"
                                class=" bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">Selesai</span>
                            <span id="main-date" class="text-sm text-gray-500">18 Juli 2024</span>
                        </div>
                        <h3 id="main-title" class="text-lg font-semibold text-gray-800 mb-2">
                            Harga makanan di kantin sekolah tidak konsisten
                        </h3>
                        <p id="main-description" class="text-gray-600 text-sm mb-4">
                            Beberapa siswa mengeluhkan harga yang terlalu mahal tanpa daftar harga yang jelas. Hal ini
                            menyebabkan kebingungan dan ketidaknyamanan dalam membeli makanan saat istirahat.
                        </p>
                    </div>
                    <div class="flex items-center justify-between mt-2 pt-3 border-t border-gray-200">
                        <div class="flex items-center space-x-2">
                            <img src="https://placehold.co/32x32" alt="User" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm font-medium text-gray-700">A*** P*******</span>
                        </div>
                        <a id="main-detail-link" href="detail.html" class="relative inline-flex items-center justify-center px-4 py-1.5 overflow-hidden
                    text-sm font-medium text-blue-600 transition duration-300 ease-out border-2 border-blue-600
                    rounded-full group hover:text-white">

                            <span class="absolute left-0 top-0 w-full h-full bg-blue-600 
                          transition-transform duration-300 ease-out transform scale-x-0 
                          origin-left group-hover:scale-x-100 rounded-full z-0">
                            </span>

                            <span class="relative z-10">Detail</span>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Daftar kartu mini (kanan) -->
            <div class="space-y-6">

                <a href="detail1.html" class="block">
                    <article onclick="updateMainCard(this)"
                        class="flex bg-white shadow-2xl rounded-2xl p-2 space-x-4 cursor-pointer" data-aos="fade-left"
                        data-aos-delay="200" data-title="Banyak komputer di lab TIK rusak dan lambat"
                        data-description="Kegiatan praktik terganggu dan tidak efektif."
                        data-image="assets/image/Sejarah.webp" data-date="12 Juli 2024" data-status="Pending"
                        data-status-color="bg-yellow-100 text-yellow-800" data-detail="detail1.html">
                        <img src="assets/image/labkomputer.webp" alt="Gambar" class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span
                                    class="text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded-full font-semibold">Pending</span>
                                <span class="text-xs text-gray-500">12 Juli 2024</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-800">Banyak komputer di lab TIK rusak dan lambat
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">Kegiatan praktik terganggu dan tidak efektif.</p>
                        </div>
                    </article>
                </a>

                <a href="detail2.html" class="block">
                    <article onclick="updateMainCard(this)"
                        class="flex bg-white shadow-2xl rounded-2xl p-2 space-x-4 cursor-pointer" data-aos="fade-left"
                        data-aos-delay="300" data-title="Kondisi toilet kotor dan tidak ada air"
                        data-description="Toilet tidak nyaman bagi siswa perempuan."
                        data-image="assets/image/Sejarah.webp" data-date="8 Juli 2024" data-status="Proses"
                        data-status-color="bg-green-100 text-green-800" data-detail="detail2.html">
                        <img src="assets/image/toilet.jpg" alt="Gambar" class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span
                                    class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full font-semibold">Proses</span>
                                <span class="text-xs text-gray-500">8 Juli 2024</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-800">Kondisi toilet kotor dan tidak ada air</h4>
                            <p class="text-xs text-gray-500 mt-1">Toilet tidak nyaman bagi siswa perempuan.</p>
                        </div>
                    </article>
                </a>

                <a href="detail3.html" class="block">
                    <article onclick="updateMainCard(this)"
                        class="flex bg-white shadow-2xl rounded-2xl p-2 space-x-4 cursor-pointer" data-aos="fade-left"
                        data-aos-delay="400" data-title="Jalan berlubang dekat asrama siswa"
                        data-description="Membahayakan siswa saat pergi dan pulang sekolah."
                        data-image="assets/image/Sejarah.webp" data-date="5 Juli 2024" data-status="Selesai"
                        data-status-color="bg-blue-100 text-blue-800" data-detail="detail3.html">
                        <img src="assets/image/jalan.jpg" alt="Gambar" class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span
                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full font-semibold">Selesai</span>
                                <span class="text-xs text-gray-500">5 Juli 2024</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-800">Jalan berlubang dekat asrama siswa</h4>
                            <p class="text-xs text-gray-500 mt-1">Membahayakan siswa saat pergi dan pulang sekolah.</p>
                        </div>
                    </article>
                </a>

            </div>
        </div>
    </section>

    <!-- Faq -->
    <section id="fag" class="bg-gray-50 py-12 px-6 lg:px-24">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-blue-700 mb-10" data-aos="fade-up">Frequently Asked Questions
                (FAQ)</h2>

            <!-- FAQ Item -->
            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-lg shadow transition duration-300" data-aos="fade-up">
                    <button
                        class="flex justify-between items-center w-full p-6 text-left text-lg font-semibold text-gray-800 hover:bg-gray-100 focus:outline-none"
                        onclick="toggleDropdown('faq1')">
                        Apa itu Aplikasi Pengaduan Masyarakat SMKN 2 Karanganyar?
                        <svg class="w-6 h-6 transform transition-transform duration-200" id="faq1-icon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq1" class="hidden p-6 text-gray-600">
                        Aplikasi ini adalah sistem digital yang disediakan sekolah untuk menerima dan menindaklanjuti
                        pengaduan dari
                        warga sekolah atau masyarakat sekitar.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-lg shadow transition duration-300" data-aos="fade-up">
                    <button
                        class="flex justify-between items-center w-full p-6 text-left text-lg font-semibold text-gray-800 hover:bg-gray-100 focus:outline-none"
                        onclick="toggleDropdown('faq2')">
                        Siapa saja yang boleh membuat pengaduan?
                        <svg class="w-6 h-6 transform transition-transform duration-200" id="faq2-icon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq2" class="hidden p-6 text-gray-600">
                        Pengaduan dapat dikirim oleh siswa, guru, wali murid, maupun masyarakat umum yang terhubung
                        dengan
                        lingkungan sekolah.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-lg shadow transition duration-300" data-aos="fade-up">
                    <button
                        class="flex justify-between items-center w-full p-6 text-left text-lg font-semibold text-gray-800 hover:bg-gray-100 focus:outline-none"
                        onclick="toggleDropdown('faq3')">
                        Apakah saya bisa membuat laporan secara anonim?
                        <svg class="w-6 h-6 transform transition-transform duration-200" id="faq3-icon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq3" class="hidden p-6 text-gray-600">
                        Ya. Anda bisa memilih opsi anonim saat mengisi laporan. Identitas Anda tidak akan ditampilkan ke
                        publik.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-white rounded-lg shadow transition duration-300" data-aos="fade-up">
                    <button
                        class="flex justify-between items-center w-full p-6 text-left text-lg font-semibold text-gray-800 hover:bg-gray-100 focus:outline-none"
                        onclick="toggleDropdown('faq4')">
                        Bagaimana cara mengetahui status laporan saya?
                        <svg class="w-6 h-6 transform transition-transform duration-200" id="faq4-icon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq4" class="hidden p-6 text-gray-600">
                        Gunakan fitur <strong>Riwayat Laporan</strong> untuk memantau status laporan Anda secara
                        real-time.
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="bg-white rounded-lg shadow transition duration-300" data-aos="fade-up">
                    <button
                        class="flex justify-between items-center w-full p-6 text-left text-lg font-semibold text-gray-800 hover:bg-gray-100 focus:outline-none"
                        onclick="toggleDropdown('faq5')">
                        Berapa lama laporan saya akan ditangani?
                        <svg class="w-6 h-6 transform transition-transform duration-200" id="faq5-icon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq5" class="hidden p-6 text-gray-600">
                        Tergantung tingkat urgensinya. Umumnya laporan akan ditanggapi dalam 1–3 hari kerja.
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="bg-white rounded-lg shadow transition duration-300" data-aos="fade-up">
                    <button
                        class="flex justify-between items-center w-full p-6 text-left text-lg font-semibold text-gray-800 hover:bg-gray-100 focus:outline-none"
                        onclick="toggleDropdown('faq6')">
                        Apa sanksi jika saya mengirim laporan palsu?
                        <svg class="w-6 h-6 transform transition-transform duration-200" id="faq6-icon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="faq6" class="hidden p-6 text-gray-600">
                        Pengguna yang mengirimkan laporan palsu atau tidak bertanggung jawab dapat dikenai peringatan
                        hingga sanksi
                        dari pihak sekolah.
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
