<div class="flex">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-700">Data Siswa</h2>
                <button onclick="openAddModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                    + Tambah Siswa
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-sm text-gray-500">
                            <th class="px-4 py-3">NO</th>
                            <th class="px-4 py-3">NAMA</th>
                            <th class="px-4 py-3">NIS</th>
                            <th class="px-4 py-3">USER</th>
                            <th class="px-4 py-3">KELAS</th>
                            <th class="px-4 py-3">JURUSAN</th>
                            <th class="px-4 py-3">WALI MURID</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($siswa as $index => $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $item->nama }}</td>
                            <td class="px-4 py-3">{{ $item->nis ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->user->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->kelas->nama ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->jurusan->nama ?? '-' }}</td>
                            <td class="px-4 py-3">
                                @foreach($item->waliMurid as $wali)
                                    <span>{{ $wali->nama }}</span>@if(!$loop->last), @endif
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <button onclick="openDetailModal({
                                    nama: '{{ addslashes($item->nama) }}',
                                    nis: '{{ addslashes($item->nis ?? '-') }}',
                                    user: '{{ addslashes($item->user->name ?? '-') }}',
                                    kelas: '{{ addslashes($item->kelas->nama ?? '-') }}',
                                    jurusan: '{{ addslashes($item->jurusan->nama ?? '-') }}',
                                    wali_murid: '{{ addslashes(implode(', ', $item->waliMurid->pluck('nama')->toArray())) }}',
                                    alamat: '{{ addslashes($item->alamat ?? '-') }}',
                                    no_hp: '{{ addslashes($item->no_hp ?? '-') }}'
                                })" class="text-blue-600 hover:text-blue-700">Detail</button>

                                <button onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->nama) }}', '{{ addslashes($item->nis ?? '') }}', '{{ $item->user_id ?? '' }}', '{{ $item->kelas_id ?? '' }}', '{{ $item->jurusan_id ?? '' }}', '{{ $item->waliMurid->pluck('id')->toJson() }}', '{{ addslashes($item->alamat ?? '') }}', '{{ addslashes($item->no_hp ?? '') }}')"
                                    class="text-yellow-600 hover:text-yellow-700">Edit</button>

                                <form action="{{ route('admin.dataSiswa.destroy', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700" onclick="return confirm('Yakin hapus siswa ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

{{-- MODAL TAMBAH --}}
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Siswa</h2>
        <form id="addSiswaForm" action="{{ route('admin.dataSiswa.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">User</label>
                <select name="user_id" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($siswa as $user)
                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">NIS</label>
                <input type="text" name="nis" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="kelas_id" class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                <select name="jurusan_id" class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Wali Murid</label>
                <select name="wali_murid_ids[]" multiple class="w-full border rounded-lg px-3 py-2 h-32 overflow-y-auto">
                    @foreach($waliMurid as $w)
                        <option value="{{ $w->id }}">{{ $w->nama }}</option>
                    @endforeach
                </select>
                <small class="text-gray-500">Tahan Ctrl/Cmd untuk memilih lebih dari satu</small>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="no_hp" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="closeAddModal()" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
@foreach($siswa as $item)
<div id="editModal{{ $item->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Siswa</h2>
        <form id="editSiswaForm{{ $item->id }}" action="{{ route('admin.dataSiswa.update', $item->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700">User</label>
                <select name="user_id" id="edit_user_id{{ $item->id }}" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $item->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">NIS</label>
                <input type="text" name="nis" id="edit_nis{{ $item->id }}" class="w-full border rounded-lg px-3 py-2" value="{{ $item->nis ?? '' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="edit_nama{{ $item->id }}" class="w-full border rounded-lg px-3 py-2" value="{{ $item->nama }}" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                <select name="kelas_id" id="edit_kelas_id{{ $item->id }}" class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ $item->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                <select name="jurusan_id" id="edit_jurusan_id{{ $item->id }}" class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->id }}" {{ $item->jurusan_id == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Wali Murid</label>
                <select name="wali_murid_ids[]" id="edit_wali_murid_ids{{ $item->id }}" multiple class="w-full border rounded-lg px-3 py-2 h-32 overflow-y-auto">
                    @foreach($waliMurid as $w)
                        <option value="{{ $w->id }}" {{ in_array($w->id, $item->waliMurid->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $w->nama }}</option>
                    @endforeach
                </select>
                <small class="text-gray-500">Tahan Ctrl/Cmd untuk memilih lebih dari satu</small>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" id="edit_alamat{{ $item->id }}" class="w-full border rounded-lg px-3 py-2">{{ $item->alamat ?? '' }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="no_hp" id="edit_no_hp{{ $item->id }}" class="w-full border rounded-lg px-3 py-2" value="{{ $item->no_hp ?? '' }}">
            </div>
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="closeEditModal('{{ $item->id }}')" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- MODAL DETAIL --}}
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl w-full max-w-2xl mx-4 p-8 relative transform scale-95 opacity-0 transition-all duration-300">
        <div class="flex justify-between items-center mb-6 border-b pb-2">
            <h2 class="text-2xl font-bold">Detail Siswa</h2>
            <button onclick="closeDetailModal()" class="text-gray-500 hover:text-red-500">&times;</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <div>
                <p><span class="font-semibold">Nama:</span> <span id="detail_nama"></span></p>
                <p><span class="font-semibold">NIS:</span> <span id="detail_nis"></span></p>
                <p><span class="font-semibold">User:</span> <span id="detail_user"></span></p>
                <p><span class="font-semibold">Kelas:</span> <span id="detail_kelas"></span></p>
            </div>
            <div>
                <p><span class="font-semibold">Jurusan:</span> <span id="detail_jurusan"></span></p>
                <p><span class="font-semibold">Wali Murid:</span> <span id="detail_wali_murid"></span></p>
                <p><span class="font-semibold">Alamat:</span> <span id="detail_alamat"></span></p>
                <p><span class="font-semibold">No HP:</span> <span id="detail_no_hp"></span></p>
            </div>
        </div>
        <div class="flex justify-end pt-6">
            <button onclick="closeDetailModal()" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Tutup</button>
        </div>
    </div>
</div>

{{-- @section('scripts') --}}
<script>
function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
}

function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
}

function openEditModal(id, nama, nis, user_id, kelas_id, jurusan_id, wali_murid_ids, alamat, no_hp) {
    const form = document.getElementById(`editSiswaForm${id}`);
    form.action = `{{ url('admin/dataSiswa') }}/${id}`;
    document.getElementById(`edit_nama${id}`).value = nama;
    document.getElementById(`edit_nis${id}`).value = nis;
    document.getElementById(`edit_user_id${id}`).value = user_id;
    document.getElementById(`edit_kelas_id${id}`).value = kelas_id;
    document.getElementById(`edit_jurusan_id${id}`).value = jurusan_id;
    document.getElementById(`edit_alamat${id}`).value = alamat;
    document.getElementById(`edit_no_hp${id}`).value = no_hp;

    // Handle multiple select for wali_murid_ids
    const waliMuridSelect = document.getElementById(`edit_wali_murid_ids${id}`);
    const waliMuridIdsArray = JSON.parse(wali_murid_ids);
    for (let option of waliMuridSelect.options) {
        option.selected = waliMuridIdsArray.includes(parseInt(option.value));
    }

    document.getElementById(`editModal${id}`).classList.remove('hidden');
}

function closeEditModal(id) {
    document.getElementById(`editModal${id}`).classList.add('hidden');
}

function openDetailModal(data) {
    for (const key in data) {
        if (document.getElementById('detail_' + key)) {
            document.getElementById('detail_' + key).textContent = data[key];
        }
    }
    const modal = document.getElementById('detailModal');
    const modalContent = modal.querySelector('div:first-child');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    const modalContent = modal.querySelector('div:first-child');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    modal.addEventListener('transitionend', () => modal.classList.add('hidden'), { once: true });
}
</script>

