@extends('guru.kepalasekolah.layout.main')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Laporan Guru</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('kepala.laporan_guru') }}" class="mb-6 bg-white p-4 shadow rounded">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Filter Bulan -->
            <div>
                <label class="block text-sm font-medium">Bulan</label>
                <select name="bulan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Semua Bulan</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                    @endfor
                </select>
            </div>

            <!-- Filter Tahun -->
            <div>
                <label class="block text-sm font-medium">Tahun</label>
                <select name="tahun" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Semua Tahun</option>
                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <!-- Filter Nama Tugas -->
            <div>
                <label class="block text-sm font-medium">Nama Tugas</label>
                <input type="text" name="nama_tugas" value="{{ request('nama_tugas') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Masukkan nama tugas">
            </div>
        </div>

        <div class="mt-4 flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
            <a href="{{ route('kepala.laporan_guru') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Reset</a>
            <a href="{{ route('kepala.cetak_laporan_guru', request()->query()) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Cetak PDF</a>
        </div>
    </form>

    <!-- Tabel Statistik -->
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Tugas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rata-rata Nilai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nilai Tertinggi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nilai Terendah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Siswa</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($statistik as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item['nama_tugas'] ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($item['rata_rata'], 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item['nilai_tertinggi'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item['nilai_terendah'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item['jumlah_siswa'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection