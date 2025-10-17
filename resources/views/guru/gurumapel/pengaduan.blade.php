@extends('guru.gurumapel.layouts.app')

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

    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-4 sm:space-y-0 mb-6 bg-white rounded-xl shadow-lg p-4">
        <div class="relative flex items-center w-full sm:w-64">
            <svg class="w-5 h-5 text-gray-400 absolute left-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <circle cx="11" cy="11" r="7"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input id="searchInput" type="text" placeholder="Cari judul pengaduan..." class="w-full pl-10 pr-3 py-2 border rounded-lg bg-gray-50 text-gray-700 focus:ring-blue-500 focus:border-blue-500" value="{{ request('search') }}" />
        </div>
        <select id="statusFilter" class="w-full sm:w-48 px-3 py-2 border rounded-lg bg-white text-gray-700 focus:ring-blue-500 focus:border-blue-500">
            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
            <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        <select id="dateFilter" class="w-full sm:w-48 px-3 py-2 border rounded-lg bg-white text-gray-700 focus:ring-blue-500 focus:border-blue-500">
            <option value="" {{ request('date') == '' ? 'selected' : '' }}>Semua Tanggal</option>
            <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Hari Ini</option>
            <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
            <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
        </select>
        <a href="{{ route('guru.pengaduan') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Reset
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-blue-50">
                    <tr class="text-sm text-gray-600 uppercase">
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Judul</th>
                        <th class="px-6 py-3">Pelapor</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Ditujukan</th>
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
                            data-reason="{{ $item->alasan ?? '' }}"
                            data-chats="{{ json_encode($item->chat->map(fn($chat) => ['user' => $chat->user->name, 'pesan' => $chat->pesan, 'dibuat_pada' => $chat->dibuat_pada ? \Carbon\Carbon::parse($chat->dibuat_pada)->format('d M Y H:i') : 'Tanggal tidak tersedia'])) }}">
                            <td class="px-6 py-4">{{ $index + 1 + ($pengaduan->currentPage() - 1) * $pengaduan->perPage() }}</td>
                            <td class="px-6 py-4">{{ $item->judul }}</td>
                            <td class="px-6 py-4 flex items-center space-x-2">
                                <div class="w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-semibold">
                                    {{ strtoupper(substr($item->siswa->nama, 0, 2)) }}
                                </div>
                                <span>{{ $item->siswa->nama }}</span>
                            </td>
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
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                    {{ $item->siswa->jurusan->nama ?? 'Umum' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openModal(this)" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded flex items-center justify-center space-x-2 mx-auto">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"></path>
                                    </svg>
                                    <span>Jawab</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada pengaduan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $pengaduan->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    </div>

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
            <form id="responseForm" action="" method="POST" data-old-id="">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Balasan</label>
                    <textarea name="pesan" rows="3" required class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm py-2 px-3 @error('pesan') border-red-500 @enderror">{{ old('pesan') }}</textarea>
                    @error('pesan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium text-gray-700">Ubah Status</label>
                    <select name="status" id="statusSelect" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm py-2 px-3 @error('status') border-red-500 @enderror">
                        <option value="Menunggu">Menunggu</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div id="reasonSection" class="mb-4 hidden">
                    <label class="block mb-1 font-medium text-gray-700">Alasan (untuk Selesai)</label>
                    <input type="text" name="alasan" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm py-2 px-3 @error('alasan') border-red-500 @enderror" value="{{ old('alasan') }}" />
                    @error('alasan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg">Kembali</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let lastOpenedPengaduanId = null;

    function openModal(button) {
        const row = button.closest('tr');
        const id = row.dataset.id;
        const title = row.dataset.title;
        const desc = row.dataset.desc;
        const status = row.dataset.status;
        const img = row.dataset.img;
        const reason = row.dataset.reason;
        const chats = JSON.parse(row.dataset.chats || '[]');

        lastOpenedPengaduanId = id;

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

        const form = document.getElementById('responseForm');
        const statusSelect = form.querySelector('select[name="status"]');
        const reasonSection = document.getElementById('reasonSection');
        const reasonInput = form.querySelector('input[name="alasan"]');
        
        const hasErrors = {{ $errors->any() ? 'true' : 'false' }};
        const oldId = form.dataset.oldId;
        
        if (hasErrors && oldId === id) {
            statusSelect.value = '{{ old('status', '') }}';
            reasonInput.value = '{{ old('alasan', '') }}';
        } else {
            statusSelect.value = status;
            reasonInput.value = reason || '';
        }
        
        reasonSection.classList.toggle('hidden', statusSelect.value !== 'Selesai');

        form.action = `{{ url('guru/pengaduan') }}/${id}/response`;
        document.getElementById('modalDetail').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
        lastOpenedPengaduanId = null;
    }

    document.getElementById('statusSelect').addEventListener('change', function () {
        const reasonSection = document.getElementById('reasonSection');
        reasonSection.classList.toggle('hidden', this.value !== 'Selesai');
    });

    document.getElementById('searchInput').addEventListener('input', function () {
        const url = new URL(window.location);
        url.searchParams.set('search', this.value);
        window.location = url;
    });

    document.getElementById('statusFilter').addEventListener('change', function () {
        const url = new URL(window.location);
        url.searchParams.set('status', this.value);
        window.location = url;
    });

    document.getElementById('dateFilter').addEventListener('change', function () {
        const url = new URL(window.location);
        url.searchParams.set('date', this.value);
        window.location = url;
    });

    @if ($errors->any())
        const urlSegments = window.location.pathname.split('/');
        const responseIndex = urlSegments.indexOf('response');
        let failedId = null;
        if (responseIndex > 0) {
            failedId = urlSegments[responseIndex - 1];
        }

        if (failedId) {
            document.getElementById('responseForm').dataset.oldId = failedId;

            const row = document.querySelector(`tr[data-id="${failedId}"]`);
            if (row) {
                const button = row.querySelector('button[onclick="openModal(this)"]');
                if (button) {
                    openModal(button);
                    document.getElementById('modalDetail').scrollTop = 0;
                }
            }
        }
    @endif
</script>
@endsection