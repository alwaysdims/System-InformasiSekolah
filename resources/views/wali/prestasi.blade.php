<div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl p-8">
    <h1 class="text-3xl font-extrabold text-center mb-8 text-blue-600 tracking-wide">
        Daftar Prestasi Siswa
    </h1>

    <!-- Search box -->
    <div class="flex justify-end mb-6">
        <div class="relative">
            <input type="text" id="searchInput" placeholder="🔍 Cari nama siswa..."
                class="border border-gray-300 rounded-full px-5 py-2 w-72 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
        </div>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-blue-600 to-indigo-500 text-white">
                    <th class="px-5 py-3 text-sm font-semibold uppercase tracking-wide">No</th>
                    <th class="px-5 py-3 text-sm font-semibold uppercase tracking-wide">Nama Siswa</th>
                    <th class="px-5 py-3 text-sm font-semibold uppercase tracking-wide">Prestasi</th>
                    <th class="px-5 py-3 text-sm font-semibold uppercase tracking-wide">Tanggal</th>
                    <th class="px-5 py-3 text-center text-sm font-semibold uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody id="prestasiTable" class="divide-y divide-gray-200">
                @forelse($prestasi as $pres)
                    <tr class="bg-white hover:bg-blue-50 transition">
                        <td class="px-5 py-3 font-medium text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3 text-gray-700">{{ $pres->siswa->nama }}</td>
                        <td class="px-5 py-3 text-gray-700">{{ $pres->prestasi }}</td>
                        <td class="px-5 py-3 text-gray-700">{{ \Carbon\Carbon::parse($pres->tanggal)->format('d M Y') }}
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button onclick="showModal('{{ $pres->siswa->nama }}', '{{ $pres->keterangan }}')"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-lg shadow-md transition">
                                Detail
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500 italic">Belum ada data prestasi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="modal"
    class="hidden fixed z-50 inset-0 bg-black bg-opacity-40 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-md p-8 transform transition-all scale-95 animate-fadeIn">
        <h2 id="modalTitle" class="text-2xl font-bold text-blue-600 mb-3"></h2>
        <p id="modalContent" class="text-gray-700 leading-relaxed mb-6"></p>
        <div class="text-right">
            <button onclick="closeModal()"
                class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg shadow-md transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    // Search filter
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#prestasiTable tr');
        rows.forEach(row => {
            let nama = row.cells[1].textContent.toLowerCase();
            row.style.display = nama.includes(filter) ? '' : 'none';
        });
    });

    // Modal functions
    function showModal(nama, keterangan) {
        document.getElementById('modalTitle').textContent = nama;
        document.getElementById('modalContent').textContent = keterangan;
        const modal = document.getElementById('modal');
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
    }
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out;
    }
</style>
