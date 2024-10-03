<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Bahan;
use App\Models\Bom;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB;


class BomController extends Controller
{
    public function index()
    {
        $bom = Bom::all();
        $produk = Produk::all();
        $bahan = Bahan::all();
        return view('manufaktur.bom', compact('bom', 'produk', 'bahan'));
    }

    public function create()
    {
        $produkList = Produk::all();
        $kategoriList = Kategori::all();
        $bahanList = Bahan::all();

        return view('manufaktur/create-bom', compact('produkList', 'kategoriList', 'bahanList'));
    }

    // public function simpanBOM(Request $request)
    // {
    //     $request->validate([
    //         'nama_produk' => 'required',
    //         'nama_kategori' => 'required',
    //         'jumlah_produk' => 'required|numeric',
    //         'internal_referensi' => 'required|string',
    //         'nama_bahan' => 'required|array',
    //         'jumlah_bahan' => 'required|array',
    //     ]);

    //     $bom = new Bom();
    //     $bom->id_produk = $request->input('nama_produk');
    //     $bom->id_kategori = $request->input('nama_kategori');
    //     $bom->id_bahan = $request->input('nama_bahan');
    //     $bom->id_bahan = $request->input('id_bahan'); // Mengambil ID bahan, bukan nama bahan

    //     $bom->jumlah_produk = $request->input('jumlah_produk');
    //     $bom->internal_referensi = $request->input('internal_referensi');

    //     $nama_bahan = $request->input('nama_bahan');
    //     $jumlah_bahan = $request->input('jumlah_bahan');

    //     // Gabungkan nama bahan dan jumlah bahan ke dalam satu kolom
    //     $dataBahan = [];
    //     foreach ($nama_bahan as $key => $bahanId) {
    //         $bahan = Bahan::find($bahanId);
    //         if ($bahan) {
    //             $dataBahan[] = $bahan->nama_bahan . ': ' . $jumlah_bahan[$key];
    //         }
    //     }

    //     $bom->nama_bahan = implode(', ', $dataBahan);

    //     $bom->save();

    //     return redirect()
    //         ->route('manufaktur.detail-bom', ['id_bom' => $bom->id_bom])
    //         ->with('success', 'Data berhasil disimpan!');
    // }




    //wes iso narik id 2 bahan


    // public function simpanBOM(Request $request)
    // {
    //     dd($request->all());
    //     $request->validate([
    //         'nama_produk' => 'required',
    //         'nama_kategori' => 'required',
    //         'jumlah_produk' => 'required|numeric',
    //         'internal_referensi' => 'required|string',
    //         'id_bahan' => 'required|array',
    //         'jumlah_bahan' => 'required|array',
    //     ]);

    //     $bom = new Bom();
    //     $bom->id_produk = $request->nama_produk;
    //     $bom->id_kategori = $request->nama_kategori;
    //     $bom->jumlah_produk = $request->jumlah_produk;
    //     $bom->internal_referensi = $request->internal_referensi;

    //     $id_bahan = $request->id_bahan; // Ambil id_bahan yang sesuai
    //     $nama_bahan = [];

    //     // Gabungkan nama bahan dan jumlah bahan ke dalam satu kolom
    //     foreach ($id_bahan as $key => $bahanId) {
    //         $bahan = Bahan::find($bahanId); // Gantilah 'Bahan' dengan model yang sesuai
    //         if ($bahan) {
    //             $nama_bahan[] = $bahan->nama_bahan . ': ' . $request->jumlah_bahan[$key];
    //         }
    //     }

    //     $bom->nama_bahan = implode(', ', $nama_bahan);
    //     $bom->save();

    //     return redirect()
    //         ->route('manufaktur.detail-bom', ['id_bom' => $bom->id_bom])
    //         ->with('success', 'Data berhasil disimpan!');
    // }





    // public function simpanBOM(Request $request)
    // {
    //     dd($request->all());
    //     $request->validate([
    //         'nama_produk' => 'required',
    //         'nama_kategori' => 'required',
    //         'jumlah_produk' => 'required|numeric',
    //         'internal_referensi' => 'required|string',
    //         'id_bahan' => 'required|array',
    //         'jumlah_bahan' => 'required|array',
    //     ]);

    //     $bom = new Bom();
    //     $bom->id_produk = $request->nama_produk; // Menggunakan $request->nama_produk yang sesuai
    //     $bom->id_kategori = $request->nama_kategori; // Menggunakan $request->nama_kategori yang sesuai
    //     $bom->jumlah_produk = $request->jumlah_produk;
    //     $bom->internal_referensi = $request->internal_referensi;

    //     $id_bahan = $request->id_bahan; // Ambil id_bahan yang sesuai
    //     $nama_bahan = [];

    //     // Gabungkan nama bahan dan jumlah bahan ke dalam satu kolom
    //     foreach ($id_bahan as $key => $bahanId) {
    //         $bahan = Bahan::find($bahanId); // Gantilah 'Bahan' dengan model yang sesuai
    //         if ($bahan) {
    //             $nama_bahan[] = $bahan->nama_bahan . ': ' . $request->jumlah_bahan[$key]; // Menggunakan $request->jumlah_bahan yang sesuai
    //         }
    //     }

    //     $bom->nama_bahan = implode(', ', $nama_bahan);
    //     $bom->save();

    //     return redirect()
    //         ->route('manufaktur.detail-bom', ['id_bom' => $bom->id_bom])
    //         ->with('success', 'Data berhasil disimpan!');
    // }

    // cobak
    public function simpanBOM(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'nama_kategori' => 'required',
            'jumlah_produk' => 'required',
            'internal_referensi' => 'required',
            'nama_bahan' => 'required|array',
            'jumlah_bahan' => 'required|array',
        ]);

        $bom = new Bom();
        $bom->id_produk = $request->nama_produk;
        $bom->nama_produk = $request->input('nama_produk');
        $bom->nama_kategori = $request->input('nama_kategori');
        $bom->jumlah_produk = $request->input('jumlah_produk');
        $bom->internal_referensi = $request->input('internal_referensi');

        // Menyimpan nama_bahan dan jumlah_bahan sebagai dua array terpisah
        $bom->nama_bahan = json_encode($request->input('nama_bahan'));
        $bom->jumlah_bahan = json_encode($request->input('jumlah_bahan'));

        $bom->save();

        return redirect()
            ->route('manufaktur.detail-bom', ['id_bom' => $bom->id_bom])
            ->with('success', 'Data berhasil disimpan!');
    }

    public function detailbom($id_bom)
    {
        // Query bom berdasarkan primary key 'id_bom'
        $bom = Bom::find($id_bom);


        return view('manufaktur.detail-bom', compact('bom'));
    }

    public function editBom($id_bom)
    {
        // Temukan BOM berdasarkan ID
        $bom = Bom::find($id_bom);
        // Temukan daftar produk, kategori, dan bahan yang dapat digunakan untuk opsi edit
        $produkList = Produk::all();
        $kategoriList = Kategori::all();
        $bahanList = Bahan::all();

        return view('manufaktur.bom-update', compact('bom', 'produkList', 'kategoriList', 'bahanList'));
        // return view('manufaktur.bom-update', compact('bom', 'produk', 'kategori', 'bahan'));

    }
    // public function updateBom(Request $request, $id_bom)
    // {
    //     // Validasi data yang dikirim dari formulir edit
    //     $request->validate([
    //         'nama_produk' => 'required|integer',
    //         'nama_kategori' => 'required|integer',
    //         'jumlah_produk' => 'required|numeric',
    //         'internal_referensi' => 'required|string',
    //         'nama_bahan' => 'required|integer',
    //         'jumlah_bahan' => 'required|numeric',
    //     ]);

    //     // Temukan BOM berdasarkan ID
    //     $bom = Bom::find($id_bom);

    //     if (!$bom) {
    //         return back()->with('error', 'BOM tidak ditemukan.');
    //     }

    //     // Mengambil data nama_produk, nama_kategori, dan nama_bahan dari model terkait
    //     $produk = Produk::find($request['nama_produk']);
    //     $kategori = Kategori::find($request['nama_kategori']);
    //     $bahan = Bahan::find($request['nama_bahan']);

    //     // Perhitungan
    //     $biayaProduksi = $produk->biaya_produksi;
    //     $biayaBahan = $bahan->biaya_bahan;
    //     $totalBiayaProduksi = $biayaProduksi * $request['jumlah_produk'];
    //     $totalBiayaBahan = $biayaBahan * $request['jumlah_bahan'];

    //     // Perbarui data BOM dengan data yang baru
    //     $bom->id_produk = $request['nama_produk'];
    //     $bom->id_kategori = $request['nama_kategori'];
    //     $bom->jumlah_produk = $request['jumlah_produk'];
    //     $bom->internal_referensi = $request['internal_referensi'];
    //     $bom->id_bahan = $request['nama_bahan'];
    //     $bom->jumlah_bahan = $request['jumlah_bahan'];
    //     $bom->total_biaya_produk = $totalBiayaProduksi;
    //     $bom->total_biaya_bahan = $totalBiayaBahan;

    //     // Set nama_produk, nama_kategori, dan nama_bahan dalam model bom
    //     $bom->nama_produk = $produk->nama_produk;
    //     $bom->nama_kategori = $kategori->nama_kategori;
    //     $bom->nama_bahan = $bahan->nama_bahan;

    //     // Lakukan perhitungan total_biaya dan total_bom sesuai dengan logika aplikasi Anda

    //     // Simpan perubahan data BOM
    //     $bom->save();
    //     return redirect()
    //         ->route('manufaktur.detail-bom', ['id_bom' => $bom->id_bom])
    //         ->with('success', 'Data berhasil diperbarui!');
    // }

    public function updateBOM(Request $request, $id_bom)
    {
        $request->validate([
            'nama_produk' => 'required',
            'nama_kategori' => 'required',
            'jumlah_produk' => 'required',
            'internal_referensi' => 'required',
            'nama_bahan' => 'required|array',
            'jumlah_bahan' => 'required|array',
        ]);

        // Mengambil data BOM berdasarkan $id_bom
        $bom = Bom::findOrFail($id_bom);

        // Update data BOM
        $bom->id_produk = $request->nama_produk;
        $bom->nama_produk = $request->input('nama_produk');
        $bom->nama_kategori = $request->input('nama_kategori');
        $bom->jumlah_produk = $request->input('jumlah_produk');
        $bom->internal_referensi = $request->input('internal_referensi');

        // Menyimpan nama_bahan dan jumlah_bahan sebagai dua array terpisah
        $bom->nama_bahan = json_encode($request->input('nama_bahan'));
        $bom->jumlah_bahan = json_encode($request->input('jumlah_bahan'));

        $bom->save();

        return redirect()
            ->route('manufaktur.detail-bom', ['id_bom' => $bom->id_bom])
            ->with('success', 'Data berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $bom = Bom::find($id);

        if (!$bom) {
            return redirect()->route('manufaktur.bom')->with('error', 'Data Bom tidak ditemukan.');
        }

        $namaProduk = $bom->produk->nama_produk;

        $bom->delete();
        return redirect()->route('manufaktur.bom')->with('success', 'Data Bom dengan produk ' . $namaProduk . ' berhasil dihapus.');
    }

    public function getBomById($id_bom)
    {
        $bom = Bom::find($id_bom);

        if (!$bom) {
            return response()->json(['error' => 'BOM not found'], 404);
        }

        $produk = Produk::all(); // Ganti dengan model Produk yang sesuai
        $kategori = Kategori::all(); // Ganti dengan model Kategori yang sesuai
        $bahan = Bahan::all(); // Ganti dengan model Bahan yang sesuai

        $data = [
            'produk' => $produk,
            'kategori' => $kategori,
            'bahan' => $bahan,
        ];

        return response()->json($data);
    }

    public function getProduk()
    {
        $produk = Produk::all(); // Ganti dengan model Produk yang sesuai
        return response()->json($produk);
    }

    public function getKategori()
    {
        $kategori = Kategori::all(); // Ganti dengan model Kategori yang sesuai
        return response()->json($kategori);
    }

    public function getBahan()
    {
        $bahan = Bahan::all(); // Ganti dengan model Bahan yang sesuai
        return response()->json($bahan);
    }

    public function cetak($id)
    {
        $bom = Bom::find($id);
        return view('manufaktur.bom-cetak', compact('bom'));
    }
}
