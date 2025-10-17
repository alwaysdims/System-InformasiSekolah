<?php

namespace App\Http\Controllers\Guru\GuruMapel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\PengaduanChat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with(['siswa', 'gambar', 'chat.user'])
            ->orderBy('dibuat_pada', 'desc');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Filter status hanya untuk Menunggu, Diproses, Selesai
        if ($request->filled('status') && in_array($request->status, ['Menunggu', 'Diproses', 'Selesai'])) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            if ($request->date == 'today') {
                $query->whereDate('dibuat_pada', now());
            } elseif ($request->date == 'week') {
                $query->whereBetween('dibuat_pada', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($request->date == 'month') {
                $query->whereMonth('dibuat_pada', now()->month)->whereYear('dibuat_pada', now()->year);
            }
        }

        $pengaduan = $query->paginate(10);

        return view('guru.gurumapel.pengaduan', compact('pengaduan'));
    }

    public function storeResponse(Request $request, $pengaduanId)
    {
        $request->validate([
            'pesan' => 'required|string',
            'status' => 'required|in:Menunggu,Diproses,Selesai',
            'alasan' => 'required_if:status,Selesai|nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            PengaduanChat::create([
                'pengaduan_id' => $pengaduanId,
                'user_id' => Auth::id(),
                'pesan' => $request->pesan,
            ]);

            $pengaduan = Pengaduan::findOrFail($pengaduanId);
            $pengaduan->update([
                'status' => $request->status,
                'alasan' => $request->status === 'Selesai' ? $request->alasan : null,
            ]);

            DB::commit();
            return redirect()->route('guru.pengaduan')->with('success', 'Respons berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Gagal menyimpan respons untuk Pengaduan ID {$pengaduanId}: " . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
                'request_data' => $request->except('_token')
            ]);
            return redirect()->route('guru.pengaduan')->with('error', 'Gagal menyimpan respons: ' . $e->getMessage());
        }
    }
}