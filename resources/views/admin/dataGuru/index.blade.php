<div class="flex items-center mb-4">
    <a href="/admin/dataGuru/add"
       class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700">
        + Tambah Guru
    </a>
</div>

<div class="overflow-x-auto rounded-lg shadow">
    <table class="min-w-full border border-gray-200 text-sm">
        <!-- Table Header -->
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">Nama</th>
                <th class="px-4 py-3 text-left">Jenis Ptk</th>
                <th class="px-4 py-3 text-left">Jabatan</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="divide-y divide-gray-200 bg-white">
            @foreach($guru as $gur)
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                <td class="px-4 py-3">{{ $gur['nama'] }}</td>
                <td class="px-4 py-3">{{ $gur['jenis_ptk'] ?? 'Tidak ada data' }}</td>
                <td class="px-4 py-3">{{ $gur['jabatan'] }}</td>
                <td class="px-4 py-3 text-center space-x-2">
                    <a href="/admin/dataGuru/details/{{ encrypt($gur['id']) }}"
                        class="px-3 py-1 text-xs rounded-lg bg-green-500 text-white hover:bg-green-600">Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>