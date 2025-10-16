@extends('guru.kurikulum.layout.main', ['title' => 'Jadwal Pelajaran'])
@section('title', 'Jadwal Pelajaran')
@section('content')

<div class="flex">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-700">Data Jadwal Pelajaran</h2>
                <!-- Tombol Tambah Jadwal -->
                <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                    + Tambah Jadwal
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

            <!-- Modal Tambah Jadwal -->
            <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative max-h-[90vh] overflow-y-auto">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Jadwal Pelajaran</h2>
                    <form id="addJadwalForm" action="{{ route('kurikulum.jadwalKelas.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Kelas</label>
                            <select name="kelas_id" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('kelas_id') border-red-500 @enderror">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Guru dan Mata Pelajaran</label>
                            <select name="guru_mapel_id" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('guru_mapel_id') border-red-500 @enderror">
                                <option value="">Pilih Guru dan Mata Pelajaran</option>
                                @foreach($guruMapels as $gm)
                                    <option value="{{ $gm->id }}" {{ old('guru_mapel_id') == $gm->id ? 'selected' : '' }}>{{ $gm->guru->nama }} - {{ $gm->mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                            @error('guru_mapel_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Hari</label>
                            <select name="hari" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('hari') border-red-500 @enderror">
                                <option value="">Pilih Hari</option>
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                    <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                @endforeach
                            </select>
                            @error('hari')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('jam_mulai') border-red-500 @enderror" value="{{ old('jam_mulai') }}">
                            @error('jam_mulai')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('jam_selesai') border-red-500 @enderror" value="{{ old('jam_selesai') }}">
                            @error('jam_selesai')
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

            <!-- Modal Edit Jadwal -->
            <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Jadwal Pelajaran</h2>
                    <form id="editJadwalForm" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Kelas</label>
                            <select name="kelas_id" id="edit_kelas_id" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('kelas_id') border-red-500 @enderror">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Guru dan Mata Pelajaran</label>
                            <select name="guru_mapel_id" id="edit_guru_mapel_id" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('guru_mapel_id') border-red-500 @enderror">
                                <option value="">Pilih Guru dan Mata Pelajaran</option>
                                @foreach($guruMapels as $gm)
                                    <option value="{{ $gm->guru_id }}">{{ $gm->guru->nama }} - {{ $gm->mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                            @error('guru_mapel_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Hari</label>
                            <select name="hari" id="edit_hari" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('hari') border-red-500 @enderror">
                                <option value="">Pilih Hari</option>
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                    <option value="{{ $hari }}">{{ $hari }}</option>
                                @endforeach
                            </select>
                            @error('hari')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="edit_jam_mulai" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('jam_mulai') border-red-500 @enderror">
                            @error('jam_mulai')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="edit_jam_selesai" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('jam_selesai') border-red-500 @enderror">
                            @error('jam_selesai')
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

            <!-- Modal Detail Jadwal -->
            <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Detail Jadwal Pelajaran</h2>
                    <div class="space-y-3 text-sm text-gray-700">
                        <p><span class="font-semibold">Kelas:</span> <span id="detail_kelas"></span></p>
                        <p><span class="font-semibold">Guru:</span> <span id="detail_guru"></span></p>
                        <p><span class="font-semibold">Mata Pelajaran:</span> <span id="detail_mapel"></span></p>
                        <p><span class="font-semibold">Hari:</span> <span id="detail_hari"></span></p>
                        <p><span class="font-semibold">Jam Mulai:</span> <span id="detail_jam_mulai"></span></p>
                        <p><span class="font-semibold">Jam Selesai:</span> <span id="detail_jam_selesai"></span></p>
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
                            <th class="px-4 py-3">KELAS</th>
                            <th class="px-4 py-3">GURU</th>
                            <th class="px-4 py-3">MATA PELAJARAN</th>
                            <th class="px-4 py-3">HARI</th>
                            <th class="px-4 py-3">JAM MULAI</th>
                            <th class="px-4 py-3">JAM SELESAI</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($jadwalPelajarans as $index => $jadwal)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $jadwal->guruMapel->guru->nama ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $jadwal->guruMapel->mapel->nama_mapel ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $jadwal->hari }}</td>
                                <td class="px-4 py-3">{{ $jadwal->jam_mulai }}</td>
                                <td class="px-4 py-3">{{ $jadwal->jam_selesai }}</td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    <button onclick="openDetailModal('{{ $jadwal->id }}', '{{ $jadwal->kelas->nama_kelas ?? '-' }}', '{{ $jadwal->guruMapel->guru->nama ?? '-' }}', '{{ $jadwal->guruMapel->mapel->nama_mapel ?? '-' }}', '{{ $jadwal->hari }}', '{{ $jadwal->jam_mulai }}', '{{ $jadwal->jam_selesai }}')" class="text-blue-600 hover:text-blue-700 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                        </svg>
                                    </button>
                                    <button onclick="openEditModal('{{ $jadwal->id }}', '{{ $jadwal->kelas_id }}', '{{ $jadwal->guru_mapel_id }}', '{{ $jadwal->hari }}', '{{ $jadwal->jam_mulai }}', '{{ $jadwal->jam_selesai }}')" class="text-yellow-600 hover:text-yellow-700 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('kurikulum.jadwalKelas.destroy', $jadwal->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 transition-colors duration-200" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-3 text-center text-gray-500">Tidak ada data Jadwal Pelajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<!-- Only showing the updated script section for brevity -->
<script>
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.getElementById('addJadwalForm').reset();
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openEditModal(id, kelas_id, guru_mapel_id, hari, jam_mulai, jam_selesai) {
        const form = document.getElementById('editJadwalForm');
        form.action = `{{ route('kurikulum.jadwalKelas.update', ['jadwalPelajaran' => ':id']) }}`.replace(':id', id);
        document.getElementById('edit_kelas_id').value = kelas_id;
        document.getElementById('edit_guru_mapel_id').value = guru_mapel_id;
        document.getElementById('edit_hari').value = hari;
        document.getElementById('edit_jam_mulai').value = jam_mulai;
        document.getElementById('edit_jam_selesai').value = jam_selesai;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openDetailModal(id, kelas, guru, mapel, hari, jam_mulai, jam_selesai) {
        document.getElementById('detail_kelas').textContent = kelas;
        document.getElementById('detail_guru').textContent = guru;
        document.getElementById('detail_mapel').textContent = mapel;
        document.getElementById('detail_hari').textContent = hari;
        document.getElementById('detail_jam_mulai').textContent = jam_mulai;
        document.getElementById('detail_jam_selesai').textContent = jam_selesai;
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>

@endsection
