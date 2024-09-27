<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Menyimpan kategori baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function kstore(Request $request)
    {
        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);
            if (Kategori::where('nama_kategori', $request->nama_kategori)->exists()) {
                return response()->json(['message' => 'Kategori sudah ada']);
            }

            $kategori = new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();

            // Simpan pesan sukses di sesi Laravel
            $request->session()->flash('success', 'Kategori berhasil ditambahkan !!!');

            return response()->json([
                'id_kategori' => $kategori->id,
                'nama_kategori' => $kategori->nama_kategori,
                'message' => 'Data berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }


    public function getKategoriSuggestions(Request $request)
    {
        $query = $request->input('query');
        $suggestions = Kategori::where('nama_kategori', 'like', '%' . $query . '%')->pluck('nama_kategori');

        return response()->json(['suggestions' => $suggestions]);
    }

}
