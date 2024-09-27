@extends('sidebar')

@section('title', 'Bills')
@section('pageTitle', 'Bills')
@section('pageSubTitle', 'Tambah Bills')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Bills</h5>
            <form class="row g-3" method="POST" action="{{ route('bill.store') }}" enctype="multipart/form-data">
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
                    <label for="vendor" class="form-label">Vendor</label>
                    <input type="text" class="form-control form-control-sm" name="vendor"
                        value="{{ $rfq->nama_vendor }}" readonly>
                </div>
                <div class="col-12">
                    <label for="referensi_vendor" class="form-label">Vendor Reference</label>
                    <input type="text" class="form-control form-control-sm" name="referensi_vendor"
                        value="{{ $rfq->referensi_vendor }}" readonly>
                </div>

                <div class="col-12">
                    <label for="deadline_order" class="form-label">Order Deadline</label>
                    <input type="text" class="form-control form-control-sm" name="deadline_order" 
                        value="{{ $rfq->deadline_order }}" readonly>
                </div>
                <div class="col-12">
                    <label for="accounting_date" class="form-label">Tanggal Akuntansi</label>
                    <input type="date" class="form-control form-control-sm" name="accounting_date" required
                        value="{{ old('accounting_date') }}">
                </div>
                <div class="col-12">
                    <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                    <select class="form-select form-control-sm" id="jenis_pembayaran" name="jenis_pembayaran" required>
                        @foreach ($jenisPembayaranOptions as $option)
                            <option value="{{ $option['value'] }}" {{ old('jenis_pembayaran') == $option['value'] ? 'selected' : '' }}>
                                {{ $option['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-4">
                    <label for="produk" class="form-label">Produk</label>
                    <input type="text" class="form-control form-control-sm" name="produk" 
                        value="{{ $rfq->bahan }}" readonly>
                </div>

                <div class="col-2">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control form-control-sm" name="jumlah" value="{{ $rfq->jumlah_bahan }}" readonly>
                </div>
                <div class="col-2">
                    <label for="biaya" class="form-label">Biaya per Unit</label>
                    <input type="number" class="form-control form-control-sm" name="biaya" value="{{ $rfq->satuan_biaya }}" readonly>
                </div>
                <div class="col-2">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control form-control-sm" name="total" value="{{ $rfq->total_biaya }}" readonly>
                </div>
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
