@extends('sidebar')

@section('title', 'Sales Order')
@section('pageTitle', 'Sales Order')
@section('pageSubTitle', 'Detail Sale Order')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card mx-auto my-5" style="max-width: 70rem;">
        <div class="card-header">
            <div class="text-center fw-bold fs-2 text-black">Sales Order</div>
        </div>

        <div class="card-body">
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Detail Order</p>
                    <p class="m-0">PO/{{ $order->id }}</p>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Customer</th>
                        <th scope="col">Expiration</th>
                        <th scope="col"></th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Jumlah Produk</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->customer }}</td>
                        <td>{{ $order->expiration }}</td>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>{{ $order->nama_produk}}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>{{ $order->total_biaya }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <div class="d-flex gap-2 justify-content-end">
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('SO.cetak', ['id' => $order->id]) }}" target="_blank"
                        class="btn btn-secondary btn-sm">To Invoice</a>
                        <a href="{{ route('SO.edit', ['id' => $order->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
