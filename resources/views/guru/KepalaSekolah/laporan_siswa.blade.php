@extends('guru.kepalasekolah.layout.main')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Laporan Siswa</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('kepala.laporan_siswa') }}" class="mb-6 bg-white p-4 shadow rounded">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
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

            <!-- Filter Status Kehadiran -->
            <div>
                <label class="block text-sm font-medium">Status Kehadiran</label>
                <select name="status_kehadiran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Semua Status</option>
                    <option value="hadir" {{ request('status_kehadiran') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="tidak_hadir" {{ request('status_kehadiran') == 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                </select>
            </div>

            <!-- Filter Jenis Pelanggaran -->
            <div>
                <label class="block text-sm font-medium">Jenis Pelanggaran</label>
                <input type="text" name="jenis_pelanggaran" value="{{ request('jenis_pelanggaran') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Masukkan jenis pelanggaran">
            </div>
        </div>

        <div class="mt-4 flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
            <a href="{{ route('kepala.laporan_siswa') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Reset</a>
            <a href="{{ route('kepala.cetak_laporan_siswa', request()->query()) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Cetak PDF</a>
        </div>
    </form>

    <!-- Tabel Laporan -->
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Kehadiran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan Kehadiran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Pelanggaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pelanggaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengumuman</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($laporan as $siswa)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nama ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $siswa->kehadiran->isNotEmpty() ? $siswa->kehadiran->first()->status : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $siswa->kehadiran->isNotEmpty() ? $siswa->kehadiran->first()->keterangan ?? '-' : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $siswa->pelanggaran->isNotEmpty() ? $siswa->pelanggaran->first()->jenis_pelanggaran ?? '-' : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $siswa->pelanggaran->isNotEmpty() ? \Carbon\Carbon::parse($siswa->pelanggaran->first()->tanggal)->translatedFormat('d M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pengumuman ? $pengumuman->judul : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection