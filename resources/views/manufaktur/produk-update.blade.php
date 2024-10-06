@extends('sidebar')

@section('title', 'Manufaktur')
@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Update Produk')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-1"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Produk</h5>
    <a href="{{route('manufaktur.produk')}}" class="btn btn-warning btn-sm ml-auto">Back</a>
            <form action="{{ route('manufaktur.produk-update', ['id' => $produk->id_produk]) }}" method="POST"
                enctype="multipart/form-data" class="row g-3">
                @csrf
                @method('PUT')
                <div class="">
                    <label for="nama_bahan" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control form-control-sm" id="nama_produk" name="nama_produk"
                        value="{{ $produk->nama_produk }}" autofocus>
                </div>
                <div class="">
                    <label for="harga_produksi" class="form-label">Harga Produksi</label>
                    <input type="number" class="form-control form-control-sm" id="harga_produksi" name="harga_produksi"
                        value="{{ $produk->harga_produksi }}">
                </div>
                <div class="">
                    <label for="biaya_produksi" class="form-label">Biaya Produksi</label>
                    <input type="number" class="form-control form-control-sm" id="biaya_produksi" name="biaya_produksi"
                        value="{{ $produk->biaya_produksi }}">
                </div>
                <div class="">
                    <label for="internal_referensi" class="form-label">Internal Referensi</label>
                    <input type="text" class="form-control form-control-sm" id="internal_referensi"
                        name="internal_referensi" value="{{ $produk->internal_referensi }}">
                </div>
                <div class="">
                    <label for="nama_kategori" class="form-label">Kategori Produk</label>
                    <input type="text" class="form-control form-control-sm" id="nama_kategori" name="nama_kategori"
                        value="{{ $produk->nama_kategori }}">
                </div>
                <div class="">
                    <label for="barcode" class="form-label">Barcode</label>
                    <input type="text" class="form-control form-control-sm" id="barcode" name="barcode"
                        value="{{ $produk->barcode }}">
                </div>
                <div class="">
                    <label for="gambar_produk" class="form-label">Gambar Produk (JPG/PNG)</label>
                    <input class="form-control form-control-sm" type="file" id="gambar_produk" name="gambar_produk"
                        value="{{ $produk->gambar_produk }}">
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
