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
    <div class="container my-5" style="max-width: 21cm;">
        <div class="text-center">
            <h3 class="fw-bold">Cetak Bahan</h3>
        </div>
        <div class="row pt-2">
            <div class="col-7 pt-2">
                <h5>Cetak Bahan</h5>
                <h6>PT. Kayuku</h6>
                <h6>Kota Malang</h6>
            </div>
            <div class="col-3">
                <img src="{{ asset('images/ERP_Logo.png') }}" alt="" style="max-width: 16rem">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-5">
                <ul>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Nama Bahan</div>
                            <div class="fw-normal">{{ $bahan->nama_bahan }}</div>
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Harga Bahan</div>
                            <div class="fw-normal">Rp. {{ $bahan->harga_bahan }}</div>
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Biaya Bahan</div>
                            <div class="fw-normal"> {{ $bahan->biaya_bahan }}</div>
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Referensi Internal</div>
                            <div class="fw-normal"> {{ $bahan->internal_referensi }}</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-5">
                <ul>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Gambar</div>
                            <img src="{{ asset('images/bahan/' . $bahan->gambar_bahan) }}" alt=""
                                style="max-width: 15rem">
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
