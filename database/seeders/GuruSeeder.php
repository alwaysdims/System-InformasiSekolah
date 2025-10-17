<?php
// GuruSeeder.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'user_id' => 3 + $i,
                'nip' => 'NIP' . $i,
                'nama' => 'Guru ' . $i,
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1980-01-01',
                'jenjang' => 'S1',
                'jurusan_kuliah' => 'Pendidikan',
                'jenis_ptk' => 'Guru',
                'status_kepeg' => 'PNS',
                'jabatan' => 'Guru',
                'alamat' => 'Alamat ' . $i,
                'no_hp' => '082' . $i . '000',
            ];
        }
        DB::table('guru')->insert($data);
    }
}
