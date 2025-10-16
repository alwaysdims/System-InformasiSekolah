<?php

namespace App\Http\Controllers\guru\gurumapel;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\TugasSoal;
use Illuminate\Http\Request;

class BuatSoalController extends Controller
{
    public function index($id)
    {
        $tugas = Tugas::with(['guruMapel.mapel', 'kelas', 'soal'])->findOrFail($id);
        return view('guru.gurumapel.detail-soal', compact('tugas'));
    }

    public function pilga($id)
    {
        $tugas = Tugas::with(['guruMapel.mapel', 'soal' => function($q) {
            $q->where('tipe', 'Pilihan Ganda');
        }])->findOrFail($id);
        return view('guru.gurumapel.pilga', compact('tugas'));
    }

    public function esay($id)
    {
        $tugas = Tugas::with(['guruMapel.mapel', 'soal' => function($q) {
            $q->where('tipe', 'Essay');
        }])->findOrFail($id);
        return view('guru.gurumapel.esay', compact('tugas'));
    }

    // STORE PILGA
    public function storePilga(Request $request, $tugasId)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'pilihan_a' => 'required', 'pilihan_b' => 'required',
            'pilihan_c' => 'required', 'pilihan_d' => 'required',
            'jawaban_benar' => 'required|in:A,B,C,D'
        ]);

        TugasSoal::create([
            'tugas_id' => $tugasId,
            'tipe' => 'Pilihan Ganda',
            'pertanyaan' => $request->pertanyaan,
            'pilihan_a' => $request->pilihan_a,
            'pilihan_b' => $request->pilihan_b,
            'pilihan_c' => $request->pilihan_c,
            'pilihan_d' => $request->pilihan_d,
            'jawaban_benar' => $request->jawaban_benar
        ]);

        return redirect()->back()->with('success', 'Soal pilihan ganda berhasil ditambahkan!');
    }

    // STORE ESAY
    public function storeEsay(Request $request, $tugasId)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban_benar' => 'nullable'
        ]);

        TugasSoal::create([
            'tugas_id' => $tugasId,
            'tipe' => 'Essay',
            'pertanyaan' => $request->pertanyaan,
            'jawaban_benar' => $request->jawaban_benar
        ]);

        return redirect()->back()->with('success', 'Soal essay berhasil ditambahkan!');
    }

    // DELETE
    public function destroy($soalId)
    {
        $soal = TugasSoal::findOrFail($soalId);
        $soal->delete();
        return redirect()->back()->with('success', 'Soal berhasil dihapus!');
    }
}
