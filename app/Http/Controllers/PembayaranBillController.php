<?php

namespace App\Http\Controllers;

use App\Models\PembayaranBill;
use App\Models\Bill;
use Illuminate\Http\Request;

class PembayaranBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaranBill = PembayaranBill::all();
        return view('purchase.bill-bahan.index', compact('pembayaranBill'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'journal' => 'required',
            'jumlah_pembayaran' => 'required',
            'payment_date' => 'required',
        ]);

        $paymenyBill = new PembayaranBill();
        $paymenyBill->nama_vendor = $request->input('nama_vendor');
        $paymenyBill->referensi_vendor = $request->input('referensi_vendor');
        $paymenyBill->deadline_order = $request->input('deadline_order');
        $paymenyBill->accounting_date = $request->input('accounting_date');
        $paymenyBill->jenis_pembayaran = $request->input('jenis_pembayaran');
        $paymenyBill->bahan = $request->input('bahan');
        $paymenyBill->jumlah_bahan = $request->input('jumlah_bahan');
        $paymenyBill->satuan_biaya = $request->input('satuan_biaya');
        $paymenyBill->total_biaya = $request->input('total_biaya');
        $paymenyBill->journal = $request->input('journal');
        $paymenyBill->jumlah_pembayaran = $request->input('jumlah_pembayaran');
        $paymenyBill->payment_date = $request->input('payment_date');
        $paymenyBill->catatan = $request->input('catatan');

        $paymenyBill->save();

        return redirect()->route('purchase.bills')->with('success', 'Data Pembayaran berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_pembayaran_bill)
    {
        $pembayaranBill = PembayaranBill::find($id_pembayaran_bill);     
        return view('purchase.bill-bahan.detail-pembayaran-bill', compact('pembayaranBill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cetak($id_pembayaran_bill){
        $pembayaranBill = PembayaranBill::find($id_pembayaran_bill);

        return view('purchase.bill-bahan.pembayaran-cetak', compact('pembayaranBill'));
    }
}
