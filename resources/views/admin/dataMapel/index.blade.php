
<div class="flex">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-700">Data Mata Pelajaran</h2>
                <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                    + Tambah Mata Pelajaran
                </button>
            </div>

            <!-- Flash Message -->
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-sm text-gray-500">
                            <th class="px-4 py-3">NO</th>
                            <th class="px-4 py-3">KODE MAPEL</th>
                            <th class="px-4 py-3">NAMA MAPEL</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($mapels as $index => $mapel)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $mapel->kode_mapel }}</td>
                            <td class="px-4 py-3">{{ $mapel->nama_mapel }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <button onclick="openDetailModal({
                                    kode_mapel: '{{ $mapel->kode_mapel }}',
                                    nama_mapel: '{{ $mapel->nama_mapel }}'
                                })" class="text-blue-600 hover:text-blue-700">Detail</button>

                                <button onclick="openEditModal({{ $mapel->id }}, '{{ $mapel->kode_mapel }}', '{{ $mapel->nama_mapel }}')"
                                    class="text-yellow-600 hover:text-yellow-700">Edit</button>

                                <form action="{{ route('admin.dataMapel.destroy', $mapel->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700" onclick="return confirm('Yakin hapus mata pelajaran ini?')">Hapus</button>
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
        <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Mata Pelajaran</h2>
        <form id="addMapelForm" action="{{ route('admin.dataMapel.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <input type="text" name="kode_mapel" placeholder="Kode Mata Pelajaran" class="w-full border rounded-lg px-3 py-2" value="{{ old('kode_mapel') }}">
                @error('kode_mapel')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="text" name="nama_mapel" placeholder="Nama Mata Pelajaran" class="w-full border rounded-lg px-3 py-2" value="{{ old('nama_mapel') }}">
                @error('nama_mapel')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="closeAddModal()" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Mata Pelajaran</h2>
        <form id="editMapelForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <input type="text" name="kode_mapel" id="edit_kode_mapel" class="w-full border rounded-lg px-3 py-2">
                @error('kode_mapel')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="text" name="nama_mapel" id="edit_nama_mapel" class="w-full border rounded-lg px-3 py-2">
                @error('nama_mapel')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl w-full max-w-2xl mx-4 p-8 relative transform scale-95 opacity-0 transition-all duration-300">
        <div class="flex justify-between items-center mb-6 border-b pb-2">
            <h2 class="text-2xl font-bold">Detail Mata Pelajaran</h2>
            <button onclick="closeDetailModal()" class="text-gray-500 hover:text-red-500">&times;</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <div>
                <p><span class="font-semibold">Kode Mata Pelajaran:</span> <span id="detail_kode_mapel"></span></p>
            </div>
            <div>
                <p><span class="font-semibold">Nama Mata Pelajaran:</span> <span id="detail_nama_mapel"></span></p>
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

function openEditModal(id, kode_mapel, nama_mapel) {
    const form = document.getElementById('editMapelForm');
    form.action = `{{ url('mapel') }}/${id}`;
    document.getElementById('edit_kode_mapel').value = kode_mapel;
    document.getElementById('edit_nama_mapel').value = nama_mapel;
    document.getElementById('editModal').classList.remove('hidden');
}
function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
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
{{-- @endsection --}}
