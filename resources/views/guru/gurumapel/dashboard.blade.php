@extends('guru.gurumapel.layouts.app')
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6 animate-fade-in" style="animation-delay: 0.2s">
        <div class="flex items-center justify-between mb-6">
            <h5 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Jadwal Mengajar Hari Ini
            </h5>
            <a href="#"
                class="inline-flex items-center text-sm font-medium text-blue-500 hover:text-blue-700 transition-colors">
                Lihat Semua
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="space-y-4">
            <div
                class="bg-indigo-50 rounded-lg p-4 border border-indigo-200 shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-indigo-200 p-3 rounded-full text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M10 13a5 5 0 0 0 7.54.54l3.5-3.5a2 2 0 0 0 0-2.83l-1.5-1.5a2 2 0 0 0-2.83 0l-3.5 3.5a5 5 0 0 0-.54 7.54z" />
                            <path d="M14 11a2 2 0 1 1-4 0 2 2 0 0 1 4 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Matematika</h3>
                        <p class="text-sm text-gray-600">X IPA 1</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-base font-bold text-indigo-700">07.00 - 08.20</span>
                    <p class="text-xs text-green-500 font-medium">Sedang Berlangsung</p>
                </div>
            </div>

            <div class="bg-gray-100 rounded-lg p-4 border border-gray-200 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-gray-200 p-3 rounded-full text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7H19M12 12v10M5 19h10.5a3.5 3.5 0 0 0 0-7H5" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Fisika</h3>
                        <p class="text-sm text-gray-600">X IPA 2</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-base font-bold text-gray-700">08.20 - 09.40</span>
                    <p class="text-xs text-yellow-500 font-medium">Akan Datang</p>
                </div>
            </div>

            <div class="bg-gray-100 rounded-lg p-4 border border-gray-200 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-gray-200 p-3 rounded-full text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M12 21.35C9.44 19.33 2 13.9 2 8.5C2 5.4 4.4 3 7.5 3c2.45 0 4.02 1.94 4.5 3.2 0.48-1.26 2.05-3.2 4.5-3.2C19.6 3 22 5.4 22 8.5c0 5.4-7.44 10.83-10 12.85z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Kimia</h3>
                        <p class="text-sm text-gray-600">XI IPA 1</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-base font-bold text-gray-700">10.00 - 11.20</span>
                    <p class="text-xs text-yellow-500 font-medium">Akan Datang</p>
                </div>
            </div>

            <div class="bg-gray-100 rounded-lg p-4 border border-gray-200 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-gray-200 p-3 rounded-full text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M12 21.35C9.44 19.33 2 13.9 2 8.5C2 5.4 4.4 3 7.5 3c2.45 0 4.02 1.94 4.5 3.2 0.48-1.26 2.05-3.2 4.5-3.2C19.6 3 22 5.4 22 8.5c0 5.4-7.44 10.83-10 12.85z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Biologi</h3>
                        <p class="text-sm text-gray-600">XII IPA 1</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-base font-bold text-gray-700">13.00 - 14.20</span>
                    <p class="text-xs text-yellow-500 font-medium">Akan Datang</p>
                </div>
            </div>
        </div>
    </div>
    <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6 animate-fade-in" style="animation-delay: 0.3s">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5.882V19.98a.98.98 0 01-.98.98H5.98a.98.98 0 01-.98-.98V5.882a1.01 1.01 0 01.465-.845l4.5-2.61a1 1 0 011.07 0l4.5 2.61a1.01 1.01 0 01.465.845zM12 21a9 9 0 100-18 9 9 0 000 18z" />
                </svg>
                Pengumuman
            </h2>
            <a href="#"
                class="inline-flex items-center text-sm font-medium text-blue-500 hover:text-blue-700 transition-colors">
                Lihat Semua
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="space-y-4">
            <div
                class="p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded-r-md rounded-md hover:shadow-md transition-shadow">
                <div class="flex items-start">
                    <div class="flex-shrink-0 text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M12 11V5a2 2 0 00-2-2H4a2 2 0 00-2 2v6c0 1.1.9 2 2 2h8zm6-8h-4a2 2 0 00-2 2v6c0 1.1.9 2 2 2h4a2 2 0 002-2V5a2 2 0 00-2-2zM4 17h16" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-base font-semibold text-gray-800">Pertemuan Rutin Bulanan</h3>
                        <p class="mt-1 text-sm text-gray-500">Hari Ini, 14:30</p>
                        <p class="mt-2 text-sm text-gray-700">
                            Seluruh guru diharapkan hadir di ruang guru untuk pertemuan rutin bulanan.
                        </p>
                        <span
                            class="mt-2 inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-200 text-yellow-800">
                            Penting!
                        </span>
                    </div>
                </div>
            </div>

            <div
                class="p-4 bg-gray-100 border-l-4 border-gray-400 rounded-r-md rounded-md hover:shadow-md transition-shadow">
                <div class="flex items-start">
                    <div class="flex-shrink-0 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                            <path d="M14 2v6h6" />
                            <path d="M10 9h4" />
                            <path d="M10 13h4" />
                            <path d="M10 17h4" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-base font-semibold text-gray-800">Pembaruan Kurikulum</h3>
                        <p class="mt-1 text-sm text-gray-500">Kemarin, 16:30</p>
                        <p class="mt-2 text-sm text-gray-700">
                            Ada beberapa perubahan pada kurikulum semester depan. File sudah dibagikan
                            di grup WA.
                        </p>
                        <span
                            class="mt-2 inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-300 text-gray-700">
                            Informasi
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
