@extends('sidebar')

@section('title', 'Quotation')
@section('pageTitle', 'Quotation')
@section('pageSubTitle', 'Detail Quotation')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card mx-auto my-5" style="max-width: 70rem;">
        <div class="card-header">
            <div class="text-center fw-bold fs-2 text-black">Quotation</div>
            <div class="text-end fw-medium fs-5 text-black">Status : {{ $quotation->status ?? 'Status Not Available' }}</div>

            <div class="text-end mt-2">
                <form action="{{ route('quotation.konfirmasi', ['id' => $quotation->id]) }}" method="post"
                    style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary" {{ $quotation->status == 'Quotation' ? 'Pesanan Pembelian' : '' }}
                        {{ in_array($quotation->status, ['Pesanan Pembelian', 'Nothing To Bills', 'Waiting Bills']) ? 'style=display:none;' : '' }}>
                        Konfirmasi
                    </button>

                </form>

                <form action="{{ route('quotation.nothingToBills', ['id' => $quotation->id]) }}" method="post"
                    style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success"
                        {{ $quotation->status == 'Pesanan Pembelian' ? 'Nothing To Bills' : '' }}
                        {{ in_array($quotation->status, ['Quotation', 'Nothing To Bills', 'Waiting Bills']) ? 'style=display:none;' : '' }}>Konfirmasi
                        Order</button>
                </form>
                <form action="{{ route('quotation.salesOrder', ['id' => $quotation->id]) }}" method="post"
                    style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success"
                        {{ $quotation->status == 'Nothing To Bills' ? 'Waiting Bills' : '' }}
                        {{ in_array($quotation->status, ['Quotation', 'Pesanan Pembelian', 'Waiting Bills']) ? 'style=display:none;' : '' }}>Validate</button>
                </form>
                <form action="{{ route('bills.createWithRFQ', $quotation->id) }}" style="display:inline;">
                    <button type="submit" class="btn btn-success"
                        {{ $quotation->status == 'Nothing To Bills' ? 'Waiting Bills' : '' }}
                        {{ in_array($quotation->status, ['Quotation', 'Pesanan Pembelian', 'Nothing To Bills']) ? 'style=display:none;' : '' }}>Buat
                        Tagihan</button>
                </form>

            </div>
        </div>

        <div class="card-body">
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Detail Order</p>
                    <p class="m-0">PO/{{ $quotation->id }}</p>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Customer</th>
                        <th scope="col">Expiration</th>
                        <th scope="col"></th>
                        <th scope="col">Produk</th>
                        <th scope="col">Jumlah Produk</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $quotation->nama_produk }}</td>
                        <td>{{ $quotation->expiration }}</td>
                        <td colspan="4"></td>
                    <tr>
                        <td colspan="3"></td>
                        <td>
                            {{ $quotation->produk }}
                        </td>
                        <td>{{ $quotation->jumlah_produk }}</td>
                        <td>{{ $quotation->total_biaya }}</td>                 
                    </tr>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex gap-2 justify-content-end">
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('quotation.cetak', ['id' => $quotation->id]) }}" target="_blank"
                        class="btn btn-secondary btn-sm">Print</a>
                    <a href="{{ route('quotation-update', ['id' => $quotation->id]) }}"
                        class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('quotation-delete', ['id' => $quotation->id]) }}" method="post">
    
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
