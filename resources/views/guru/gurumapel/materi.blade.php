@extends('guru.gurumapel.layouts.app')

@section('content')
<div class="flex">
    <main class="flex-1 p-4 sm:p-6 lg:p-8">
        <div class="w-[140%] mx-auto bg-white p-6 rounded-xl shadow-2xl ring-1 ring-gray-100">

            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h2 class="text-2xl font-extrabold text-gray-800">Data Materi Pelajaran</h2>
                <button onclick="openAddModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-4 py-2 rounded-lg shadow-md transition duration-150">
                    <i class="fas fa-plus mr-1"></i> Tambah Materi
                </button>
            </div>

            @if(session('success'))
                <div id="alert-success" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg shadow-sm flex justify-between items-center" role="alert">
                    <p class="font-medium">{{ session('success') }}</p>
                    <button onclick="document.getElementById('alert-success').remove()" class="text-green-700 hover:text-green-900 transition duration-150">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div id="alert-error" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg shadow-sm flex justify-between items-center" role="alert">
                    <p class="font-medium">{{ session('error') }}</p>
                    <button onclick="document.getElementById('alert-error').remove()" class="text-red-700 hover:text-red-900 transition duration-150">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            @if ($errors->any())
                <div id="alert-validation-error" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg shadow-sm" role="alert">
                    <p class="font-bold mb-1">Terjadi Kesalahan Validasi:</p>
                    <ul class="list-disc ml-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="overflow-x-auto w-full">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/12">NO</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-4/12">JUDUL MATERI</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-2/12">FILE</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-3/12">PUBLIKASI KE KELAS</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-2/12">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-gray-700">
                        @forelse($materis as $index => $materi)
                            <tr class="hover:bg-gray-50 transition duration-100">
                                <td class="px-4 py-3 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 font-medium">{{ $materi->judul }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($materi->file_path)
                                    <a href="{{ Storage::url($materi->file_path) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-100">
                                        <i class="fas fa-file-download mr-1"></i> {{ basename($materi->file_path) }}
                                    </a>
                                    @else
                                        <span class="text-gray-400">Tidak ada file</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <button onclick="openPublishModal('{{ $materi->id }}', '{{ addslashes($materi->judul) }}')"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg shadow-sm transition duration-150">
                                        <i class="fas fa-paper-plane mr-1"></i> Publikasikan
                                    </button>
                                </td>
                                <td class="px-4 py-3 text-center whitespace-nowrap space-x-2">
                                    <button onclick="openUpdateModal('{{ $materi->id }}', '{{ addslashes($materi->judul) }}', '{{ addslashes($materi->deskripsi ?? '') }}')"
                                        class="text-yellow-600 hover:text-yellow-700 p-2 rounded-full transition duration-100" title="Edit"><i class="fas fa-edit"></i></button>

                                    <form action="{{ route('guru.materi.destroy', $materi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus materi: {{ addslashes($materi->judul) }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-full transition duration-100" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-5 text-center text-gray-500">Belum ada materi yang diunggah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="addModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden p-4">
                <div class="bg-white rounded-xl w-full max-w-md shadow-2xl transform scale-100 opacity-100 transition duration-300">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Tambah Materi Baru</h2>

                        <form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Judul Materi <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Integral dan Turunan" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                                <textarea name="deskripsi" placeholder="Deskripsi singkat atau tujuan pembelajaran"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 h-20">{{ old('deskripsi') }}</textarea>
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Upload File (PDF/DOCX/PPTX/DLL) <span class="text-red-500">*</span></label>
                                <input type="file" name="file" required accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx"
                                    class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <small class="text-gray-500 text-xs mt-1 block">Max size: 10MB</small>
                            </div>

                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" onclick="closeAddModal()"
                                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-150">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-150">
                                    <i class="fas fa-upload mr-1"></i> Simpan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div id="updateModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden p-4">
                <div class="bg-white rounded-xl w-full max-w-md shadow-2xl transform scale-100 opacity-100 transition duration-300">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Update Materi</h2>

                        <form id="updateForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Judul Materi <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" id="updateJudul" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                                <textarea name="deskripsi" id="updateDeskripsi"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 h-20"></textarea>
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Upload File Baru (Opsional)</label>
                                <input type="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx"
                                    class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <small class="text-gray-500 text-xs mt-1 block">Kosongkan jika tidak ingin mengubah file.</small>
                            </div>

                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" onclick="closeUpdateModal()"
                                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-150">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-150">
                                    <i class="fas fa-save mr-1"></i> Update
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div id="publishModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden p-4">
                <div class="bg-white rounded-xl w-full max-w-md shadow-2xl transform scale-100 opacity-100 transition duration-300">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Publikasikan Materi</h2>
                        <p class="text-gray-700 mb-4 font-medium">Materi: <span id="publishTitle" class="font-semibold text-indigo-600"></span></p>

                        <form action="" method="POST" id="publishForm" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Kelas Tujuan</label>
                                <select name="kelas_id" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelas as $ss)
                                        <option value="{{ $ss->id }}">{{ $ss->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" onclick="closePublishModal()"
                                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-150">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-150">
                                    <i class="fas fa-share-square mr-1"></i> Publikasikan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

@endsection

@section('scripts')
<script>
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openUpdateModal(id, judul, deskripsi) {
        document.getElementById('updateForm').action = '{{ url("guru/materi") }}/' + id;
        document.getElementById('updateJudul').value = judul;
        document.getElementById('updateDeskripsi').value = deskripsi;
        document.getElementById('updateModal').classList.remove('hidden');
    }

    function closeUpdateModal() {
        document.getElementById('updateModal').classList.add('hidden');
    }

    function openPublishModal(id, title) {
        document.getElementById('publishTitle').innerText = title;
        document.getElementById('publishForm').action = '{{ url("guru/materi") }}/' + id + '/publish';
        document.getElementById('publishModal').classList.remove('hidden');
    }

    function closePublishModal() {
        document.getElementById('publishModal').classList.add('hidden');
    }
</script>
@endsection