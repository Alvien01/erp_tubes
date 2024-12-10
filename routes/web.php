<?php

use App\Models\VendorIndividual;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BomController;
use App\Http\Controllers\rfqController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembayaranBillController;
//use App\Models\Bom;
use App\Http\Controllers\VendorCompanyController;
use App\Http\Controllers\VendorIndividualController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\quotationController;
use App\Http\Controllers\SOController;
use App\Models\PembayaranBill;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now bom!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/sidebar', function () {
    return view('sidebar');
});

// Manufaktur Bahan
Route::get('/manufaktur/bahan', [BahanController::class, 'index'])->name('manufaktur.bahan');
// Route::get('/manufaktur/create-bahan', [BahanController::class, 'create'])->name('manufaktur.create');
Route::get('/manufaktur/create-bahan', [BahanController::class, 'create'])->name('manufaktur.create-bahan');
Route::get('/manufaktur/bahan-detail/{id}', [BahanController::class, 'show'])->name('manufaktur.bahan-detail');
Route::get('/manufaktur/bahan/update/{id}', [BahanController::class, 'edit'])->name('manufaktur.bahan-update');
Route::put('/manufaktur/bahan/update/{id}', [BahanController::class, 'update'])->name('manufaktur.bahan-update');
Route::delete('/manufaktur/bahan-detail/{id}', [BahanController::class, 'destroy'])->name('manufaktur.bahan-detail.destroy');
Route::get('/manufaktur/cetak-bahan/{id}', [BahanController::class, 'cetak'])->name('manufaktur.bahan-cetak');

Route::post('stores', [BahanController::class, 'store'])->name('stores');

// Manufaktur Produk
Route::get('/manufaktur/produk', [ProdukController::class, 'index'])->name('manufaktur.produk');
Route::get('/manufaktur/create-produk', [ProdukController::class, 'create'])->name('manufaktur.create-produk');
Route::get('/manufaktur/produk-detail/{id}', [ProdukController::class, 'show'])->name('manufaktur.produk-detail');
Route::get('/manufaktur/produk-update/{id}', [ProdukController::class, 'edit'])->name('manufaktur.produk-update');
Route::put('/manufaktur/produk-update/{id}', [ProdukController::class, 'update'])->name('manufaktur.produk-update');
Route::delete('/manufaktur/produk-detail/{id}', [ProdukController::class, 'destroy'])->name('manufaktur.produk-detail.destroy');
Route::post('/store', [ProdukController::class, 'store'])->name('store');
Route::get('/manufaktur/cetak-produk/{id}', [ProdukController::class, 'cetak'])->name('manufaktur.produk-cetak');
//KATEGORI OJOK DIUBAH COKKKK
Route::get('/get-kategori-suggestions', [KategoriController::class, 'getKategoriSuggestions']);
Route::post('/kstore', [KategoriController::class, 'kstore']);

// Struktur Biaya / Detail BOM
// Narik Produk,Bahan,Kategori NANDA
Route::get('/get-produk', [BomController::class, 'getProduk'])->name('get-produk');
Route::get('/get-kategori', [BomController::class, 'getKategori'])->name('get-kategori');
Route::get('/get-bahan-data', [BomController::class, 'getBahan'])->name('get-bahan');
Route::get('/get-bom', [BomController::class, 'getBom'])->name('get-bom');
Route::get('/manufaktur/bom-cetak/{id}', [BomController::class, 'cetak'])->name('manufaktur.bom-cetak');

Route::get('/manufaktur/bom', [BomController::class, 'index'])->name('manufaktur.bom');

// Menampilkan detail BoM
Route::get('/manufaktur/bom', [BomController::class, 'index'])->name('manufaktur.bom');

// Route untuk menampilkan detail BoM berdasarkan ID
Route::get('/manufaktur/detail-bom/{id_bom}', [BomController::class, 'detailbom'])->name('manufaktur.detail-bom');

// Route::post('/manufaktur/simpan-bom', [BomController::class, 'simpanBOM'])->name('manufaktur.simpan-bom');
Route::post('/manufaktur/simpan-bom', [BomController::class, 'simpanBom'])->name('simpan-bom');

// Route untuk menambahkan BoM
Route::get('/manufaktur/create-bom', [BomController::class, 'create'])->name('manufaktur.create-bom');

// Route untuk mengedit BoM
Route::get('/manufaktur/edit-bom/{id_bom}', [BomController::class, 'editBom'])->name('manufaktur.bom-update');

// Route untuk mengupdate BoM
Route::put('/manufaktur/bom-update/{id_bom}', [BomController::class, 'updateBom'])->name('manufaktur.bom-update');

// Route untuk menghapus BoM
Route::delete('/manufaktur/bom-detail/{id}', [BomController::class, 'destroy'])->name('manufaktur.bom-detail.destroy');

//Edit njopok data option value
Route::get('/get-bom/{id_bom}', [BomController::class, 'getBomById'])->name('get-bom');

Route::get('/manufaktur/edit-bom/{id_bom}', [BomController::class, 'editBom'])->name('manufaktur.edit-bom');

//Order
// Route::get('/manufaktur/order', [OrderController::class, 'index'])->name('manufaktur.order');

Route::get('/manufaktur/order', [OrderController::class, 'index'])->name('manufaktur.order');
Route::get('/manufaktur/order/index', [OrderController::class, 'index'])->name('manufaktur.order.index');
Route::get('/manufaktur/order/create', [OrderController::class, 'create'])->name('manufaktur.create');
Route::post('/manufaktur/order/store', [OrderController::class, 'store'])->name('manufaktur.store');

// Menampilkan detail order
Route::get('/manufaktur/order/{id_order}', [OrderController::class, 'show'])->name('manufaktur.show');
// Formulir untuk mengedit order
Route::get('/manufaktur/order/{id_order}/edit', [OrderController::class, 'edit'])->name('manufaktur.edit');
// Update order ke dalam database
Route::put('/manufaktur/order/{id_order}', [OrderController::class, 'update'])->name('manufaktur.order-update');
Route::delete('/manufaktur/order-detail/{id_order}', [OrderController::class, 'destroy'])->name('manufaktur.order-detail.destroy');
// Contoh rute di routes/web.php
Route::post('/save_total_produksi', [OrderController::class, 'saveTotalProduksi']);



Route::get('/manufaktur/order/search', [OrderController::class, 'search'])->name('order.search');
// Route::get('/get_bom_data', [OrderController::class, 'getBomData']);
Route::get('/get_bom_data/{id_produk}', [OrderController::class, 'getBOMData']);

Route::get('/get_bahan_data/{bomId}', [OrderController::class, 'getBahanData']);

Route::post('/order/{id_order}/konfirmasi', [OrderController::class, 'konfirmasi'])->name('konfirmasi.order');
Route::post('/order/{id_order}/selesai', [OrderController::class, 'selesai'])->name('selesai.order');




//Vendor
Route::resource('purchase/vendor', VendorIndividualController::class);
Route::resource('purchase/vendor/company', VendorCompanyController::class);

// RFQ
Route::get('/purchase/rfq', [rfqController::class, 'index'])->name('purchase.rfq');
Route::get('/purchase/create-rfq', [rfqController::class, 'create'])->name('rfq.create');
Route::post('/purchase/rfq/store', [rfqController::class, 'store'])->name('rfq.store');
Route::get('/purchase/detail-rfq/{id_rfq}', [rfqController::class, 'show'])->name('rfq.show');
Route::post('/purchase/{id_rfq}/konfirmasi', [rfqController::class, 'konfirmasi'])->name('rfq.konfirmasi');
Route::post('/purchase/{id_rfq}/nothingtobills', [rfqController::class, 'nothingToBills'])->name('rfq.nothingToBills');
Route::post('/purchase/{id_rfq}/waitingBills', [rfqController::class, 'waitingBills'])->name('rfq.waitingBills');
//Route::post('/order/{id_order}/selesai', [OrderController::class, 'selesai'])->name('selesai.order');
Route::get('/purchase/rfq/update/{id_rfq}', [rfqController::class, 'edit'])->name('rfq-update');
Route::put('/purchase/rfq/update/{id_rfq}', [rfqController::class, 'update'])->name('rfq-update');
Route::delete('/purchase/rfq/delete/{id_rfq}', [rfqController::class, 'destroy'])->name('rfq-delete');
Route::get('/purchase/rfq-cetak/{id_rfq}', [rfqController::class, 'cetak'])->name('rfq.cetak');


// Bills
Route::get('/purchase/bill', [BillController::class, 'index'])->name('purchase.bills');
Route::get('/purchase/create-bills', [BillController::class, 'create'])->name('bills.create');
Route::get('/purchase/create-bills/{id_rfq}', [BillController::class, 'createWithRFQ'])->name('bills.createWithRFQ');
Route::post('/purchase/create-bills/store', [BillController::class, 'store'])->name('bill.store');
Route::get('/purchase/detail-bills/{id_bills}', [BillController::class, 'show'])->name('bills.show');
Route::get('/purchase/bills/update/{id_bills}', [BillController::class, 'edit'])->name('bills-update');
Route::put('/purchase/bills/update/{id_bills}', [BillController::class, 'update'])->name('bills-update');
Route::delete('/purchase/bills/delete/{id_bills}', [BillController::class, 'destroy'])->name('bills-delete');
Route::post('/purchase/{id_bills}/createBill', [BillController::class, 'createBill'])->name('bills.createBill');
Route::get('/purchase/bills-cetak/{id_bills}', [BillController::class, 'cetak'])->name('bills.cetak');

// PembayaranBill
Route::get('/purchase/pembayaran-bill', [PembayaranBillController::class, 'index'])->name('purchase.bills');
Route::post('/purchase/create-payment/store', [PembayaranBillController::class, 'store'])->name('payment.store');
Route::get('/purchase/detail-payment/{id_pembayaran_bill}', [PembayaranBillController::class, 'show'])->name('payment.show');
Route::get('/purchase/pembayaran-cetak/{id_pembayaran_bill}', [PembayaranBillController::class, 'cetak'])->name('payment.cetak');

// customer individu
Route::get('sales/customer', [CustomerController::class, 'index'])->name('sales.customer');
Route::get('sales/customer/create-individual', [CustomerController::class, 'CreateIndividual'])->name('customer.create-individual');
Route::post('sales/customer/create-individual/store', [CustomerController::class, 'StoreIndividual'])->name('individual.store');
Route::get('sales/customer/edit-individual/{id}', [CustomerController::class, 'editIndividual'])->name('individual.edit');
Route::put('sales/customer/edit-individual/{id}', [CustomerController::class, 'updateIndividual'])->name('individual.update');
Route::delete('sales/customer/delete-individual/{id}', [CustomerController::class, 'destroyIndividual'])->name('individual.destroy');
// customer company
Route::get('sales/customer/create-company', [CustomerController::class, 'CreateCompany'])->name('customer.create-company');
Route::post('sales/customer/create-company/store', [CustomerController::class, 'StoreCompany'])->name('company.store');
Route::get('sales/customer/edit-company/{id}', [CustomerController::class, 'editCompany'])->name('company.edit');
Route::put('sales/customer/edit-company/{id}', [CustomerController::class, 'updateCompany'])->name('company.update');
Route::delete('sales/customer/delete-company/{id}', [CustomerController::class, 'destroycompany'])->name('company.destroy');

// // Quotation
Route::get('sales/quotation', [quotationController::class, 'index'])->name('sales.quotation');
Route::get('sales/quotation/create-quotation', [quotationController::class, 'create'])->name('quotation.create');
Route::post('sales/quotation/store', [quotationController::class, 'store'])->name('quotation.store');
Route::get('sales/quotation/detail-quotation/{id}', [quotationController::class, 'show'])->name('quotation.show');
Route::post('sales/quotation/{id}/konfirmasi', [quotationController::class, 'konfirmasi'])->name('quotation.konfirmasi');
Route::post('sales/quotation/{id}/nothingtobills', [quotationController::class, 'nothingToBills'])->name('quotation.nothingToBills');
Route::post('sales/quotation/{id}/salesOrder', [quotationController::class, 'salesOrder'])->name('quotation.salesOrder');
//Route::post('/order/{id_order}/selesai', [quotationController::class, 'selesai'])->name('selesai.order');
Route::get('sales/quotation/quotation/update/{id}', [quotationController::class, 'edit'])->name('quotation-update');
Route::put('sales/quotation/quotation/update/{id}', [quotationController::class, 'update'])->name('quotation-update');
Route::delete('sales/quotation/quotation/delete/{id}', [quotationController::class, 'destroy'])->name('quotation-delete');
Route::get('sales/quotation/quotation-cetak/{id}', [quotationController::class, 'cetak'])->name('quotation.cetak');

// // SalesOrder
// Route::get('sales/order', [SOController::class, 'index'])->name('sales.SO');
// Route::get('sales/order/create-SO', [SOController::class, 'create'])->name('SO.create');
// Route::get('sales/order/create-SO/{id}', [SOController::class, 'createWithQuotation'])->name('SO.createWithQuotation');
// // Route::post('sales/order/create-SO/store', [SOController::class, 'store'])->name('SO.store');
// Route::post('/create-SO/store', [SOController::class, 'store'])->name('SO.store'); // Proses penyimpanan Sales Order
// Route::get('sales/order/detail-SO/{id}', [SOController::class, 'show'])->name('SO.show');
// Route::post('sales/order/{id}/konfirmasi', [quotationController::class, 'konfirmasi'])->name('SO.konfirmasi');
// Route::post('sales/order/{id}/nothingtobills', [quotationController::class, 'nothingToBills'])->name('SO.nothingToBills');
// Route::post('sales/order/{id}/salesOrder', [quotationController::class, 'salesOrder'])->name('SO.salesOrder');
// Route::post('/order/{id_order}/selesai', [quotationController::class, 'selesai'])->name('selesai.SO');
// Route::get('sales/order/SO/update/{id}', [SOController::class, 'edit'])->name('SO-update');
// Route::put('sales/order/SO/update/{id}', [SOController::class, 'update'])->name('SO-update');
// Route::delete('sales/order/SO/delete/{id}', [SOController::class, 'destroy'])->name('SO-delete');
// Route::post('sales/order/{id}/createSO', [SOController::class, 'createSO'])->name('SO.createSO');
// Route::get('sales/order/SO-cetak/{id}', [SOController::class, 'cetak'])->name('SO.cetak');
// Route::get('sales/order/search', [OrderController::class, 'search'])->name('SO.search');
// Route::get('get_quotation_data/{id}', [OrderController::class, 'getQuotationData']);
// Sales Order Routes
Route::get('sales/order', [SOController::class, 'index'])->name('sales.SO');
Route::get('sales/order/create', [SOController::class, 'create'])->name('SO.create');
Route::get('sales/order/create/{id}', [SOController::class, 'createWithQuotation'])->name('SO.createWithQuotation');

// Proses penyimpanan Sales Order
Route::post('sales/order/store', [SOController::class, 'store'])->name('SO.store');

// Menampilkan detail Sales Order
Route::get('sales/order/{id}', [SOController::class, 'show'])->name('SO.show');

// Konfirmasi Sales Order
Route::post('sales/order/{id}/konfirmasi', [QuotationController::class, 'konfirmasi'])->name('SO.konfirmasi');

// Proses untuk tidak ada tagihan (nothing to bill)
Route::post('sales/order/{id}/nothing-to-bills', [QuotationController::class, 'nothingToBills'])->name('SO.nothingToBills');

// Menyimpan Sales Order
Route::post('sales/order/{id}/sales-order', [QuotationController::class, 'salesOrder'])->name('SO.salesOrder');

// Proses selesai pada Sales Order
Route::post('sales/order/{id}/selesai', [QuotationController::class, 'selesai'])->name('SO.selesai');

// Menampilkan form update Sales Order
Route::get('sales/order/update/{id}', [SOController::class, 'edit'])->name('SO.edit');

// Update Sales Order
Route::put('sales/order/update/{id}', [SOController::class, 'update'])->name('SO.update');

// Menghapus Sales Order
Route::delete('sales/order/delete/{id}', [SOController::class, 'destroy'])->name('SO.delete');

// Proses untuk membuat Sales Order baru
Route::post('sales/order/{id}/create-SO', [SOController::class, 'createSO'])->name('SO.createSO');

// Menampilkan dan mencetak Sales Order
Route::get('sales/order/cetak/{id}', [SOController::class, 'cetak'])->name('SO.cetak');

// Pencarian Sales Order
Route::get('sales/order/search', [OrderController::class, 'search'])->name('SO.search');

// Mengambil data Quotation berdasarkan ID
Route::get('sales/order/quotation/{id}', [OrderController::class, 'getQuotationData'])->name('SO.getQuotationData');
