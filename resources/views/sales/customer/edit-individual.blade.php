@extends('sidebar')

@section('title', 'Sales')
@section('pageTitle', 'Sales')
@section('pageSubTitle', 'Edit Customer || Individual')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Customer</h5>
            <form class="row g-3" method="POST" action="{{ route('individual.update', $individual->id) }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @method('PUT')
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-12">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control form-control-sm" name="nama" autofocus required
                        value="{{ $individual->nama }}">
                </div>
                <div class="col-12">
                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control form-control-sm" name="nama_perusahaan" required
                        value="{{ $individual->nama_perusahaan }}">
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control form-control-sm" name="alamat"
                        value="{{ $individual->alamat }}">
                </div>
                <div class="col-12">
                    <label for="telp" class="form-label">No Telp</label>
                    <input type="number" class="form-control form-control-sm" name="telp" required
                        value="{{ $individual->telp }}">
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control form-control-sm" name="email" value="{{ $individual->email }}">
                </div>
                <div class="col-12">
                    <label for="posisi_pekerjaan" class="form-label">Posisi Pekerjaan</label>
                    <input type="text" class="form-control form-control-sm" name="posisi_pekerjaan" value="{{ $individual->posisi_pekerjaan }}">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <div class="col-12 text-end">
                <form action="{{ route('individual.destroy', $individual->id) }}" method="POST" class="pt-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
