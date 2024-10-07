@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Tambah Data BoM')

@section('content')
    <div class="card">
        <div class="card-body pt-3">
            <form action="{{ route('simpan-bom') }}" method="post" id="bomForm">
                @csrf
                <div class="d-flex justify-content-between mb-3">
                    <button type="submit" class="btn btn-primary btn-sm" id="strukturBiayaButton">Struktur Biaya</button>
                    <a href="{{ route('manufaktur.bom') }}" class="btn btn-warning btn-sm">Back</a>
                </div>

                <div class="row g-3">
                    <div class="">
                        <label for="nama_produk" class="form-label">Produk</label>
                        <select class="form-select form-control-sm" id="nama_produk" name="nama_produk" required>
                            <option value="">- Pilih Produk -</option>
                            @foreach ($produkList as $item)
                                <option value="{{ $item->id_produk }}">{{ $item->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="">
                        <label for="nama_kategori" class="form-label">Kategori</label>
                        <select class="form-select form-control-sm" id="nama_kategori" name="nama_kategori" required>
                            <option value="">- Pilih Kategori -</option>
                            @if (isset($kategoriList))
                                @foreach ($kategoriList as $item)
                                    <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="">
                        <label for="jumlah_produk" class="form-label">Jumlah</label>
                        <input type="text" class="form-control form-control-sm" id="jumlah_produk" name="jumlah_produk" required>
                    </div>
                    <div class="">
                        <label for="internal_referensi" class="form-label">Referensi</label>
                        <input type="text" class="form-control form-control-sm" id="internal_referensi" name="internal_referensi" required>
                    </div>

                    <!-- Elemen input awal yang sudah ada -->
                    <div class="dynamicInputs row g-2">
                        <div class="col-md-8">
                            <label for="nama_bahan" class="form-label">Pilih Bahan</label>
                            <select class="form-select form-control-sm" id="nama_bahan" name="nama_bahan[]" required>
                                <option value="">- Pilih bahan -</option>
                                @if (isset($bahanList))
                                    @foreach ($bahanList as $item)
                                        <option value="{{ $item->nama_bahan }}">{{ $item->nama_bahan }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="jumlah_bahan" class="form-label">Jumlah</label>
                            <input type="text" class="form-control form-control-sm" id="jumlah_bahan" name="jumlah_bahan[]" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-sm" id="addInputBtn">Tambah Bahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#addInputBtn').click(function() {
                var inputGroup = `
            <div class="dynamicInputs row g-2">
                <div class="col-md-8">
                    <label for="inputState" class="form-label">Pilih Bahan</label>
                    <select class="form-select form-control-sm" name="nama_bahan[]" required>
                        <option value="">- Pilih bahan -</option>
                        @if (isset($bahanList))
                            @foreach ($bahanList as $item)
                                <option value="{{ $item->nama_bahan }}">{{ $item->nama_bahan }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputCity" class="form-label">Jumlah</label>
                    <input type="text" class="form-control form-control-sm" name="jumlah_bahan[]" required>
                </div>
            </div>
        `;
                $('.dynamicInputs').last().after(inputGroup);
            });
        });
    </script>
@endsection
