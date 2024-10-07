@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Data BoM')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card card-body pt-3" id="bomDataContainer">
        <div class="row">
            <div class="col-12 d-flex justify-content-end mb-3">
                <a href="{{ route('manufaktur.create-bom') }}" class="btn btn-primary btn-sm">Tambah BoM</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Internal Referensi</th>
                        <th scope="col" class="text-center">Produk</th>
                        <th scope="col" class="text-center">Kategori</th>
                        <th scope="col" class="text-center">Jumlah</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($bom) && count($bom) > 0)
                        @foreach ($bom as $index => $bomItem)
                            <tr>
                                <th scope="row" class="text-center">{{ $index + 1 }}</th>
                                <td class="text-center">{{ $bomItem->internal_referensi }}</td>
                                <td class="text-center">{{ $bomItem->produk->nama_produk }}</td>
                                <td class="text-center">{{ $bomItem->nama_kategori }}</td>
                                <td class="text-center">{{ $bomItem->jumlah_produk }}</td>
                                <td class="text-center">
                                    <a href="{{ route('manufaktur.detail-bom', ['id_bom' => $bomItem->id_bom]) }}">Detail</a>
                                    <a href="{{ route('manufaktur.bom-update', ['id_bom' => $bomItem->id_bom]) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">Data BoM tidak tersedia.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
