@extends('siswa.layout.main')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8 bg-gradient-to-b from-blue-50 to-white min-h-screen">
    <h1 class="text-3xl font-bold text-blue-900 mb-6 flex items-center gap-2">
        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
        </svg>
        Pengaduan
    </h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Tombol Buat Pengaduan -->
    <div class="flex justify-end mb-6">
        <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Pengaduan
        </button>
    </div>

    <!-- Tabel Pengaduan -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-blue-50">
                    <tr class="text-sm text-gray-600 uppercase">
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Judul</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($pengaduan as $index => $item)
                        <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors duration-200"
                            data-id="{{ $item->id }}"
                            data-title="{{ $item->judul }}"
                            data-desc="{{ $item->isi }}"
                            data-status="{{ $item->status }}"
                            data-img="{{ $item->gambar->first() ? asset('storage/' . $item->gambar->first()->file_path) : asset('images/placeholder.jpg') }}"
                            data-chats="{{ json_encode($item->chat->map(fn($chat) => ['user' => $chat->user->name, 'pesan' => $chat->pesan, 'dibuat_pada' => $chat->dibuat_pada ? \Carbon\Carbon::parse($chat->dibuat_pada)->format('d M Y H:i') : 'Tanggal tidak tersedia'])) }}">
                            <td class="px-6 py-4">{{ $index + 1 + ($pengaduan->currentPage() - 1) * $pengaduan->perPage() }}</td>
                            <td class="px-6 py-4">{{ $item->judul }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        'Menunggu' => 'bg-amber-100 text-amber-500',
                                        'Diproses' => 'bg-blue-100 text-blue-700',
                                        'Selesai' => 'bg-green-100 text-green-700',
                                    ];
                                    $class = $statusClasses[$item->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $class }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $item->dibuat_pada->translatedFormat('d M Y H:i') }}</td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openModal(this)" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded flex items-center justify-center space-x-2 mx-auto">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"></path>
                                    </svg>
                                    <span>Detail</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada pengaduan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $pengaduan->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- Modal Buat Pengaduan -->
    <div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden overflow-y-auto">
        <div class="bg-white rounded-xl w-full max-w-2xl mx-4 my-6 p-6 relative max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-bold text-blue-900 mb-4 text-center">Buat Pengaduan Baru</h2>
            <form id="createForm" action="{{ route('siswa.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Judul Pengaduan</label>
                    <input type="text" name="judul" required class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm py-2 px-3 @error('judul') border-red-500 @enderror" value="{{ old('judul') }}" />
                    @error('judul')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Deskripsi Pengaduan</label>
                    <textarea name="isi" rows="4" required class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm py-2 px-3 @error('isi') border-red-500 @enderror">{{ old('isi') }}</textarea>
                    @error('isi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Unggah Gambar (opsional)</label>
                    <input type="file" name="gambar[]" multiple accept="image/*" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm py-2 px-3 @error('gambar.*') border-red-500 @enderror" />
                    @error('gambar.*')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeCreateModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg">Batal</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Pengaduan -->
    <div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden overflow-y-auto">
        <div class="bg-white rounded-xl w-full max-w-2xl mx-4 my-6 p-6 relative max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-bold text-blue-900 mb-4 text-center" id="modalTitle"></h2>
            <div class="flex justify-center mb-4">
                <img id="modalImg" src="" class="rounded-lg shadow-md w-48 h-48 object-cover cursor-pointer">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700">Deskripsi Pengaduan</label>
                <textarea id="modalDesc" rows="3" readonly class="w-full border-gray-200 rounded-lg shadow-sm text-sm py-2 px-3 bg-gray-50"></textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium text-gray-700">Riwayat Chat</label>
                <div id="chatHistory" class="border border-gray-200 rounded-lg p-3 max-h-40 overflow-y-auto bg-gray-50"></div>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg">Kembali</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk membuka dan menutup modal buat pengaduan
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        document.getElementById('createForm').reset();
    }

    // Fungsi untuk membuka dan menutup modal detail
    function openModal(button) {
        const row = button.closest('tr');
        const id = row.dataset.id;
        const title = row.dataset.title;
        const desc = row.dataset.desc;
        const status = row.dataset.status;
        const img = row.dataset.img;
        const chats = JSON.parse(row.dataset.chats || '[]');

        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDesc').value = desc;
        document.getElementById('modalImg').src = img;

        const chatHistory = document.getElementById('chatHistory');
        chatHistory.innerHTML = chats.length ? chats.map(chat => {
            const isUser = chat.user === '{{ Auth::user()->name }}';
            const alignClass = isUser ? 'text-right' : 'text-left';
            const bgClass = isUser ? 'bg-blue-50 border-blue-200' : 'bg-white border-gray-200';
            const name = isUser ? 'Anda' : chat.user;
            const timestamp = chat.dibuat_pada || 'Tanggal tidak tersedia';

            return `
                <div class="mb-2 p-2 ${bgClass} rounded-lg shadow-sm border ${alignClass}">
                    <p class="text-xs text-gray-400 mb-1">${timestamp} <span class="font-bold text-gray-700">${name}</span></p>
                    <p class="text-sm text-gray-600">${chat.pesan}</p>
                </div>
            `;
        }).join('') : '<p class="text-sm text-gray-500">Belum ada balasan</p>';

        document.getElementById('modalDetail').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
    }
</script>
@endsection