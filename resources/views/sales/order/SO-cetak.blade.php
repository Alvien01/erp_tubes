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
            <div class="text-center fw-bold fs-2 text-black">Sales Order</div>
            <div class="text-end fw-medium fs-5 text-black">Status : {{ $order->status ?? 'To Invoice' }}</div>
        </div>
        <div class="card-body">
            <div class="row p-2 mt-2">
            <div class="col-7 pt-2">
                <h5>Cetak Label</h5>
                <h6>PT. Wikasa Muebel</h6>
                <h6>Kota Tulungagung</h6>
            </div>
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Detail Sales Order</p>
                    <p class="m-0">Order/{{ $order->id }}</p>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"></th>Customer
                        <th scope="col">Expariation</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->customer }}</td>
                        <td>{{ $order->expiration }}</td>
                        <td>{{ $order->nama_produk }}</td>
                        <td colspan="4"></td>
                    <tr>
                        <td colspan="4"></td>
                        <td>
                            {{ $order->bahan }}
                        </td>
                        <td>{{ $order->jumlah }}</td>
                        <td>{{ $order->total_biaya }}</td>
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
