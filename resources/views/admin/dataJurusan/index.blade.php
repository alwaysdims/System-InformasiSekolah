<div class="flex">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-700">Data Jurusan</h2>
                <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                    + Tambah Jurusan
                </button>
            </div>

            <!-- Modal Tambah Jurusan -->
            <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Jurusan</h2>
                    <form action="{{ route('admin.dataJurusan.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Kode Jurusan</label>
                            <input type="text" name="kode_jurusan" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('kode_jurusan') }}">
                            @error('kode_jurusan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Nama Jurusan</label>
                            <input type="text" name="nama_jurusan" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('nama_jurusan') }}">
                            @error('nama_jurusan')
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

            <!-- Modal Detail Jurusan -->
            <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Detail Jurusan</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kode Jurusan</label>
                            <p id="detail_kode_jurusan" class="text-gray-900"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Jurusan</label>
                            <p id="detail_nama_jurusan" class="text-gray-900"></p>
                        </div>
                        <div class="flex justify-end space-x-2 pt-2">
                            <button onclick="closeDetailModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                                Tutup
                            </button>
                            <button onclick="openEditFromDetail()" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Jurusan -->
            <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Jurusan</h2>
                    <form id="editJurusanForm" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="jurusan_id" id="edit_jurusan_id">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Kode Jurusan</label>
                            <input type="text" name="kode_jurusan" id="edit_kode_jurusan" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('kode_jurusan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Nama Jurusan</label>
                            <input type="text" name="nama_jurusan" id="edit_nama_jurusan" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('nama_jurusan')
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

            <!-- Modal Hapus Jurusan -->
            <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Konfirmasi Hapus Jurusan</h2>
                    <p class="text-gray-700 mb-4">Apakah Anda yakin ingin menghapus jurusan <span id="delete_jurusan_name" class="font-semibold"></span>?</p>
                    <form id="deleteJurusanForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-end space-x-2 pt-2">
                            <button type="button" onclick="closeDeleteModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                                Batal
                            </button>
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg">
                                Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-sm text-gray-500">
                            <th class="px-4 py-3">NO</th>
                            <th class="px-4 py-3">KODE JURUSAN</th>
                            <th class="px-4 py-3">NAMA JURUSAN</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($jurusans as $index => $jurusan)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $jurusan->kode_jurusan }}</td>
                                <td class="px-4 py-3">{{ $jurusan->nama_jurusan }}</td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    <button onclick="openDetailModal({{ $jurusan->id }}, '{{ $jurusan->kode_jurusan }}', '{{ $jurusan->nama_jurusan }}')" class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1.5 rounded">Lihat</button>
                                    <button onclick="openEditModal({{ $jurusan->id }}, '{{ $jurusan->kode_jurusan }}', '{{ $jurusan->nama_jurusan }}')" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1.5 rounded">Edit</button>
                                    <button onclick="openDeleteModal({{ $jurusan->id }}, '{{ $jurusan->nama_jurusan }}')" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 rounded">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-center text-gray-500">Belum ada data jurusan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    let currentJurusanId = null;

    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openDetailModal(id, kode_jurusan, nama_jurusan) {
        currentJurusanId = id;
        document.getElementById('detail_kode_jurusan').textContent = kode_jurusan;
        document.getElementById('detail_nama_jurusan').textContent = nama_jurusan;
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
        currentJurusanId = null;
    }

    function openEditModal(id, kode_jurusan, nama_jurusan) {
        currentJurusanId = id;
        document.getElementById('edit_jurusan_id').value = id;
        document.getElementById('edit_kode_jurusan').value = kode_jurusan;
        document.getElementById('edit_nama_jurusan').value = nama_jurusan;
        document.getElementById('editJurusanForm').action = `{{ url('admin/jurusan') }}/${id}`;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        currentJurusanId = null;
    }

    function openEditFromDetail() {
        closeDetailModal();
        document.getElementById('edit_jurusan_id').value = currentJurusanId;
        document.getElementById('edit_kode_jurusan').value = document.getElementById('detail_kode_jurusan').textContent;
        document.getElementById('edit_nama_jurusan').value = document.getElementById('detail_nama_jurusan').textContent;
        document.getElementById('editJurusanForm').action = `{{ url('admin/jurusan') }}/${currentJurusanId}`;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function openDeleteModal(id, nama_jurusan) {
        document.getElementById('delete_jurusan_name').textContent = nama_jurusan;
        document.getElementById('deleteJurusanForm').action = `{{ url('admin/jurusan') }}/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Automatically open modals based on session data
    @if(session('openAddModal'))
        window.onload = function() {
            openAddModal();
        };
    @endif

    @if(session('openDetailModal'))
        window.onload = function() {
            @foreach($jurusans as $jurusan)
                @if($jurusan->id == session('openDetailModal'))
                    openDetailModal({{ $jurusan->id }}, '{{ $jurusan->kode_jurusan }}', '{{ $jurusan->nama_jurusan }}');
                @endif
            @endforeach
        };
    @endif

    @if(session('openEditModal'))
        window.onload = function() {
            @foreach($jurusans as $jurusan)
                @if($jurusan->id == session('openEditModal'))
                    openEditModal({{ $jurusan->id }}, '{{ $jurusan->kode_jurusan }}', '{{ $jurusan->nama_jurusan }}');
                @endif
            @endforeach
        };
    @endif
</script>
