@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Data Bahan')

@section('content')
    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Button to Add New Product --}}
    <div class="mb-4">
        <a href="{{ route('manufaktur.create-produk') }}" class="btn btn-primary">
            <strong>Tambah Produk</strong>
        </a>
    </div>

    {{-- Product Grid Layout --}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($produk as $index => $product)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="{{ route('manufaktur.produk-detail', ['id' => $product->id_produk]) }}" 
                   class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm">
                        {{-- Product Image --}}
                        @if ($product->gambar_produk)
                            <img src="{{ asset('images/produk/' . $product->gambar_produk) }}" class="card-img-top img-fluid"  style="height: 150px; object-fit: cover;" alt="Gambar Produk">
                        @else
                            <div class="text-center py-5 bg-light">
                                <i class="bi bi-image" style="font-size: 50px;"></i>
                            </div>
                        @endif

                        {{-- Product Details --}}
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $product->nama_produk }}</h5>
                            <p class="card-text">[{{ $product->internal_referensi }}]</p>
                            <p class="card-text text-muted mb-1">
                                Harga: Rp {{ number_format($product->harga_produksi, 0, ',', '.') }}
                            </p>

                            {{-- Product Status and Quantity --}}
                            @php
                                $status = $orderStatuses[$index];
                            @endphp
                            <p class="card-text text-muted">
                                @if ($status == 'Selesai')
                                    On Hand: {{ $orderQuantities[$index] }}
                                @else
                                    On Hand: 0
                                @endif
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $produk->links('pagination::bootstrap-4') }}
    </div>
@endsection
