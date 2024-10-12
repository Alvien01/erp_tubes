@extends('sidebar')

@section('title', 'Request for Quotation')
@section('pageTitle', 'Request for Quotation')
@section('pageSubTitle', 'Tambah RfQ')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Request for Quotation</h5>
            <div class="col-12 text-end mb-3">
                    <a href="{{route('purchase.rfq')}}" class="btn btn-warning btn-sm ml-auto">Back</a>
                </div>
            <form class="row g-3" method="POST" action="{{ route('rfq.store') }}" enctype="multipart/form-data">
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
                    <label for="nama" class="form-label">Vendor</label>
                    <select class="form-select form-control-sm" id="vendor" name="vendor" required>
                        <option value="">- Pilih Vendor -</option>

                        @foreach ($vendors as $item)
                            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="referensi_vendor" class="form-label">Vendor Reference</label>
                    <input type="text" class="form-control form-control-sm" name="referensi_vendor" value="{{ old('referensi_vendor') }}">
                </div>
                <div class="col-12">
                    <label for="deadline_order" class="form-label">Order Deadline</label>
                    <input type="date" class="form-control form-control-sm" name="deadline_order" required
                        value="{{ old('deadline_order') }}">
                </div>

                <div class="col-3">
                    <label for="produk" class="form-label">Produk</label>
                    <select class="form-select form-control-sm" id="produk" name="produk" required>
                        <option value="">- Pilih Produk -</option>

                        @foreach ($produk as $item)
                            <option value="{{ $item->nama_produk }}">{{ $item->nama_produk }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control form-control-sm" name="jumlah" value="{{ old('jumlah') }}">
                </div>
                <div class="col-3">
                    <label for="biaya" class="form-label">Biaya per Unit</label>
                    <input type="number" class="form-control form-control-sm" name="biaya" value="{{ old('biaya') }}">
                </div>
                {{-- <div class="col-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control form-control-sm" name="total" value="{{ old('total') }}">
                </div> --}}
                <div class="col-12 text-end">
                    <button class="btn btn-primary">Tambah Produk</button>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
