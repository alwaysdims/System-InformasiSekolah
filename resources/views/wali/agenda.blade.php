<div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl p-8">
    <h1 class="text-3xl font-extrabold text-center mb-8 text-blue-600 tracking-wide">
        Daftar Agenda Sekolah
    </h1>

    <!-- Search box -->
    <div class="flex justify-end mb-6">
        <div class="relative">
            <input type="text" id="searchInput" placeholder="🔍 Cari judul agenda..."
                class="border border-gray-300 rounded-full px-5 py-2 w-72 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
        </div>
    </div>

    <!-- Tabel responsive -->
    <div class="overflow-x-auto rounded-lg shadow">
        <div class="min-w-full inline-block align-middle">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                        <th class="px-5 py-3 text-sm font-semibold uppercase tracking-wide">No</th>
                        <th class="px-5 py-3 text-sm font-semibold uppercase tracking-wide">Judul</th>
                        <th class="px-5 py-3 text-sm font-semibold uppercase tracking-wide">Tanggal</th>
                        <th class="px-5 py-3 text-center text-sm font-semibold uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody id="agendaTable" class="divide-y divide-gray-200">
                    @forelse($agenda as $a)
                    <tr class="bg-white hover:bg-blue-50 transition">
                        <td class="px-5 py-3 font-medium text-gray-700 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3 text-gray-700 whitespace-nowrap">{{ $a->judul }}</td>
                        <td class="px-5 py-3 text-gray-700 whitespace-nowrap">{{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}</td>
                        <td class="px-5 py-3 text-center whitespace-nowrap">
                            <button
                                onclick="showModal('{{ $a->judul }}', '{{ $a->deskripsi }}', '{{ $a->creator->nama }}')"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-lg shadow-md transition">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500 italic">Belum ada agenda</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal"
    class="hidden fixed z-50 inset-0 bg-black bg-opacity-40 backdrop-blur-sm flex items-center justify-center transition">
    <div class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-md p-8 transform transition-all scale-95 animate-fadeIn">
        <h2 id="modalTitle" class="text-2xl font-bold text-blue-600 mb-3"></h2>
        <p id="modalContent" class="text-gray-700 leading-relaxed mb-4"></p>
        <p id="modalCreator" class="text-sm text-gray-500 italic mb-6"></p>
        <div class="text-right">
            <button onclick="closeModal()"
                class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow-md transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    // Search filter
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#agendaTable tr');
        rows.forEach(row => {
            let judul = row.cells[1]?.textContent.toLowerCase();
            row.style.display = judul && judul.includes(filter) ? '' : 'none';
        });
    });

    // Modal functions
    function showModal(judul, deskripsi, dibuat_oleh) {
        document.getElementById('modalTitle').textContent = judul;
        document.getElementById('modalContent').textContent = deskripsi;
        document.getElementById('modalCreator').textContent = "Dibuat oleh : " + dibuat_oleh;
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
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

    /* Scrollbar halus untuk tabel */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background-color: #2563eb; /* biru Tailwind */
        border-radius: 10px;
    }
    .overflow-x-auto::-webkit-scrollbar-track {
        background-color: #f9fafb;
    }
</style>
