@extends('sidebar')

@section('title', 'Quotation')
@section('pageTitle', 'Quotation')
@section('pageSubTitle', 'Tambah Quotation')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Quotation</h5>
            <form class="row g-3" method="POST" action="{{ route('quotation.store') }}" enctype="multipart/form-data">
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
                    <label for="customer" class="form-label">Customer</label>
                    <select class="form-select form-control-sm" id="customer" name="customer" required>
                        <option value="">- Pilih customer -</option>

                        @foreach ($customers as $item)
                            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- <div class="col-12">
                    <label for="referensi_vendor" class="form-label">Vendor Reference</label>
                    <input type="text" class="form-control form-control-sm" name="referensi_vendor" value="{{ old('referensi_vendor') }}">
                </div> -->
                <div class="col-12">
                    <label for="dexpiration" class="form-label">Expiration</label>
                    <input type="date" class="form-control form-control-sm" name="expiration" required
                        value="{{ old('expiration') }}">
                </div>

                <div class="col-12">
                <label for="payment_terms" class="form-label">Payment Terms</label>
                    <select class="form-select form-control-sm" id="payment_terms" name="payment_terms" required>
                        @foreach ($quotation as $item)
                            <option value="{{ $item['value'] }}" {{ old('payment_terms') == $item['value'] ? 'selected' : '' }}>
                                {{ $item['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3">
                    <label for="nama_produk" class="form-label">Produk</label>
                    <select class="form-select form-control-sm" id="nama_produk" name="nama_produk" required>
                        <option value="">- Pilih Produk -</option>

                        @foreach ($produkList as $item)
                                <option value="{{ $item->id_produk }}">{{ $item->nama_produk }}</option>
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