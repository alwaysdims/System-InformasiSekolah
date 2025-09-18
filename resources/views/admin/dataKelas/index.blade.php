<div class="flex">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-700">Data Kelas</h2>
                <!-- Tombol Tambah Kelas -->
                <button onclick="openAddModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                    + Tambah Kelas
                </button>
                <!-- Modal Tambah Kelas -->
                <div id="addModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                        <!-- Header -->
                        <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Kelas</h2>
                        <!-- Form -->
                        <form id="addKelasForm" action="{{ route('admin.dataKelas.store') }}" method="POST"
                            class="space-y-4">
                            @csrf
                            <!-- Nama Kelas -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Kelas</label>
                                <input type="text" name="nama_kelas" placeholder="Nama Kelas"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('nama_kelas') border-red-500 @enderror">
                                @error('nama_kelas')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Tingkat -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Tingkat</label>
                                <select name="tingkat" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('tingkat') border-red-500 @enderror">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                                @error('tingkat')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Jurusan -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Jurusan</label>
                                <select name="jurusan_id" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('jurusan_id') border-red-500 @enderror">
                                    <option value="">Pilih Jurusan (Opsional)</option>
                                    @foreach($jurusan as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Wali Kelas -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Wali Kelas</label>
                                <select name="wali_kelas_id" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('wali_kelas_id') border-red-500 @enderror">
                                    <option value="">Pilih Wali Kelas (Opsional)</option>
                                    @foreach($guru as $g)
                                    <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                                @error('wali_kelas_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Tombol -->
                            <div class="flex justify-end space-x-2 pt-2">
                                <button type="button" onclick="closeAddModal()"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Modal Edit Kelas -->
                <div id="editModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                        <!-- Header -->
                        <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Kelas</h2>
                        <!-- Form -->
                        <form id="editKelasForm" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <!-- Nama Kelas -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Kelas</label>
                                <input type="text" name="nama_kelas" id="edit_nama_kelas" placeholder="Nama Kelas"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('nama_kelas') border-red-500 @enderror">
                                @error('nama_kelas')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Tingkat -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Tingkat</label>
                                <select name="tingkat" id="edit_tingkat" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('tingkat') border-red-500 @enderror">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                                @error('tingkat')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Jurusan -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Jurusan</label>
                                <select name="jurusan_id" id="edit_jurusan_id" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('jurusan_id') border-red-500 @enderror">
                                    <option value="">Pilih Jurusan (Opsional)</option>
                                    @foreach($jurusan as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Wali Kelas -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Wali Kelas</label>
                                <select name="wali_kelas_id" id="edit_wali_kelas_id" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('wali_kelas_id') border-red-500 @enderror">
                                    <option value="">Pilih Wali Kelas (Opsional)</option>
                                    @foreach($guru as $g)
                                    <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                                @error('wali_kelas_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Tombol -->
                            <div class="flex justify-end space-x-2 pt-2">
                                <button type="button" onclick="closeEditModal()"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Detail Kelas -->
                <div id="detailModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                        <!-- Header -->
                        <h2 class="text-lg font-bold mb-4 text-gray-700">Detail Kelas</h2>
                        <!-- Isi Detail -->
                        <div class="space-y-3 text-sm text-gray-700">
                            <p><span class="font-semibold">Nama Kelas:</span> <span id="detail_nama_kelas"></span></p>
                            <p><span class="font-semibold">Tingkat:</span> <span id="detail_tingkat"></span></p>
                            <p><span class="font-semibold">Jurusan:</span> <span id="detail_jurusan"></span></p>
                            <p><span class="font-semibold">Wali Kelas:</span> <span id="detail_wali_kelas"></span></p>
                        </div>
                        <!-- Tombol -->
                        <div class="flex justify-end pt-4">
                            <button type="button" onclick="closeDetailModal()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-sm text-gray-500">
                            <th class="px-4 py-3">NO</th>
                            <th class="px-4 py-3">NAMA KELAS</th>
                            <th class="px-4 py-3">TINGKAT</th>
                            <th class="px-4 py-3">JURUSAN</th>
                            <th class="px-4 py-3">WALI KELAS</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($kelas as $index => $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $item->nama_kelas }}</td>
                            <td class="px-4 py-3">{{ $item->tingkat }}</td>
                            <td class="px-4 py-3">{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->waliKelas->nama ?? '-' }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <!-- Detail -->
                                <button
                                    onclick="openDetailModal('{{ $item->id }}', '{{ $item->nama_kelas }}', '{{ $item->tingkat }}', '{{ $item->jurusan->nama_jurusan ?? '-' }}', '{{ $item->waliKelas->nama ?? '-' }}')"
                                    class="text-blue-600 hover:text-blue-700 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                    </svg>
                                </button>

                                <!-- Update -->
                                <button
                                    onclick="openEditModal({{ $item->id }}, '{{ $item->nama_kelas }}', '{{ $item->tingkat }}', '{{ $item->jurusan_id ?? '' }}', '{{ $item->wali_kelas_id ?? '' }}')"
                                    class="text-yellow-600 hover:text-yellow-700 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>

                                <!-- Delete -->
                                <form action="{{ route('admin.dataKelas.destroy', $item->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-700 transition-colors duration-200"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $kelas->links() }}
            </div>
        </div>
    </main>
</div>

<script>
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.getElementById('addKelasForm').reset();
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openEditModal(id, nama_kelas, tingkat, jurusan_id, wali_kelas_id) {
        const form = document.getElementById('editKelasForm');
        form.action = `{{ url('admin/dataKelas') }}/${id}`;
        document.getElementById('edit_nama_kelas').value = nama_kelas;
        document.getElementById('edit_tingkat').value = tingkat;
        document.getElementById('edit_jurusan_id').value = jurusan_id;
        document.getElementById('edit_wali_kelas_id').value = wali_kelas_id;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Handle form submission feedback
    @if(session('success'))
    alert('{{ session('success') }}');
    @endif

    function openDetailModal(id, nama_kelas, tingkat, jurusan, wali_kelas) {
        document.getElementById('detail_nama_kelas').textContent = nama_kelas;
        document.getElementById('detail_tingkat').textContent = tingkat;
        document.getElementById('detail_jurusan').textContent = jurusan;
        document.getElementById('detail_wali_kelas').textContent = wali_kelas;
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>