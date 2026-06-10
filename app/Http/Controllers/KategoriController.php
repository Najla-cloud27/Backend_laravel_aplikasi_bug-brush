<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::where('user_id', request()->user()->id)->paginate(15);

        return response()->json($kategori);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'warna' => 'required',
        ]);

        $kategori = Kategori::create([
            'user_id' => $request->user()->id,
            'nama_kategori' => $request->nama_kategori,
            'warna' => $request->warna,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $kategori
        ]);
    }

    public function show(string $id)
    {
        $kategori = Kategori::where('user_id', request()->user()->id)->findOrFail($id);

        return response()->json($kategori);
    }

    public function update(Request $request, string $id)
    {
        $kategori = Kategori::where('user_id', $request->user()->id)->findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'warna' => $request->warna,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil diupdate',
            'data' => $kategori
        ]);
    }

    public function destroy(string $id)
    {
        $kategori = Kategori::where('user_id', request()->user()->id)->findOrFail($id);

        $kategori->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}
