@extends('siswa.layout.main')

@section('content')
<main class="flex-1 overflow-y-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-lg font-semibold text-blue-600">Jawab Soal Essay: {{ $tugas->judul }}</h2>
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
                    <textarea name="jawaban[{{ $soal->id }}]" class="w-full border rounded p-2"
                              rows="5">{{ $jawaban->where('soal_id', $soal->id)->first()->jawaban ?? '' }}</textarea>
                </div>
            @endforeach
            <input type="hidden" name="soal_id" value="{{ $tugas->soal->pluck('id')->implode(',') }}">
            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                Simpan Jawaban
            </button>
        </form>
    </div>
</main>
@endsection
