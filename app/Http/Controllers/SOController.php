<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Quotation;
use App\Models\CustomerCompany;
use App\Models\CustomerIndividual;
use App\Models\SO;
use Illuminate\Support\Facades\Log;

class SOController extends Controller
{
    // Menampilkan daftar SO
    public function index()
    {
        $order = SO::all();
        return view('sales.order.index', compact('order'));
    }

    // Form untuk membuat SO baru
    public function create()
    {
        $quotationList = Quotation::all();
        return view('sales.order.create-SO', compact('quotationList'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
                'id_quotation' => 'required|exists:quotations,id',
                'id_customer_individual' => 'required|exists:customer_individuals,id',
                'id_customer_company' => 'nullable|exists:customer_companies,id',
                'customer' => 'required|string|max:255',
                'expiration' => 'required|date',
                'nama_produk' => 'required|string|max:255',
                'jumlah' => 'required|integer|min:1',
                'satuan_biaya' => 'required|numeric',
                'total_biaya' => 'required|numeric',
            ]);
    
        // Simpan data ke dalam database
        $salesOrder = new SO();
        $salesOrder->id_quotation = $validatedData['id_quotation'];
        $salesOrder->id_customer_individual = $validatedData['id_customer_individual'];
        $salesOrder->id_customer_company = $validatedData['id_customer_company'];
        $salesOrder->customer = $validatedData['customer'];
        $salesOrder->expiration = $validatedData['expiration'];
        $salesOrder->nama_produk = $validatedData['nama_produk'];
        $salesOrder->jumlah = $validatedData['jumlah'];
        $salesOrder->satuan_biaya = $validatedData['satuan_biaya'];
        $salesOrder->total_biaya = $validatedData['total_biaya'];
        $salesOrder->save();
        return redirect()->route('sales.SO')->with('success', 'Sales Order berhasil disimpan.');
        // Redirect atau memberikan respons lainnya
        // return redirect()->route('SO.index')->with('success', 'Sales order berhasil disimpan!');
    }
    
    // Menyimpan data SO baru
    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     try {
    //         // Validasi input
            // $validatedData = $request->validate([
            //     'id_quotation' => 'required|exists:quotations,id',
            //     'id_customer_individual' => 'required|exists:customer_individuals,id',
            //     'id_customer_company' => 'nullable|exists:customer_companies,id',
            //     'customer' => 'required|string|max:255',
            //     'expiration' => 'required|date',
            //     'nama_produk' => 'required|string|max:255',
            //     'jumlah' => 'required|integer|min:1',
            //     'satuan_biaya' => 'required|numeric',
            //     'total_biaya' => 'required|numeric',
            // ]);

    //         // Simpan data ke tabel SO
    //         $salesOrder = new SO();
    //         $salesOrder->id_quotation = $validatedData['id_quotation'];
    //         $salesOrder->id_customer_individual = $validatedData['id_customer_individual'];
    //         $salesOrder->id_customer_company = $validatedData['id_customer_company'];
    //         $salesOrder->customer = $validatedData['customer'];
    //         $salesOrder->expiration = $validatedData['expiration'];
    //         $salesOrder->nama_produk = $validatedData['nama_produk'];
    //         $salesOrder->jumlah = $validatedData['jumlah'];
    //         $salesOrder->satuan_biaya = $validatedData['satuan_biaya'];
    //         $salesOrder->total_biaya = $validatedData['total_biaya'];
    //         $salesOrder->save();

    //         return redirect()->route('sales.SO')->with('success', 'Sales Order berhasil disimpan.');
    //     } catch (\Exception $e) {
    //         Log::error('Gagal menyimpan Sales Order: ' . $e->getMessage());
    //         return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
    //     }
    // }

    // Menampilkan detail SO
    public function show($id)
    {
        $order = SO::find($id);
        if (!$order) {
            abort(404);
        }
        return view('sales.order.detail-SO', compact('order'));
    }

    // Menampilkan form edit untuk SO
    public function edit($id)
    {
        $SO = SO::find($id);
        $quotationList = Quotation::all();
        if (!$SO) {
            return redirect()->route('sales.order')->with('error', 'Order tidak ditemukan.');
        }
        return view('sales.order.edit-SO', compact('SO', 'quotationList'));
    }

    // Memperbarui data SO
    public function update(Request $request, $id_order)
    {
        $validatedData = $request->validate([
            'id_bom' => 'required|exists:tb_bom,id_bom',
            'nama_produk' => 'required',
            'jumlah_produk' => 'required|integer',
            'nama_bahan.*' => 'required',
            'jumlah_bahan.*' => 'required|integer',
        ]);

        $tbOrder = SO::find($id_order);
        if (!$tbOrder) {
            return redirect()->route('manufaktur.order')->with('error', 'Order tidak ditemukan.');
        }

        $tbOrder->id_bom = $validatedData['id_bom'];
        $tbOrder->nama_produk = $validatedData['nama_produk'];
        $tbOrder->jumlah_produk = $validatedData['jumlah_produk'];
        $tbOrder->nama_bahan = $validatedData['nama_bahan'];
        $tbOrder->jumlah_bahan = $validatedData['jumlah_bahan'];
        $tbOrder->save();

        return redirect()->route('manufaktur.order')->with('success', 'Data berhasil diperbarui.');
    }

    // Menghapus SO
    public function destroy($id_order)
    {
        $order = SO::find($id_order);
        if ($order) {
            $order->delete();
        }
        return redirect()->route('manufaktur.order')->with('success', 'Data Order berhasil dihapus.');
    }
}
