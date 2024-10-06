@extends('sidebar')

@section('title', 'Manufaktur')
@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Tambah Bahan Baku')

@section('content')
    <div class="card">
        <div class="card-body pt-4">
            <h5 class="card-title">Bahan Baku</h5>
            <div class="col-12 text-end mb-3">
                    <a href="{{route('manufaktur.bahan')}}" class="btn btn-warning btn-sm ml-auto">Back</a>
                </div>
            <form class="row g-3" action="{{ route('stores') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="">
                    <label for="nama_bahan" class="form-label">Nama Bahan</label>
                    <input type="text" class="form-control form-control-sm" id="nama_bahan" name="nama_bahan" required>
                </div>
                <div class="">
                    <label for="biaya_bahan" class="form-label">Biaya Bahan</label>
                    <input type="number" class="form-control form-control-sm" id="biaya_bahan" name="biaya_bahan">
                </div>
                <div class="">
                    <label for="harga_bahan" class="form-label">Harga Bahan</label>
                    <input type="number" class="form-control form-control-sm" id="harga_bahan" name="harga_bahan" required>
                </div>
                <div class="">
                    <label for="internal_referensi" class="form-label">Internal Referensi</label>
                    <input type="text" class="form-control form-control-sm" id="internal_referensi"
                        name="internal_referensi" required>
                </div>
                <div class="">
                    <label for="gambar_bahan" class="form-label">Gambar Bahan</label>
                    <input class="form-control form-control-sm" id="gambar_bahan" type="file" name="gambar_bahan">
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
