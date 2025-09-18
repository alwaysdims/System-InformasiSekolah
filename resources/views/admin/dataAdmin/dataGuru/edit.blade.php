<div class="flex items-center mb-4">
    <a href="/admin/dataGuru/details/{{ encrypt($guru->id) }}"
       class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700">
        <- Kembali
    </a>
</div>

<form action="/admin/dataGuru/update/{{ encrypt($guru->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm font-medium text-gray-700">NIP</label>
        <input type="number" min="0" name="nip" placeholder="opsional..." value="{{ $guru->nip ?? '' }}"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            >
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="nama" placeholder="wajib di isi..." value="{{ $guru->nama }}"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
        <select name="jenis_kelamin"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            required>
            <option value="" disabled>-- Pilih --</option>
            <option value="Laki-laki" @if($guru->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki</option>
            <option value="Perempuan" @if($guru->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" placeholder="opsional..." value="{{ $guru->tempat_lahir ?? '' }}"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" placeholder="opsional..." value="{{ $guru->tanggal_lahir ?? '' }}"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenjang</label>
        <input type="text" name="jenjang" placeholder="opsional..." value="{{ $guru->jenjang ?? '' }}"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jurusan Kuliah</label>
        <input type="text" name="jurusan_kuliah" placeholder="opsional..." value="{{ $guru->jurusan_kuliah ?? '' }}"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenis PTK</label>
        <input type="text" name="jenis_ptk" placeholder="opsional..." value="{{ $guru->jenis_ptk ?? '' }}"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Status Kepegawaian</label>
        <input type="text" name="status_kepeg" placeholder="opsional..." value="{{ $guru->status_kepeg ?? '' }}"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jabatan</label>
        <select name="jabatan"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            <option value="" disabled>-- Opsional --</option>
            <option value="Guru Mapel" @if($guru->jabatan == 'Guru Mapel') selected @endif>Guru Mapel</option>
            <option value="Guru Kesiswaan" @if($guru->jabatan == 'Guru Kesiswaan') selected @endif>Guru Kesiswaan</option>
            <option value="Guru BK" @if($guru->jabatan == 'Guru BK') selected @endif>Guru BK</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Alamat</label>
        <textarea name="alamat" rows="3" placeholder="opsional..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ $guru->alamat ?? '' }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">No HP</label>
        <input type="number" min="0" name="no_hp" placeholder="opsional..." value="{{ $guru->no_hp ?? '' }}"
            class="mt-1 block mb-[30px] w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Simpan
        </button>
    </div>
</form>