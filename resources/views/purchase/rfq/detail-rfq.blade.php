@extends('sidebar')

@section('title', 'RFQ')
@section('pageTitle', 'RFQ')
@section('pageSubTitle', 'Detail RFQ')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card mx-auto my-5" style="max-width: 70rem;">
        <div class="card-header">
            <div class="text-center fw-bold fs-2 text-black">RFQ</div>
            <div class="text-end fw-medium fs-5 text-black">Status : {{ $rfq->status ?? 'Status Not Available' }}</div>

            <div class="text-end mt-2">
                <form action="{{ route('rfq.konfirmasi', ['id_rfq' => $rfq->id_rfq]) }}" method="post"
                    style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary" {{ $rfq->status == 'RFQ' ? 'Pesanan Pembelian' : '' }}
                        {{ in_array($rfq->status, ['Pesanan Pembelian', 'Nothing To Bills', 'Waiting Bills']) ? 'style=display:none;' : '' }}>
                        Konfirmasi
                    </button>

                </form>

                <form action="{{ route('rfq.nothingToBills', ['id_rfq' => $rfq->id_rfq]) }}" method="post"
                    style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success"
                        {{ $rfq->status == 'Pesanan Pembelian' ? 'Nothing To Bills' : '' }}
                        {{ in_array($rfq->status, ['RFQ', 'Nothing To Bills', 'Waiting Bills']) ? 'style=display:none;' : '' }}>Konfirmasi
                        Order</button>
                </form>
                <form action="{{ route('rfq.waitingBills', ['id_rfq' => $rfq->id_rfq]) }}" method="post"
                    style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success"
                        {{ $rfq->status == 'Nothing To Bills' ? 'Waiting Bills' : '' }}
                        {{ in_array($rfq->status, ['RFQ', 'Pesanan Pembelian', 'Waiting Bills']) ? 'style=display:none;' : '' }}>Validate</button>
                </form>
                <form action="{{ route('bills.createWithRFQ', $rfq->id_rfq) }}" style="display:inline;">
                    <button type="submit" class="btn btn-success"
                        {{ $rfq->status == 'Nothing To Bills' ? 'Waiting Bills' : '' }}
                        {{ in_array($rfq->status, ['RFQ', 'Pesanan Pembelian', 'Nothing To Bills']) ? 'style=display:none;' : '' }}>Buat
                        Tagihan</button>
                </form>

            </div>
        </div>

        <div class="card-body">
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Detail Order</p>
                    <p class="m-0">PO/{{ $rfq->id_rfq }}</p>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Vendor</th>
                        <th scope="col">Deadline Order</th>
                        <th scope="col"></th>
                        <th scope="col">Bahan</th>
                        <th scope="col">Jumlah Bahan</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $rfq->nama_vendor }}</td>
                        <td>{{ $rfq->deadline_order }}</td>
                        <td colspan="4"></td>
                    <tr>
                        <td colspan="3"></td>
                        <td>
                            {{ $rfq->bahan }}
                        </td>
                        <td>{{ $rfq->jumlah_bahan }}</td>
                        <td>{{ $rfq->total_biaya }}</td>
                    </tr>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex gap-2 justify-content-end">
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('rfq.cetak', ['id_rfq' => $rfq->id_rfq]) }}" target="_blank"
                        class="btn btn-secondary btn-sm">Print</a>
                    <a href="{{ route('rfq-update', ['id_rfq' => $rfq->id_rfq]) }}"
                        class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('rfq-delete', ['id_rfq' => $rfq->id_rfq]) }}" method="post">
    
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
