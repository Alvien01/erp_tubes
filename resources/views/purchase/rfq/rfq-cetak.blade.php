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
        <div class="text-center fw-bold fs-2 text-black">Request For Quotation PO{{ $rfq->id_rfq }}</div>
        <hr>
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Detail RFQ</p>
                    <p class="m-0">PO/{{ $rfq->id_rfq }}</p>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Vendor</p>
                    <p class="m-0">{{ $rfq->nama_vendor }}</p>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Alamat Pengiriman</p>
                    <p class="m-0">Nama Company</p>
                    <p class="m-0">JL. SATU DUA</p>
                    <p class="m-0">MALANG</p>
                    <p class="m-0">INDONESIA</p>
                    <p class="m-0">09876834724</p>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Qyt</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $rfq->bahan }}</td>
                        <td>{{ $rfq->deadline_order }}</td>
                        <td>{{ $rfq->jumlah_bahan }}</td>
                    </tr>
                </tbody>
            </table>
    </div> 
    <script>
        window.print();
    </script>
</body>

</html>
