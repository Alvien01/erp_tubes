<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Bahan;
use App\Models\Bom;
use App\Models\Order;
use App\Models\VendorCompany;
use App\Models\CustomerIndividual;
use App\Models\CustomerCompany;
class DashboardController extends Controller
{
    public function index()
{
    $produk = Produk::count(); // Atau metode lain untuk mendapatkan jumlah produk
    $order = Order::count();
    $bahan = Bahan::count();
    $bom = Bom::count();

    return view('dashboard', compact('produk', 'order', 'bahan', 'bom'));
}

    
}
