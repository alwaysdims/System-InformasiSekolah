@extends('siswa.layout.main')

@section('content')
<div class="flex-1 flex flex-col">
    <!-- Header -->
    <header class="glass-effect sticky top-0 z-40 shadow-lg">
        <div class="flex items-center justify-between p-4">
            <div class="flex items-center space-x-4">
                <button id="sidebarToggle" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-xl text-gray-600"></i>
                </button>
                <div>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Jadwal Kelas
                    </h1>
                    @if ($kelas)
                        <p class="text-sm text-gray-500">Kelas: {{ $kelas->nama_kelas }}</p>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        <div class="flex-1 p-4">
            <div class="glass-effect rounded-2xl shadow-xl p-6">
                @if (isset($error))
                    <div class="text-center text-red-500 p-4">
                        {{ $error }}
                    </div>
                @elseif ($jadwal->isEmpty())
                    <div class="text-center text-gray-500 p-4">
                        Belum ada jadwal pelajaran untuk kelas ini.
                    </div>
                @else
                    <!-- Day Filter -->
                    <div class="mb-6">
                        <label for="dayFilter" class="text-sm font-semibold text-gray-700 mr-2">Filter Hari:</label>
                        <select id="dayFilter" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="all">Semua Hari</option>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="minggu">Minggu</option>
                        </select>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" id="scheduleTable">
                            <thead>
                                <tr class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white">
                                    <th class="p-4">Hari</th>
                                    <th class="p-4">Mata Pelajaran</th>
                                    <th class="p-4">Guru</th>
                                    <th class="p-4">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $item)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-all duration-300" data-day="{{ strtolower($item->hari) }}">
                                        <td class="p-4">{{ ucfirst($item->hari) }}</td>
                                        <td class="p-4">{{ $item->guruMapel->mapel->nama_mapel ?? 'N/A' }}</td>
                                        <td class="p-4">{{ $item->guruMapel->guru->nama ?? 'N/A' }}</td>
                                        <td class="p-4">{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Include necessary scripts -->
<script>
    // Sidebar toggle (assuming sidebar exists in layout)
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && e.target !== sidebarToggle) {
                sidebar.classList.remove('active');
            }
        });
    }

    // Day filter functionality
    const dayFilter = document.getElementById('dayFilter');
    const scheduleTable = document.getElementById('scheduleTable');

    if (dayFilter && scheduleTable) {
        dayFilter.addEventListener('change', () => {
            const selectedDay = dayFilter.value.toLowerCase();
            const rows = scheduleTable.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const rowDay = row.getAttribute('data-day');
                if (selectedDay === 'all' || rowDay === selectedDay) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
</script>
@endsection
