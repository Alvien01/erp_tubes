@extends('sidebar')

@section('title', 'Purchase')
@section('pageTitle', 'Purchase')
@section('pageSubTitle', 'Edit Vendor || Company')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Vendor</h5>
            <div class="col-12 text-end mb-3">
                    <a href="{{route('vendor.index')}}" class="btn btn-warning btn-sm ml-auto">Back</a>
                </div>
            <form class="row g-3" method="POST" action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data">
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
                        value="{{ $company->nama }}">
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control form-control-sm" name="alamat"
                        value="{{ $company->alamat }}">
                </div>
                <div class="col-12">
                    <label for="telp" class="form-label">No Telp</label>
                    <input type="number" class="form-control form-control-sm" name="telp" required
                        value="{{ $company->telp }}">
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control form-control-sm" name="email" value="{{ $company->email }}">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <div class="col-12 text-end">
                <form action="{{ route('company.destroy', $company->id) }}" method="POST" class="pt-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
