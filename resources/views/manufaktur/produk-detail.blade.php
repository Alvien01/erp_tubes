@extends('sidebar')

@section('title', 'Manufaktur')
@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Detail Produk')

@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card mx-auto my-5" style="max-width: 50rem;">
    <div class="card-header text-center fw-bold fs-2 text-black mb-3">Detail Produk</div>
    <div class="mb-3 d-flex justify-content-end pe-3">
    <a href="{{route('manufaktur.produk')}}" class="btn btn-warning btn-sm ml-auto"><strong>Back</strong></a>
</div>
    <div class="card-body">
        <div class="row p-2 mt-2">
            <div class="col-sm-6 col-md-8">
                <p class="fw-bold m-0"><strong>Nama produk</strong></p>
                <p class="m-0" style="border: 1px solid #ddd; padding: 5px;">{{ $produk->nama_produk }}</p>
            </div>
            <div class="col-sm-12 col-md-2 text-end">
                @if ($produk->gambar_produk)
                    <img src="{{ asset('images/produk/' . $produk->gambar_produk) }}" alt="Gambar Produk" 
                         style="max-width: 13rem; border: 2px solid #ddd; border-radius: 10px; padding: 4px;">
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <ol class="list-group">
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-normal text-black"><strong>Harga</strong></div>
                <p class="m-0" style="border: 1px solid #ddd; padding: 5px;">{{ $produk->harga_produksi }}</p>

                                <!-- <div class="fw-light" style="border-bottom: 1px solid #ddd; padding-bottom: 5px;">Rp. {{ $produk->harga_produksi }}</div> -->
                                 
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-normal text-black"><strong>Biaya</strong></div>
                            <!-- <div class="fw-light">Rp. {{ $produk->biaya_produksi }}</div> -->
                            <p class="m-0" style="border: 1px solid #ddd; padding: 5px;">Rp. {{ $produk->biaya_produksi }}</p>

                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-normal text-black"><strong>Kategori Produk</strong></div>
                                <p class="m-0" style="border: 1px solid #ddd; padding: 5px;">{{ $produk->nama_kategori }}</p>

                        <!-- <div class="fw-light"> {{ $produk->nama_kategori }}</div> -->
                        </div>
                    </li>
                </ol>
            </div>
            <div class="col-md-6">
                <ol class="list-group">
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-normal text-black"><strong>Referensi Internal</strong></div>
                            <!-- <div class="fw-light"> {{ $produk->internal_referensi }}</div> -->
                                <p class="m-0" style="border: 1px solid #ddd; padding: 5px;"> {{ $produk->internal_referensi }}</p>
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-normal text-black"><strong>Barcode</strong></div>
                            <div class="fw-light">{{ $produk->barcode }}{!! DNS1D::getBarcodeHTML("$produk->barcode", 'C39', 1, 30) !!}</div>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
        
    </div>
    <div class="card-footer">
        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('manufaktur.produk-cetak', ['id' => $produk->id_produk]) }}" target="_blank"
                class="btn btn-secondary btn-sm">Print</a>
            <a href="{{ route('manufaktur.produk-update', ['id' => $produk->id_produk]) }}"
                class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('manufaktur.produk-detail', ['id' => $produk->id_produk]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
