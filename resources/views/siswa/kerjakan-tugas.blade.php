@extends('siswa.layout.main')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl sm:text-3xl font-bold">📚 {{ $tugas->judul }}</h1>
        <p class="mt-2 text-blue-100">Mata Pelajaran: {{ $tugas->guruMapel->mata_pelajaran->nama_mapel ?? 'N/A' }}</p>
        <p class="text-blue-100">Batas Waktu: {{ $tugas->tanggal_tenggat ? \Carbon\Carbon::parse($tugas->tanggal_tenggat)->format('d/m/Y H:i') : 'Belum ditentukan' }}</p>
        <p class="text-blue-100">Durasi: {{ $tugas->durasi }} menit</p>
    </div>

    <!-- Questions Section -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Daftar Soal</h2>
        @forelse($tugas->soal as $index => $soal)
        <div class="mb-6 p-4 border rounded-lg">
            <h3 class="text-lg font-medium">Soal {{ $index + 1 }}:</h3>
            <p class="text-gray-600 mb-2">{{ $soal->pertanyaan }}</p>

            <!-- Display options (assuming multiple-choice questions) -->
            @if($soal->tipe === 'pilihan_ganda')
            <form action="{{ route('siswa.tugas.submit', $tugas->id) }}" method="POST">
                @csrf
                <input type="hidden" name="soal_id" value="{{ $soal->id }}">
                <div class="space-y-2">
                    @foreach($soal->pilihan as $pilihan)
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $pilihan }}"
                               {{ $jawaban->where('soal_id', $soal->id)->first()->jawaban ?? '' === $pilihan ? 'checked' : '' }}>
                        <span>{{ $pilihan }}</span>
                    </label>
                    @endforeach
                </div>
            @else
            <!-- For open-ended questions -->
            <textarea name="jawaban[{{ $soal->id }}]" class="w-full p-2 border rounded-lg" placeholder="Masukkan jawaban Anda...">{{ $jawaban->where('soal_id', $soal->id)->first()->jawaban ?? '' }}</textarea>
            @endif

            <!-- Submit button for each question (optional, can be one submit button for all) -->
            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">Simpan Jawaban</button>
        </form>
        </div>
        @empty
        <div class="text-center py-8">
            <p class="text-gray-500">Belum ada soal untuk tugas ini.</p>
        </div>
        @endforelse
    </div>

    <!-- Back Button -->
    <a href="{{ route('siswa.tugas.index') }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg mt-4">
        Kembali ke Daftar Tugas
    </a>
</div>
@endsection
