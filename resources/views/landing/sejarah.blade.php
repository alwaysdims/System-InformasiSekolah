@extends('landing.layout.main')

@section('title', 'Sejarah - SMKN 2 Karanganyar')

@section('content')

    <!-- Section Sejarah -->
    <section id="sejarah" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-20">

            <!-- Gambar Header -->
            <div class="overflow-hidden rounded-2xl shadow-lg">
                <img src="{{ asset('assets/image/Sejarah.webp') }}" alt="Sejarah SMKN 2 Karanganyar"
                    class="w-full object-cover transform hover:scale-105 transition duration-700 ease-in-out">
            </div>

            <!-- Card Konten -->
            <div class="w-full mx-auto bg-white rounded-2xl shadow-xl mt-14 relative z-10 p-8 md:p-12">
                <!-- Header Card -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">
                        Sejarah SMK Negeri 2 Karanganyar
                        <span class="block w-16 h-1 bg-blue-600 mt-2 rounded-full"></span>
                    </h2>
                    <span class="text-gray-500 text-sm">Kamis, 25 September 2025</span>
                </div>

                <!-- Isi Konten -->
                <div class="space-y-4 text-gray-700 leading-relaxed text-lg">
                    <p>
                        <span class="font-bold">Sekolah Menengah Kejuruan Negeri 2 Karanganyar</span> atau yang sering
                        disebut dengan
                        <span class="font-bold">SMK N 2 Karanganyar</span> adalah sebuah Sekolah Menengah Kejuruan yang
                        berlokasi di
                        Jl. Laksda Yos Sudarso Telp. (0271) 494549 Fax. (0271) 6498171 Bejen, Karanganyar 57716.
                    </p>

                    <p>
                        <span class="font-bold">SMK N 2 Karanganyar</span> berdiri sejak tahun <span
                            class="font-semibold">1997</span>
                        di area tanah seluas 27.720 m² dan diresmikan pada tanggal
                        <span class="font-semibold">18 November 1997</span> oleh Menteri Pendidikan Nasional
                        <span class="font-bold">Prof. Dr. Ing. Wardiman Djojonegoro</span> dengan satu program studi
                        Teknik Mesin.
                    </p>

                    <p>
                        Sekolah ini pertama kali dipimpin oleh Kepala Sekolah
                        <span class="font-bold">Drs. Surip Sunamto</span> dari Tahun Pelajaran 1997/1998 hingga
                        2005/2006.
                        Atas anjuran dari Bupati Karanganyar, pada Tahun Pelajaran 2004/2005 dibuka satu Program Studi
                        Teknologi Tekstil.
                    </p>

                    <p>
                        Pada Tahun Pelajaran 2006/2007, karena belum ada Kepala Sekolah resmi maka Dinas Pendidikan
                        Kabupaten Karanganyar
                        menugaskan <span class="font-bold">Drs. Sugiyarso HS, S.Pd., S.H., M.Ag.</span> sebagai
                        pelaksana tugas Kepala Sekolah.
                        Barulah pada Tahun Pelajaran 2007/2008 seorang guru Karanganyar yang lulus ujian dan mendapatkan
                        SK Bupati, yaitu
                        <span class="font-bold">Drs. Wahyu Widodo, M.T.</span> resmi menjadi Kepala Sekolah.
                    </p>

                    <p>
                        Pada Tahun Pelajaran 2008/2009, <span class="font-bold">SMK N 2 Karanganyar</span> membuka 2
                        Program Studi sekaligus,
                        yaitu Teknik Otomotif Elektronik dan Rekayasa Perangkat Lunak.
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
