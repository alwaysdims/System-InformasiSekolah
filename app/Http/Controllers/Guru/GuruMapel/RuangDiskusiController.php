<?php

namespace App\Http\Controllers\Guru\GuruMapel;

use App\Models\ForumDiskusi;
use Illuminate\Http\Request;
use App\Models\ForumKomentar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RuangDiskusiController extends Controller
{
    public function index()
    {
        $forums = ForumDiskusi::with(['guruMapel.mapel', 'creator', 'komentar'])->latest('dibuat_pada')->get();
        return view('guru.gurumapel.forum-diskusi', compact('forums'));
    }

    public function show($id)
    {
        $forum = ForumDiskusi::with(['guruMapel.mapel', 'creator', 'komentar.user'])->findOrFail($id);
        $forums = ForumDiskusi::with(['guruMapel.mapel', 'creator', 'komentar'])->latest('dibuat_pada')->get(); // For sidebar
        return view('guru.gurumapel.diskusi', compact('forum', 'forums'));
    }

    public function store(Request $request, $forum)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        $forumModel = ForumDiskusi::findOrFail($forum); // Validasi forum exists

        try {
            $komentar = ForumKomentar::create([
                'forum_id' => $forum,
                'user_id' => Auth::id(),
                'komentar' => $request->komentar,
                'dibuat_pada' => now(),
            ]);

            return response()->json([
                'message' => 'Komentar berhasil ditambahkan',
                'komentar' => [
                    'id' => $komentar->id,
                    'user' => [
                        'name' => Auth::user()->name,
                        'avatar' => Auth::user()->avatar ?? asset('images/default.png'),
                    ],
                    'komentar' => $komentar->komentar,
                    'dibuat_pada' => $komentar->dibuat_pada->diffForHumans(),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan komentar: ' . $e->getMessage(),
            ], 500);
        }
    }
}
