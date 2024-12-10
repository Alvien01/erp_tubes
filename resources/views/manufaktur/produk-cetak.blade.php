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
            <h3 class="fw-bold">Cetak Produk</h3>
        </div>
        <div class="row pt-2">
            <div class="col-7 pt-2">
                <h5>Cetak Label</h5>
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
                            <div class="fw-bold text-black">Nama Produk</div>
                            <div class="fw-normal">{{ $produk->nama_produk }}</div>
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Harga Produksi</div>
                            <div class="fw-normal">Rp. {{ $produk->harga_produksi }}</div>
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Biaya Produksi</div>
                            <div class="fw-normal"> {{ $produk->biaya_produksi }}</div>
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Referensi Internal</div>
                            <div class="fw-normal"> {{ $produk->internal_referensi }}</div>
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Kategori</div>
                            <div class="fw-normal"> {{ $produk->nama_kategori }}</div>
                        </div>
                    </li>
                </ul>

            </div>
            <div class="col-5">
                <ul>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Barcode</div>
                            <div class="d-flex flex-column mb-3" style="max-width: 21rem;">
                                <div class="p-2 text-center border fw-bold">{{ $produk->nama_produk }}</div>
                                <div class="p-2 text-center fw-light border">{!! DNS1D::getBarcodeHTML("$produk->barcode", 'C39') !!}</div>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-start py-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-black">Gambar Produk</div>
                            <img src="{{ asset('images/produk/' . $produk->gambar_produk) }}" alt=""
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