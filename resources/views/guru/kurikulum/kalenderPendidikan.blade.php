@extends('guru.kurikulum.layout.main', ['title' => 'Kalender Pendidikan'])
@section('title', 'Kalender Pendidikan')
@section('content')

<div class="flex">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-700">Data Kalender Pendidikan</h2>
                <!-- Tombol Tambah Kegiatan -->
                <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                    + Tambah Kegiatan
                </button>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Modal Tambah Kegiatan -->
            <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative max-h-[90vh] overflow-y-auto">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Kegiatan</h2>
                    <form id="addKalenderForm" action="{{ route('kurikulum.kalenderPendidikan.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" placeholder="Tahun Ajaran (e.g., 2024/2025)" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('tahun_ajaran') border-red-500 @enderror" value="{{ old('tahun_ajaran') }}">
                            @error('tahun_ajaran')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Semester</label>
                            <select name="semester" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('semester') border-red-500 @enderror">
                                <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>2</option>
                            </select>
                            @error('semester')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Kegiatan</label>
                            <input type="text" name="kegiatan" placeholder="Nama Kegiatan" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('kegiatan') border-red-500 @enderror" value="{{ old('kegiatan') }}">
                            @error('kegiatan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('tanggal_mulai') border-red-500 @enderror" value="{{ old('tanggal_mulai') }}">
                            @error('tanggal_mulai')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('tanggal_selesai') border-red-500 @enderror" value="{{ old('tanggal_selesai') }}">
                            @error('tanggal_selesai')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end space-x-2 pt-2">
                            <button type="button" onclick="closeAddModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                                Batal
                            </button>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Edit Kegiatan -->
            <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Kegiatan</h2>
                    <form id="editKalenderForm" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" id="edit_tahun_ajaran" placeholder="Tahun Ajaran (e.g., 2024/2025)" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('tahun_ajaran') border-red-500 @enderror">
                            @error('tahun_ajaran')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Semester</label>
                            <select name="semester" id="edit_semester" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('semester') border-red-500 @enderror">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                            @error('semester')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Kegiatan</label>
                            <input type="text" name="kegiatan" id="edit_kegiatan" placeholder="Nama Kegiatan" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('kegiatan') border-red-500 @enderror">
                            @error('kegiatan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('tanggal_mulai') border-red-500 @enderror">
                            @error('tanggal_mulai')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="edit_tanggal_selesai" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('tanggal_selesai') border-red-500 @enderror">
                            @error('tanggal_selesai')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end space-x-2 pt-2">
                            <button type="button" onclick="closeEditModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                                Batal
                            </button>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Detail Kegiatan -->
            <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Detail Kegiatan</h2>
                    <div class="space-y-3 text-sm text-gray-700">
                        <p><span class="font-semibold">Tahun Ajaran:</span> <span id="detail_tahun_ajaran"></span></p>
                        <p><span class="font-semibold">Semester:</span> <span id="detail_semester"></span></p>
                        <p><span class="font-semibold">Kegiatan:</span> <span id="detail_kegiatan"></span></p>
                        <p><span class="font-semibold">Tanggal Mulai:</span> <span id="detail_tanggal_mulai"></span></p>
                        <p><span class="font-semibold">Tanggal Selesai:</span> <span id="detail_tanggal_selesai"></span></p>
                        <p><span class="font-semibold">Dibuat Oleh:</span> <span id="detail_dibuat_oleh"></span></p>
                        <p><span class="font-semibold">Dibuat Pada:</span> <span id="detail_dibuat_pada"></span></p>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="button" onclick="closeDetailModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-sm text-gray-500">
                            <th class="px-4 py-3">NO</th>
                            <th class="px-4 py-3">TAHUN AJARAN</th>
                            <th class="px-4 py-3">SEMESTER</th>
                            <th class="px-4 py-3">KEGIATAN</th>
                            <th class="px-4 py-3">TANGGAL MULAI</th>
                            <th class="px-4 py-3">TANGGAL SELESAI</th>
                            <th class="px-4 py-3">DIBUAT OLEH</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($kalenderPendidikans as $index => $kalender)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $kalender->tahun_ajaran }}</td>
                                <td class="px-4 py-3">{{ $kalender->semester }}</td>
                                <td class="px-4 py-3">{{ $kalender->kegiatan }}</td>
                                <td class="px-4 py-3">{{ $kalender->tanggal_mulai }}</td>
                                <td class="px-4 py-3">{{ $kalender->tanggal_selesai }}</td>
                                <td class="px-4 py-3">{{ $kalender->pembuat->username ?? '-' }}</td> <!-- Asumsi User punya field 'name' -->
                                <td class="px-4 py-3 text-center space-x-2">
                                    <button onclick="openDetailModal('{{ $kalender->id }}', '{{ $kalender->tahun_ajaran }}', '{{ $kalender->semester }}', '{{ $kalender->kegiatan }}', '{{ $kalender->tanggal_mulai }}', '{{ $kalender->tanggal_selesai }}', '{{ $kalender->pembuat->name ?? '-' }}', '{{ $kalender->dibuat_pada }}')" class="text-blue-600 hover:text-blue-700 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                        </svg>
                                    </button>
                                    <button onclick="openEditModal('{{ $kalender->id }}', '{{ $kalender->tahun_ajaran }}', '{{ $kalender->semester }}', '{{ $kalender->kegiatan }}', '{{ $kalender->tanggal_mulai }}', '{{ $kalender->tanggal_selesai }}')" class="text-yellow-600 hover:text-yellow-700 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('kurikulum.kalenderPendidikan.destroy', $kalender->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 transition-colors duration-200" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-3 text-center text-gray-500">Tidak ada data Kalender Pendidikan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.getElementById('addKalenderForm').reset();
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openEditModal(id, tahun_ajaran, semester, kegiatan, tanggal_mulai, tanggal_selesai) {
        const form = document.getElementById('editKalenderForm');
        form.action = `{{ route('kurikulum.kalenderPendidikan.update', ['kalenderPendidikan' => ':id']) }}`.replace(':id', id);
        document.getElementById('edit_tahun_ajaran').value = tahun_ajaran;
        document.getElementById('edit_semester').value = semester;
        document.getElementById('edit_kegiatan').value = kegiatan;
        document.getElementById('edit_tanggal_mulai').value = tanggal_mulai;
        document.getElementById('edit_tanggal_selesai').value = tanggal_selesai;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openDetailModal(id, tahun_ajaran, semester, kegiatan, tanggal_mulai, tanggal_selesai, dibuat_oleh, dibuat_pada) {
        document.getElementById('detail_tahun_ajaran').textContent = tahun_ajaran;
        document.getElementById('detail_semester').textContent = semester;
        document.getElementById('detail_kegiatan').textContent = kegiatan;
        document.getElementById('detail_tanggal_mulai').textContent = tanggal_mulai;
        document.getElementById('detail_tanggal_selesai').textContent = tanggal_selesai;
        document.getElementById('detail_dibuat_oleh').textContent = dibuat_oleh;
        document.getElementById('detail_dibuat_pada').textContent = dibuat_pada;
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>

@endsection
