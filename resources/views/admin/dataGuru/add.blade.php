<div class="flex items-center mb-4">
    <a href="/admin/dataGuru" class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700">
        <- Kembali </a>
</div>

@if ($errors->any())
    <div class="mb-4 p-4 rounded-md bg-red-100 text-red-700">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/admin/dataGuru/store" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-medium text-gray-700">NIP</label>
        <input type="number" min="0" name="nip" placeholder="wajib di isi..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="nama" placeholder="wajib di isi..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
        <select name="jenis_kelamin"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            required>
            <option value="" disabled selected>-- Wajib --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" placeholder="opsional..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" placeholder="opsional..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenjang</label>
        <input type="text" name="jenjang" placeholder="opsional..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jurusan Kuliah</label>
        <input type="text" name="jurusan_kuliah" placeholder="opsional..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jenis PTK</label>
        <select name="jenis_ptk" required
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
               focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            <option value="" disabled {{ old('jenis_ptk') ? '' : 'selected' }}>-- Wajib --</option>
            <option value="Guru" {{ old('jenis_ptk') == 'Guru' ? 'selected' : '' }}>Guru</option>
            <option value="Tenaga Pendidikan" {{ old('jenis_ptk') == 'Tenaga Pendidikan' ? 'selected' : '' }}>Tenaga
                Pendidikan</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Status Kepegawaian</label>
        <select name="status_kepeg" required
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm 
               focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            <option value="" disabled {{ old('status_kepeg') ? '' : 'selected' }}>-- Wajib --</option>
            <option value="PNS" {{ old('status_kepeg') == 'PNS' ? 'selected' : '' }}>PNS</option>
            <option value="PPPK" {{ old('status_kepeg') == 'PPPK' ? 'selected' : '' }}>PPPK</option>
            <option value="Honorer Sekolah" {{ old('status_kepeg') == 'Honorer Sekolah' ? 'selected' : '' }}>Honorer
                Sekolah</option>
            <option value="Honorer Daerah" {{ old('status_kepeg') == 'Honorer Daerah' ? 'selected' : '' }}>Honorer
                Daerah</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Jabatan</label>
        <select name="jabatan" required
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            <option value="" disabled selected>-- Wajib --</option>Kepala Sekolah,Waka Kurikulum,Waka
            Kesiswaan,Guru Mapel,BK
            <option value="Kepala Sekolah">Kepala Sekolah</option>
            <option value="Waka Kurikulum">Waka Kurikulum</option>
            <option value="Waka Kesiswaan">Waka Kesiswaan</option>
            <option value="Guru Mapel">Guru Mapel</option>
            <option value="BK">BK</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Alamat</label>
        <textarea name="alamat" rows="3" placeholder="opsional..."
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">No HP</label>
        <input type="number" min="0" name="no_hp" placeholder="opsional..."
            class="mt-1 block mb-[30px] w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
    </div>

    <h3 class="text-lg sm:text-lg font-semibold">Buatkan akun</h3>

    <div>
        <label class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" placeholder="dont use space"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" placeholder="example@gmail.com"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">password</label>
        <input type="password" name="password" placeholder="******"
            class="mt-1 block w-full rounded-md px-3 py-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            required>
    </div>

    <div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Simpan
        </button>
    </div>
</form>
