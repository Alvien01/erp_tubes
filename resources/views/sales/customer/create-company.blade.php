@extends('sidebar')

@section('title', 'Customer')
@section('pageTitle', 'Customer')
@section('pageSubTitle', 'Tambah Customer || Company')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Vendor</h5>
            <form class="row g-3" method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                        value="{{ old('nama') }}">
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control form-control-sm" name="alamat"
                        value="{{ old('alamat') }}">
                </div>
                <div class="col-12">
                    <label for="telp" class="form-label">No Telp</label>
                    <input type="number" class="form-control form-control-sm" name="telp" required
                        value="{{ old('telp') }}">
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control form-control-sm" name="email" value="{{ old('email') }}">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
