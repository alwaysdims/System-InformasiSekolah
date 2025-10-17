@extends('guru.gurumapel.layouts.app') <!-- Asumsi layout master dengan sidebar dan header -->

@section('content')
    <div class="flex">
        <main class="flex-1 overflow-y-auto p-6">
            <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">

                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-gray-700">Data Materi Pelajaran</h2>
                    <!-- Tombol Tambah Materi -->
                    <button onclick="openAddModal()"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                        + Tambah Materi
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 text-sm text-gray-500">
                                <th class="px-4 py-3">NO</th>
                                <th class="px-4 py-3">MAPEL</th>
                                <th class="px-4 py-3">FILE</th>
                                <th class="px-4 py-3">PUBLIKASI KE KELAS</th>
                                <th class="px-4 py-3 text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($materis as $index => $materi)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">{{ $materi->judul }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ Storage::url($materi->file_path) }}"
                                            class="text-blue-600 hover:underline">{{ basename($materi->file_path) }}</a>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button onclick="openPublishModal('{{ $materi->id }}', '{{ $materi->judul }}')"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-3 py-1.5 rounded">
                                            Publikasikan
                                        </button>
                                    </td>
                                    <td class="px-4 py-3 text-center space-x-2">
                                        <button onclick="openUpdateModal('{{ $materi->id }}', '{{ $materi->judul }}', '{{ $materi->deskripsi }}')"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1.5 rounded">Update</button>
                                        <form action="{{ route('guru.materi.destroy', $materi->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 rounded"
                                                onclick="return confirm('Yakin hapus?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal Tambah Materi -->
                <div id="addModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">

                        <!-- Header -->
                        <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Materi</h2>

                        <!-- Form -->
                        <form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <!-- Mapel -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Mata Pelajaran</label>
                                <select name="mapel"
                                    class="w-full border rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Pilih Mapel --</option>
                                    <option value="Matematika">Matematika</option>
                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="PKN">PKN</option>
                                </select>
                            </div>

                            <!-- Dibuat Oleh -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Dibuat Oleh</label>
                                <input type="text" name="author" placeholder="Nama Guru / Pembuat Materi"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Upload File -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Upload File (Word / PPT / Excel)</label>
                                <input type="file" name="file" accept=".doc,.docx,.ppt,.pptx,.xls,.xlsx"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
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

                <!-- Modal Update Materi (Mirip add, tapi dengan data) -->
                <div id="updateModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">

                        <!-- Header -->
                        <h2 class="text-lg font-bold mb-4 text-gray-700">Update Materi</h2>

                        <!-- Form -->
                        <form id="updateForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <!-- Mapel -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Mata Pelajaran</label>
                                <select name="mapel" id="updateMapel"
                                    class="w-full border rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Pilih Mapel --</option>
                                    <option value="Matematika">Matematika</option>
                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="PKN">PKN</option>
                                </select>
                            </div>

                            <!-- Dibuat Oleh -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Dibuat Oleh</label>
                                <input type="text" name="author" id="updateAuthor" placeholder="Nama Guru / Pembuat Materi"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Upload File -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">Upload File Baru (Opsional)</label>
                                <input type="file" name="file" accept=".doc,.docx,.ppt,.pptx,.xls,.xlsx"
                                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Tombol -->
                            <div class="flex justify-end space-x-2 pt-2">
                                <button type="button" onclick="closeUpdateModal()"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                                    Update
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Modal Publikasi -->
                <div id="publishModal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                        <h2 class="text-lg font-bold mb-4">Publikasikan Materi</h2>
                        <p id="publishTitle" class="text-gray-700 mb-4"></p>

                        <form action="" method="POST" id="publishForm">
                            @csrf

                            <label class="block mb-2 text-sm font-medium">Pilih Kelas</label>
                            <select name="kelas_id" class="w-full border rounded-lg px-3 py-2 mb-4">
                                @foreach($kelas as $ss)
                                    <option value="{{ $ss->id }}">{{ $ss->nama_kelas }}</option> <!-- Adjust field nama kelas -->
                                @endforeach
                            </select>

                            <div class="flex justify-end space-x-2">
                                <button type="button" onclick="closePublishModal()"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                                    Publikasikan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function openUpdateModal(id, mapel, author) {
            document.getElementById('updateForm').action = '{{ url("guru/materi") }}/' + id;
            document.getElementById('updateMapel').value = mapel;
            document.getElementById('updateAuthor').value = author;
            document.getElementById('updateModal').classList.remove('hidden');
        }

        function closeUpdateModal() {
            document.getElementById('updateModal').classList.add('hidden');
        }

        function openPublishModal(id, title) {
            document.getElementById('publishTitle').innerText = "Materi: " + title;
            document.getElementById('publishForm').action = '{{ url("guru/materi") }}/' + id + '/publish';
            document.getElementById('publishModal').classList.remove('hidden');
        }

        function closePublishModal() {
            document.getElementById('publishModal').classList.add('hidden');
        }
    </script>
@endsection
