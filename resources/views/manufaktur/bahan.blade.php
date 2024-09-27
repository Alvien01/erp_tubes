@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Data Bahan')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        @foreach ($bahan as $bahanItem)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="{{ route('manufaktur.bahan-detail', ['id' => $bahanItem->id_bahan]) }}">
                    <div class="card mb-3" style="max-width:540px;">
                        <div class="row g-0">
                            <div class="m-auto col-md-4 col-sm-6 sm-m-auto text-center">
                                @if ($bahanItem->gambar_bahan)
                                    <img src="{{ asset('/images/bahan/' . $bahanItem->gambar_bahan) }}" class="img-fluid"
                                        alt="..." style="max-height: 6rem">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title m-0">{{ $bahanItem->nama_bahan }}</h5>
                                    <p class="card-text m-0">[{{ $bahanItem->internal_referensi }}]</p>
                                    <p class="card-text m-0"><small class="text-muted">Harga: Rp
                                            {{ $bahanItem->harga_bahan }}</small></p>
                                    @php
                                        $totalOnHand = 0;
                                    @endphp

                                    @foreach ($order as $item)
                                        @if (in_array($bahanItem->nama_bahan, $item->nama_bahan))
                                            @php
                                                $index = array_search($bahanItem->nama_bahan, $item->nama_bahan);
                                                $totalOnHand += $item->jumlah_bahan[$index] ?? 0;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <p class="card-text m-0"><small class="text-muted">On Hand:
                                            {{ $totalOnHand ?? '0' }}
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
