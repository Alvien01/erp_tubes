<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Order;

class ProdukController extends Controller
{
    public function index()
    {
        // $produk = Produk::all();
        $produk = Produk::orderBy('created_at', 'asc')->paginate(6);

        // Ambil jumlah_produk dari relasi
        $orderQuantities = $produk->map(function ($product) {
            return $product->orders->sum('jumlah_produk');
        });

        // Ambil status dari relasi order
        $orderStatuses = $produk->map(function ($product) {
            return $product->orders->pluck('status')->first();
        });

        return view('manufaktur.produk', compact('produk', 'orderQuantities', 'orderStatuses'));
    }

    public function create()
    {
        return view('/manufaktur/create-produk');
    }

    public function getProduk()
    {
        $produk = Produk::all();
        return response()->json($produk);
    }

    public function addCategory(Request $request)
    {
        $kategoriBaru = $request->input('kategori_baru');

        // Simpan kategori baru ke database (tabel Kategori)
        // Gantilah ini dengan logika penyimpanan yang sesuai
        $kategori = new Kategori();
        $kategori->nama = $kategoriBaru;
        $kategori->save();

        // Berikan respons sukses
        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga_produksi' => 'required',
            'biaya_produksi' => 'nullable',
            'internal_referensi' => 'required',
            'nama_kategori' => 'nullable',
            'barcode' => 'nullable',
            'gambar_produk' => 'nullable|image|max:1048',
        ]);
        $produk = new Produk();
        $produk->nama_produk = $request->input('nama_produk');
        $produk->harga_produksi = $request->input('harga_produksi');
        $produk->biaya_produksi = $request->input('biaya_produksi');
        $produk->internal_referensi = $request->input('internal_referensi');
        $produk->nama_kategori = $request->input('nama_kategori');
        $produk->barcode = $request->input('barcode');
        $produk->gambar_produk = $request->input('gambar_produk');

        //Pindah Simpan Gambar ke file yang didefinisikan (filesystems ori)
        // if ($request->hasFile('gambar_produk')) {
        //     $gambar = $request->file('gambar_produk');
        //     $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
        //     $gambar->move(public_path('images/produk'), $nama_gambar);
        //     $produk->gambar_produk = $nama_gambar;
        // }

        if ($request->hasFile('gambar_produk')) {
            $gambar = $request->file('gambar_produk');
            $nama_gambar = $produk->nama_produk . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('images/produk', $nama_gambar, 'public');
            $produk->gambar_produk = $nama_gambar;
        }

        $produk->save();

        return redirect()
            ->route('manufaktur.produk')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Request $request, $id_produk)
    {
        $produk = Produk::find($id_produk);
        if (!$produk) {
            return redirect()
                ->route('manufaktur.produk')
                ->with('error', 'Data tidak ditemukan.');
        }
        return view('manufaktur.produk-update', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga_produksi' => 'required',
            'biaya_produksi' => 'nullable',
            'internal_referensi' => 'required',
            'nama_kategori' => 'nullable',
            'barcode' => 'nullable',
            'gambar_produk' => 'nullable|image|max:5048',
        ]);
        $produk = Produk::find($id);
        $produk->nama_produk = $request->input('nama_produk');
        $produk->harga_produksi = $request->input('harga_produksi');
        $produk->biaya_produksi = $request->input('biaya_produksi');
        $produk->internal_referensi = $request->input('internal_referensi');
        $produk->nama_kategori = $request->input('nama_kategori');
        $produk->barcode = $request->input('barcode');

        if (!$produk) {
            return redirect()
                ->route('manufaktur.produk')
                ->with('error', 'Produk tidak ditemukan.');
        }

        if ($request->hasFile('gambar_produk')) {
            $gambar = $request->file('gambar_produk');
            $nama_gambar = $produk->nama_produk . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('images/produk', $nama_gambar, 'public');
            $produk->gambar_produk = $nama_gambar;
        }

        $produk->save();

        return redirect()
            ->route('manufaktur.produk-detail', ['id' => $id])
            ->with('success', 'Data berhasil diperbarui');
    }

    public function show($id)
    {
        $produk = Produk::find($id);
        return view('manufaktur.produk-detail', compact('produk'));
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return redirect()
            ->route('manufaktur.produk')
            ->with('success', 'Produk berhasil Dihapus');
    }

    public function cetak($id)
    {
        $produk = Produk::find($id);
        return view('manufaktur.produk-cetak', compact('produk'));
    }
}
