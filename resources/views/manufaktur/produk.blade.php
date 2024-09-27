@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Data Produk')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        @foreach ($produk as $index => $product)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="{{ route('manufaktur.produk-detail', ['id' => $product->id_produk]) }}">
                    <div class="card mb-3" style="max-width:540px;">
                        <div class="row g-0">
                            <div class="m-auto col-md-4 col-sm-6 sm-m-auto text-center">
                                @if ($product->gambar_produk)
                                    <img src="{{ asset('images/produk/' . $product->gambar_produk) }}" alt="Gambar Produk" style="max-width: 5.5rem;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title m-0">{{ $product->nama_produk }}</h5>
                                    <p class="card-text m-0">[{{ $product->internal_referensi }}]</p>
                                    <p class="card-text m-0"><small class="text-muted">Harga : Rp {{ $product->harga_produksi }}</small></p>
                            
                                    {{-- Tampilkan jumlah_produk berdasarkan status --}}
                                    @php
                                        $status = $orderStatuses[$index];
                                    @endphp
                                    <p class="card-text m-0">
                                        <small class="text-muted"> On Hand : 
                                            @if ($status == 'Selesai')
                                                On Hand : {{ $orderQuantities[$index] }}
                                            @else
                                                {{ $status == 'Draft' ? '0' : '0' }}
                                            @endif
                                        </small>
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    
@endsection
