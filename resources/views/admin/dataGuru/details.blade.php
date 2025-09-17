<div class="flex items-center mb-4">
    <a href="/admin/dataGuru/"
       class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700">
        <- Kembali
    </a>
</div>

<div class="overflow-x-auto rounded-lg shadow">
    <table class="min-w-full border border-gray-200 text-sm">
        <!-- Header Kosong -->
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-3 w-1/4"></th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>

        <!-- Body -->
        <tbody class="divide-y divide-gray-200 bg-white">
            @foreach($guru as $gur)
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">NIP</td>
                <td class="px-4 py-3">{{ $gur['nip'] ?? '-' }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">Nama</td>
                <td class="px-4 py-3">{{ $gur['nama'] }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">Jenis Kelamin</td>
                <td class="px-4 py-3">{{ $gur['jenis_kelamin'] }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">Tempat Lahir</td>
                <td class="px-4 py-3">{{ $gur['tempat_lahir'] ?? '-' }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">Tanggal Lahir</td>
                <td class="px-4 py-3">{{ $gur['tanggal_lahir'] ?? '-' }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">Jenjang</td>
                <td class="px-4 py-3">{{ $gur['jenjang'] ?? '-' }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">Jurusan Kuliah</td>
                <td class="px-4 py-3">{{ $gur['jurusan_kuliah'] ?? '-' }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">Jenis PTK</td>
                <td class="px-4 py-3">{{ $gur['jenis_ptk'] ?? '-' }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">Status Kepegawaian</td>
                <td class="px-4 py-3">{{ $gur['status_kepeg'] ?? '-' }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">Jabatan</td>
                <td class="px-4 py-3">{{ $gur['jabatan'] }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">Alamat</td>
                <td class="px-4 py-3">{{ $gur['alamat'] ?? '-' }}</td>
            </tr>
            <tr class="hover:bg-blue-50">
                <td class="px-4 py-3 font-semibold text-gray-700">No HP</td>
                <td class="px-4 py-3">{{ $gur['no_hp'] ?? '-' }}</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="mt-4 flex space-x-2">
    <a href="/admin/dataGuru/edit/{{ encrypt($gur['id']) }}" 
        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        Edit
    </a>
    <form action="{{ route('dataGuru.destroy', $gur['id']) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
        @csrf
        @method('DELETE')
        <button type="submit" 
        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
        Hapus
    </button>
</form>
</div>
@endforeach
