@extends('guru.kepalasekolah.layout.main')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8 bg-gradient-to-b from-blue-50 to-white min-h-screen">
    <h1 class="text-3xl font-bold text-blue-900 mb-6 flex items-center gap-2">
        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2M9 19"></path>
        </svg>
        Dashboard Kepala Sekolah
    </h1>

    <!-- Statistik Siswa Terdaftar -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a2 2 0 00-2-2h-3m-2 4H2v-2a2 2 0 012-2h3m5-12h5a2 2 0 012 2v2m-7 0H2v2a2 2 0 01-2-2V5a2 2 0 012-2h5"></path>
            </svg>
            <h2 class="text-xl font-semibold text-gray-700">Statistik Siswa</h2>
        </div>
        <div class="bg-white shadow-lg rounded-xl p-6 transform hover:scale-105 transition-transform duration-300">
            <p class="text-lg font-medium text-gray-800">Total Siswa: <span class="font-bold text-blue-900">{{ $totalSiswa }}</span></p>
            <div class="mt-4">
                <h3 class="text-md font-medium text-gray-600">Distribusi per Kelas</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">
                    @foreach ($siswaPerKelas as $kelas)
                        <li class="flex items-center gap-2 text-gray-600">
                            <span class="w-2 h-2 bg-blue-400 rounded-full"></span>
                            {{ $kelas->nama_kelas }}: {{ $kelas->jumlah }} siswa
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Grafik Kehadiran dan Pelanggaran -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h2 class="text-xl font-semibold text-gray-700">Kehadiran & Pelanggaran</h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Grafik Kehadiran per Kelas -->
            <div class="bg-white shadow-lg rounded-xl p-6 transform hover:scale-105 transition-transform duration-300">
                <h3 class="text-lg font-medium text-gray-600 mb-4">Kehadiran per Kelas (Bulan Ini)</h3>
                <canvas id="kehadiranChart" height="100"></canvas>
            </div>
            <!-- Grafik Pelanggaran Bulanan -->
            <div class="bg-white shadow-lg rounded-xl p-6 transform hover:scale-105 transition-transform duration-300">
                <h3 class="text-lg font-medium text-gray-600 mb-4">Pelanggaran Bulanan (6 Bulan)</h3>
                <canvas id="pelanggaranChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Kehadiran Chart
            const ctxKehadiran = document.getElementById('kehadiranChart').getContext('2d');
            new Chart(ctxKehadiran, {
                type: 'bar',
                data: {
                    labels: @json($kehadiranPerKelas->pluck('nama_kelas')),
                    datasets: [{
                        label: 'Persentase Kehadiran (%)',
                        data: @json($kehadiranPerKelas->pluck('persentase_hadir')),
                        backgroundColor: 'rgba(59, 130, 246, 0.6)',
                        borderColor: 'rgba(29, 78, 216, 0.8)',
                        borderWidth: 1,
                        hoverBackgroundColor: 'rgba(59, 130, 246, 0.8)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: { color: 'rgba(0, 0, 0, 0.05)' },
                            ticks: { color: '#4B5563' }
                        },
                        x: { ticks: { color: '#4B5563' } }
                    },
                    plugins: {
                        legend: { labels: { color: '#4B5563' } }
                    }
                }
            });

            // Pelanggaran Chart
            const ctxPelanggaran = document.getElementById('pelanggaranChart').getContext('2d');
            new Chart(ctxPelanggaran, {
                type: 'line',
                data: {
                    labels: @json($pelanggaranBulanan->pluck('bulan')),
                    datasets: [{
                        label: 'Jumlah Pelanggaran',
                        data: @json($pelanggaranBulanan->pluck('jumlah')),
                        backgroundColor: 'rgba(239, 68, 68, 0.6)',
                        borderColor: 'rgba(185, 28, 28, 0.8)',
                        fill: false,
                        tension: 0.4,
                        pointBackgroundColor: '#D4AF37',
                        pointBorderColor: '#B91C1C',
                        pointHoverBackgroundColor: '#D4AF37'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0, 0, 0, 0.05)' },
                            ticks: { color: '#4B5563' }
                        },
                        x: { ticks: { color: '#4B5563' } }
                    },
                    plugins: {
                        legend: { labels: { color: '#4B5563' } }
                    }
                }
            });
        });
    </script>

    <!-- Progres Pembelajaran -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h2 class="text-xl font-semibold text-gray-700">Progres Pembelajaran</h2>
        </div>
        <div class="bg-white shadow-lg rounded-xl p-6">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Tugas Selesai (%)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($progresPembelajaran as $progres)
                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $progres->nama_kelas }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                <div class="flex items-center gap-2">
                                    <div class="w-16 bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progres->persentase_selesai }}%"></div>
                                    </div>
                                    <span>{{ number_format($progres->persentase_selesai, 2) }}%</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pengumuman Sekolah -->
    <div class="mb-8">
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.379c.4 0 .78.157 1.06.44"></path>
            </svg>
            <h2 class="text-xl font-semibold text-gray-700">Pengumuman Sekolah</h2>
        </div>
        <div class="bg-white shadow-lg rounded-xl p-6">
            @forelse ($pengumuman as $item)
                <div class="mb-4 p-4 bg-blue-50 rounded-lg transition-all duration-200 hover:bg-blue-100">
                    <h3 class="text-lg font-medium text-blue-900">{{ $item->judul }}</h3>
                    <p class="text-gray-600">{{ \Illuminate\Support\Str::limit($item->isi, 100) }}</p>
                    <p class="text-sm text-gray-500 mt-1">Dibuat: {{ \Carbon\Carbon::parse($item->dibuat_pada)->translatedFormat('d M Y') }}</p>
                </div>
            @empty
                <p class="text-gray-500 text-center">Tidak ada pengumuman</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Sertakan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection