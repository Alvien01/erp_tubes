@extends('sidebar')

@section('title', 'Order')

@section('pageTitle', 'Sales Order')
@section('pageSubTitle', 'Sales Order')

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

    <div class="mb-3 d-flex justify-content-end">
        <a href="{{ route('SO.create') }}" class="btn btn-primary">Tambah Order</a>
    </div>

    <div class="card card-body pt-3" id="orderDataContainer">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Id</th>
                    <th scope="col" class="text-center">Customer</th>
                    <th scope="col" class="text-center">Expiration</th>
                    <th scope="col" class="text-center">Nama Produk</th>
                    <th scope="col" class="text-center">Total</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($order) && count($order) > 0)
                    @foreach ($order as $index => $orderItem)
                        <tr>
                            <th scope="row" class="text-center">Order/{{ $orderItem->id }}</th>
                            <td class="text-center">{{ $orderItem->customer }}</td>
                            <td class="text-center">{{ $orderItem->expiration }}</td>
                            <td class="text-center">{{ $orderItem->nama_produk }}</td>
                            <td class="text-center"> {{ $orderItem->total_biaya }}</td>
                            <td class="text-center"> {{ $orderItem->status }}</td>
                            <td class="text-center">
                                <a href="{{ route('SO.show', ['id' => $orderItem->id]) }} " class="btn btn-secondary">Detail</a> 
                                {{-- <a href="{{ route('manufaktur.edit', ['id' => $orderItem->id]) }}">Edit</a>  --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak Ada order yang dibuat.</td>
                    </tr>
                @endif 
            </tbody>
        </table>
    </div>
@endsection
