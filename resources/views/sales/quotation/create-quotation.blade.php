@extends('sidebar')

@section('title', 'Quotation')
@section('pageTitle', 'Quotation')
@section('pageSubTitle', 'Tambah Quotation')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Quotation</h5>
            <form class="row g-3" method="POST" action="{{ route('quotation.store') }}" enctype="multipart/form-data">
                {{-- Token CSRF --}}
                @csrf

                {{-- Tampilkan Error Jika Ada --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Input Customer --}}
                <div class="col-12">
                    <label for="customer" class="form-label">Customer</label>
                    <select class="form-select form-control-sm" id="customer" name="customer" required>
                        <option value="">- Pilih Customer -</option>
                        @foreach ($customers as $item)
                            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Input Expiration --}}
                <div class="col-12">
                    <label for="expiration" class="form-label">Expiration</label>
                    <input type="date" class="form-control form-control-sm" name="expiration" required
                        value="{{ old('expiration') }}">
                </div>

                {{-- Input Produk --}}
                <div class="col-3">
                    <label for="nama_produk" class="form-label">Produk</label>
                    <select class="form-select form-control-sm" id="produk" name="nama_produk" required>
                        <option value="">- Pilih Produk -</option>
                        @foreach ($produk as $item)
                            <option value="{{ $item->nama_produk }}">{{ $item->nama_produk }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Input Jumlah --}}
                <div class="col-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control form-control-sm" name="jumlah" value="{{ old('jumlah') }}">
                </div>

                {{-- Input Satuan Biaya --}}
                <div class="col-3">
                    <label for="satuan_biaya" class="form-label">Satuan Biaya</label>
                    <input type="number" class="form-control form-control-sm" name="satuan_biaya" value="{{ old('satuan_biaya') }}">
                </div>

                {{-- Tombol Tambah Produk --}}
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-primary">Tambah Produk</button>
                </div>

                {{-- Tombol Submit --}}
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
