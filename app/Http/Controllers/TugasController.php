<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
     // tampil semua tugas
    public function index()
    {
        $tugas = Tugas::with('kategori')->get();

        return response()->json($tugas);
    }

    // tambah tugas
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required',
            'tenggat_waktu' => 'required',
            'durasi_menit' => 'required',
        ]);

        $tugas = Tugas::create([
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

    // tampil detail tugas
    public function show(string $id)
    {
        $tugas = Tugas::with('kategori')->findOrFail($id);

        return response()->json($tugas);
    }

    // update tugas
    public function update(Request $request, string $id)
    {
        $tugas = Tugas::findOrFail($id);

        $tugas->update($request->all());

        return response()->json([
            'message' => 'Tugas berhasil diupdate',
            'data' => $tugas
        ]);
    }

    // hapus tugas
    public function destroy(string $id)
    {
        $tugas = Tugas::findOrFail($id);

        $tugas->delete();

        return response()->json([
            'message' => 'Tugas berhasil dihapus'
        ]);
    }
}