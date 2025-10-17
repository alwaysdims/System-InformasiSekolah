<div class="flex">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">

            {{-- Notifikasi sukses --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-700">Data Prestasi Siswa</h2>
                <button onclick="openAddModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                    + Tambah Prestasi
                </button>
            </div>

            <!-- Table Prestasi -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-sm text-gray-500">
                            <th class="px-4 py-3">NO</th>
                            <th class="px-4 py-3">NAMA SISWA</th>
                            <th class="px-4 py-3">PRESTASI</th>
                            <th class="px-4 py-3">KETERANGAN</th>
                            <th class="px-4 py-3">TANGGAL</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($prestasis as $index => $p)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $p->siswa->nama ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $p->prestasi }}</td>
                                <td class="px-4 py-3">{{ $p->keterangan }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    <!-- Detail -->
                                    <button onclick="openDetailModal('{{ $p->siswa->nama ?? '-' }}', '{{ $p->prestasi }}', '{{ $p->keterangan }}', '{{ $p->tanggal }}')"
                                        class="text-blue-600 hover:text-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <button onclick="openEditModal({{ $p->id }}, '{{ $p->siswa_id }}', '{{ $p->prestasi }}', '{{ $p->keterangan }}', '{{ $p->tanggal }}')"
                                        class="text-yellow-600 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Hapus -->
                                    <form action="{{ route('guru.kesiswaan.prestasi.destroy', $p->id) }}" method="POST"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')"
                                                class="text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
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

<!-- Modal Tambah -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Prestasi Siswa</h2>
        <form action="{{ route('guru.kesiswaan.prestasi.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Siswa</label>
                <select name="siswa_id" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswas as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Prestasi</label>
                <input type="text" name="prestasi" class="w-full border rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" class="w-full border rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="closeAddModal()" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Prestasi Siswa</h2>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700">Siswa</label>
                <select name="siswa_id" id="edit_siswa_id" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                    @foreach($siswas as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Prestasi</label>
                <input type="text" name="prestasi" id="edit_prestasi" class="w-full border rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="edit_keterangan" class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="edit_tanggal" class="w-full border rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Detail Prestasi Siswa</h2>
        <div class="space-y-3 text-sm text-gray-700">
            <p><span class="font-semibold">Nama Siswa:</span> <span id="detail_nama_siswa"></span></p>
            <p><span class="font-semibold">Prestasi:</span> <span id="detail_prestasi"></span></p>
            <p><span class="font-semibold">Keterangan:</span> <span id="detail_keterangan"></span></p>
            <p><span class="font-semibold">Tanggal:</span> <span id="detail_tanggal"></span></p>
        </div>
        <div class="flex justify-end pt-4">
            <button type="button" onclick="closeDetailModal()" class="bg-gray-300 px-4 py-2 rounded-lg">Tutup</button>
        </div>
    </div>
</div>

<script>
    // Modal functions
    function openAddModal() { document.getElementById('addModal').classList.remove('hidden'); }
    function closeAddModal() { document.getElementById('addModal').classList.add('hidden'); }

    function openEditModal(id, siswa_id, prestasi, keterangan, tanggal) {
        const form = document.getElementById('editForm');
        form.action = `/guru/kesiswaan/prestasi/${id}`;
        document.getElementById('edit_siswa_id').value = siswa_id;
        document.getElementById('edit_prestasi').value = prestasi;
        document.getElementById('edit_keterangan').value = keterangan;
        document.getElementById('edit_tanggal').value = tanggal;
        document.getElementById('editModal').classList.remove('hidden');
    }
    function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }

    function openDetailModal(nama, prestasi, keterangan, tanggal) {
        document.getElementById('detail_nama_siswa').textContent = nama;
        document.getElementById('detail_prestasi').textContent = prestasi;
        document.getElementById('detail_keterangan').textContent = keterangan;
        document.getElementById('detail_tanggal').textContent = tanggal;
        document.getElementById('detailModal').classList.remove('hidden');
    }
    function closeDetailModal() { document.getElementById('detailModal').classList.add('hidden'); }

    // Auto-hide alert
    setTimeout(() => {
        const alert = document.querySelector('[role="alert"]');
        if(alert) alert.style.display = 'none';
    }, 3000);
</script>
