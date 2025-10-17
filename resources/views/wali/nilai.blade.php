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
                        <th class="px-5 py-3 text-sm font-semibold uppercase tracking-wide">Judul Tugas</th>
                        <th class="px-5 py-3 text-sm font-semibold uppercase tracking-wide">Total Nilai</th>
                    </tr>
                </thead>
                <tbody id="agendaTable" class="divide-y divide-gray-200">
                    @forelse($nilai as $nil)
                    <tr class="bg-white hover:bg-blue-50 transition">
                        <td class="px-5 py-3 font-medium text-gray-700 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3 text-gray-700 whitespace-nowrap">{{ $nil->tugas->judul }}</td>
                        <td class="px-5 py-3 text-gray-700 whitespace-nowrap">{{ $nil->total_nilai }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500 italic">Belum ada nilai</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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
