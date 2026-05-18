<?php

namespace App\Http\Controllers;

use App\Models\Kutipan;
use Illuminate\Http\Request;

class KutipanController extends Controller
{
     // tampil semua kutipan
    public function index()
    {
        $kutipan = Kutipan::all();

        return response()->json($kutipan);
    }

    // tambah kutipan
    public function store(Request $request)
    {
        $request->validate([
            'isi_kutipan' => 'required',
            'penulis' => 'nullable',
        ]);

        $kutipan = Kutipan::create([
            'isi_kutipan' => $request->isi_kutipan,
            'penulis' => $request->penulis,
        ]);

        return response()->json([
            'message' => 'Kutipan berhasil ditambahkan',
            'data' => $kutipan
        ]);
    }

    // detail kutipan
    public function show(string $id)
    {
        $kutipan = Kutipan::findOrFail($id);

        return response()->json($kutipan);
    }

    // update kutipan
    public function update(Request $request, string $id)
    {
        $kutipan = Kutipan::findOrFail($id);

        $kutipan->update($request->all());

        return response()->json([
            'message' => 'Kutipan berhasil diupdate',
            'data' => $kutipan
        ]);
    }

    // hapus kutipan
    public function destroy(string $id)
    {
        $kutipan = Kutipan::findOrFail($id);

        $kutipan->delete();

        return response()->json([
            'message' => 'Kutipan berhasil dihapus'
        ]);
    }
}