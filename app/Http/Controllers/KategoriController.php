<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
     // tampil semua kategori
    public function index()
    {
        return response()->json(
            Kategori::all()
        );
    }

    // tambah kategori
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'warna' => 'required',
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'warna' => $request->warna,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $kategori
        ]);
    }

    // tampil satu kategori
    public function show(string $id)
    {
        return response()->json(
            Kategori::findOrFail($id)
        );
    }

    // update kategori
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'warna' => $request->warna,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil diupdate',
            'data' => $kategori
        ]);
    }

    // hapus kategori
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}