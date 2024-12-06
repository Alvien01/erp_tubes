@extends('sidebar')

@section('title', 'Sales')

@section('pageTitle', 'Sales')
@section('pageSubTitle', 'Quotation')

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
        <a href="{{ route('quotation.create') }}" class="btn btn-primary">Tambah Order</a>
    </div>

    <div class="card card-body pt-3" id="orderDataContainer">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Id</th>
                    <th scope="col" class="text-center">Expiration</th>
                    <th scope="col" class="text-center">Customer</th>
                    <th scope="col" class="text-center">Total</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($quotation) && count($quotation) > 0)
                    @foreach ($quotation as $index => $quotationItem)
                        <tr>
                            <th scope="row" class="text-center">PO{{ $quotationItem->id_ }}</th>
                            <td class="text-center">{{ $quotationItem->expiration }}</td>
                            <td class="text-center">{{ $quotationItem->customer }}</td>
                            <td class="text-center"> {{ $quotationItem->total_biaya }}</td>
                            <td class="text-center"> {{ $quotationItem->status }}</td>
                            <td class="text-center">
                                <a href="{{ route('quotation.show', ['id' => $quotationItem->id]) }}" class="btn btn-info text-white"><strong>Detail</strong></a> 
                                {{-- <a href="{{ route('quotation.edit', ['id_order' => $orderItem->id_order]) }}">Edit</a>  --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak Ada Quotation yang dibuat.</td>
                    </tr>
                @endif 
            </tbody>
        </table>
    </div>
@endsection
