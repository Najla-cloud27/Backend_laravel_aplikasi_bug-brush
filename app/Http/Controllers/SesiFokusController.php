<?php

namespace App\Http\Controllers;

use App\Models\SesiFokus;
use Illuminate\Http\Request;

class SesiFokusController extends Controller
{
     // tampil semua sesi fokus
    public function index()
    {
        $sesiFokus = SesiFokus::with('tugas')->get();

        return response()->json($sesiFokus);
    }

    // tambah sesi fokus
    public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required',
            'waktu_mulai' => 'required',
            'status' => 'required',
        ]);

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

    // detail sesi fokus
    public function show(string $id)
    {
        $sesiFokus = SesiFokus::with('tugas')->findOrFail($id);

        return response()->json($sesiFokus);
    }

    // update sesi fokus
    public function update(Request $request, string $id)
    {
        $sesiFokus = SesiFokus::findOrFail($id);

        $sesiFokus->update($request->all());

        return response()->json([
            'message' => 'Sesi fokus berhasil diupdate',
            'data' => $sesiFokus
        ]);
    }

    // hapus sesi fokus
    public function destroy(string $id)
    {
        $sesiFokus = SesiFokus::findOrFail($id);

        $sesiFokus->delete();

        return response()->json([
            'message' => 'Sesi fokus berhasil dihapus'
        ]);
    }
}