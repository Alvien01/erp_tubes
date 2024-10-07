<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Quotation;
use App\Models\CustomerCompany;
use App\Models\CustomerIndividual;
use App\Models\SO;
use App\Models\User;
use App\Models\Order;
use App\Models\Bom;

class SOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $quotataion = quotataion::all();
        $order = SO::all();
        return view('sales.order.index', compact( 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quotationList = Quotation::all();
        
        return view('sales.order.create-SO', compact('quotationList'));
    }

    // Contoh metode di OrderController
    public function saveTotalProduksi(Request $request)
    {
        // Ambil data dari permintaan
        $namaProduk = $request->input('customer');

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
        $id = $request->input('id');
        $id_customer_individual = $request->input('id_customer_individual');
        $id_customer_company = $request->input('id_customer_company');
        $customer = $request->input('customer');
        $expiration = $request->input('expiration');
        $nama_produk = $request->input('nama_produk');
        $jumlah = $request->input('jumlah');
        $satuan_biaya = $request->input('satuan_biaya');
        $total_biaya = $request->input('total_biaya');
        $created_at = $request->input('created_at');
        $updated_at = $request->input('updated_at');

        $tbOrder = new SO(); // Gantilah 'Order' dengan nama model yang sesuai

        $tbOrder->id_quotation = $id;
        $tbOrder->id_customer_individual = $id_customer_individual; 
        $tbOrder->id_customer_company = $id_customer_company; 
        $tbOrder->customer = $customer; 
        $tbOrder->expiration = $expiration; 
        $tbOrder->nama_produk = $nama_produk; 
        $tbOrder->jumlah = $jumlah; 
        $tbOrder->satuan_biaya = $satuan_biaya; 
        $tbOrder->total_biaya = $total_biaya; 
        $tbOrder->created_at = $created_at; 
        $tbOrder->updated_at = $updated_at; 

        // Simpan data bahan ke dalam kolom json di tb_order
        // $tbOrder->nama_bahan = $validatedData['nama_bahan'];
        // $tbOrder->jumlah_bahan = $validatedData['jumlah_bahan'];

        // Simpan instance model ke database
        $tbOrder->save();

        // Redirect ke halaman sukses atau tempat lain yang diinginkan
        return redirect()->route('sales.SO')->with('success', 'Data berhasil disimpan.');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = SO::find($id);

        // Pastikan data ditemukan
        if (!$order) {
            abort(404); // Atau berikan respons atau tindakan yang sesuai jika data tidak ditemukan
        }

        // Dekode string JSON jika nilainya adalah string JSON
        $order->nama_produk = is_string($order->nama_produk) ? json_decode($order->nama_produk) : $order->nama_produk;
        $order->total_biaya = is_string($order->total_biaya) ? json_decode($order->total_biaya) : $order->total_biaya;

        return view('sales.order.detail-SO', compact('order'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Ambil data order berdasarkan ID
        $SO = SO::find($id);
        $quotationList = Quotation::all();


        // Jika order tidak ditemukan, redirect atau berikan respons sesuai kebutuhan
        if (!$SO) {
            return redirect()->route('sales.order')->with('error', 'Order tidak ditemukan.');
        }

        // Lakukan hal-hal lain yang diperlukan untuk persiapan tampilan edit

        // Tampilkan view edit dengan membawa data order
        return view('sales.SO-update', compact('SO', 'bomList', 'produk', 'bahan'));
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
    public function cetak($id)
    {
        $order = SO::find($id);
        return view('sales.order.SO-cetak', compact('order'));
    }
}
