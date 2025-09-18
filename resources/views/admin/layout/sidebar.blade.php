<!-- Overlay for mobile -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 overlay"></div>

<!-- Sidebar -->
<aside id="sidebar"
    class="sidebar text-white p-5 flex flex-col shadow-2xl fixed inset-y-0 transform -translate-x-full z-50 sm:translate-x-0 sm:left-4 sm:top-4 sm:h-[95%] ">
    <div class="flex items-center gap-4 mb-8">
        <img src="{{ asset('assets/admin/images/logo-smkn2kra.webp') }}" alt="SKANDAKRA Logo" class="w-12 h-12 rounded-lg">
        <h1 class="text-sm font-bold leading-tight">SYSTEM INFORMASI SKANDAKRA</h1>
    </div>
    <nav class="space-y-2 flex-1">
        <a href="/admin/dashboard" class="sidebar-item @if($title == 'Dashboard') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="/admin/dataGuru" class="sidebar-item @if($title == 'Data Guru') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-chalkboard-teacher"></i> Data Guru
        </a>
        <a href="forum_diskusi.html" class="sidebar-item @if($title == 'Forum Diskusi') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-user-graduate"></i> Data Siswa
        </a>
        <a href="{{ route('admin.wali_murid.index') }}" class="sidebar-item @if($title == 'Forum Diskusi') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-users"></i> Data Wali Murid
        </a>
        <a href="{{ '/admin/dataAdmin' }}" class="sidebar-item @if($title == 'Data Admin') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-user-shield"></i> Data Admin
        </a>
        <a href="forum_diskusi.html" class="sidebar-item @if($title == 'Forum Diskusi') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-book-open"></i> Mata Pelajaran
        </a>
        <a href="forum_diskusi.html" class="sidebar-item @if($title == 'Forum Diskusi') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-tools"></i> Kejuruan
        </a>
        <a href="forum_diskusi.html" class="sidebar-item @if($title == 'Forum Diskusi') active @endif flex items-center gap-3 text-sm font-medium">
            <i class="fas fa-school"></i> Kelas
        </a>
    </nav>
</aside>
