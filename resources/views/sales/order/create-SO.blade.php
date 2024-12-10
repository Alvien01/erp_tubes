@extends('sidebar')

@section('title', 'Order')

@section('pageTitle', 'Sales Order')
@section('pageSubTitle', 'Tambah Order')

@section('content')
<div class="card card-body pt-3" id="orderFormContainer">
    <form action="{{ route('SO.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="quotation" class="form-label">Pilih Quotation</label>
            <select class="form-select" id="quotation" name="quotation">
                <option value=""><strong>- Pilih Quotation -</strong></option>
                @foreach ($quotationList as $quotation)
                    <option value="{{ $quotation->id }}"
                        data-customer="{{ $quotation->customer }}"
                        data-nama_produk="{{ $quotation->nama_produk }}"
                        data-total_biaya="{{ $quotation->total_biaya }}">
                        {{ $quotation->customer }} - {{ $quotation->nama_produk }} ({{ $quotation->total_biaya }})
                    </option>
                @endforeach
            </select>
        </div>
        <table class="table table-bordered" id="bahanTable">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Nama Produk</th>
                    <th scope="col" class="text-center">Total Biaya</th>
                </tr>
            </thead>
            <tbody id="bahanTableBody">
                <!-- Data akan diisi dengan JavaScript -->
            </tbody>
        </table>
        <!-- Hidden input untuk menyimpan data tambahan -->
        <input type="hidden" name="customer" id="customer" value="">
        <input type="hidden" name="nama_produk" id="nama_produk" value="">
        <input type="hidden" name="total_biaya" id="total_biaya" value="">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Saat Quotation berubah
        $('#quotation').change(function () {
            // Ambil data dari option yang dipilih
            var selectedOption = $(this).find(':selected');
            var customer = selectedOption.data('customer');
            var nama_produk = selectedOption.data('nama_produk');
            var total_biaya = selectedOption.data('total_biaya');

            // Perbarui tabel dan input hidden
            $('#bahanTableBody').html(
                `<tr>
                    <td class="text-center">${nama_produk}</td>
                    <td class="text-center">${total_biaya}</td>
                </tr>`
            );
            $('#customer').val(customer);
            $('#nama_produk').val(nama_produk);
            $('#total_biaya').val(total_biaya);
        });
    });
</script>
@endsection
