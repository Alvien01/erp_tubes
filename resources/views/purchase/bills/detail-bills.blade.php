@extends('sidebar')

@section('title', 'Bill')
@section('pageTitle', 'Bill')
@section('pageSubTitle', 'Detail Bill')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card mx-auto my-5" style="max-width: 70rem;">
        <div class="card-header">
            <div class="text-center fw-bold fs-2 text-black">Bill</div>
            <div class="col-12 text-end mb-3">
                    <a href="{{route('purchase.rfq')}}" class="btn btn-warning btn-sm ml-auto">Back</a>
                </div>
            <div class="text-end fw-medium fs-5 text-black">Status : {{ $bill->status ?? 'Status Not Available' }}</div>

            <div class="text-end mt-2">
                <form action="{{ route('bills.createBill', ['id_bills' => $bill->id_bills]) }}" method="post"
                    style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success" {{ $bill->status == 'Draft Bill' ? 'Bill' : '' }}
                        {{ in_array($bill->status, ['Bill']) ? 'style=display:none;' : '' }}>Post</button>
                </form>
            </div>

            <div class="text-end mt-2">
                <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModal"
                    {{ $bill->status == 'Bill' ? '' : '' }}
                    {{ in_array($bill->status, ['Draft Bill']) ? 'style=display:none;' : '' }}>Daftar Pembayaran</button>
            </div>

        </div>

        <div class="card-body">
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Detail Bills</p>
                    <p class="m-0">BILL/{{ $bill->id_bills }}</p>
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
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $bill->nama_vendor }}</td>
                        <td>{{ $bill->deadline_order }}</td>
                        <td>{{ $bill->accounting_date }}</td>
                        <td>{{ $bill->jenis_pembayaran }}</td>
                        <td colspan="4"></td>
                    <tr>
                        <td colspan="4"></td>
                        <td>
                            {{ $bill->bahan }}
                        </td>
                        <td>{{ $bill->jumlah_bahan }}</td>
                        <td>{{ $bill->total_biaya }}</td>
                    </tr>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex gap-2 justify-content-end">
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('bills.cetak', ['id_bills' => $bill->id_bills]) }}" target="_blank"
                        class="btn btn-secondary btn-sm">Print</a>
                    <a href="{{ route('bills-update', ['id_bills' => $bill->id_bills]) }}"
                        class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('bills-delete', ['id_bills' => $bill->id_bills]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Large Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat
                    autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet
                    incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div><!-- End Large Modal--> --}}

    <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('payment.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Daftar Pembayaran</h5>
                    </div>
                    <div class="modal-body">
                        <!-- Formulir Vendor -->
                        <div class="mb-3" >
                            <label for="nama_vendor" class="form-label">Nama Vendor</label>
                            <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" required
                                value="{{ $bill->nama_vendor }}">
                        </div>

                        <div class="mb-3" hidden>
                            <label for="referensi_vendor" class="form-label">Referensi Vendor</label>
                            <input type="text" class="form-control" id="referensi_vendor" name="referensi_vendor"
                                required value="{{ $bill->referensi_vendor }}">
                        </div>

                        <div class="mb-3" hidden>
                            <label for="deadline_order" class="form-label">Deadline Order</label>
                            <input type="date" class="form-control" id="deadline_order" name="deadline_order" required
                                value="{{ $bill->deadline_order }}">
                        </div>

                        <div class="mb-3" hidden>
                            <label for="accounting_date" class="form-label">Accounting Date</label>
                            <input type="date" class="form-control" id="accounting_date" name="accounting_date" required
                                value="{{ $bill->accounting_date }}">
                        </div>

                        <div class="mb-3" hidden>
                            <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                            <select class="form-select" id="jenis_pembayaran" name="jenis_pembayaran" required
                                value="{{ $bill->jenis_pembayaran }}">
                                <option value="Pembayaran Langsung">Pembayaran Langsung</option>
                            </select>
                        </div>

                        <div class="mb-3" hidden>
                            <label for="bahan" class="form-label">Bahan</label>
                            <input type="text" class="form-control" id="bahan" name="bahan" required
                                value="{{ $bill->bahan }}">
                        </div>

                        <div class="mb-3" hidden>
                            <label for="jumlah_bahan" class="form-label">Jumlah Bahan</label>
                            <input type="number" class="form-control" id="jumlah_bahan" name="jumlah_bahan" required
                                value="{{ $bill->jumlah_bahan }}">
                        </div>

                        <div class="mb-3" hidden>
                            <label for="satuan_biaya" class="form-label">Satuan Biaya</label>
                            <input type="number" class="form-control" id="satuan_biaya" name="satuan_biaya" required
                                value="{{ $bill->satuan_biaya }}">
                        </div>

                        <div class="mb-3" hidden>
                            <label for="total_biaya" class="form-label">Total Biaya</label>
                            <input type="number" class="form-control" id="total_biaya" name="total_biaya"
                                value="{{ $bill->total_biaya }}">
                        </div>

                        <div class="mb-3">
                            <label for="journal" class="form-label">Journal</label>
                            <select class="form-select form-control-sm" id="journal" name="journal" required>
                                @foreach ($journalOption as $option)
                                    <option value="{{ $option['value'] }}"
                                        {{ old('journal') == $option['value'] ? 'selected' : '' }}>
                                        {{ $option['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                            <input type="number" class="form-control" id="jumlah_pembayaran" name="jumlah_pembayaran"
                                value="{{ $bill->total_biaya }}">
                        </div>
                        <div class="mb-3">
                            <label for="payment_date" class="form-label">Payment Date</label>
                            <input type="date" class="form-control" id="payment_date" name="payment_date"
                                value="{{ $bill->payment_date }}">
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <input type="text" class="form-control" id="catatan" name="catatan"
                                value="{{ $bill->catatan }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Validate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
