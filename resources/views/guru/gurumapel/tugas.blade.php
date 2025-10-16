@extends('guru.gurumapel.layouts.app')
@section('content')
<main class="flex-1 overflow-y-auto p-6">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                @foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach
            </div>
        @endif

        <!-- Filter Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:space-x-4 space-y-3 sm:space-y-0 mb-6 bg-gray-50 p-4 rounded-lg shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0 w-full">
                <div class="relative w-full sm:w-72">
                    <input id="searchInput" type="text" placeholder="🔍 Cari soal..." value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm" />
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <div class="relative w-full sm:w-52">
                    <select id="mapelFilter" class="w-full pl-10 pr-4 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm appearance-none">
                        <option value="">📘 Semua Mapel</option>
                        @foreach($guruMapels as $gm)
                            <option value="{{ $gm->mapel->nama }}" {{ request('mapel') == $gm->mapel->nama ? 'selected' : '' }}>{{ $gm->mapel->nama }}</option>
                        @endforeach
                    </select>
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
            <div>
                <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white text-sm px-5 py-2 rounded-lg flex items-center space-x-2 shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                    <span>+ Tambah Soal</span>
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse shadow rounded-lg overflow-hidden">
                <thead>
                    <tr class="border-b border-gray-200 text-sm text-gray-600 bg-gray-100">
                        <th class="px-4 py-3">NO</th>
                        <th class="px-4 py-3">JUDUL</th>
                        <th class="px-4 py-3">MAPEL</th>
                        <th class="px-4 py-3 text-center">LIHAT SOAL</th>
                        <th class="px-4 py-3 text-center">SUDAH MENGERJAKAN</th>
                        <th class="px-4 py-3 text-center">TERBITKAN</th>
                        <th class="px-4 py-3 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody id="questionsTableBody" class="text-gray-700">
                    @forelse($tugas as $index => $t)
                        <tr class="border-b border-gray-100 hover:bg-gray-50" data-judul="{{ strtolower($t->judul) }}" data-mapel="{{ strtolower($t->guruMapel->mapel->nama) }}">
                            <td class="px-4 py-3">{{ $tugas->firstItem() + $index }}</td>
                            <td class="px-4 py-3">{{ $t->judul }}</td>
                            <td class="px-4 py-3">{{ $t->guruMapel->mapel->nama_mapel }}</td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('guru.detail.tugas', $t->id) }}" class="p-2 bg-green-600 hover:bg-green-700 text-white rounded-full inline-flex items-center justify-center" title="Lihat Soal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                                    </svg>
                                </a>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('guru.tugas.hasil', $t->id) }}" class="p-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full inline-flex items-center justify-center" title="Lihat Hasil">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </a>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($t->isPublished())
                                    <span class="p-2 bg-green-600 text-white rounded-full" title="Sudah Diterbitkan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                @else
                                    <button onclick="openPublishModal({{ $t->id }})" class="p-2 bg-purple-600 hover:bg-purple-700 text-white rounded-full" title="Terbitkan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4" />
                                        </svg>
                                    </button>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="openEditModal({{ $t->id }})" class="p-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4h2m-1 0v16m8-8H4" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('guru.tugas.destroy', $t->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-600 hover:bg-red-700 text-white rounded-full" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-3 text-center text-gray-500">Belum ada tugas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Laravel Pagination -->
        <div class="mt-6">{{ $tugas->appends(request()->query())->links() }}</div>

        <!-- Modal Tambah Soal -->
        <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden overflow-y-auto">
            <div class="bg-white rounded-lg w-full max-w-lg mx-4 p-6 relative">
                <button onclick="closeAddModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">✖</button>
                <h2 class="text-xl font-bold mb-4 text-center">Tambah Soal</h2>
                <form id="addForm" action="{{ route('guru.tugas.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block mb-1 text-sm font-medium">Judul</label>
                        <input type="text" id="addJudul" name="judul" class="border rounded-lg px-3 py-2 w-full" required>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium">Mata Pelajaran</label>
                        <select id="addMapel" name="guru_mapel_id" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="">Pilih Mapel</option>
                            @foreach($guruMapels as $gm)
                                <option value="{{ $gm->id }}">{{ $gm->mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium">Jenis</label>
                        <select id="addTipe" name="tipe" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="Pilihan Ganda">Pilihan ganda</option>
                            <option value="Essay">Essay</option>
                            <option value="Campuran">Campuran</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium">Waktu</label>
                        <select id="addDurasi" name="deadline" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="30">30 Menit</option>
                            <option value="45">45 Menit</option>
                            <option value="60">60 Menit</option>
                            <option value="90">90 Menit</option>
                            <option value="120">120 Menit</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 text-sm font-medium">Bobot Pilihan Ganda (%)</label>
                            <input type="number" id="addBobotPg" name="bobot_pg" min="0" max="100" class="border rounded-lg px-3 py-2 w-full" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium">Bobot Esai (%)</label>
                            <input type="number" id="addBobotEsai" name="bobot_esai" min="0" max="100" class="border rounded-lg px-3 py-2 w-full" required>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeAddModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Batal</button>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit Soal -->
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden overflow-y-auto">
            <div class="bg-white rounded-lg w-full max-w-lg mx-4 p-6 relative">
                <button onclick="closeEditModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">✖</button>
                <h2 class="text-xl font-bold mb-4 text-center">Edit Soal</h2>
                <form id="editForm" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block mb-1 text-sm font-medium">Judul</label>
                        <input type="text" id="editJudul" name="judul" class="border rounded-lg px-3 py-2 w-full" required>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium">Mata Pelajaran</label>
                        <select id="editMapel" name="guru_mapel_id" class="w-full border rounded-lg px-3 py-2" required>
                            @foreach($guruMapels as $gm)
                                <option value="{{ $gm->id }}">{{ $gm->mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium">Jenis</label>
                        <select id="editTipe" name="tipe" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="Pilihan Ganda">Pilihan ganda</option>
                            <option value="Essay">Essay</option>
                            <option value="Campuran">Campuran</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium">Waktu</label>
                        <select id="editDurasi" name="deadline" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="30">30 Menit</option>
                            <option value="45">45 Menit</option>
                            <option value="60">60 Menit</option>
                            <option value="90">90 Menit</option>
                            <option value="120">120 Menit</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 text-sm font-medium">Bobot Pilihan Ganda (%)</label>
                            <input type="number" id="editBobotPg" name="bobot_pg" min="0" max="100" class="border rounded-lg px-3 py-2 w-full" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium">Bobot Esai (%)</label>
                            <input type="number" id="editBobotEsai" name="bobot_esai" min="0" max="100" class="border rounded-lg px-3 py-2 w-full" required>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeEditModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Batal</button>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Terbitkan -->
        <div id="publishModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center px-4">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                <button onclick="closePublishModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">✖</button>
                <h2 id="publishTitle" class="text-xl font-bold text-gray-800 mb-4 text-center">Terbitkan Soal</h2>
                <form id="publishForm" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <select multiple id="kelasSelect" name="kelas_ids[]" class="w-full border-gray-300 rounded-lg px-3 py-2 text-sm shadow-sm focus:ring-purple-500 focus:border-purple-500" required>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">*Bisa pilih lebih dari satu kelas (Ctrl / Cmd + klik).</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Terbit</label>
                        <input id="publishTime" name="publish_time" type="datetime-local" class="w-full border-gray-300 rounded-lg px-3 py-2 text-sm shadow-sm focus:ring-purple-500 focus:border-purple-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Info Soal</label>
                        <textarea id="infoSoal" name="info" rows="3" class="w-full border-gray-300 rounded-lg px-3 py-2 text-sm shadow-sm focus:ring-purple-500 focus:border-purple-500" placeholder="Contoh: Hitung luas segitiga..."></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closePublishModal()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold">Batal</button>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold">Terbitkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    const tugasData = @json($tugas->items());
    const rows = document.querySelectorAll('#questionsTableBody tr');

    // Filter
    document.getElementById('searchInput').addEventListener('input', filterTable);
    document.getElementById('mapelFilter').addEventListener('change', filterTable);

    function filterTable() {
        const keyword = document.getElementById('searchInput').value.toLowerCase();
        const mapel = document.getElementById('mapelFilter').value.toLowerCase();
        rows.forEach(row => {
            const judul = row.dataset.judul || '';
            const m = row.dataset.mapel || '';
            row.style.display = (judul.includes(keyword) && (!mapel || m.includes(mapel))) ? '' : 'none';
        });
    }

    // Modals
    function openAddModal() {
        document.getElementById('addForm').reset();
        document.getElementById('addForm').action = "{{ route('guru.tugas.store') }}";
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openEditModal(id) {
        let t = tugasData.find(u => u.id == id);
        document.getElementById('editForm').action = `/guru/tugas/${id}`;
        document.getElementById('editJudul').value = t.judul;
        document.getElementById('editMapel').value = t.guru_mapel_id;
        document.getElementById('editTipe').value = t.tipe;
        document.getElementById('editDurasi').value = t.deadline;
        document.getElementById('editBobotPg').value = t.bobot_pg;
        document.getElementById('editBobotEsai').value = t.bobot_esai;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openPublishModal(id) {
        let t = tugasData.find(u => u.id == id);
        document.getElementById('publishTitle').textContent = `Terbitkan: ${t.judul}`;
        document.getElementById('publishForm').action = `/guru/tugas/${id}/publish`;
        let select = document.getElementById('kelasSelect');
        Array.from(select.options).forEach(o => o.selected = false);
        if (t.kelas && t.kelas.length) {
            t.kelas.forEach(k => {
                let opt = Array.from(select.options).find(o => o.value == k.id);
                if (opt) opt.selected = true;
            });
        }
        document.getElementById('publishTime').value = t.publish_time ? new Date(t.publish_time).toISOString().slice(0, 16) : '';
        document.getElementById('infoSoal').value = t.deskripsi || '';
        document.getElementById('publishModal').classList.remove('hidden');
    }

    function closePublishModal() {
        document.getElementById('publishModal').classList.add('hidden');
    }

    // Close on outside click
    window.onclick = (e) => {
        if (e.target.id.includes('Modal')) e.target.classList.add('hidden');
    };
</script>
@endsection
