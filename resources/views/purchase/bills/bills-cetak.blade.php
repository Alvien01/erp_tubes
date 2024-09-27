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
     <div class="card mx-auto my-5" style="max-width: 70rem;">
        <div class="card-header">
            <div class="text-center fw-bold fs-2 text-black">Bill</div>
            <div class="text-end fw-medium fs-5 text-black">Status : {{ $bill->status ?? 'Status Not Available' }}</div>
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
    </div> 
    <script>
        window.print();
    </script>
</body>

</html>
