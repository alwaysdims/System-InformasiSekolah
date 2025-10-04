@extends('landing.layout.main')

@section('title', 'Sambutan - SMKN 2 Karanganyar')

@section('content')

    <!-- Section Sejarah -->
    <section id="sejarah" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-20">

            <!-- Gambar Header -->
            <div class="overflow-hidden rounded-2xl shadow-lg">
                <img src="{{ asset('assets/image/sambutan.webp') }}" alt="Sejarah SMKN 2 Karanganyar"
                    class="w-full object-cover transform hover:scale-105 transition duration-700 ease-in-out">
            </div>

            <!-- Card Konten -->
            <div class="w-full mx-auto bg-white rounded-2xl shadow-xl mt-14 relative z-10 p-8 md:p-12">
                <!-- Header Card -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">
                        Sambutan Kepala Sekolah
                        <span class="block w-16 h-1 bg-blue-600 mt-2 rounded-full"></span>
                    </h2>
                    <span class="text-gray-500 text-sm">Kamis, 25 September 2025</span>
                </div>

                <!-- Isi Konten -->
                <div class="space-y-4 text-gray-700 leading-relaxed text-lg">
                    <p>
                        <span class="font-bold">Bismillahirrohmannirrohim</span>
                    </p>

                    <p>
                        <span class="font-bold">Assalamualaikum Warahmatullahi Wabarakatuh</span>
                    </p>

                    <p>
                        Alhamdulillahi robbil alamin kami panjatkan kehadirat Allah SWT, bahwasannya dengan rahmat dan
                        karunia-Nya lah
                        akhirnya Website sekolah ini dengan alamat
                        <span class="font-bold">www.smkn2kra.sch.id</span>
                        dapat kami perbaharui. Kami mengucapkan selamat datang di Website kami
                        <span class="font-bold">Sekolah Menengah Kejuruan Negeri (SMKN) 2 Karanganyar</span>
                        yang saya tujukan untuk seluruh unsur pimpinan, guru, karyawan dan siswa serta khalayak umum
                        guna dapat
                        mengakses seluruh informasi tentang segala profil, aktifitas/kegiatan serta fasilitas sekolah
                        kami.
                    </p>

                    <p>
                        Kami selaku pimpinan sekolah mengucapkan
                        <span class="font-bold">terima kasih</span> kepada tim pembuat Website ini yang telah berusaha
                        untuk dapat lebih
                        memperkenalkan segala perihal yang dimiliki oleh sekolah. Dan tentunya Website sekolah kami
                        masih terdapat
                        banyak kekurangan, oleh karena itu kepada seluruh lapisan masyarakat dapat memberikan
                        <span class="font-bold">saran dan kritik</span>
                        yang membangun demi kemajuan Website ini lebih lanjut.
                    </p>

                    <p>
                        <span class="font-bold">Terima kasih</span> sekian yang dapat kami sampaikan, apabila terdapat
                        kekurangan dan
                        kesalahan, mohon dimaafkan.
                    </p>

                    <p>
                        <span class="font-bold">Wassalamualaikum Warahmatullahi Wabarakatuh</span>
                    </p>
                </div>

            </div>
        </div>
    </section>
@endsection
    
    <script>
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
