@extends('sidebar')

@section('title', 'Pembayaran')
@section('pageTitle', 'Pembayaran')
@section('pageSubTitle', 'Detail Pembayaran')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card mx-auto my-5" style="max-width: 70rem;">
        <div class="card-header">
            <div class="text-center fw-bold fs-2 text-black">Pembayaran</div>
        </div>

        <div class="card-body">
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Detail Pembayaran</p>
                    <p class="m-0">BILL/{{ $pembayaranBill->id_pembayaran_bill }}</p>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Vendor</th>
                        <th scope="col">Deadline Order</th>
                        <th scope="col">Tanggal Akuntansi</th>
                        <th scope="col">Jenis Pembayaran</th>
                        <th scope="col">Bahan</th>
                        <th scope="col">Jumlah Bahan</th>
                        <th scope="col">Biaya Satuan</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $pembayaranBill->nama_vendor }}</td>
                        <td>{{ $pembayaranBill->deadline_order }}</td>
                        <td>{{ $pembayaranBill->accounting_date }}</td>
                        <td>{{ $pembayaranBill->jenis_pembayaran }}</td>
                        <td colspan="4"></td>
                    <tr>
                        <td colspan="4"></td>
                        <td>
                            {{ $pembayaranBill->bahan }}
                        </td>
                        <td>{{ $pembayaranBill->jumlah_bahan }}</td>
                        <td>{{ $pembayaranBill->satuan_biaya }}</td>
                        <td>{{ $pembayaranBill->jumlah_pembayaran }}</td>
                    </tr>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex gap-2 justify-content-end">
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('payment.cetak', ['id_pembayaran_bill' => $pembayaranBill->id_pembayaran_bill]) }}" target="_blank"
                        class="btn btn-secondary btn-sm">Print</a>
                    
                    <form action="#" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    

@endsection
