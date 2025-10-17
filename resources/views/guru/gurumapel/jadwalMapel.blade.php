@extends('guru.gurumapel.layouts.app', ['title' => 'Pembagian Mata Pelajaran Guru'])
@section('title', 'Pembagian Mata Pelajaran Guru')
@section('content')

<div class="flex w-full">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-700">Pembagian Mata Pelajaran Guru</h2>
            </div>

            <!-- Pesan Error -->
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-sm text-gray-500">
                            <th class="px-4 py-3">NO</th>
                            <th class="px-4 py-3">NAMA GURU</th>
                            <th class="px-4 py-3">MATA PELAJARAN</th>
                            <th class="px-4 py-3">JURUSAN</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($guruMapels as $index => $guruMapel)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $guruMapel->guru->nama ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $guruMapel->mapel->nama_mapel ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $guruMapel->jurusan->nama_jurusan ?? '-' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <button onclick="openDetailModal('{{ $guruMapel->id }}', '{{ $guruMapel->guru->nama ?? '-' }}', '{{ $guruMapel->mapel->nama_mapel ?? '-' }}', '{{ $guruMapel->jurusan->nama_jurusan ?? '-' }}')" class="text-blue-600 hover:text-blue-700 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500">Tidak ada data Pembagian Mata Pelajaran Guru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Modal Detail -->
            <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Detail Pembagian Mata Pelajaran Guru</h2>
                    <div class="space-y-3 text-sm text-gray-700">
                        <p><span class="font-semibold">Nama Guru:</span> <span id="detail_guru"></span></p>
                        <p><span class="font-semibold">Mata Pelajaran:</span> <span id="detail_mapel"></span></p>
                        <p><span class="font-semibold">Jurusan:</span> <span id="detail_jurusan"></span></p>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="button" onclick="closeDetailModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function openDetailModal(id, guru, mapel, jurusan) {
        document.getElementById('detail_guru').textContent = guru;
        document.getElementById('detail_mapel').textContent = mapel;
        document.getElementById('detail_jurusan').textContent = jurusan;
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>

@endsection