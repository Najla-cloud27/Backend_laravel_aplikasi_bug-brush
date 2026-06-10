<?php

namespace App\Http\Controllers;

use App\Models\Kutipan;
use Illuminate\Http\Request;

class KutipanController extends Controller
{
    public function index()
    {
        $kutipan = Kutipan::paginate(15);

        return response()->json($kutipan);
    }

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

    public function show(string $id)
    {
        $kutipan = Kutipan::findOrFail($id);

        return response()->json($kutipan);
    }

    public function update(Request $request, string $id)
    {
        $kutipan = Kutipan::findOrFail($id);

        $kutipan->update($request->only(['isi_kutipan', 'penulis']));

        return response()->json([
            'message' => 'Kutipan berhasil diupdate',
            'data' => $kutipan
        ]);
    }

    public function destroy(string $id)
    {
        $kutipan = Kutipan::findOrFail($id);

        $kutipan->delete();

        return response()->json([
            'message' => 'Kutipan berhasil dihapus'
        ]);
    }
}
