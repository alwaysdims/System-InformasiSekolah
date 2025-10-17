@extends('guru.gurumapel.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto w-full bg-white p-6 rounded-lg shadow-lg">

    <!-- Header Soal -->
    <div class="mb-6 border-b pb-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Siswa Yang Melaksanakan Ujian</h1>
                <p class="text-sm text-gray-500 mt-1">
                    <span>Mapel: </span>
                    <span class="font-semibold text-blue-600">{{ $tugas->guruMapel->mapel->nama_mapel }}</span> |
                    <span>Judul: </span>
                    <span class="font-semibold text-purple-600">{{ $tugas->judul }}</span> |
                    <span>Durasi: </span>
                    <span class="font-semibold text-green-600">{{ $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('d/m/Y H:i') : '-' }}</span>
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Total Siswa: <span class="font-semibold text-green-600">{{ $jawabanSiswa->count() }}</span> |
                    Rata-rata Nilai: <span class="font-semibold text-orange-600">{{ $jawabanSiswa->avg('total') ? number_format($jawabanSiswa->avg('total'), 0) : 0 }}</span>
                </p>
            </div>
            <div class="flex space-x-3 mt-4 sm:mt-0">
                <a href="{{ route('guru.tugas.index') }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-md text-sm flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span>Back</span>
                </a>
                <button onclick="printTable()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    <span>Cetak</span>
                </button>
                <button onclick="exportExcel()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Export Excel</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-4 sm:space-y-0 mb-6">
        <div class="flex items-center border rounded-lg px-3 py-2 w-full sm:w-64 bg-gray-100">
            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input id="searchInput" type="text" placeholder="Cari siswa..." class="bg-transparent outline-none w-full text-gray-700" />
        </div>
        <select id="statusFilter" class="border rounded-lg px-3 py-2 sm:w-32 bg-gray-100">
            <option value="">Semua Status</option>
            <option value="Lulus">Lulus</option>
            <option value="Remidi">Remidi</option>
        </select>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden" id="hasilTable">
            <thead>
                <tr class="bg-cyan-600 text-white">
                    <th class="px-4 py-2">NO</th>
                    <th class="px-4 py-2">NISN</th>
                    <th class="px-4 py-2">Nama Siswa</th>
                    <th class="px-4 py-2">Kelas</th>
                    <th class="px-4 py-2">Nilai PG</th>
                    <th class="px-4 py-2">Nilai Essay</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Hasil</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center" id="tableBody">
                @forelse($jawabanSiswa as $index => $data)
                <tr class="border-b hover:bg-gray-50"
                    data-nama="{{ strtolower($data['nama']) }}"
                    data-status="{{ $data['status'] }}">
                    <td class="px-4 py-3 font-medium">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $data['nisn'] }}</td>
                    <td class="px-4 py-3 text-left">{{ $data['nama'] }}</td>
                    <td class="px-4 py-3">{{ $data['kelas'] }}</td>
                    <td class="px-4 py-3 {{ $data['nilai_pg'] >= 70 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                        {{ $data['nilai_pg'] }}
                    </td>
                    <td class="px-4 py-3 {{ $data['nilai_essay'] >= 70 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                        {{ $data['nilai_essay'] }}
                    </td>
                    <td class="px-4 py-3 font-semibold text-blue-600">{{ $data['total'] }}</td>
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            {{ $data['status'] == 'Lulus' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $data['status'] }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <a href="#" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm flex items-center justify-center space-x-1 mx-auto"
                           title="Detail Jawaban" onclick="alert('Fitur detail jawaban - Coming Soon!')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Belum ada siswa yang mengerjakan tugas ini.
                    </td>
                </tr>
                @endforelse
            </tbody>

            <!-- Hapus pagination Laravel karena kita pakai manual -->
            <!-- <div class="flex justify-center mt-6">
                {{-- {{ $jawabanSiswa->links() }} --}}
            </div> -->
        </table>
    </div>

    <!-- Pagination -->
    {{-- <div class="flex justify-center mt-6">
        {{-- {{ $jawabanSiswa->links()
    </div> --}}
</div>

<script>
    // Filter Table
    document.getElementById('searchInput').addEventListener('input', filterTable);
    document.getElementById('statusFilter').addEventListener('change', filterTable);

    function filterTable() {
        const keyword = document.getElementById('searchInput').value.toLowerCase();
        const status = document.getElementById('statusFilter').value;
        const rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            const nama = row.dataset.nama || '';
            const rowStatus = row.dataset.status || '';

            const show = (nama.includes(keyword) &&
                         (!status || rowStatus === status));

            row.style.display = show ? '' : 'none';
        });
    }

    // Print Table
    function printTable() {
        window.print();
    }

    // Export Excel (simulasi)
    function exportExcel() {
        const table = document.getElementById('hasilTable');
        const rows = table.querySelectorAll('tr');
        let csv = [];

        rows.forEach(row => {
            const cols = row.querySelectorAll('td, th');
            const rowData = Array.from(cols).map(col =>
                col.textContent.trim().replace(/"/g, '""')
            );
            csv.push(rowData.join(','));
        });

        const csvContent = csv.join('\n');
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `hasil-tugas-{{ $tugas->judul }}-${new Date().toISOString().slice(0,10)}.csv`;
        a.click();
    }
</script>

<style>
@media print {
    .bg-yellow-400, .bg-blue-500, .bg-green-500, #pagination { display: none !important; }
    table { font-size: 12px !important; }
}
</style>
@endsection
