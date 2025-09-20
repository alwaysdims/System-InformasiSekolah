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
        <input type="number" min="0" name="nip"
            value="{{ old('nip', $guru->nip) }}"
            placeholder="wajib di isi..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        @error('nip') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="nama"
            value="{{ old('nama', $guru->nama) }}"
            placeholder="wajib di isi..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
        @error('nama') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
        <select name="jenis_kelamin" required
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            <option value="" disabled>-- Wajib --</option>
            <option value="Laki-laki" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
        <input type="text" name="tempat_lahir"
            value="{{ old('tempat_lahir', $guru->tempat_lahir) }}"
            placeholder="opsional..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
        @error('tempat_lahir') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir"
            value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
        @error('tanggal_lahir') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenjang</label>
        <input type="text" name="jenjang"
            value="{{ old('jenjang', $guru->jenjang) }}"
            placeholder="opsional..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
        @error('jenjang') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jurusan Kuliah</label>
        <input type="text" name="jurusan_kuliah"
            value="{{ old('jurusan_kuliah', $guru->jurusan_kuliah) }}"
            placeholder="opsional..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
        @error('jurusan_kuliah') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenis PTK</label>
        <select name="jenis_ptk" required
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            <option value="" disabled>-- Wajib --</option>
            <option value="Guru" {{ old('jenis_ptk', $guru->jenis_ptk) == 'Guru' ? 'selected' : '' }}>Guru</option>
            <option value="Tenaga Pendidikan" {{ old('jenis_ptk', $guru->jenis_ptk) == 'Tenaga Pendidikan' ? 'selected' : '' }}>Tenaga Pendidikan</option>
        </select>
        @error('jenis_ptk') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Status Kepegawaian</label>
        <select name="status_kepeg" required
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            <option value="" disabled>-- Wajib --</option>
            <option value="PNS" {{ old('status_kepeg', $guru->status_kepeg) == 'PNS' ? 'selected' : '' }}>PNS</option>
            <option value="PPPK" {{ old('status_kepeg', $guru->status_kepeg) == 'PPPK' ? 'selected' : '' }}>PPPK</option>
            <option value="Honorer Sekolah" {{ old('status_kepeg', $guru->status_kepeg) == 'Honorer Sekolah' ? 'selected' : '' }}>Honorer Sekolah</option>
            <option value="Honorer Daerah" {{ old('status_kepeg', $guru->status_kepeg) == 'Honorer Daerah' ? 'selected' : '' }}>Honorer Daerah</option>
        </select>
        @error('status_kepeg') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jabatan</label>
        <select name="jabatan" required
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            <option value="" disabled>-- Wajib --</option>
            <option value="Kepala Sekolah" {{ old('jabatan', $guru->jabatan) == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
            <option value="Waka Kurikulum" {{ old('jabatan', $guru->jabatan) == 'Waka Kurikulum' ? 'selected' : '' }}>Waka Kurikulum</option>
            <option value="Waka Kesiswaan" {{ old('jabatan', $guru->jabatan) == 'Waka Kesiswaan' ? 'selected' : '' }}>Waka Kesiswaan</option>
            <option value="Guru Mapel" {{ old('jabatan', $guru->jabatan) == 'Guru Mapel' ? 'selected' : '' }}>Guru Mapel</option>
            <option value="BK" {{ old('jabatan', $guru->jabatan) == 'BK' ? 'selected' : '' }}>BK</option>
        </select>
        @error('jabatan') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Alamat</label>
        <textarea name="alamat" rows="3" placeholder="opsional..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('alamat', $guru->alamat) }}</textarea>
        @error('alamat') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">No HP</label>
        <input type="number" min="0" name="no_hp"
            value="{{ old('no_hp', $guru->no_hp) }}"
            placeholder="opsional..."
            class="mt-1 block mb-[30px] w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
        @error('no_hp') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Update
        </button>
    </div>
</form>
