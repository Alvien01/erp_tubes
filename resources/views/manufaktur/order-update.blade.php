@extends('sidebar')

@section('title', 'Manufaktur')
@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Update Order')

@section('content')
    <div class="card card-body pt-3" id="orderFormContainer">
        <form action="{{ route('manufaktur.order-update', ['id_order' => $order->id_order]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <select class="form-select" id="nama_produk" name="nama_produk" required
                    onchange="setProductId(this.options[this.selectedIndex].getAttribute('data-text'))">
                    <option value="">Pilih Produk</option>
                    @foreach ($produk as $item)
                        <option data-text="{{ $item->id_produk }}" selected>
                            {{ $item->nama_produk }}
                            [{{ $item->internal_referensi }}]
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="id_produk" id="id_produk" value="{{ old('id_produk') }}">


            <div class="mb-3">
                <label for="id_bom" class="form-label">Pilih BOM</label>
                <select class="form-select" id="id_bom" name="id_bom" required>
                    <option value="">- Pilih BOM -</option>
                    @foreach ($bomList as $bomItem)
                        <option value="{{ $bomItem->id_bom }}" selected>
                            {{ $bomItem->produk->nama_produk }},
                            [{{ $bomItem->internal_referensi }}]
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah_produk" class="form-label">Jumlah Produk</label>
                <input type="number" class="form-control" id="jumlah_produk" name="jumlah_produk" required value="{{ $order->jumlah_produk }}">
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
    {{-- <script>
    $(document).ready(function () {
        // Inisialisasi Select2 pada elemen dengan id_bom
        $('#id_bom').select2({
            ajax: {
                url: '{{ route('order.search') }}', // Ganti dengan rute pencarian yang sesuai
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: '- Pilih BOM -',
            minimumInputLength: 1 // Atur jumlah karakter minimal sebelum pencarian dimulai
        });
    });
</script> --}}

    <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Tambahkan script untuk menangani perubahan pada elemen select -->
    {{-- <script>
$(document).ready(function () {
    $("#id_bom").change(function () {
$("#bahanTableBody").empty();

var selectedBOM = $("option:selected", this).data("text");

// Lakukan permintaan AJAX untuk mendapatkan data bomList
$.ajax({
    url: '/get_bom_data',
    type: 'GET',
    dataType: 'json',
    success: function (response) {
        var bomList = response;

        var selectedBOMData = bomList.find(function (bomItem) {
            return bomItem.id_bom == selectedBOM;
        });

        if (selectedBOMData) {
            var internalReferensi = selectedBOMData.internal_referensi;
            var jumlahProduk = selectedBOMData.jumlah_produk;

            $("#referensi").val(internalReferensi).show();
            $("#jumlah_produk").val(jumlahProduk).show();

            var namaBahanArray = selectedBOMData.nama_bahan;
            var jumlahBahanArray = selectedBOMData.jumlah_bahan;

            // Kosongkan isi tabel sebelum menambahkan baris baru
            $("#bahanTableBody").empty();

            for (var i = 0; i < namaBahanArray.length; i++) {
                var newRow = "<tr><td class='text-center'>" + (i + 1) + "</td>";
                newRow += "<td class='text-center'>" + namaBahanArray[i] + "</td>";
                newRow += "<td class='text-center'>" + jumlahBahanArray[i] + "</td></tr>";

                $("#bahanTableBody").append(newRow);
            }
        } else {
            $("#referensi").hide();
            $("#jumlah_produk").hide();
            $("#bahanTableBody").empty();
        }
    },
    error: function (error) {
        console.error('Error fetching bomList:', error);
    }
});
});

});
</script> --}}


    {{-- <script>
    $(document).ready(function() {
        
        // Tangkap perubahan pada elemen select
        $("#id_bom").change(function() {
            // Bersihkan isi dari tbody
            $("#bahanTableBody").empty();

            // Ambil nilai data-text dari opsi yang dipilih
            var selectedBOM = $("option:selected", this).data("text");

            // Cari BOM yang sesuai dalam data JSON
            var selectedBOMData = bomData.find(function(bomItem) {
                return bomItem.id_bom == selectedBOM;
            });

            // Jika BOM dipilih, tampilkan referensi dan jumlah produk
            if (selectedBOMData) {
                // Ambil referensi dan jumlah produk dari data BOM yang sesuai
                var internalReferensi = selectedBOMData.internal_referensi;
                var jumlahProduk = selectedBOMData.jumlah_produk;

                // Tampilkan referensi dan jumlah produk
                $("#referensi").val(internalReferensi).show();
                $("#jumlah_produk").val(jumlahProduk).show();

                // Tampilkan nama bahan dan jumlah bahan ke dalam tabel
                var namaBahanArray = selectedBOMData.nama_bahan;
                var jumlahBahanArray = selectedBOMData.jumlah_bahan;

                for (var i = 0; i < namaBahanArray.length; i++) {
                    var newRow = "<tr><td class='text-center'>" + (i + 1) + "</td>";
                    newRow += "<td class='text-center'>" + namaBahanArray[i] + "</td>";
                    newRow += "<td class='text-center'>" + jumlahBahanArray[i] + "</td></tr>";

                    $("#bahanTableBody").append(newRow);
                }
            } else {
                // Jika tidak ada BOM yang dipilih, sembunyikan referensi, jumlah produk, dan bersihkan tabel
                $("#referensi").hide();
                $("#jumlah_produk").hide();
                $("#bahanTableBody").empty();
            }
        });
    });
</script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
    $(document).ready(function () {
        // Tambahkan event listener untuk perubahan pada select
        $('#id_bom').change(function () {
            var selectedBOM = $(this).val();

            // Lakukan permintaan Ajax untuk mendapatkan data bahan berdasarkan BOM yang dipilih
            $.ajax({
                url: '/get_bahan_data/' + selectedBOM,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    // Hapus data bahan sebelumnya
                    $('#bahanTable tbody').empty();

                    // Tampilkan data bahan baru
                    $.each(response, function (index, bahan) {
                        var newRow = "<tr><td class='text-center'>" + bahan.nama_bahan + "</td>";
                        newRow += "<td class='text-center'>" + bahan.jumlah_bahan + "</td></tr>";
                        $('#bahanTable tbody').append(newRow);
                    });
                },
                error: function (error) {
                    console.error('Error fetching bahan data:', error);
                }
            });
        });
    });
</script> --}}


    <script>
        $(document).ready(function() {
            // Tambahkan event listener untuk perubahan pada select id_bom
            $('#id_bom').change(function() {
                var selectedBOM = $(this).val();

                // Lakukan permintaan Ajax untuk mendapatkan data bahan berdasarkan BOM yang dipilih
                $.ajax({
                    url: '/get_bahan_data/' + selectedBOM,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Hapus data bahan sebelumnya
                        $('#bahanTableBody').empty();

                        // Tampilkan data bahan baru
                        $.each(response, function(index, bahan) {
                            var newRow = "<tr>";
                            newRow +=
                                "<td class='text-center'><input type='text' name='nama_bahan[]' value='" +
                                bahan.nama_bahan + "' readonly></td>";
                            newRow +=
                                "<td class='text-center'><input type='number' name='jumlah_bahan[]' value='" +
                                bahan.jumlah_bahan + "' readonly></td>";
                            newRow += "</tr>";
                            $('#bahanTableBody').append(newRow);
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching bahan data:', error);
                        // Tambahkan langkah-langkah penanganan kesalahan di sini
                    }
                });
            });
        });
    </script>
    <script>
        // Fungsi untuk mengatur nilai id_produk saat memilih produk
        function setProductId(productId) {
            document.getElementById('id_produk').value = productId;
        }
    </script>
@endsection
