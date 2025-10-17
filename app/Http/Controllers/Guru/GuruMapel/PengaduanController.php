<?php

namespace App\Http\Controllers\Guru\GuruMapel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\PengaduanChat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with(['siswa', 'gambar', 'chat.user'])
            ->orderBy('created_at', 'desc');

        // Filter Pencarian
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter Status
        if ($request->filled('status') && in_array($request->status, ['Pending', 'Proses', 'Selesai', 'Ditolak'])) {
            $query->where('status', $request->status);
        }

        // Filter Tanggal
        if ($request->filled('date')) {
            if ($request->date == 'today') {
                $query->whereDate('created_at', now());
            } elseif ($request->date == 'week') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($request->date == 'month') {
                $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
            }
        }

        $pengaduan = $query->paginate(10);

        return view('guru.gurumapel.pengaduan', compact('pengaduan'));
    }

    public function storeResponse(Request $request, $pengaduanId)
    {
        $request->validate([
            'pesan' => 'required|string',
            'status' => 'required|in:Pending,Proses,Selesai,Ditolak',
            'alasan' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Simpan pesan chat
            PengaduanChat::create([
                'pengaduan_id' => $pengaduanId,
                'user_id' => Auth::id(),
                'pesan' => $request->pesan,
            ]);

            // Perbarui status dan alasan pengaduan
            $pengaduan = Pengaduan::findOrFail($pengaduanId);
            $pengaduan->update([
                'status' => $request->status,
                'alasan' => $request->status == 'Selesai' || $request->status == 'Ditolak' ? $request->alasan : null,
            ]);

            DB::commit();
            return redirect()->route('guru.pengaduan')->with('success', 'Respons berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('guru.pengaduan')->with('error', 'Gagal menyimpan respons.');
        }
    }
}
?>