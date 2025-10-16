@extends('landing.layout.main')

@section('title', 'Profil - SMKN 2 Karanganyar')

@section('content')

    <!-- PROFIL SEKOLAH -->
    <section id="profil" class="py-16 bg-gradient-to-b from-blue-50 to-white">
        <div class="container mx-auto px-6 lg:px-20">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Profil Sekolah</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <!-- Tabel Profil -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    
                    <!-- Isi Tabel -->
                    <table class="w-full text-sm text-gray-700">
                        <tbody>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium w-44">NPSN</td>
                                <td class="px-6 py-3">20312071</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">NSS</td>
                                <td class="px-6 py-3">321031509009</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Nama</td>
                                <td class="px-6 py-3">SMK (STM) N 2 KARANGANYAR</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Akreditasi</td>
                                <td class="px-6 py-3">A</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Alamat</td>
                                <td class="px-6 py-3">JL. YOS SUDARSO, JENGGLONG</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Kode Pos</td>
                                <td class="px-6 py-3">57716</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Nomor Telepon</td>
                                <td class="px-6 py-3">0271-495496 / 495475-494071-1</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Nomor Faks</td>
                                <td class="px-6 py-3">0271495491</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Email</td>
                                <td class="px-6 py-3">smkn2kra@yahoo.co.id</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Jenjang</td>
                                <td class="px-6 py-3">SMK</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Status</td>
                                <td class="px-6 py-3">Negeri</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Lintang</td>
                                <td class="px-6 py-3">-7.595621864865226</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Bujur</td>
                                <td class="px-6 py-3">110.95017337125405</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Ketinggian</td>
                                <td class="px-6 py-3">156 mdpl</td>
                            </tr>
                            <tr class="hover:bg-blue-50/50 transition">
                                <td class="px-6 py-3 font-medium">Waktu Belajar</td>
                                <td class="px-6 py-3">Pagi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Gambar Ilustrasi -->
                <div class="flex justify-center mt-[-60px]">
                    <img src="{{ asset('assets/image/smkn2kra.png') }}" alt="Profil Sekolah"
                        class="w-96 md:w-[28rem] object-contain drop-shadow-2xl animate-fadeIn">
                </div>                
            </div>
        </div>
    </section>


    <section id="visi-misi" class="py-16 bg-white">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-2xl font-bold">Visi dan Misi</h2>
            </div>

            <div class="mt-8 bg-blue-50 p-8 rounded-2xl shadow">
                <h3 class="text-lg font-semibold">Visi</h3>
                <p class="mt-2 text-gray-700">
                    Terwujudnya Peserta Didik yang Bertaqwa, Berkarakter Unggul, Berprestasi, Berwawasan Global dan
                    Berbudaya Lingkungan
                </p>

                <h3 class="mt-6 text-lg font-semibold">Misi</h3>
                <ol class="mt-2 text-gray-700 list-decimal list-inside space-y-1">
                    <li>Menanamkan keimanan dan ketakwaan kepada Tuhan YME</li>
                    <li>Mewujudkan Profil Pelajar Pancasila</li>
                    <li>Menyelenggarakan Pendidikan dan Pelatihan Yang Berkualitas, Berwawasan Global dan Berbudaya
                        Lingkungan</li>
                </ol>
            </div>
        </div>
    </section>


    {{-- <!-- FASILITAS -->
    <section id="fasilitas" class="py-16 bg-white">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Fasilitas</h2>
                    <p class="mt-2 text-gray-600">Fasilitas penunjang proses belajar mengajar.</p>
                </div>
                <a href="#" class="text-blue-600 hover:underline text-sm">Lihat semua fasilitas</a>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- contoh fasilitas -->
                <div class="p-5 bg-gray-50 rounded-lg text-center">
                    <img src="https://via.placeholder.com/120x80.png?text=Lab" alt="Lab"
                        class="mx-auto rounded-md mb-3">
                    <h4 class="font-semibold">Laboratorium</h4>
                </div>
                <div class="p-5 bg-gray-50 rounded-lg text-center">
                    <img src="https://via.placeholder.com/120x80.png?text=Bengkel" alt="Bengkel"
                        class="mx-auto rounded-md mb-3">
                    <h4 class="font-semibold">Bengkel Praktik</h4>
                </div>
                <div class="p-5 bg-gray-50 rounded-lg text-center">
                    <img src="https://via.placeholder.com/120x80.png?text=Perpustakaan" alt="Perpustakaan"
                        class="mx-auto rounded-md mb-3">
                    <h4 class="font-semibold">Perpustakaan</h4>
                </div>
                <div class="p-5 bg-gray-50 rounded-lg text-center">
                    <img src="https://via.placeholder.com/120x80.png?text=Olahraga" alt="Olahraga"
                        class="mx-auto rounded-md mb-3">
                    <h4 class="font-semibold">Lapangan & Olahraga</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- GURU / TENAGA PENDIDIK -->
    <section id="guru" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="text-center">
                <h2 class="text-2xl font-bold">Tenaga Pendidik & Staf</h2>
                <p class="mt-2 text-gray-600">Guru profesional dan staf pendukung yang berpengalaman.</p>
            </div>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <!-- contoh guru -->
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <img src="https://via.placeholder.com/160x160.png?text=Guru+1" alt="Guru"
                        class="mx-auto rounded-full mb-4 object-cover">
                    <h4 class="font-semibold">Nama Guru</h4>
                    <p class="text-sm text-gray-500">Waka Kurikulum</p>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <img src="https://via.placeholder.com/160x160.png?text=Guru+2" alt="Guru"
                        class="mx-auto rounded-full mb-4 object-cover">
                    <h4 class="font-semibold">Nama Guru</h4>
                    <p class="text-sm text-gray-500">Kepala Laboratorium</p>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <img src="https://via.placeholder.com/160x160.png?text=Guru+3" alt="Guru"
                        class="mx-auto rounded-full mb-4 object-cover">
                    <h4 class="font-semibold">Nama Guru</h4>
                    <p class="text-sm text-gray-500">Guru Praktek</p>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <img src="https://via.placeholder.com/160x160.png?text=Guru+4" alt="Guru"
                        class="mx-auto rounded-full mb-4 object-cover">
                    <h4 class="font-semibold">Nama Guru</h4>
                    <p class="text-sm text-gray-500">Staf Administrasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KEGIATAN & PRESTASI -->
    <section id="kegiatan" class="py-16 bg-white">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Kegiatan & Prestasi</h2>
                    <p class="mt-2 text-gray-600">Kegiatan ekstrakurikuler, kompetisi, dan prestasi siswa.</p>
                </div>
                <a href="#" class="text-blue-600 hover:underline text-sm">Lihat semua kegiatan</a>
            </div>

            <div class="mt-6 grid md:grid-cols-3 gap-6">
                <article class="bg-gray-50 rounded-lg p-6">
                    <h4 class="font-semibold">Lomba Keterampilan Siswa</h4>
                    <p class="mt-2 text-sm text-gray-600">Siswa meraih juara pada ajang tingkat provinsi.</p>
                </article>
                <article class="bg-gray-50 rounded-lg p-6">
                    <h4 class="font-semibold">Kegiatan Pengabdian Masyarakat</h4>
                    <p class="mt-2 text-sm text-gray-600">Siswa terlibat pada kegiatan bakti sosial dan pelatihan.</p>
                </article>
                <article class="bg-gray-50 rounded-lg p-6">
                    <h4 class="font-semibold">Pameran & Job Fair</h4>
                    <p class="mt-2 text-sm text-gray-600">Kolaborasi dengan mitra industri untuk penempatan kerja.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- GALERI SINGKAT -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold">Galeri</h2>
                <a href="#" class="text-blue-600 hover:underline text-sm">Lihat galeri lengkap</a>
            </div>

            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                <img src="https://via.placeholder.com/400x300.png?text=Foto+1" alt="Galeri 1"
                    class="rounded-lg object-cover w-full h-40">
                <img src="https://via.placeholder.com/400x300.png?text=Foto+2" alt="Galeri 2"
                    class="rounded-lg object-cover w-full h-40">
                <img src="https://via.placeholder.com/400x300.png?text=Foto+3" alt="Galeri 3"
                    class="rounded-lg object-cover w-full h-40">
                <img src="https://via.placeholder.com/400x300.png?text=Foto+4" alt="Galeri 4"
                    class="rounded-lg object-cover w-full h-40">
            </div>
        </div>
    </section> --}}

    <!-- KONTAK -->
    <section id="kontak" class="py-16 bg-white">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-2xl font-bold">Hubungi Kami</h2>
                <p class="mt-3 text-gray-600">Alamat, telepon, email, dan jam operasional.</p>

                <div class="mt-6 grid sm:grid-cols-2 gap-6 text-left">
                    <div class="bg-gray-50 p-6 rounded-2xl">
                        <h4 class="font-semibold">Alamat</h4>
                        <p class="mt-2 text-sm text-gray-600">Jl. Contoh No. 123, Karanganyar, Jawa Tengah</p>

                        <h4 class="mt-4 font-semibold">Telepon</h4>
                        <p class="mt-2 text-sm text-gray-600">(+62) 27x-xxxx-xxx</p>

                        <h4 class="mt-4 font-semibold">Email</h4>
                        <p class="mt-2 text-sm text-gray-600">info@smkn2kra.sch.id</p>
                    </div>

                    <form class="bg-gray-50 p-6 rounded-2xl" action="#" method="POST">
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" class="mt-2 w-full rounded-md border-gray-200 shadow-sm"
                            required>

                        <label class="block text-sm font-medium text-gray-700 mt-4">Email</label>
                        <input type="email" name="email" class="mt-2 w-full rounded-md border-gray-200 shadow-sm"
                            required>

                        <label class="block text-sm font-medium text-gray-700 mt-4">Pesan</label>
                        <textarea name="pesan" rows="4" class="mt-2 w-full rounded-md border-gray-200 shadow-sm"
                            required></textarea>

                        <button type="submit"
                            class="mt-4 inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

    <!-- SCRIPTS -->
    <script>
        // Mobile nav toggle
        const btn = document.getElementById('btn-mobile');
        const mobileNav = document.getElementById('mobile-nav');
        btn ? .addEventListener('click', () => mobileNav.classList.toggle('hidden'));

        // Year auto
        document.getElementById('year').textContent = new Date().getFullYear();

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
