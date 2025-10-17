<div class="flex">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            {{-- Alert sukses --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-700">Data Pelanggaran Siswa</h2>
                <button onclick="openAddModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                    + Tambah Pelanggaran
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-sm text-gray-500">
                            <th class="px-4 py-3">NO</th>
                            <th class="px-4 py-3">NAMA SISWA</th>
                            <th class="px-4 py-3">JENIS PELANGGARAN</th>
                            <th class="px-4 py-3">KETERANGAN</th>
                            <th class="px-4 py-3">TANGGAL</th>
                            <th class="px-4 py-3">DITANGANI OLEH</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($pelanggarans as $index => $p)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $p->siswa->nama ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $p->jenis_pelanggaran }}</td>
                                <td class="px-4 py-3">{{ $p->keterangan }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</td>
                                <td class="px-4 py-3">{{ $p->ditanganiOleh->nama ?? '-' }}</td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    <button onclick="openDetailModal('{{ $p->siswa->nama ?? '-' }}', '{{ $p->jenis_pelanggaran }}', '{{ $p->keterangan }}', '{{ $p->tanggal }}', '{{ $p->ditanganiOleh->nama ?? '-' }}')"
                                        class="text-blue-600 hover:text-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button onclick="openEditModal({{ $p->id }}, '{{ $p->siswa_id }}', '{{ $p->jenis_pelanggaran }}', '{{ $p->keterangan }}', '{{ $p->tanggal }}', '{{ $p->ditangani_oleh }}')"
                                        class="text-yellow-600 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('guru.kesiswaan.pelanggaran.destroy', $p->id) }}" method="POST"
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
        <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Pelanggaran Siswa</h2>
        <form action="{{ route('guru.kesiswaan.pelanggaran.store') }}" method="POST" class="space-y-4">
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
                <label class="block text-sm font-medium text-gray-700">Jenis Pelanggaran</label>
                <input type="text" name="jenis_pelanggaran" class="w-full border rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" class="w-full border rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Ditangani Oleh</label>
                <select name="ditangani_oleh" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <option value="">-- Pilih Guru --</option>
                    @foreach($gurus as $g)
                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
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

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Pelanggaran Siswa</h2>
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
                <label class="block text-sm font-medium text-gray-700">Jenis Pelanggaran</label>
                <input type="text" name="jenis_pelanggaran" id="edit_jenis_pelanggaran" class="w-full border rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="edit_keterangan" class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="edit_tanggal" class="w-full border rounded-lg px-3 py-2 text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Ditangani Oleh</label>
                <select name="ditangani_oleh" id="edit_ditangani_oleh" class="w-full border rounded-lg px-3 py-2 text-sm">
                    @foreach($gurus as $g)
                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                    @endforeach
                </select>
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
        <h2 class="text-lg font-bold mb-4 text-gray-700">Detail Pelanggaran</h2>
        <div class="space-y-3 text-sm text-gray-700">
            <p><span class="font-semibold">Nama Siswa:</span> <span id="detail_nama_siswa"></span></p>
            <p><span class="font-semibold">Jenis Pelanggaran:</span> <span id="detail_jenis"></span></p>
            <p><span class="font-semibold">Keterangan:</span> <span id="detail_keterangan"></span></p>
            <p><span class="font-semibold">Tanggal:</span> <span id="detail_tanggal"></span></p>
            <p><span class="font-semibold">Ditangani Oleh:</span> <span id="detail_guru"></span></p>
        </div>
        <div class="flex justify-end pt-4">
            <button type="button" onclick="closeDetailModal()" class="bg-gray-300 px-4 py-2 rounded-lg">Tutup</button>
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

    function openEditModal(id, siswa_id, jenis, ket, tanggal, guru_id) {
        const form = document.getElementById('editForm');
        form.action = `/guru/kesiswaan/pelanggaran/${id}`;
        document.getElementById('edit_siswa_id').value = siswa_id;
        document.getElementById('edit_jenis_pelanggaran').value = jenis;
        document.getElementById('edit_keterangan').value = ket;
        document.getElementById('edit_tanggal').value = tanggal;
        document.getElementById('edit_ditangani_oleh').value = guru_id;
        document.getElementById('editModal').classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openDetailModal(nama, jenis, ket, tanggal, guru) {
        document.getElementById('detail_nama_siswa').textContent = nama;
        document.getElementById('detail_jenis').textContent = jenis;
        document.getElementById('detail_keterangan').textContent = ket;
        document.getElementById('detail_tanggal').textContent = tanggal;
        document.getElementById('detail_guru').textContent = guru;
        document.getElementById('detailModal').classList.remove('hidden');
    }
    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    // Auto-hide alert setelah 3 detik
    setTimeout(() => {
        const alert = document.querySelector('[role="alert"]');
        if(alert) alert.style.display = 'none';
    }, 3000)
</script>
