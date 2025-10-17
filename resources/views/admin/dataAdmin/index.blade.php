<div class="flex">
    <main class="flex-1 overflow-y-auto p-6">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-700">Data Admin</h2>
                <button onclick="openAddModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg">
                    + Tambah Admin
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-sm text-gray-500">
                            <th class="px-4 py-3">NO</th>
                            <th class="px-4 py-3">NAMA</th>
                            <th class="px-4 py-3">USERNAME</th>
                            <th class="px-4 py-3">EMAIL</th>
                            <th class="px-4 py-3">NO HP</th>
                            <th class="px-4 py-3 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($admins as $index => $admin)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $admin->nama }}</td>
                            <td class="px-4 py-3">{{ $admin->user->username }}</td>
                            <td class="px-4 py-3">{{ $admin->user->email }}</td>
                            <td class="px-4 py-3">{{ $admin->no_hp ?? '-' }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <!-- Detail -->
                                <button
                                    onclick="openDetailModal('{{ $admin->id }}', '{{ $admin->nama }}', '{{ $admin->user->username }}', '{{ $admin->user->email }}', '{{ $admin->no_hp ?? '-' }}')"
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
                                    onclick="openEditModal({{ $admin->id }}, '{{ $admin->nama }}', '{{ $admin->user->username }}', '{{ $admin->user->email }}', '{{ $admin->no_hp ?? '' }}')"
                                    class="text-yellow-600 hover:text-yellow-700 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                <!-- Delete -->
                                <form action="{{ route('admin.dataAdmin.destroy', $admin->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-700 transition-colors duration-200"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                                <div id="detailModal"
                                class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 hidden">
                                <div
                                    class="bg-white rounded-xl w-full max-w-2xl mx-4 p-8 relative shadow-2xl transform transition-all duration-300 scale-95 opacity-0">
                                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                                        <h2 class="text-3xl font-bold text-gray-800">Detail Admin 👨‍🏫</h2>
                                        <button onclick="closeDetailModal()"
                                            class="text-gray-500 hover:text-red-500 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" class="w-8 h-8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 text-lg text-gray-700">
                                        <div class="space-y-4">
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">Nama</span>
                                                <span id="detail_nama" class="mt-1 text-gray-700"></span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">Jenis Kelamin</span>
                                                <span id="detail_jenis_kelamin" class="mt-1 text-gray-700"></span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">Tempat Lahir</span>
                                                <span id="detail_tempat_lahir" class="mt-1 text-gray-700"></span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">Tanggal Lahir</span>
                                                <span id="detail_tanggal_lahir" class="mt-1 text-gray-700"></span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">Email</span>
                                                <span id="detail_email" class="mt-1 text-gray-700"></span>
                                            </div>
                                        </div>

                                        <div class="space-y-4 mt-4 md:mt-0">
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">Username</span>
                                                <span id="detail_username" class="mt-1 text-gray-700"></span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">No HP</span>
                                                <span id="detail_no_hp" class="mt-1 text-gray-700"></span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">Jabatan</span>
                                                <span id="detail_jabatan" class="mt-1 text-gray-700"></span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">Status Kepegawaian</span>
                                                <span id="detail_status" class="mt-1 text-gray-700"></span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">Alamat</span>
                                                <span id="detail_alamat" class="mt-1 text-gray-700"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end pt-8">
                                        <button type="button" onclick="closeDetailModal()"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-105">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Tambah Admin -->
            <div id="addModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Admin</h2>
                    <form id="addAdminForm" action="{{ route('admin.dataAdmin.store') }}" method="POST"
                        class="space-y-4">
                        @csrf
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" placeholder="Nama Admin"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror">
                            @error('nama')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                            <input type="text" name="username" placeholder="Username"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('username') border-red-500 @enderror">
                            @error('username')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" placeholder="Email"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                            @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" placeholder="Password"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                            @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">No HP</label>
                            <input type="text" name="no_hp" placeholder="No HP"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('no_hp') border-red-500 @enderror">
                            @error('no_hp')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
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

            <!-- Modal Edit Admin -->
            <div id="editModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Admin</h2>
                    <form id="editAdminForm" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" id="edit_nama" placeholder="Nama Admin"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror">
                            @error('nama')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                            <input type="text" name="username" id="edit_username" placeholder="Username"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('username') border-red-500 @enderror">
                            @error('username')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="edit_email" placeholder="Email"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                            @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Password (Kosongkan jika
                                tidak diubah)</label>
                            <input type="password" name="password" id="edit_password" placeholder="Password"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                            @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">No HP</label>
                            <input type="text" name="no_hp" id="edit_no_hp" placeholder="No HP"
                                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 @error('no_hp') border-red-500 @enderror">
                            @error('no_hp')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
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

            <!-- Modal Detail Admin -->
            <div id="detailModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
                    <h2 class="text-lg font-bold mb-4 text-gray-700">Detail Admin</h2>
                    <div class="space-y-3 text-sm text-gray-700">
                        <p><span class="font-semibold">Nama:</span> <span id="detail_nama"></span></p>
                        <p><span class="font-semibold">Username:</span> <span id="detail_username"></span></p>
                        <p><span class="font-semibold">Email:</span> <span id="detail_email"></span></p>
                        <p><span class="font-semibold">No HP:</span> <span id="detail_no_hp"></span></p>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="button" onclick="closeDetailModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

{{-- @section('scripts') --}}
<script>
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openEditModal(id, nama, username, email, no_hp) {
        const form = document.getElementById('editAdminForm');
        form.action = `{{ url('admin/dataAdmin') }}/${id}`;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_no_hp').value = no_hp;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openDetailModal(id, nama, username, email, no_hp) {
        document.getElementById('detail_nama').textContent = nama;
        document.getElementById('detail_username').textContent = username;
        document.getElementById('detail_email').textContent = email;
        document.getElementById('detail_no_hp').textContent = no_hp;
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    const modal = document.getElementById('detailModal');
    const modalContent = modal.querySelector('div:first-child');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    const modalContent = modal.querySelector('div:first-child');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    modal.addEventListener('transitionend', () => modal.classList.add('hidden'), { once: true });
}
</script>
{{-- @endsection --}}
