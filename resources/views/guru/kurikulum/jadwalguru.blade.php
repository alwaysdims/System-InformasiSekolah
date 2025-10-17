@extends('guru.kurikulum.layout.main', ['title' => 'Pembagian Tugas Guru'])
@section('title', 'Pembagian Tugas Guru')
@section('content')

<div class="flex">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-700">Pembagian Mata Pelajaran Guru</h2>
                <button onclick="openAddModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                    + Tambah Pembagian Tugas
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-sm text-gray-500">
                            <th class="px-4 py-3">NO</th>
                            <th class="px-4 py-3">NAMA GURU</th>
                            <th class="px-4 py-3">MATA PELAJARAN</th>
                            <th class="px-4 py-3">JURUSAN</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($guruMapel as $index => $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $item->guru->nama ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->mapel->nama_mapel ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <button onclick="openDetailModal({
                                    guru: '{{ addslashes($item->guru->nama ?? '-') }}',
                                    mapel: '{{ addslashes($item->mapel->nama ?? '-') }}',
                                    jurusan: '{{ addslashes($item->jurusan->nama ?? '-') }}'
                                })" class="text-blue-600 hover:text-blue-700">Detail</button>

                                <button onclick="openEditModal({{ $item->id }}, '{{ $item->guru_id }}', '{{ $item->mapel_id }}', '{{ $item->jurusan_id }}')"
                                    class="text-yellow-600 hover:text-yellow-700">Edit</button>

                                <form action="{{ route('kurikulum.pembagianTugasGuru.destroy', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700" onclick="return confirm('Yakin hapus pembagian tugas ini?')">Hapus</button>
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
        <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Pembagian Tugas</h2>
        <form id="addGuruMapelForm" action="{{ route('kurikulum.pembagianTugasGuru.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Guru</label>
                <select name="guru_id" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach($guru as $g)
                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                <select name="mapel_id" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($mapel as $m)
                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
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
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="closeAddModal()" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
@foreach($guruMapel as $item)
<div id="editModal{{ $item->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Pembagian Tugas</h2>
        <form id="editGuruMapelForm{{ $item->id }}" action="{{ route('kurikulum.pembagianTugasGuru.update', $item->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700">Guru</label>
                <select name="guru_id" id="edit_guru_id{{ $item->id }}" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach($guru as $g)
                        <option value="{{ $g->id }}" {{ $item->guru_id == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                <select name="mapel_id" id="edit_mapel_id{{ $item->id }}" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($mapel as $m)
                        <option value="{{ $m->id }}" {{ $item->mapel_id == $m->id ? 'selected' : '' }}>{{ $m->nama }}</option>
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
    <div class="bg-white rounded-xl w-full max-w-md mx-4 p-8 relative transform scale-95 opacity-0 transition-all duration-300">
        <div class="flex justify-between items-center mb-6 border-b pb-2">
            <h2 class="text-2xl font-bold">Detail Pembagian Tugas</h2>
            <button onclick="closeDetailModal()" class="text-gray-500 hover:text-red-500">&times;</button>
        </div>
        <div class="grid grid-cols-1 gap-4 text-gray-700">
            <p><span class="font-semibold">Nama Guru:</span> <span id="detail_guru"></span></p>
            <p><span class="font-semibold">Mata Pelajaran:</span> <span id="detail_mapel"></span></p>
            <p><span class="font-semibold">Jurusan:</span> <span id="detail_jurusan"></span></p>
        </div>
        <div class="flex justify-end pt-6">
            <button onclick="closeDetailModal()" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Tutup</button>
        </div>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
}

function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
}

function openEditModal(id, guru_id, mapel_id, jurusan_id) {
    const form = document.getElementById(`editGuruMapelForm${id}`);
    form.action = `{{ url('waka-kurikulum/pembagianTugasGuru') }}/${id}`;
    document.getElementById(`edit_guru_id${id}`).value = guru_id;
    document.getElementById(`edit_mapel_id${id}`).value = mapel_id;
    document.getElementById(`edit_jurusan_id${id}`).value = jurusan_id;
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
@endsection
