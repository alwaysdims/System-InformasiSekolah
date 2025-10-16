@extends('siswa.layout.main')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 w-full rounded-xl shadow-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold">📚 Tugas & Ujian Saya</h1>
                <p class="mt-2 text-blue-100">Lengkapi tugas tepat waktu untuk nilai terbaik!</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <span class="bg-white/20 px-4 py-2 rounded-full text-sm font-semibold">
                    {{ $tugasCount ?? 0 }} Tugas
                </span>
            </div>
        </div>
    </div>

    <!-- Filter Pills -->
    <div class="flex flex-wrap gap-2">
        <button class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium">Semua</button>
        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm">Belum Dikerjakan</button>
        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm">Dikerjakan</button>
        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full text-sm">Selesai</button>
    </div>

    <!-- Tugas Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        
        @forelse($tugas ?? [] as $tgs)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <!-- Header Card -->
            <div class="bg-gradient-to-r {{ $tgs->status == 'selesai' ? 'from-green-500 to-green-600' : ($tgs->status == 'dikerjakan' ? 'from-yellow-500 to-yellow-600' : 'from-blue-500 to-blue-600') }} px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-white font-bold text-lg">{{ $tgs->judul }}</h3>
                        <p class="text-blue-100 text-sm mt-1">{{ $tgs->guruMapel->mata_pelajaran->nama_mapel ?? 'N/A' }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/20">
                        {{ Str::upper($tgs->status) }}
                    </span>
                </div>
            </div>

            <!-- Body Card -->
            <div class="p-6">
                <!-- Deskripsi -->
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $tgs->deskripsi }}</p>

                <!-- Detail -->
                <div class="space-y-3 mb-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">📅 Batas Waktu</span>
                        <span class="font-semibold">
                            {{ $tgs->tanggal_tenggat ? \Carbon\Carbon::parse($tgs->tanggal_tenggat)->format('d/m/Y H:i') : 'Belum ditentukan' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">⏱️ Durasi</span>
                        <span class="font-semibold">{{ $tgs->durasi }} menit</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">📊 Total Soal</span>
                        <span class="font-semibold">{{ $tgs->soal->count() }} soal</span>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Progress</span>
                        <span>{{ $tgs->soal->count() ? round(($tgs->jawaban()->where('siswa_id', auth()->id())->count() / $tgs->soal->count()) * 100, 0) : 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full transition-all duration-300"
                            style="width: {{ $tgs->soal->count() ? round(($tgs->jawaban()->where('siswa_id', auth()->id())->count() / $tgs->soal->count()) * 100, 0) : 0 }}%"></div>
                    </div>
                </div>

                <!-- Action Button -->
                @if($tgs->status == 'selesai')
                    <button class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-semibold transition">
                        ✅ Selesai Dikerjakan
                    </button>
                @elseif($tgs->status == 'dikerjakan')
                    <a href="{{ route('siswa.tugas.detail', $tgs->id) }}"
                       class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-lg font-semibold text-center block transition">
                        📝 Lihat Detail
                    </a>
                @else
                    <a href="{{ route('siswa.tugas.detail', $tgs->id) }}"
                       class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold text-center block transition">
                        🚀 Lihat Detail
                    </a>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="text-gray-400 text-6xl mb-4">📚</div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada tugas</h3>
            <p class="text-gray-500">Tugas akan muncul di sini setelah guru membuatnya.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
