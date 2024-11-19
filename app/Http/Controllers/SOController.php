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

    // Menyimpan data SO baru
    public function store(Request $request)
{
    try {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'id_quotation' => 'required|exists:quotations,id', // Pastikan id_quotation ada di tabel quotations
            'id_customer_individual' => 'required|exists:customer_individuals,id', // Cek id_customer_individual di tabel customer_individuals
            'id_customer_company' => 'nullable|exists:customer_companies,id', // Cek id_customer_company di tabel customer_companies (opsional)
            'customer' => 'required|string|max:255',
            'expiration' => 'required|date',
            'nama_produk' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan_biaya' => 'required|numeric',
            'total_biaya' => 'required|numeric',
        ]);

        // Buat instance baru dari model SO dan simpan data
        $tbOrder = new SO();
        $tbOrder->id_quotation = $validatedData['id_quotation'];
        $tbOrder->id_customer_individual = $validatedData['id_customer_individual'];
        $tbOrder->id_customer_company = $validatedData['id_customer_company'] ?? null; // Pastikan kolom ini nullable
        $tbOrder->customer = $validatedData['customer'];
        $tbOrder->expiration = $validatedData['expiration'];
        $tbOrder->nama_produk = $validatedData['nama_produk'];
        $tbOrder->jumlah = $validatedData['jumlah'];
        $tbOrder->satuan_biaya = $validatedData['satuan_biaya'];
        $tbOrder->total_biaya = $validatedData['total_biaya'];

        // Simpan data ke database
        $tbOrder->save();

        // Redirect ke halaman sukses
        return redirect()->route('sales.SO')->with('success', 'Data berhasil disimpan.');

    } catch (\Exception $e) {
        // Log error untuk debugging
        \Log::error('Gagal menyimpan Sales Order: ' . $e->getMessage());

        // Redirect kembali dengan pesan error
        return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
    }
}

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
        return view('sales.SO-update', compact('SO', 'quotationList'));
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

        $tbOrder = Order::find($id_order);
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
        $order = Order::find($id_order);
        if ($order) {
            $order->delete();
        }
        return redirect()->route('manufaktur.order')->with('success', 'Data Order berhasil dihapus.');
    }

    // Metode pencarian
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

    // Mengambil data BOM
    public function getBomData()
    {
        $bomList = Bom::all();
        return response()->json($bomList);
    }

    // Mengambil data bahan berdasarkan ID BOM
    public function getBahanData($bomId)
    {
        $bom = Bom::find($bomId);
        if (!$bom) {
            return response()->json(['error' => 'BOM not found'], 404);
        }
        $namaBahanArray = json_decode($bom->nama_bahan, true);
        $jumlahBahanArray = json_decode($bom->jumlah_bahan, true);

        $bahanData = [];
        for ($i = 0; $i < count($namaBahanArray); $i++) {
            $bahanData[] = [
                'nama_bahan' => $namaBahanArray[$i],
                'jumlah_bahan' => $jumlahBahanArray[$i],
            ];
        }

        return response()->json($bahanData);
    }

    // Konfirmasi order
    public function konfirmasi($id_order)
    {
        $order = Order::find($id_order);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }
        $order->status = 'Konfirmasi';
        $order->save();
        return redirect()->back()->with('success', 'Status berubah Terkorfirmasi');
    }

    // Tandai order sebagai selesai
    public function selesai($id_order)
    {
        $order = Order::find($id_order);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }
        $order->status = 'Selesai';
        $order->save();
        return redirect()->back()->with('success', 'Status berubah Selesai');
    }

    // Cetak SO
    public function cetak($id)
    {
        $order = SO::find($id);
        return view('sales.order.SO-cetak', compact('order'));
    }
}
