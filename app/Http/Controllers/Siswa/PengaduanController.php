<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\PengaduanGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Pastikan user punya relasi siswa
        if (!$user || !$user->siswa) {
            return redirect()->route('login')->with('error', 'Akun Anda tidak terdaftar sebagai siswa.');
        }

        $query = Pengaduan::with(['gambar', 'chat.user'])
            ->where('siswa_id', $user->siswa->id)
            ->orderBy('dibuat_pada', 'desc');

        // 🔍 Filter pencarian
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // 🧩 Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 🗓️ Filter tanggal
        if ($request->filled('date')) {
            switch ($request->date) {
                case 'today':
                    $query->whereDate('dibuat_pada', today());
                    break;
                case 'week':
                    $query->whereBetween('dibuat_pada', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereBetween('dibuat_pada', [now()->startOfMonth(), now()->endOfMonth()]);
                    break;
            }
        }

        $pengaduan = $query->paginate(10);

        return view('siswa.pengaduan', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maks 2MB per gambar
        ]);

        DB::beginTransaction();
        try {
            // Buat pengaduan baru
            $pengaduan = Pengaduan::create([
                'siswa_id' => Auth::user()->siswa->id,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'status' => 'Menunggu',
                'dibuat_pada' => now(),
            ]);

            // Simpan gambar jika ada
            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    $path = $file->store('pengaduan_gambar', 'public');
                    PengaduanGambar::create([
                        'pengaduan_id' => $pengaduan->id,
                        'file_path' => $path,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('siswa.pengaduan.index')->with('success', 'Pengaduan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Gagal menyimpan pengaduan: " . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
                'request_data' => $request->except('_token', 'gambar'),
            ]);
            return redirect()->route('siswa.pengaduan.index')->with('error', 'Gagal menyimpan pengaduan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
