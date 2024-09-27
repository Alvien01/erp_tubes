@extends('sidebar')

@section('title', 'Order')

@section('pageTitle', 'Sales Order')
@section('pageSubTitle', 'Tambah Order')

@section('content')
    <div class="card card-body pt-3" id="orderFormContainer">
        <form action="{{ route('SO.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="customer" class="form-label">Pilih Quotation</label>
                <select class="form-select" id="customer" name="customer">
                    <option value="">- Pilih Quotation -</option>
                    @foreach ($quotationList as $quotation)
                        <option value="{{ $quotation->id }}"
                        data-id="{{ $quotation->id }}"
                        data-id_customer_individual="{{ $quotation->id_customer_individual }}"
                        data-id_customer_company="{{ $quotation->id_customer_company }}"
                        data-customer="{{ $quotation->customer }}"
                        data-expiration="{{ $quotation->expiration }}"
                        data-nama_produk="{{ $quotation->nama_produk }}"
                        data-jumlah="{{ $quotation->jumlah }}"
                        data-satuan_biaya="{{ $quotation->satuan_biaya }}"
                        data-total_biaya="{{ $quotation->total_biaya }}"
                        data-created_at="{{ $quotation->created_at }}"
                        data-updated_at="{{ $quotation->updated_at }}"
                        >{{ $quotation->customer }},
                            [{{ $quotation->nama_produk }}, {{ $quotation->total_biaya }}]</option>
                    @endforeach
                </select>
            </div>
            <table class="table table-bordered" id="bahanTable">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nama Produk</th>
                        <th scope="col" class="text-center">Total Biaya</th>
                    </tr>
                </thead>
                <tbody id="bahanTableBody">

                </tbody>
            </table>
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="id_customer_individual" id="id_customer_individual" value="">
            <input type="hidden" name="id_customer_company" id="id_customer_company" value="">
            <input type="hidden" name="customer" id="customer_nama" value="">
            <input type="hidden" name="expiration" id="expiration" value="">
            <input type="hidden" name="nama_produk" id="nama_produk" value="">
            <input type="hidden" name="jumlah" id="jumlah" value="">
            <input type="hidden" name="satuan_biaya" id="satuan_biaya" value="">
            <input type="hidden" name="total_biaya" id="total_biaya" value="">
            <input type="hidden" name="status" id="status" value="">
            <input type="hidden" name="created_at" id="created_at" value="">
            <input type="hidden" name="updated_at" id="updated_at" value="">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $('#customer').change(function () {
                var selectedQuotation = $(this).find(':selected');
                var id = selectedQuotation.data('id');
                var id_customer_individual = selectedQuotation.data('id_customer_individual');
                var id_customer_company = selectedQuotation.data('id_customer_company');
                var customer = selectedQuotation.data('customer');
                var expiration = selectedQuotation.data('expiration');
                var nama_produk = selectedQuotation.data('nama_produk');
                var jumlah = selectedQuotation.data('jumlah');
                var satuan_biaya = selectedQuotation.data('satuan_biaya');
                var total_biaya = selectedQuotation.data('total_biaya');
                var created_at = selectedQuotation.data('created_at');
                var updated_at = selectedQuotation.data('updated_at');

                // Update the table with selected Quotation details
                $('#bahanTableBody').html('<tr><td class="text-center">' + nama_produk + '</td><td class="text-center">' + jumlah + '</td></tr>');
                $('#id').val(id);
                $('#id_customer_individual').val(id_customer_individual);
                $('#id_customer_company').val(id_customer_company);
                $('#customer_nama').val(customer);
                $('#expiration').val(expiration);
                $('#nama_produk').val(nama_produk);
                $('#jumlah').val(jumlah);
                $('#satuan_biaya').val(satuan_biaya);
                $('#total_biaya').val(total_biaya);
                $('#created_at').val(created_at);
                $('#updated_at').val(updated_at);
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function () {
            // Inisialisasi Select2 pada elemen dengan id_bom
            $('#id').select2({
                ajax: {
                    url: '{{ route('SO.search') }}', // Ganti dengan rute pencarian yang sesuai
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: '- Pilih Quotation -',
                minimumInputLength: 1 // Atur jumlah karakter minimal sebelum pencarian dimulai
            });
        });
    </script> --}}
    <!-- Tambahkan script untuk menangani perubahan pada elemen select -->
    <script>
    $(document).ready(function () {
        $("#id").change(function () {
    $("#bahanTableBody").empty();

    var selectedBOM = $("option:selected", this).data("text");

    // Lakukan permintaan AJAX untuk mendapatkan data bomList
    $.ajax({
        url: 'get_quotation_data',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var quotationList = response;

            var selectedQuotationData = quotationList.find(function (quotationItem) {
                return quotationItem.id == selectedQuotation;
            });

            if (selectedQuotationData) {
                // var internalReferensi = selectedBOMData.internal_referensi;
                // var jumlahProduk = selectedQuotationData.total_biaya;

                // $("#referensi").val(internalReferensi).show();
                // $("#total_biaya").val(jumlahProduk).show();

                var namaBahanArray = selectedQuotationData.nama_produk;
                var jumlahBahanArray = selectedBOMData.total_biaya;

                // Kosongkan isi tabel sebelum menambahkan baris baru
                // $("#bahanTableBody").empty();

                // for (var i = 0; i < namaBahanArray.length; i++) {
                //     var newRow = "<tr><td class='text-center'>" + (i + 1) + "</td>";
                //     newRow += "<td class='text-center'>" + namaBahanArray[i] + "</td>";
                //     newRow += "<td class='text-center'>" + jumlahBahanArray[i] + "</td></tr>";

                //     $("#bahanTableBody").append(newRow);
                // }
            } else {
                $("#referensi").hide();
                $("#total_biaya").hide();
                $("#bahanTableBody").empty();
            }
        },
        error: function (error) {
            console.error('Error fetching quotationList:', error);
        }
    });
});

    });
</script>


    <!-- {{-- <script>
        $(document).ready(function() {
            
            // Tangkap perubahan pada elemen select
            $("#id_bom").change(function() {
                // Bersihkan isi dari tbody
                $("#bahanTableBody").empty();

                // Ambil nilai data-text dari opsi yang dipilih
                var selectedQuotation = $("option:selected", this).data("text");

                // Cari BOM yang sesuai dalam data JSON
                var selectedQuotataionData = quotataionData.find(function(quotataionItem) {
                    return quotataionItem.id == selectedQuotation;
                });

                // Jika BOM dipilih, tampilkan referensi dan jumlah produk
                if (selectedQuotataionData) {
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


    {{-- <script>
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
                        newRow += "<td class='text-center'><input type='text' name='nama_bahan[]' value='" + bahan.nama_bahan + "' readonly></td>";
                        newRow += "<td class='text-center'><input type='number' name='jumlah_bahan[]' value='" + bahan.jumlah_bahan + "' readonly></td>";
                        newRow += "</tr>";
                        $('#bahanTableBody').append(newRow);
                    });
                },
                error: function (error) {
                    console.error('Error fetching bahan data:', error);
                    // Tambahkan langkah-langkah penanganan kesalahan di sini
                }
            });
        });
    });
</script> --}}

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


@endsection -->
