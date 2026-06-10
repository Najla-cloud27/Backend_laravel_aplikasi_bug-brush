<?php

namespace App\Http\Controllers;

use App\Models\SesiFokus;
use Illuminate\Http\Request;

class SesiFokusController extends Controller
{
    public function index()
    {
        $sesiFokus = SesiFokus::with('tugas.kategori')
            ->whereHas('tugas', function ($q) {
                $q->where('user_id', request()->user()->id);
            })
            ->paginate(15);

        return response()->json($sesiFokus);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required',
            'waktu_mulai' => 'required',
            'status' => 'required',
        ]);

        $tugas = \App\Models\Tugas::where('user_id', $request->user()->id)->findOrFail($request->tugas_id);

        $sesiFokus = SesiFokus::create([
            'tugas_id' => $request->tugas_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Sesi fokus berhasil ditambahkan',
            'data' => $sesiFokus
        ]);
    }

    public function show(string $id)
    {
        $sesiFokus = SesiFokus::with('tugas.kategori')
            ->whereHas('tugas', function ($q) {
                $q->where('user_id', request()->user()->id);
            })
            ->findOrFail($id);

        return response()->json($sesiFokus);
    }

    public function update(Request $request, string $id)
    {
        $sesiFokus = SesiFokus::whereHas('tugas', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        })->findOrFail($id);

        $sesiFokus->update($request->only(['tugas_id', 'waktu_mulai', 'waktu_selesai', 'status']));

        return response()->json([
            'message' => 'Sesi fokus berhasil diupdate',
            'data' => $sesiFokus
        ]);
    }

    public function destroy(string $id)
    {
        $sesiFokus = SesiFokus::whereHas('tugas', function ($q) {
            $q->where('user_id', request()->user()->id);
        })->findOrFail($id);

        $sesiFokus->delete();

        return response()->json([
            'message' => 'Sesi fokus berhasil dihapus'
        ]);
    }
}
