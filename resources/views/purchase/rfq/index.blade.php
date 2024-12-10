@extends('sidebar')

@section('title', 'Purchase')

@section('pageTitle', 'Purchase')
@section('pageSubTitle', 'Request for Quotation')

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
        <a href="{{ route('rfq.create') }}" class="btn btn-primary">Tambah Order</a>
    </div>

    <div class="card card-body pt-3" id="orderDataContainer">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Id</th>
                    <th scope="col" class="text-center">Order Deadline</th>
                    <th scope="col" class="text-center">Vendor</th>
                    <th scope="col" class="text-center">Total</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($rfq) && count($rfq) > 0)
                    @foreach ($rfq as $index => $rfqItem)
                        <tr>
                            <th scope="row" class="text-center">PO{{ $rfqItem->id_rfq }}</th>
                            <td class="text-center">{{ $rfqItem->deadline_order }}</td>
                            <td class="text-center">{{ $rfqItem->nama_vendor }}</td>
                            <td class="text-center"> {{ $rfqItem->total_biaya }}</td>
                            <td class="text-center"> {{ $rfqItem->status }}</td>
                            <td class="text-center">
                            <a href="{{ route('rfq.show', ['id_rfq' => $rfqItem->id_rfq]) }}" class="btn btn-success">Detail</a>
                                {{-- <a href="{{ route('manufaktur.edit', ['id_order' => $orderItem->id_order]) }}">Edit</a>  --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak Ada RfQ yang dibuat.</td>
                    </tr>
                @endif 
            </tbody>
        </table>
    </div>
@endsection
