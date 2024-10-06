@extends('sidebar')

@section('title', 'Manufaktur')
@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Detail Bahan')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mx-auto my-5" style="max-width: 50rem;">
        <div class="card-header text-center fw-bold fs-2 text-black">Detail Bahan</div>
        <br>
            <div class="col-12 text-end mb-3">
                <a href="{{ route('manufaktur.bahan') }}" class="btn btn-warning btn-sm me-2">Back</a>
            </div>


        <div class="card-body">
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Nama Bahan</p>
                    <p class="m-0">{{ $bahan->nama_bahan }}</p>
                </div>
                <div class="col-sm-6 col-md-4 text-end">
                    @if ($bahan->gambar_bahan)
                        <img src="{{ asset('images/bahan/' . $bahan->gambar_bahan) }}" class="img-fluid" alt="..."
                            style="max-width: 6rem;">
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ol class="list-group">
                        <li class="d-flex justify-content-between align-items-start py-1">
                            <div class="ms-2 me-auto">
                                <div class="fw-normal text-black">Harga</div>
                                <div class="fw-light">Rp. {{ $bahan->harga_bahan }}</div>
                            </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-start py-1">
                            <div class="ms-2 me-auto">
                                <div class="fw-normal text-black">Biaya</div>
                                <div class="fw-light">Rp. {{ $bahan->biaya_bahan }}</div>
                            </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-start py-1">
                            <div class="ms-2 me-auto">
                                <div class="fw-normal text-black">Internal Referensi</div>
                                <div class="fw-light">{{ $bahan->internal_referensi }}</div>
                            </div>
                        </li>
                    </ol>
                </div>
                {{-- <div class="col-md-6">
                    <ol class="list-group">
                        <li class="d-flex justify-content-between align-items-start py-1">
                            <div class="ms-2 me-auto">
                                <div class="fw-normal text-black">Referensi Internal</div>
                                <div class="fw-light">Rp. 1000</div>
                            </div>
                        </li>
                        <li class="d-flex justify-content-between align-items-start py-1">
                            <div class="ms-2 me-auto">
                                <div class="fw-normal text-black">Barcode</div>
                                <div class="fw-light">Rp. 1000</div>
                            </div>
                        </li>
                    </ol>
                </div> --}}
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('manufaktur.bahan-cetak', ['id' => $bahan->id_bahan]) }}" target="_blank"
                    class="btn btn-secondary btn-sm">Print</a>
                <a href="{{ route('manufaktur.bahan-update', ['id' => $bahan->id_bahan]) }}"
                    class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('manufaktur.bahan-detail.destroy', ['id' => $bahan->id_bahan]) }}" method="post">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
