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
                    <th scope="col" class="text-center">Vendor</th>
                    <th scope="col" class="text-center">Total</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($bill) && count($bill) > 0)
                    @foreach ($bill as $index => $billItem)
                        <tr>
                            <th scope="row" class="text-center">BILL/{{ $billItem->id_bills }}</th>
                            <td class="text-center">{{ $billItem->deadline_order }}</td>
                            <td class="text-center">{{ $billItem->accounting_date }}</td>
                            <td class="text-center">{{ $billItem->nama_vendor }}</td>
                            <td class="text-center"> {{ $billItem->total_biaya }}</td>
                            <td class="text-center"> {{ $billItem->status }}</td>
                            <td class="text-center">
                                <a href="{{ route('bills.show', ['id_bills' => $billItem->id_bills]) }}"class="btn btn-success">Detail</a> 
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
