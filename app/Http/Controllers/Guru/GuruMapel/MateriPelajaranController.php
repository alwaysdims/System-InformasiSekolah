<?php

namespace App\Http\Controllers\Guru\GuruMapel;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pastikan user terautentikasi
        // if (!Auth::check()) {
        //     return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        // }

        $user = Auth::user();

        // Cek apakah user punya relasi guruMapel
        if (!$user->guruMapel) {
            return redirect()->back()->with('error', 'Akun Anda tidak terkait dengan data Guru Mapel.');
        }

        $guruMapelId = $user->guruMapel->id;
        $materis = Materi::where('guru_mapel_id', $guruMapelId)->get();
        $kelas = Kelas::all(); // Untuk modal publikasi

        return view('guru.gurumapel.materi', compact('materis', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (!Auth::check() || !Auth::user()->guruMapel) {
        //     return redirect()->back()->with('error', 'Akses ditolak. Pastikan Anda login dan terkait dengan Guru Mapel.');
        // }

        $request->validate([
            'mapel' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'file' => 'required|file|mimes:doc,docx,ppt,pptx,xls,xlsx|max:20480', // Max 20MB
        ]);

        $guruMapelId = Auth::user()->guruMapel->id;

        // Upload file
        $filePath = $request->file('file')->store('materi', 'public');

        Materi::create([
            'guru_mapel_id' => $guruMapelId,
            'mapel' => $request->mapel,
            'judul' => $request->mapel, // Adjust jika judul berbeda
            'deskripsi' => $request->author, // Adjust jika deskripsi berbeda
            'file_path' => $filePath,
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materi $materi)
    {
        // if (!Auth::check() || !Auth::user()->guruMapel || $materi->guru_mapel_id !== Auth::user()->guruMapel->id) {
        //     return redirect()->back()->with('error', 'Akses ditolak.');
        // }

        $request->validate([
            'mapel' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:doc,docx,ppt,pptx,xls,xlsx|max:20480',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($materi->file_path);
            $filePath = $request->file('file')->store('materi', 'public');
            $materi->file_path = $filePath;
        }

        $materi->update([
            'mapel' => $request->mapel,
            'judul' => $request->mapel,
            'deskripsi' => $request->author,
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materi $materi)
    {
        // if (!Auth::check() || !Auth::user()->guruMapel || $materi->guru_mapel_id !== Auth::user()->guruMapel->id) {
        //     return redirect()->back()->with('error', 'Akses ditolak.');
        // }

        Storage::disk('public')->delete($materi->file_path);
        $materi->delete();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus!');
    }

    /**
     * Publish materi ke kelas tertentu.
     */
    public function publish(Request $request, Materi $materi)
    {
        // if (!Auth::check() || !Auth::user()->guruMapel || $materi->guru_mapel_id !== Auth::user()->guruMapel->id) {
        //     return redirect()->back()->with('error', 'Akses ditolak.');
        // }

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        if ($materi->kelas()->where('kelas_id', $request->kelas_id)->exists()) {
            return redirect()->route('guru.materi.index')->with('error', 'Materi sudah dipublikasikan ke kelas ini.');
        }

        $materi->kelas()->attach($request->kelas_id);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dipublikasikan ke kelas!');
    }
}
