<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <style>
        @page {
            size: A4 portrait;
        }

        @media print {
            body {
                background-color: #fff;
            }

            h3 {
                color: #000;
                background-color: transparent;
            }
        }
    </style>
</head>

<body>
    @php
        use Carbon\Carbon;
    @endphp
     <div class="mx-auto my-5" style="max-width: 70rem;">
        <div class="text-center fw-bold fs-2 text-black">Vendor Bill / BILL{{ $pembayaranBill->id_pembayaran_bill }}</div>
        <hr>
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Detail Pembayaran</p>
                    <p class="m-0">PO/{{ $pembayaranBill->id_pembayaran_bill }}</p>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Vendor</p>
                    <p class="m-0">{{ $pembayaranBill->nama_vendor }}</p>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Alamat Pengiriman</p>
                    <p class="m-0">PT Company</p>
                    <p class="m-0">JL. BUSAN</p>
                    <p class="m-0">MALANG</p>
                    <p class="m-0">INDONESIA</p>
                    <p class="m-0">09876834724</p>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Qyt</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $pembayaranBill->bahan }}</td>
                        <td>{{ $pembayaranBill->jumlah_bahan }}</td>
                        <td>{{ $pembayaranBill->satuan_biaya }}</td>
                        <td>{{ $pembayaranBill->jumlah_pembayaran }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="row p-2 justify-content-end">
                <div class="col-sm-6 col-md-8">
                    <p class="m-0">Sub Total    : {{ $pembayaranBill->jumlah_pembayaran }}</p>
                    <p class="m-0">Total        : {{ $pembayaranBill->jumlah_pembayaran }}</p>
                    <p class="m-0 justify-content-end">Paid On {{ $pembayaranBill->payment_date }}</p>
                </div>
            </div>
    </div> 
    <script>
        window.print();
    </script>
</body>

</html>
