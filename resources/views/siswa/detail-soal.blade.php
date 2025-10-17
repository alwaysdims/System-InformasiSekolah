@extends('siswa.layout.main')

@section('content')
<main class="flex-1 overflow-y-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-lg font-semibold text-blue-600">Detail Soal Tugas/Ujian</h2>
            <a href="{{ route('siswa.tugas.index') }}"
                class="inline-flex items-center px-3 py-1.5 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <!-- Tabel Detail -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-gray-700">
                <tbody>
                    <tr class="border-b">
                        <td class="py-3 px-4 font-medium w-1/4">Judul Tugas/Ujian</td>
                        <td class="py-3 px-4">: {{ $tugas->judul }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4 font-medium">Kelas yang Ditugaskan</td>
                        <td class="py-3 px-4">
                            <ol class="list-decimal list-inside">
                                @forelse($tugas->kelas as $kelas)
                                    <li>{{ $kelas->nama_kelas }}</li>
                                @empty
                                    <li>Belum ada kelas</li>
                                @endforelse
                            </ol>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4 font-medium">Mata Pelajaran</td>
                        <td class="py-3 px-4">: {{ $tugas->guruMapel->mata_pelajaran->nama_mapel ?? 'N/A' }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4 font-medium">Jenis Soal</td>
                        <td class="py-3 px-4">: {{ ucfirst($tugas->tipe) }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4 font-medium">Bobot Pilihan Ganda</td>
                        <td class="py-3 px-4">: {{ $tugas->bobot_pg }}%</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4 font-medium">Bobot Pilihan Esai</td>
                        <td class="py-3 px-4">: {{ $tugas->bobot_esai }}%</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-medium">Waktu Pengerjaan</td>
                        <td class="py-3 px-4">: {{ $tugas->durasi }} Menit</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('siswa.tugas.pilga', $tugas->id) }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M9 16h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Jawab Pilihan Ganda
            </a>
            <a href="{{ route('siswa.tugas.esay', $tugas->id) }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M9 16h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Jawab Soal Essay
            </a>
        </div>
    </div>
</main>
@endsection
