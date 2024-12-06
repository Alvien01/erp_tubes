@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Data Order')

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
        <a href="{{ route('manufaktur.create') }}" class="btn btn-primary">Tambah Order</a>
    </div>

    <div class="card card-body pt-3" id="orderDataContainer">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Tanggal Order</th>
                    <th scope="col" class="text-center">Nama Produk</th>
                    <th scope="col" class="text-center">Jumlah Produk</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($order) && count($order) > 0)
                    @foreach ($order as $index => $orderItem)
                        <tr>
                            <th scope="row" class="text-center">{{ $index + 1 }}</th>
                            <td class="text-center">{{ $orderItem->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="text-center">{{ $orderItem->nama_produk }}</td>
                            <td class="text-center">{{ $orderItem->jumlah_produk }}</td>
                            <td class="text-center"> {{ $orderItem->status }}</td>
                            <td class="text-center">
                                <a href="{{ route('manufaktur.show', ['id_order' => $orderItem->id_order]) }}" class="btn btn-primary">Detail</a>
                                {{-- <a href="{{ route('manufaktur.edit', ['id_order' => $orderItem->id_order]) }}">Edit</a> --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Belum ada order yang dibuat.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
