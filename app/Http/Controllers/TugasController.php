<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::with('kategori')
            ->where('user_id', request()->user()->id)
            ->paginate(15);

        return response()->json($tugas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required',
            'tenggat_waktu' => 'required',
            'durasi_menit' => 'required',
        ]);

        $tugas = Tugas::create([
            'user_id' => $request->user()->id,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'status' => $request->status,
            'tenggat_waktu' => $request->tenggat_waktu,
            'pengulangan' => $request->pengulangan,
            'hari_kustom' => $request->hari_kustom,
            'durasi_menit' => $request->durasi_menit,
        ]);

        return response()->json([
            'message' => 'Tugas berhasil ditambahkan',
            'data' => $tugas
        ]);
    }

    public function show(string $id)
    {
        $tugas = Tugas::with('kategori')
            ->where('user_id', request()->user()->id)
            ->findOrFail($id);

        return response()->json($tugas);
    }

    public function update(Request $request, string $id)
    {
        $tugas = Tugas::where('user_id', $request->user()->id)->findOrFail($id);

        $tugas->update($request->only(['kategori_id', 'judul', 'status', 'tenggat_waktu', 'pengulangan', 'hari_kustom', 'durasi_menit']));

        return response()->json([
            'message' => 'Tugas berhasil diupdate',
            'data' => $tugas
        ]);
    }

    public function destroy(string $id)
    {
        $tugas = Tugas::where('user_id', request()->user()->id)->findOrFail($id);

        $tugas->delete();

        return response()->json([
            'message' => 'Tugas berhasil dihapus'
        ]);
    }
}
