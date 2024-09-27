<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\Order;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mendapatkan data bahan
        $bahan = Bahan::all();
        $order = Order::all();
    
        // Menambahkan data jumlah_bahan_on_hand dari tb_order ke setiap objek bahan
        // foreach ($bahan as $bahanItem) {
        //     $jumlahBahanOnHand = Order::where('id_bahan', $bahanItem->id_bahan)->sum('jumlah_bahan');
        //     $bahanItem->jumlah_bahan_on_hand = $jumlahBahanOnHand;
        // }
    
        // Menampilkan tampilan blade dengan data bahan yang sudah diperbarui
        return view('manufaktur.bahan', compact('bahan', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manufaktur.create-bahan');
    }

    public function getBahan()
    {
        $bahan = Bahan::all();
        return response()->json($bahan);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'biaya_bahan' => 'nullable',
            'harga_bahan' => 'required',
            'internal_referensi' => 'required',
            'gambar_produk' => 'nullable|file|max:5048',
        ]);

        $bahan = new Bahan();
        $bahan->nama_bahan = $request->input('nama_bahan');
        $bahan->biaya_bahan = $request->input('biaya_bahan');
        $bahan->harga_bahan = $request->input('harga_bahan');
        $bahan->internal_referensi = $request->input('internal_referensi');

        if ($request->hasFile('gambar_bahan')) {
            $gambar = $request->file('gambar_bahan');
            $nama_gambar = $bahan->nama_bahan . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('images/bahan', $nama_gambar, 'public');
            $bahan->gambar_bahan = $nama_gambar;
        }

        $bahan->save();
        return redirect()->route('manufaktur.bahan')->with('success', 'Bahan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bahan = Bahan::find($id);
        return view('manufaktur.bahan-detail', compact('bahan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $bahan = Bahan::find($id);
        if (!$bahan) {
            return redirect()->route('manufaktur.bahan')->with('error', 'Data tidak ditemukan.');
        }
        return view('manufaktur.bahan-update', compact('bahan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'biaya_bahan' => 'nullable',
            'harga_bahan' => 'required',
            'gambar_bahan' => 'nullable|image|max:5048',
        ]);

        $bahan = Bahan::find($id);
        $bahan->nama_bahan = $request->input('nama_bahan');
        $bahan->harga_bahan = $request->input('harga_bahan');
        $bahan->biaya_bahan = $request->input('biaya_bahan');
        $bahan->internal_referensi = $request->input('internal_referensi');


        if ($request->hasFile('gambar_bahan')) {
            $gambar = $request->file('gambar_bahan');
            $nama_gambar = $bahan->nama_bahan . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('images/bahan', $nama_gambar, 'public');
            $bahan->gambar_bahan = $nama_gambar;
        }

        $bahan->save();
        return redirect()->route('manufaktur.bahan-detail', ['id' => $bahan->id_bahan])->with('success', 'Data bahan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bahan = Bahan::find($id);

        if (!$bahan) {
            return redirect()->route('manufaktur.bahan')->with('error', 'Data tidak ditemukan.');
        }

        $bahan->delete();
        return redirect()->route('manufaktur.bahan')->with('success', 'Data berhasil dihapus.');
    }

    public function cetak($id)
    {
        $bahan = Bahan::find($id);
        return view('manufaktur.bahan-cetak', compact('bahan'));
    }

}
