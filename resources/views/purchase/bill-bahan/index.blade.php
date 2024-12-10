@extends('sidebar')

@section('title', 'Bill')

@section('pageTitle', 'Bill')
@section('pageSubTitle', 'Bills')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- <div class="mb-3 d-flex justify-content-end">
        <a href="{{ route('bills.create') }}" class="btn btn-primary">Tambah Order</a>
    </div> --}}

    <div class="card card-body pt-3" id="orderDataContainer">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Id</th>
                    <th scope="col" class="text-center">Order Deadline</th>
                    <th scope="col" class="text-center">Tanggal Akuntansi</th>
                    <th scope="col" class="text-center">Jumlah Pembayaran</th>
                    <th scope="col" class="text-center">Tanggal Pembayaran</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($pembayaranBill) && count($pembayaranBill) > 0)
                    @foreach ($pembayaranBill as $index => $billItem)
                        <tr>
                            <th scope="row" class="text-center">BILL/{{ $billItem->id_pembayaran_bill }}</th>
                            <td class="text-center">{{ $billItem->deadline_order }}</td>
                            <td class="text-center">{{ $billItem->accounting_date }}</td>
                            <td class="text-center">{{ $billItem->jumlah_pembayaran }}</td>
                            <td class="text-center"> {{ $billItem->payment_date }}</td>
                            <td class="text-center">
                                <a href="{{ route('payment.show', ['id_pembayaran_bill' => $billItem->id_pembayaran_bill]) }}" class="btn btn-success">Detail</a> 
                                {{-- <a href="{{ route('manufaktur.edit', ['id_order' => $orderItem->id_order]) }}">Edit</a>  --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak Ada bill yang dibuat.</td>
                    </tr>
                @endif 
            </tbody>
        </table>
    </div>
@endsection
