@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Tambah Order')

@section('content')
    <div class="card card-body pt-3" id="orderFormContainer">
        <form action="{{ route('manufaktur.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <div class="col-12 text-end mb-3">
                    <a href="{{route('manufaktur.order')}}" class="btn btn-warning btn-sm ml-auto">Back</a>
                </div>
                <select class="form-select" id="nama_produk" name="nama_produk" required
                    onchange="setProductId(this.options[this.selectedIndex].getAttribute('data-text'))">
                    <option value="">Pilih Produk</option>
                    @foreach ($produk as $item)
                        <option data-text="{{ $item->id_produk }}">{{ $item->nama_produk }}
                            [{{ $item->internal_referensi }}]</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="id_produk" id="id_produk" value="{{ old('id_produk') }}">
            {{-- <input  name="id_bahan" id="id_bahan" value="{{ old('id_bahan') }}"> --}}


            <div class="mb-3">
                <label for="id_bom" class="form-label">Pilih BOM</label>
                <select class="form-select" id="id_bom" name="id_bom" required>
                    <option value="">- Pilih BOM -</option>
                    @foreach ($bomList as $bomItem)
                        <option value="{{ $bomItem->id_bom }}">{{ $bomItem->produk->nama_produk }},
                            [{{ $bomItem->internal_referensi }}]</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah_produk" class="form-label">Jumlah Produk</label>
                <input type="number" class="form-control" id="jumlah_produk" name="jumlah_produk" required>
            </div>

            <table class="table table-bordered" id="bahanTable">
                <thead>
                    <tr>
                        {{-- <th scope="col" class="text-center">No</th> --}}
                        <th scope="col" class="text-center">Nama Bahan</th>
                        <th scope="col" class="text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody id="bahanTableBody">

                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
    <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Tambahkan event listener untuk perubahan pada select id_bom
            $('#id_bom').change(function () {
                var selectedBOM = $(this).val();
    
                // Lakukan permintaan Ajax untuk mendapatkan data bahan berdasarkan BOM yang dipilih
                $.ajax({
                    url: '/get_bahan_data/' + selectedBOM,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        // Hapus data bahan sebelumnya
                        $('#bahanTableBody').empty();
    
                        // Tampilkan data bahan baru
                        $.each(response, function (index, bahan) {
                            var newRow = "<tr>";
                            newRow +=
                                "<td class='text-center'><input type='text' name='nama_bahan[]' value='" +
                                bahan.nama_bahan + "' readonly></td>";
                            newRow +=
                                "<td class='text-center'><input type='number' name='jumlah_bahan[]' value='" +
                                bahan.jumlah_bahan +
                                "' class='jumlah_bahan'></td>";
                            newRow +=
                                "<td class='text-center'><span class='total_produksi' data-index='" +
                                index + "'>0</span></td>";
    
                            newRow += "</tr>";
                            $('#bahanTableBody').append(newRow);
                        });
    
                        // Tambahkan event listener untuk perubahan pada input jumlah_bahan
                        $(document).on('input', 'input[name^="jumlah_bahan"]', function () {
                            calculateProduksi();
                        });
    
                        // Tambahkan event listener untuk perubahan pada input jumlah_produk
                        $('#jumlah_produk').change(function () {
                            calculateProduksi();
                        });
                    },
                    error: function (error) {
                        console.error('Error fetching bahan data:', error);
                        // Tambahkan langkah-langkah penanganan kesalahan di sini
                    }
                });
            });
    
            // Fungsi untuk menghitung jumlah bahan berdasarkan jumlah produk yang dimasukkan
            function calculateProduksi() {
                var jumlahProduk = parseInt($('#jumlah_produk').val());
    
                $('input[name^="jumlah_bahan"]').each(function (index) {
                    var jumlahBahan = parseInt($(this).val());
                    var totalProduksi = jumlahProduk * jumlahBahan;
    
                    // Update nilai pada kolom total produksi
                    $('.total_produksi[data-index="' + index + '"]').text(totalProduksi);
    
                    // Update nilai pada input jumlah bahan
                    $('input[name="jumlah_bahan[]"]').eq(index).val(-totalProduksi);
                });
            }
        });
    </script>
    
    


    <script>
        // Fungsi untuk mengatur nilai id_produk saat memilih produk
        function setProductId(productId) {
            document.getElementById('id_produk').value = productId;
        }
    </script>


@endsection
