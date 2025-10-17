<?php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\ForumDiskusi;
use App\Models\ForumKomentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuangDiskusiController extends Controller
{
    public function show(ForumDiskusi $forum)
    {
        $forums = ForumDiskusi::with('guruMapel')->get(); // Fetch all forums for the sidebar
        return view('siswa.ruang-diskusi.show', compact('forums', 'forum'));
    }

    public function getKomentar(ForumDiskusi $forum)
    {
        $komentar = $forum->komentar()
            ->with(['user' => function ($query) {
                $query->select('id', 'name', 'role');
            }])
            ->get()
            ->map(function ($komentar) {
                return [
                    'id' => $komentar->id,
                    'sender' => [
                        'name' => $komentar->user->name,
                        'role' => $komentar->user->role ?? 'Siswa',
                    ],
                    'text' => $komentar->komentar,
                    'time' => $komentar->created_at->format('H:i'),
                    'isMe' => $komentar->user_id === Auth::id(),
                ];
            });

        return response()->json($komentar);
    }

    public function store(Request $request, ForumDiskusi $forum)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        $komentar = ForumKomentar::create([
            'forum_id' => $forum->id,
            'user_id' => Auth::id(),
            'komentar' => $request->komentar,
        ]);

        return response()->json([
            'id' => $komentar->id,
            'sender' => [
                'name' => Auth::user()->name,
                'role' => Auth::user()->role ?? 'Siswa',
            ],
            'text' => $komentar->komentar,
            'time' => $komentar->created_at->format('H:i'),
            'isMe' => true,
        ], 201);
    }
}

