@extends('guru.gurumapel.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">

    <!-- Header Soal -->
    <div class="mb-6 border-b pb-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $tugas->judul }}</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Mapel: <span class="font-semibold text-blue-600">{{ $tugas->guruMapel->mata_pelajaran->nama_mapel ?? 'N/A' }}</span> |
                    Durasi: <span class="font-semibold text-green-600">{{ $tugas->durasi }} menit</span>
                </p>
            </div>
            <div class="flex space-x-3 mt-4 sm:mt-0">
                <a href="{{ route('guru.detail.tugas', $tugas->id) }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold px-4 py-2 rounded-lg flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Kembali</span>
                </a>
                <button onclick="openModalBuatSoal({{ $tugas->id }})"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Buat Soal</span>
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
            <input id="searchInput" type="text" placeholder="Cari soal.." class="bg-transparent outline-none w-full text-gray-700" />
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200 text-sm text-gray-500">
                    <th class="px-4 py-3">NO</th>
                    <th class="px-4 py-3">SOAL</th>
                    <th class="px-4 py-3">A</th>
                    <th class="px-4 py-3">B</th>
                    <th class="px-4 py-3">C</th>
                    <th class="px-4 py-3">D</th>
                    <th class="px-4 py-3">JAWABAN BENAR</th>
                    <th class="px-4 py-3 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody id="soalTable" class="text-gray-700">
                @forelse($tugas->soal->where('tipe', 'Pilihan Ganda') as $index => $soal)
                <tr class="border-b border-gray-100 hover:bg-gray-50" data-soal-id="{{ $soal->id }}">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $soal->pertanyaan }}</td>
                    <td class="px-4 py-3">{{ $soal->pilihan_a }}</td>
                    <td class="px-4 py-3">{{ $soal->pilihan_b }}</td>
                    <td class="px-4 py-3">{{ $soal->pilihan_c }}</td>
                    <td class="px-4 py-3">{{ $soal->pilihan_d }}</td>
                    <td class="px-4 py-3 font-semibold text-green-600">{{ $soal->jawaban_benar }}</td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center space-x-2">
                            <button onclick="openEditModal({{ $soal->id }})"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1.5 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M16 3l5 5L9 20H4v-5L16 3z" />
                                </svg>
                            </button>
                            <button onclick="deleteSoal({{ $soal->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">Belum ada soal pilihan ganda</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Buat Soal -->
    <div id="modalBuatSoal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center px-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl p-6 relative overflow-y-auto max-h-[90vh]">
            <button onclick="closeModalBuatSoal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">✖</button>
            <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Buat Soal Pilihan Ganda</h2>
            <form action="{{ route('guru.pilga.store', $tugas->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Soal</label>
                    <textarea name="pertanyaan" class="w-full border rounded p-2" rows="3" required></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan A</label>
                        <textarea name="pilihan_a" class="w-full border rounded p-2" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan B</label>
                        <textarea name="pilihan_b" class="w-full border rounded p-2" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan C</label>
                        <textarea name="pilihan_c" class="w-full border rounded p-2" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan D</label>
                        <textarea name="pilihan_d" class="w-full border rounded p-2" required></textarea>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jawaban Benar</label>
                    <div class="flex space-x-4">
                        @foreach(['A', 'B', 'C', 'D'] as $huruf)
                        <label class="flex items-center space-x-1">
                            <input type="radio" name="jawaban_benar" value="{{ $huruf }}" class="text-blue-600" required>
                            <span>{{ $huruf }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModalBuatSoal()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function openModalBuatSoal(tugasId) { document.getElementById('modalBuatSoal').classList.remove('hidden'); }
function closeModalBuatSoal() { document.getElementById('modalBuatSoal').classList.add('hidden'); }
</script>
@endsection
