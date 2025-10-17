<!-- Overlay for mobile -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 overlay"></div>

<!-- Sidebar -->
<aside id="sidebar"
    class="sidebar text-white p-5 flex flex-col shadow-2xl fixed inset-y-0 transform -translate-x-full z-50
           sm:translate-x-0 sm:left-4 sm:top-4 sm:h-[95%] bg-gray-900 rounded-2xl">

    <!-- Header Sidebar -->
    <div class="flex items-center gap-4 mb-8">
        <img src="{{ asset('assets/admin/images/logo-smkn2kra.webp') }}" alt="SKANDAKRA Logo" class="w-12 h-12 rounded-lg">
        <h1 class="text-sm font-bold leading-tight">
            SYSTEM INFORMASI <br> SKANDAKRA
        </h1>
    </div>

    <!-- Navigation -->
    <nav class="space-y-2 flex-1 text-[15px]">
        <!-- Dashboard -->
        <a href="{{ route('guru.kesiswaan.dashboard') }}"
           class="sidebar-item @if($title == 'Dashboard') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-home"></i> Dashboard
        </a>

        <!-- Data Pelanggaran Siswa -->
        <a href="{{ route('guru.kesiswaan.pelanggaran.index') }}"
           class="sidebar-item @if($title == 'Data Pelanggaran Siswa') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-exclamation-triangle"></i> Data Pelanggaran
        </a>

        <!-- Prestasi Siswa -->
        <a href="{{ route('guru.kesiswaan.prestasi.index') }}"
           class="sidebar-item @if($title == 'Data Prestasi Siswa') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-trophy"></i> Prestasi Siswa
        </a>

        {{-- <!-- Layanan Aduan -->
        <a href="{{ route('waka.kesiswaan.pengaduan.index') }}"
           class="sidebar-item @if($title == 'Layanan Aduan Siswa') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-comments"></i> Layanan Aduan
        </a>

        <!-- Laporan & Rekap -->
        <a href="{{ route('waka.kesiswaan.laporan.index') }}"
           class="sidebar-item @if($title == 'Laporan Kesiswaan') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-file-alt"></i> Laporan & Rekap
        </a> --}}
    </nav>
</aside>
