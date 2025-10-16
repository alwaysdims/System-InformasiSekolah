@extends('siswa.layout.main')

@section('content')
<main class="flex-1 overflow-y-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-lg font-semibold text-blue-600">Jawab Soal Pilihan Ganda: {{ $tugas->judul }}</h2>
            <a href="{{ route('siswa.tugas.detail', $tugas->id) }}"
                class="inline-flex items-center px-3 py-1.5 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('siswa.tugas.submit', $tugas->id) }}" method="POST">
            @csrf
            @foreach($tugas->soal as $index => $soal)
                <div class="mb-6">
                    <h3 class="text-md font-medium text-gray-700 mb-2">{{ $index + 1 }}. {{ $soal->pertanyaan }}</h3>
                    @php
                    $opsiList = array_filter([
                        $soal->pilihan_a,
                        $soal->pilihan_b,
                        $soal->pilihan_c,
                        $soal->pilihan_d,
                    ]);
                @endphp

                @foreach($opsiList as $opsi)
                    <div class="flex items-center mb-2">
                        <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $opsi }}"
                               class="mr-2"
                               {{ optional($jawaban->where('soal_id', $soal->id)->first())->jawaban == $opsi ? 'checked' : '' }}>
                        <label>{{ $opsi }}</label>
                    </div>
                @endforeach

                </div>
            @endforeach
            <input type="hidden" name="soal_id" value="{{ $tugas->soal->pluck('id')->implode(',') }}">
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                Simpan Jawaban
            </button>
        </form>
    </div>
</main>
@endsection
