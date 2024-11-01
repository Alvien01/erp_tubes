<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Quotation;
use App\Models\SO;
use App\Models\Order;
use App\Models\RFQ;
use App\Models\CustomerCompany;
use App\Models\CustomerIndividual;
use Illuminate\Http\Request;

class quotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotation = Quotation::all();
        return view('sales.quotation.index', compact('quotation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $produk = Produk::all();
        $customerCompany = CustomerCompany::all();
        $customerIndividual = CustomerIndividual::all();
        $customers = $customerCompany->merge($customerIndividual);

        return view('sales.quotation.create-quotation', compact('produk', 'customerCompany', 'customerIndividual', 'customers'));
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
            'customer' => 'required',
            'expiration' => 'required',
            'nama_produk' => 'required',
            'jumlah' => 'required',
            'satuan_biaya' => 'required',
        ]);

        // Hitung total biaya
        $totalBiaya = $request->input('jumlah') * $request->input('satuan_biaya');

        // Buat RFQ baru
        $quotation = new Quotation();
        $quotation->customer = $request->input('customer');
        $quotation->expiration = $request->input('expiration');
        $quotation->nama_produk = $request->input('nama_produk');
        $quotation->jumlah = $request->input('jumlah');
        $quotation->satuan_biaya = $request->input('satuan_biaya');
        $quotation->total_biaya = $totalBiaya;

        $quotation->save();

        return redirect()->route('sales.quotation')->with('success', 'Data Quotation berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quotation = Quotation::find($id);     
        $customerCompany = CustomerCompany::all();
        $customerIndividual = CustomerIndividual::all();
        $customers = $customerCompany->merge($customerIndividual);
        return view('sales.quotation.detail-quotation', compact('quotation', 'customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation, $id)
    {
        $quotation = Quotation::find($id);
        $produk = Produk::all();
        $customerCompany = CustomerCompany::all();
        $customerIndividual = CustomerIndividual::all();
        $customers = $customerCompany->merge($customerIndividual);
        return view('sales.quotation.edit-quotation', compact('quotation', 'produk', 'customerCompany', 'customerIndividual', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation  $quotation, $id)
    {
        $request->validate([
            'customer' => 'required',
            'expiration' => 'required',
            'nama_produk' => 'required',
            'jumlah' => 'required',
            'satuan_biaya' => 'required',
        ]);

        // Hitung total biaya
        $totalBiaya = $request->input('jumlah') * $request->input('satuan_biaya');

        $quotation = Quotation::find($id);
        $quotation->customer = $request->input('customer');
        $quotation->expiration = $request->input('expiration');
        $quotation->nama_produk = $request->input('nama_produk');
        $quotation->jumlah = $request->input('jumlah');
        $quotation->satuan_biaya = $request->input('satuan_biaya');
        $quotation->total_biaya = $totalBiaya;
        $quotation->status = 'Quotation';

        $rfq->save();

        return redirect()->route('sales.quotation')->with('success', 'Data Quotation berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation  $quotation, $id)
    {
        $quotation = Quotation::find($id);

        if (!$quotation) {
            return redirect()->route('sales.quotation')->with('error', 'Data tidak ditemukan.');
        }

        $quotation->delete();
        return redirect()->route('sales.quotation')->with('success', 'Data berhasil dihapus.');
    }

    public function konfirmasi($id)
    {
        $quotation = Quotation::find($id);
      
        $quotation->status = 'Pesanan Pembelian';
        $quotation->save();

        // Redirect back or to another page
        return redirect()->back()->with('success', 'Status Berhasil di Ubah !');
    }

    public function nothingToBills($id)
    {
        $quotation = Quotation::find($id);
      
        $quotation->status = 'Nothing To Bills';
        $quotation->save();

        // Redirect back or to another page
        return redirect()->back()->with('success', 'Status Berhasil di Ubah !');
    }

    // public function salesOrder($id)
    // {
    //     // Temukan RFQ berdasarkan ID
    //     $quotation = Quotation::find($id);

    //     // Jika RFQ tidak ditemukan
    //     if (!$quotation) {
    //         return redirect()->back()->with('error', 'Quotation tidak ditemukan.');
    //     }

    //     // Ambil semua order terkait dengan RFQ
    //     $orders = Order::all();

    //     // Jika ada order
    //     foreach ($orders as $order) {
    //         // Ambil bahan dan jumlah_bahan dari order
    //         $namaBahanOrder = $order->nama_produk;
    //         $jumlahBahanOrder = $order->jumlah_produk;

    //         // Ambil bahan dan jumlah_bahan dari rfq
    //         $bahanQuotation = $quotation->produk;
    //         $jumlahProdukQuotation = $rfq->jumlah_produk;

    //         // Periksa apakah bahan RFQ ada dalam array nama_bahan Order
    //         $indexOrder = array_search($bahanQuotation, $namaProdukQuotation);

    //         // Jika bahan RFQ ada dalam Order
    //         if ($indexOrder !== false) {
    //             // Tambahkan jumlah_bahan RFQ ke jumlah_bahan pada Order
    //             $jumlahProdukQuotation[$indexOrder] += $jumlahProdukQuotation;
    //         }

    //         // Simpan perubahan pada Order
    //         $order->jumlah_produk = $jumlahProdukQuotation;
    //         $order->save();
    //     }

    //     // Ubah status RFQ menjadi 'Waiting Bills'
    //     $quotation->status = 'sales order';
    //     $quotation->save();

    //     return redirect()->back()->with('success', 'Status Berhasil di Ubah!');
    // }
    public function salesOrder($id)
    {
        // Temukan RFQ berdasarkan ID
        $quotation = Quotation::find($id);
    
        // Jika RFQ tidak ditemukan
        if (!$quotation) {
            return redirect()->back()->with('error', 'Quotation tidak ditemukan.');
        }
    
        // Ambil semua order terkait dengan RFQ
        $orders = Order::all();
    
        // Jika ada order
        foreach ($orders as $order) {
            // Ambil bahan dan jumlah_bahan dari order
            $namaBahanOrder = $order->nama_produk;
            $jumlahBahanOrder = $order->jumlah_produk ?? 0; // Nilai default 0 jika null
    
            // Ambil bahan dan jumlah_bahan dari rfq
            $bahanQuotation = $quotation->produk;
            $jumlahProdukQuotation = $quotation->jumlah_produk ?? 0; // Nilai default 0 jika null
    
            // Periksa apakah bahan RFQ ada dalam nama_bahan Order
            if ($bahanQuotation == $namaBahanOrder) {
                // Tambahkan jumlah_bahan RFQ ke jumlah_bahan pada Order
                $jumlahProdukQuotation += $jumlahBahanOrder;
            }
    
            // Simpan perubahan pada Order
            if ($jumlahProdukQuotation !== null) {
                $order->jumlah_produk = $jumlahProdukQuotation;
                $order->save();
            } else {
                return redirect()->back()->with('error', 'Jumlah produk tidak boleh kosong.');
            }
        }
    
        // Ubah status RFQ menjadi 'sales order'
        $quotation->status = 'sales order';
        $quotation->save();
    
        return redirect()->back()->with('success', 'Status Berhasil di Ubah!');
    }
    
    

    public function cetak($id)
    {
        $quotation = Quotation::find($id_rfq);
        return view('sales.quotation.quotation-cetak', compact('quotation'));
    }

}
