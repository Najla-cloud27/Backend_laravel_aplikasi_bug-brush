<?php

namespace App\Http\Controllers;

use App\Models\Progres;
use Illuminate\Http\Request;

class ProgresController extends Controller
{
    // tampil semua progres
    public function index()
    {
        $progres = Progres::with('user')->get();

        return response()->json($progres);
    }

    // tambah progres
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'total_fokus' => 'required',
            'total_tugas_selesai' => 'required',
            'tanggal' => 'required',
        ]);

        $progres = Progres::create([
            'user_id' => $request->user_id,
            'total_fokus' => $request->total_fokus,
            'total_tugas_selesai' => $request->total_tugas_selesai,
            'tanggal' => $request->tanggal,
        ]);

        return response()->json([
            'message' => 'Progres berhasil ditambahkan',
            'data' => $progres
        ]);
    }

    // detail progres
    public function show(string $id)
    {
        $progres = Progres::with('user')->findOrFail($id);

        return response()->json($progres);
    }

    // update progres
    public function update(Request $request, string $id)
    {
        $progres = Progres::findOrFail($id);

        $progres->update($request->all());

        return response()->json([
            'message' => 'Progres berhasil diupdate',
            'data' => $progres
        ]);
    }

    // hapus progres
    public function destroy(string $id)
    {
        $progres = Progres::findOrFail($id);

        $progres->delete();

        return response()->json([
            'message' => 'Progres berhasil dihapus'
        ]);
    }

}