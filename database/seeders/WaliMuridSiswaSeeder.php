<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\WaliMurid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaliMuridSiswaSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        DB::table('wali_murid_siswa')->truncate();

        $siswaIds = Siswa::pluck('id')->toArray();
        $waliMuridIds = WaliMurid::pluck('id')->toArray();

        if (empty($siswaIds) || empty($waliMuridIds)) {
            echo "Peringatan: Tabel siswa atau wali murid kosong. Melewati WaliMuridSiswaSeeder.\n";
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return;
        }

        $relationships = [];
        $numRelationships = min(count($siswaIds), count($waliMuridIds)); 

        $usedPairs = []; 
        $maxAttempts = $numRelationships * 3;

        for ($i = 0; $i < $numRelationships; $i++) {
            $siswaId = null;
            $waliMuridId = null;
            $attempt = 0;
            $pairExists = true;

            while ($pairExists && $attempt < $maxAttempts) {
                $siswaId = $siswaIds[array_rand($siswaIds)];
                $waliMuridId = $waliMuridIds[array_rand($waliMuridIds)];
                
                $pair = $waliMuridId . '-' . $siswaId; 
                
                if (!isset($usedPairs[$pair])) {
                    $pairExists = false;
                    $usedPairs[$pair] = true;
                }
                $attempt++;
            }

            if (!$pairExists) {
                $relationships[] = [
                    'siswa_id' => $siswaId,
                    'wali_murid_id' => $waliMuridId,
                    'hubungan' => 'Orang Tua',
                ];
            } else {
                break;
            }
        }
        
        DB::table('wali_murid_siswa')->insert($relationships);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}