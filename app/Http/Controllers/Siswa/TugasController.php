<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Tugas;
use App\Models\TugasSoal;
use App\Models\SiswaKelas;
use App\Models\TugasJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil semua tugas
        $tugas = Tugas::with([
            'guruMapel.mapel',
            'soal',
            'jawaban' => function ($q) {
                $q->where('siswa_id', auth()->id());
            }
        ])
        ->orderBy('deadline', 'asc')
        ->get();

        // Logging untuk debugging
        Log::info('Menampilkan semua tugas untuk siswa_id: ' . auth()->id(), [
            'jumlah_tugas' => $tugas->count()
        ]);

        // Update status tugas (selesai / belum / terlewat)
        foreach ($tugas as $tgs) {
            $now = now();
            $tenggat = \Carbon\Carbon::parse($tgs->deadline);

            if ($tgs->jawaban()->where('siswa_id', auth()->id())->count() >= $tgs->soal->count()) {
                $tgs->status = 'selesai';
            } elseif ($now->lt($tenggat)) {
                $tgs->status = 'belum';
            } else {
                $tgs->status = 'terlewat';
            }
        }

        return view('siswa.tugas', compact('tugas'));
    }

    public function detail($id)
    {
        // Load the task with its questions, teacher-subject, and related classes
        $tugas = Tugas::with(['soal', 'guruMapel.mapel', 'kelas.siswa'])->findOrFail($id);

        // Check if the logged-in student is registered in one of the task's classes

        // $terdaftar = SiswaKelas::whereIn('kelas_id', $tugas->kelas->pluck('id'))
        // ->where('siswa_id', Auth::user()->siswa->id)
        // ->exists();

        // if (!$terdaftar) {
        // return redirect()->back()->with('error', 'Anda tidak terdaftar di kelas ini!');
        // }

        return view('siswa.detail-soal', compact('tugas'));
    }

    public function kerjakan($id)
    {
        // Load the task with its questions, teacher-subject, and related classes
        $tugas = Tugas::with(['soal', 'guruMapel', 'kelas.siswa'])->findOrFail($id);

        // Check if the logged-in student is registered in one of the task's classes
        // $terdaftar = $tugas->kelas->flatMap(function ($kelas) {
        //     return $kelas->siswa->pluck('id');
        // })->contains(auth()->id());

        // if (!$terdaftar) {
        //     return redirect()->back()->with('error', 'Anda tidak terdaftar di kelas ini!');
        // }

        // Load the student's answers for this task (if any)
        $jawaban = $tugas->jawaban()->where('siswa_id', auth()->id())->get();

        // Pass the task and its answers to the view
        return view('siswa.kerjakan-soal', compact('tugas', 'jawaban'));
    }

    public function submit(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'soal_id' => 'required|exists:tugas_soal,id',
            'jawaban' => 'required|array',
        ]);

        $tugas = Tugas::findOrFail($id);

        // Check if the student is registered in the task's class
        // Uncomment if needed

        // $terdaftar = SiswaKelas::whereIn('kelas_id', $tugas->kelas->pluck('id'))
        // ->where('siswa_id', Auth::user()->siswa->id)
        // ->exists();

        // if (!$terdaftar) {
        //     return redirect()->back()->with('error', 'Anda tidak terdaftar di kelas ini!');
        // }

        // Calculate the score per multiple-choice question
        $totalPgSoal = TugasSoal::where('tugas_id', $tugas->id)
            ->where('tipe', 'pilihan_ganda')
            ->count();
        $bobotPerSoalPg = $totalPgSoal > 0 ? $tugas->bobot_pg / $totalPgSoal : 0;

        // Save or update the student's answers and calculate scores
        foreach ($request->jawaban as $soal_id => $jawaban) {
            $soal = TugasSoal::findOrFail($soal_id);

            // Determine the score based on question type
            $nilai = null;
            if ($soal->tipe === 'pilihan_ganda') {
                // Compare student's answer with the correct answer
                $nilai = ($jawaban === $soal->jawaban_benar) ? $bobotPerSoalPg : 0;
            }
            // For 'esai', leave nilai as null or 0 for manual grading
            // You can set $nilai = 0 if you prefer a default score

            TugasJawaban::updateOrCreate(
                [
                    'tugas_id' => $tugas->id,
                    'soal_id' => $soal_id,
                    'siswa_id' => Auth::user()->siswa->id,
                ],
                [
                    'jawaban' => $jawaban,
                    'nilai' => $nilai,
                ]
            );
        }

        // Update task status
        $totalSoal = $tugas->soal->count();
        $totalJawaban = $tugas->jawaban()->where('siswa_id', Auth::user()->siswa->id)->count();

        if ($totalJawaban >= $totalSoal) {
            $tugas->save();
        }

        // Log for debugging
        Log::info('Jawaban disimpan untuk tugas_id: ' . $tugas->id, [
            'siswa_id' => Auth::user()->siswa->id,
            'total_soal' => $totalSoal,
            'total_jawaban' => $totalJawaban,
        ]);

        // Redirect to detail-soal view
        return redirect()->route('siswa.tugas.detail', $tugas->id)
            ->with('success', 'Jawaban berhasil disimpan!');
    }


        public function pilga($id)
    {
        // Load the task with its multiple-choice questions
        $tugas = Tugas::with([
            'soal' => function ($query) {
                $query->where('tipe', 'Pilihan Ganda');
            },
            'guruMapel',
            'kelas.siswa'
        ])->findOrFail($id);

        // Check if the logged-in student is registered in one of the task's classes

        // $terdaftar = SiswaKelas::whereIn('kelas_id', $tugas->kelas->pluck('id'))
        // ->where('siswa_id', Auth::user()->siswa->id)
        // ->exists();

        // if (!$terdaftar) {
        // return redirect()->back()->with('error', 'Anda tidak terdaftar di kelas ini!');
        // }

        // Load the student's answers for multiple-choice questions
        $jawaban = $tugas->jawaban()->where('siswa_id', auth()->id())->get();

        return view('siswa.kerjakan-pilga', compact('tugas', 'jawaban'));
    }

    public function esay($id)
    {
        // Load the task with its essay questions
        $tugas = Tugas::with([
            'soal' => function ($query) {
                $query->where('tipe', 'Essay');
            },
            'guruMapel',
            'kelas.siswa'
        ])->findOrFail($id);

        // Check if the logged-in student is registered in one of the task's classes

        // $terdaftar = SiswaKelas::whereIn('kelas_id', $tugas->kelas->pluck('id'))
        // ->where('siswa_id', Auth::user()->siswa->id)
        // ->exists();

        // if (!$terdaftar) {
        // return redirect()->back()->with('error', 'Anda tidak terdaftar di kelas ini!');
        // }

        // Load the student's answers for essay questions
        $jawaban = $tugas->jawaban()->where('siswa_id', auth()->id())->get();

        return view('siswa.kerjakan-esay', compact('tugas', 'jawaban'));
    }
}
