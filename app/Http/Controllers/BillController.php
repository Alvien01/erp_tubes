<?php

namespace App\Http\Controllers;

use App\Models\RFQ;
use App\Models\Bill;
use App\Models\PembayaranBill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bill = Bill::all();
        return view('purchase.bills.index', compact('bill'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Ambil ID RFQ dari request
        $id_rfq = $request->input('id_rfq');

        // Lakukan operasi yang diperlukan untuk halaman pembuatan tagihan
        // ...

        // Tambahkan logika sesuai kebutuhan

        return view('purchase.bills.create-bills', compact('id_rfq'));
    }



    public function createWithRFQ($id_rfq)
    {
        // Ambil data RFQ dari database berdasarkan $id_rfq
        $rfq = RFQ::find($id_rfq);
        $jenisPembayaranOptions = Bill::enumOptions('jenis_pembayaran');


        // Tampilkan tampilan Blade 'create-bills' dengan menyertakan data RFQ
        return view('purchase.bills.create-bills', compact('rfq','jenisPembayaranOptions'));
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
            'accounting_date' => 'required',
            'jenis_pembayaran' => 'required',
        ]);

        $bill = new Bill();
        $bill->nama_vendor = $request->input('vendor');
        $bill->referensi_vendor = $request->input('referensi_vendor');
        $bill->deadline_order = $request->input('deadline_order');
        $bill->accounting_date = $request->input('accounting_date');
        $bill->jenis_pembayaran = $request->input('jenis_pembayaran');
        $bill->bahan = $request->input('produk');
        $bill->jumlah_bahan = $request->input('jumlah');
        $bill->satuan_biaya = $request->input('biaya');
        $bill->total_biaya = $request->input('total');

        $bill->save();

        return redirect()->route('purchase.bills')->with('success', 'Data Bill berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show($id_bills)
    {
        $bill = Bill::find($id_bills);     
        $journalOption = PembayaranBill::enumOptions('journal');
        return view('purchase.bills.detail-bills', compact('bill', 'journalOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill, $id_bills)
    {
        $bill = Bill::find($id_bills);
        $rfq = RFQ::all();
        $jenisPembayaranOptions = Bill::enumOptions('jenis_pembayaran');


        // Tampilkan tampilan Blade 'create-bills' dengan menyertakan data RFQ
        return view('purchase.bills.edit-bills', compact('bill', 'rfq','jenisPembayaranOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill, $id_bills)
    {
        $request->validate([
            'accounting_date' => 'required',
            'jenis_pembayaran' => 'required',
        ]);

        $bill = Bill::find($id_bills);
       
        $bill->accounting_date = $request->input('accounting_date');
        $bill->jenis_pembayaran = $request->input('jenis_pembayaran');
       

        $bill->save();

        return redirect()->route('purchase.bills')->with('success', 'Data Bill berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill, $id_bills)
    {
        $bill = Bill::find($id_bills);

        if (!$bill) {
            return redirect()->route('purchase.bills')->with('error', 'Data tidak ditemukan.');
        }

        $bill->delete();
        return redirect()->route('purchase.bills')->with('success', 'Data berhasil dihapus.');
    }

    public function createBill($id_bills)
    {
        $bill = Bill::find($id_bills);
      
        $bill->status = 'Bill';
        $bill->save();

        // Redirect back or to another page
        return redirect()->back()->with('success', 'Status Berhasil di Ubah !');
    }

    public function cetak($id_bills)
    {
        $bill = Bill::find($id_bills);
        return view('purchase.bills.bills-cetak', compact('bill'));
    }
}
