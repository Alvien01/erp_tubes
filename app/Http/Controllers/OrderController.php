<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Bahan;
use App\Models\Bom;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bom = Bom::all();
        $produk = Produk::all();
        $bahan = Bahan::all();
        $order = Order::all();
        return view('manufaktur.order', compact('bom', 'produk', 'bahan', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Produk::all();
        $bomList = Bom::all();
        $bahan = Bahan::all();
        
        return view('manufaktur.create-order', compact('bomList', 'produk', 'bahan'));
    }

    // Contoh metode di OrderController
    public function saveTotalProduksi(Request $request)
    {
        // Ambil data dari permintaan
        $idBOM = $request->input('id_bom');
        $namaBahan = $request->input('nama_bahan');
        $totalProduksi = $request->input('total_produksi');

        // Simpan data ke dalam database (sesuai kebutuhan Anda)
        // ...

        // Beri respons ke klien (opsional)
        return response()->json(['success' => true]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_bom' => 'required|exists:tb_bom,id_bom',
            'nama_produk' => 'required',
            'jumlah_produk' => 'required|integer',
            'nama_bahan.*' => 'required', // Menggunakan * untuk menangani array dari formulir
            'jumlah_bahan.*' => 'required|integer', // Menggunakan * untuk menangani array dari formulir
        ]);

        $idProduk = $request->input('id_produk');
        $idBahan = $request->input('id_bahan');

        // Proses data formulir dan simpan ke database
        $tbOrder = new Order(); // Gantilah 'Order' dengan nama model yang sesuai

        $tbOrder->id_bom = $validatedData['id_bom'];
        $tbOrder->id_produk = $idProduk;
        $tbOrder->id_bahan = $idBahan;
        $tbOrder->nama_produk = $validatedData['nama_produk'];
        $tbOrder->jumlah_produk = $validatedData['jumlah_produk'];

        // Simpan data bahan ke dalam kolom json di tb_order
        $tbOrder->nama_bahan = $validatedData['nama_bahan'];
        $tbOrder->jumlah_bahan = $validatedData['jumlah_bahan'];

        // Simpan instance model ke database
        $tbOrder->save();

        // Redirect ke halaman sukses atau tempat lain yang diinginkan
        return redirect()->route('manufaktur.order')->with('success', 'Data berhasil disimpan.');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_order)
    {
        $order = Order::find($id_order);

        // Pastikan data ditemukan
        if (!$order) {
            abort(404); // Atau berikan respons atau tindakan yang sesuai jika data tidak ditemukan
        }

        // Dekode string JSON jika nilainya adalah string JSON
        $order->nama_bahan = is_string($order->nama_bahan) ? json_decode($order->nama_bahan) : $order->nama_bahan;
        $order->jumlah_bahan = is_string($order->jumlah_bahan) ? json_decode($order->jumlah_bahan) : $order->jumlah_bahan;

        return view('manufaktur.detail-order', compact('order'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_order)
    {
        // Ambil data order berdasarkan ID
        $order = Order::find($id_order);
        $produk = Produk::all();
        $bomList = Bom::all();
        $bahan = Bahan::all();


        // Jika order tidak ditemukan, redirect atau berikan respons sesuai kebutuhan
        if (!$order) {
            return redirect()->route('manufaktur.order')->with('error', 'Order tidak ditemukan.');
        }

        // Lakukan hal-hal lain yang diperlukan untuk persiapan tampilan edit

        // Tampilkan view edit dengan membawa data order
        return view('manufaktur.order-update', compact('order', 'bomList', 'produk', 'bahan'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_order)
    {
        // Validasi data yang diterima dari formulir edit
        $validatedData = $request->validate([
            'id_bom' => 'required|exists:tb_bom,id_bom',
            'nama_produk' => 'required',
            'jumlah_produk' => 'required|integer',
            'nama_bahan.*' => 'required', // Menggunakan * untuk menangani array dari formulir
            'jumlah_bahan.*' => 'required|integer', // Menggunakan * untuk menangani array dari formulir
        ]);

        // Ambil data order berdasarkan ID
        $tbOrder = Order::find($id_order);

        // Jika order tidak ditemukan, redirect atau berikan respons sesuai kebutuhan
        if (!$tbOrder) {
            return redirect()->route('manufaktur.order')->with('error', 'Order tidak ditemukan.');
        }

        // Update data order dengan data yang diterima dari formulir edit
        $tbOrder->id_bom = $validatedData['id_bom'];
        $tbOrder->nama_produk = $validatedData['nama_produk'];
        $tbOrder->jumlah_produk = $validatedData['jumlah_produk'];
        $tbOrder->nama_bahan = $validatedData['nama_bahan'];
        $tbOrder->jumlah_bahan = $validatedData['jumlah_bahan'];

        // Simpan perubahan ke database
        $tbOrder->save();

        // Redirect ke halaman sukses atau tempat lain yang diinginkan
        return redirect()->route('manufaktur.order')->with('success', 'Data berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_order)
    {
        $order = Order::find($id_order);

        
        $order->delete();
        return redirect()->route('manufaktur.order')->with('success', 'Data Order berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $term = $request->input('term');

        $results = Bom::with('produk')
            ->whereHas('produk', function ($query) use ($term) {
                $query->where('nama_produk', 'like', '%' . $term . '%');
            })
            ->get();

        return response()->json($results);
    }

    public function getBomData()
    {
        $bomList = Bom::all();

        return response()->json($bomList);
    }

    public function getBahanData($bomId)
    {
        // Ambil data bahan berdasarkan $bomId
        $bom = Bom::find($bomId);

        // Cek apakah BOM ditemukan
        if (!$bom) {
            return response()->json(['error' => 'BOM not found'], 404);
        }

        // Dekode data nama_bahan dan jumlah_bahan dari BOM
        $namaBahanArray = json_decode($bom->nama_bahan, true);
        $jumlahBahanArray = json_decode($bom->jumlah_bahan, true);

        // Bangun array baru yang berisi data bahan
        $bahanData = [];
        for ($i = 0; $i < count($namaBahanArray); $i++) {
            $bahanData[] = [
                'nama_bahan' => $namaBahanArray[$i],
                'jumlah_bahan' => $jumlahBahanArray[$i],
            ];
        }

        // Kembalikan data bahan sebagai respons JSON
        return response()->json($bahanData);
    }

    public function konfirmasi($id_order)
    {
        $order = Order::find($id_order);

        if (!$order) {
            // Handle order not found, redirect or show an error
            return redirect()->back()->with('error', 'Order not found');
        }

        // Update the order status to 'Konfirmasi'
        $order->status = 'Konfirmasi';
        $order->save();

        // Redirect back or to another page
        return redirect()->back()->with('success', 'Status berubah Terkorfirmasi');
    }

    public function selesai($id_order)
    {
        $order = Order::find($id_order);

        if (!$order) {
            // Handle order not found, redirect or show an error
            return redirect()->back()->with('error', 'Order not found');
        }

        // Update the order status to 'Selesai'
        $order->status = 'Selesai';
        $order->save();

        // Redirect back or to another page
        return redirect()->back()->with('success', 'Status berubah Selesai');
    }
}
