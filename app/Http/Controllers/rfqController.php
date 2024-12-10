<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Produk;
use App\Models\RFQ;
use App\Models\Order;
use App\Models\VendorCompany;
use App\Models\VendorIndividual;
use Illuminate\Http\Request;

class rfqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rfq = RFQ::all();
        return view('purchase.rfq.index', compact('rfq'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bahan = Bahan::all();
        $produk = Produk::all();
        $vendorCompany = VendorCompany::all();
        $vendorIndividual = VendorIndividual::all();
        $vendors = $vendorCompany->merge($vendorIndividual);

        return view('purchase.rfq.create-rfq', compact('bahan', 'vendorCompany', 'vendorIndividual', 'vendors', 'produk'));
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
            'vendor' => 'required',
            'referensi_vendor' => 'nullable',
            'deadline_order' => 'required',
            'produk' => 'required',
            'jumlah' => 'required',
            'biaya' => 'required',
        ]);

        // Hitung total biaya
        $totalBiaya = $request->input('jumlah') * $request->input('biaya');

        // Buat RFQ baru
        $rfq = new RFQ();
        $rfq->nama_vendor = $request->input('vendor');
        $rfq->referensi_vendor = $request->input('referensi_vendor');
        $rfq->deadline_order = $request->input('deadline_order');
        $rfq->produk = $request->input('produk');
        $rfq->jumlah_bahan = $request->input('jumlah');
        $rfq->satuan_biaya = $request->input('biaya');
        $rfq->total_biaya = $totalBiaya;

        $rfq->save();

        return redirect()->route('purchase.rfq')->with('success', 'Data RFQ berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RFQ  $rFQ
     * @return \Illuminate\Http\Response
     */
    public function show($id_rfq)
    {
        $rfq = RFQ::find($id_rfq);
        $vendorCompany = VendorCompany::all();
        $vendorIndividual = VendorIndividual::all();
        $vendors = $vendorCompany->merge($vendorIndividual);
        
        if (!$rfq) {
            return redirect()->route('purchase.rfq')->with('error', 'RFQ tidak ditemukan.');
        }

        return view('purchase.rfq.detail-rfq', compact('rfq', 'vendors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RFQ  $rFQ
     * @return \Illuminate\Http\Response
     */
    public function edit(RFQ $rFQ, $id_rfq)
    {
        $rfq = RFQ::find($id_rfq);
        $bahan = Bahan::all();
        $vendorCompany = VendorCompany::all();
        $vendorIndividual = VendorIndividual::all();
        $vendors = $vendorCompany->merge($vendorIndividual);
        
        if (!$rfq) {
            return redirect()->route('purchase.rfq')->with('error', 'RFQ tidak ditemukan.');
        }

        return view('purchase.rfq.edit-rfq', compact('rfq', 'bahan', 'vendorCompany', 'vendorIndividual', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RFQ  $rFQ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RFQ $rFQ, $id_rfq)
    {
        $request->validate([
            'vendor' => 'required',
            'referensi_vendor' => 'nullable',
            'deadline_order' => 'required',
            'produk' => 'required',
            'jumlah' => 'required',
            'biaya' => 'required',
        ]);

        // Hitung total biaya
        $totalBiaya = $request->input('jumlah') * $request->input('biaya');

        $rfq = RFQ::find($id_rfq);
        
        if (!$rfq) {
            return redirect()->route('purchase.rfq')->with('error', 'RFQ tidak ditemukan.');
        }

        $rfq->nama_vendor = $request->input('vendor');
        $rfq->referensi_vendor = $request->input('referensi_vendor');
        $rfq->deadline_order = $request->input('deadline_order');
        $rfq->bahan = $request->input('produk');
        $rfq->jumlah_bahan = $request->input('jumlah');
        $rfq->satuan_biaya = $request->input('biaya');
        $rfq->total_biaya = $totalBiaya;
        $rfq->status = 'RFQ';

        $rfq->save();

        return redirect()->route('purchase.rfq')->with('success', 'Data RFQ berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RFQ  $rFQ
     * @return \Illuminate\Http\Response
     */
    public function destroy(RFQ $rFQ, $id_rfq)
    {
        $rfq = RFQ::find($id_rfq);

        if (!$rfq) {
            return redirect()->route('purchase.rfq')->with('error', 'Data tidak ditemukan.');
        }

        $rfq->delete();
        return redirect()->route('purchase.rfq')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Konfirmasi status RFQ.
     *
     * @param  int  $id_rfq
     * @return \Illuminate\Http\Response
     */
    public function konfirmasi($id_rfq)
    {
        $rfq = RFQ::find($id_rfq);
        
        if (!$rfq) {
            return redirect()->route('purchase.rfq')->with('error', 'RFQ tidak ditemukan.');
        }

        $rfq->status = 'Pesanan Pembelian';
        $rfq->save();

        return redirect()->back()->with('success', 'Status Berhasil diubah!');
    }

    /**
     * Mengubah status RFQ menjadi "Nothing To Bills".
     *
     * @param  int  $id_rfq
     * @return \Illuminate\Http\Response
     */
    public function nothingToBills($id_rfq)
    {
        $rfq = RFQ::find($id_rfq);
        
        if (!$rfq) {
            return redirect()->route('purchase.rfq')->with('error', 'RFQ tidak ditemukan.');
        }

        $rfq->status = 'Nothing To Bills';
        $rfq->save();

        return redirect()->back()->with('success', 'Status Berhasil diubah!');
    }

    /**
     * Mengubah status RFQ menjadi "Waiting Bills".
     *
     * @param  int  $id_rfq
     * @return \Illuminate\Http\Response
     */
    public function waitingBills($id_rfq)
    {
        $rfq = RFQ::find($id_rfq);
        
        if (!$rfq) {
            return redirect()->route('purchase.rfq')->with('error', 'RFQ tidak ditemukan.');
        }

        // Ambil semua order terkait dengan RFQ
        $orders = Order::all();

        // Jika ada order, periksa dan update jumlah bahan
        foreach ($orders as $order) {
            $namaBahanOrder = $order->nama_bahan;
            $jumlahBahanOrder = $order->jumlah_bahan;
            $bahanRFQ = $rfq->bahan;
            $jumlahBahanRFQ = $rfq->jumlah_bahan;

            // Cek apakah bahan RFQ ada dalam order
            $indexOrder = array_search($bahanRFQ, $namaBahanOrder);

            // Jika ditemukan, tambahkan jumlah bahan RFQ ke order
            if ($indexOrder !== false) {
                $jumlahBahanOrder[$indexOrder] += $jumlahBahanRFQ;
            }

            $order->jumlah_bahan = $jumlahBahanOrder;
            $order->save();
        }

        $rfq->status = 'Waiting Bills';
        $rfq->save();

        return redirect()->back()->with('success', 'Status Berhasil diubah!');
    }

    /**
     * Cetak RFQ.
     *
     * @param  int  $id_rfq
     * @return \Illuminate\Http\Response
     */
    public function cetak($id_rfq)
    {
        $rfq = RFQ::find($id_rfq);
        
        if (!$rfq) {
            return redirect()->route('purchase.rfq')->with('error', 'RFQ tidak ditemukan.');
        }

        return view('purchase.rfq.cetak-rfq', compact('rfq'));
    }
}