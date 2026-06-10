<?php

namespace App\Http\Controllers;

use App\Models\Progres;
use Illuminate\Http\Request;

class ProgresController extends Controller
{
    public function index()
    {
        $progres = Progres::with('user')
            ->where('user_id', request()->user()->id)
            ->paginate(15);

        return response()->json($progres);
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_fokus' => 'required',
            'total_tugas_selesai' => 'required',
            'tanggal' => 'required',
        ]);

        $progres = Progres::create([
            'user_id' => $request->user()->id,
            'total_fokus' => $request->total_fokus,
            'total_tugas_selesai' => $request->total_tugas_selesai,
            'tanggal' => $request->tanggal,
        ]);

        return response()->json([
            'message' => 'Progres berhasil ditambahkan',
            'data' => $progres
        ]);
    }

    public function show(string $id)
    {
        $progres = Progres::with('user')
            ->where('user_id', request()->user()->id)
            ->findOrFail($id);

        return response()->json($progres);
    }

    public function update(Request $request, string $id)
    {
        $progres = Progres::where('user_id', $request->user()->id)->findOrFail($id);

        $progres->update($request->only(['total_fokus', 'total_tugas_selesai', 'tanggal']));

        return response()->json([
            'message' => 'Progres berhasil diupdate',
            'data' => $progres
        ]);
    }

    public function destroy(string $id)
    {
        $progres = Progres::where('user_id', request()->user()->id)->findOrFail($id);

        $progres->delete();

        return response()->json([
            'message' => 'Progres berhasil dihapus'
        ]);
    }
}
