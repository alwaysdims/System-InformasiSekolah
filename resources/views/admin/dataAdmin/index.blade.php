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
                                <button onclick="openDetailModal({
                                    nama: '{{ $admin->nama }}',
                                    username: '{{ $admin->user->username }}',
                                    email: '{{ $admin->user->email }}',
                                    no_hp: '{{ $admin->no_hp ?? '-' }}',
                                    jenis_kelamin: '{{ $admin->jenis_kelamin ?? '-' }}',
                                    tempat_lahir: '{{ $admin->tempat_lahir ?? '-' }}',
                                    tanggal_lahir: '{{ $admin->tanggal_lahir ?? '-' }}',
                                    jabatan: '{{ $admin->jabatan ?? '-' }}',
                                    status_kepegawaian: '{{ $admin->status_kepegawaian ?? '-' }}',
                                    alamat: '{{ $admin->alamat ?? '-' }}'
                                })" class="text-blue-600 hover:text-blue-700">Detail</button>

                                <button onclick="openEditModal({{ $admin->id }}, '{{ $admin->nama }}', '{{ $admin->user->username }}', '{{ $admin->user->email }}', '{{ $admin->no_hp ?? '' }}')"
                                    class="text-yellow-600 hover:text-yellow-700">Edit</button>

                                <form action="{{ route('admin.dataAdmin.destroy', $admin->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700" onclick="return confirm('Yakin hapus admin ini?')">Hapus</button>
                                </form>
<<<<<<< HEAD
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
        </div>
    </main>
</div>

{{-- MODAL TAMBAH --}}
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-md mx-4 p-6 relative">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Tambah Admin</h2>
        <form id="addAdminForm" action="{{ route('admin.dataAdmin.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="nama" placeholder="Nama" class="w-full border rounded-lg px-3 py-2">
            <input type="text" name="username" placeholder="Username" class="w-full border rounded-lg px-3 py-2">
            <input type="email" name="email" placeholder="Email" class="w-full border rounded-lg px-3 py-2">
            <input type="password" name="password" placeholder="Password" class="w-full border rounded-lg px-3 py-2">
            <input type="text" name="no_hp" placeholder="No HP" class="w-full border rounded-lg px-3 py-2">
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
        <h2 class="text-lg font-bold mb-4 text-gray-700">Edit Admin</h2>
        <form id="editAdminForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="text" name="nama" id="edit_nama" class="w-full border rounded-lg px-3 py-2">
            <input type="text" name="username" id="edit_username" class="w-full border rounded-lg px-3 py-2">
            <input type="email" name="email" id="edit_email" class="w-full border rounded-lg px-3 py-2">
            <input type="password" name="password" id="edit_password" placeholder="Kosongkan jika tidak diubah" class="w-full border rounded-lg px-3 py-2">
            <input type="text" name="no_hp" id="edit_no_hp" class="w-full border rounded-lg px-3 py-2">
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
            <h2 class="text-2xl font-bold">Detail Admin</h2>
            <button onclick="closeDetailModal()" class="text-gray-500 hover:text-red-500">&times;</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <div>
                <p><span class="font-semibold">Nama:</span> <span id="detail_nama"></span></p>
                <p><span class="font-semibold">Jenis Kelamin:</span> <span id="detail_jenis_kelamin"></span></p>
                <p><span class="font-semibold">Tempat Lahir:</span> <span id="detail_tempat_lahir"></span></p>
                <p><span class="font-semibold">Tanggal Lahir:</span> <span id="detail_tanggal_lahir"></span></p>
                <p><span class="font-semibold">Email:</span> <span id="detail_email"></span></p>
            </div>
            <div>
                <p><span class="font-semibold">Username:</span> <span id="detail_username"></span></p>
                <p><span class="font-semibold">No HP:</span> <span id="detail_no_hp"></span></p>
                <p><span class="font-semibold">Jabatan:</span> <span id="detail_jabatan"></span></p>
                <p><span class="font-semibold">Status Kepegawaian:</span> <span id="detail_status"></span></p>
                <p><span class="font-semibold">Alamat:</span> <span id="detail_alamat"></span></p>
            </div>
        </div>
        <div class="flex justify-end pt-6">
            <button onclick="closeDetailModal()" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Tutup</button>
        </div>
    </div>
</div>


@section('scripts')
<script>
function openAddModal() { document.getElementById('addModal').classList.remove('hidden'); }
function closeAddModal() { document.getElementById('addModal').classList.add('hidden'); }

function openEditModal(id, nama, username, email, no_hp) {
    const form = document.getElementById('editAdminForm');
    form.action = `{{ url('admin/dataAdmin') }}/${id}`;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_no_hp').value = no_hp;
    document.getElementById('editModal').classList.remove('hidden');
}
function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }

function openDetailModal(data) {
    for (const key in data) {
        if (document.getElementById('detail_' + key)) {
            document.getElementById('detail_' + key).textContent = data[key];
        }
    }
<<<<<<< HEAD

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

    // Handle form submission feedback
    @if(session('success'))
    alert('{{ session('
        success ') }}');
    @endif

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

=======
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
>>>>>>> 1e22eb0 (Siswa)
</script>
@endsection
