@extends('sidebar')

@section('title', 'Manufaktur')
@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Tambah Produk')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Produk</h5>
                <div class="col-12 text-end mb-3">
                    <a href="{{route('manufaktur.produk')}}" class="btn btn-warning btn-sm ml-auto">Back</a>
                </div>
            <form class="row g-3" method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf
                <div class="col-12">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control form-control-sm" name="nama_produk" autofocus required
                        value="{{ old('nama_produk') }}">
                </div>
                <div class="col-12">
                    <label for="harga_produksi" class="form-label">Harga Produksi</label>
                    <input type="number" class="form-control form-control-sm" name="harga_produksi" required
                        value="{{ old('harga_produksi') }}">
                </div>
                <div class="col-12">
                    <label for="biaya_produksi" class="form-label">Biaya Produksi</label>
                    <input type="number" class="form-control form-control-sm" name="biaya_produksi"
                        value="{{ old('biaya_produksi') }}">
                </div>
                <div class="col-12">
                    <label for="internal_referensi" class="form-label">Internal Referensi</label>
                    <input type="text" class="form-control form-control-sm" name="internal_referensi" required
                        value="{{ old('internal_referensi') }}">
                </div>
                <div class="col-12">
                    <label for="nama_kategori" class="form-label">Kategori Produk</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="nama_kategori" name="nama_kategori"
                            value="{{ old('nama_kategori') }}">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary" id="tambahKategoriButton" data-toggle="modal"
                                data-target="#tambahKategoriModal">Tambah Kategori</button>
                        </div>
                    </div>
                    <div id="suggestions"></div>
                </div>

                @if (session('success'))
                    <div class="col-12">
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    <label for="barcode" class="form-label">Barcode</label>
                    <input type="text" class="form-control form-control-sm" name="barcode" value="{{ old('barcode') }}">
                </div>
                <div class="col-12">
                    <label for="gambar_produk" class="form-label">Gambar Produk (JPG/PNG)</label>
                    <input class="form-control" type="file" name="gambar_produk" value="{{ old('gambar_produk') }}">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Realtime Kontlo--}}
    {{-- <script>
        $(document).ready(function () {
    // Tangani saat tombol "Tambah Kategori" ditekan
    $('#tambahKategoriButton').click(function () {
        var nama_kategori = $('#nama_kategori').val();

        // Lakukan permintaan Ajax untuk menambahkan kategori
        $.ajax({
            type: 'POST',
            url: '/kategori/store', // Ganti URL sesuai dengan rute Anda
            data: {
                _token: '{{ csrf_token() }}',
                nama_kategori: nama_kategori
            },
            success: function (response) {
                if (response.message === 'Kategori berhasil ditambahkan !!!') {
                    // Tampilkan pesan sukses
                    $('#suggestions').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                } else {
                    // Tampilkan pesan gagal
                    $('#suggestions').html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
                }
            }
        });
    });
});

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successNotification = document.getElementById('successNotification');
            const notificationDiv = document.getElementById('notificationDiv');

            // Hide the success notification initially
            successNotification.style.display = 'none';

            const tambahKategoriButton = document.getElementById('tambahKategoriButton');

            tambahKategoriButton.addEventListener('click', function() {
                // Perform an AJAX request to add a category
                const newKategori = document.getElementById('nama_kategori').value;
                fetch('/kstore', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            nama_kategori: newKategori
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.id_kategori) {
                            // Show the success notification
                            successNotification.textContent = data.message;
                            successNotification.style.display = 'block';

                            // Clear the input field
                            document.getElementById('nama_kategori').value = '';
                        }
                    });
            });
        });
    </script> --}}
{{-- KONTLO FINISH --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const namaKategoriInput = document.getElementById('nama_kategori');
            const suggestionsContainer = document.getElementById('suggestions');
            const tambahKategoriButton = document.getElementById('tambahKategoriButton');
            const successMessage = document.getElementById('successMessage');

            function getSuggestions(inputText) {
                fetch(`/get-kategori-suggestions?query=${inputText}`)
                    .then(response => response.json())
                    .then(data => {
                        const suggestions = data.suggestions;
                        suggestionsContainer.innerHTML = '';

                        if (suggestions.length > 0) {
                            suggestions.forEach(suggestion => {
                                const suggestionElement = document.createElement('div');
                                suggestionElement.textContent = suggestion;
                                suggestionElement.classList.add('suggestion');
                                suggestionElement.addEventListener('click', function() {
                                    namaKategoriInput.value = suggestion;
                                    suggestionsContainer.style.display = 'none';
                                });
                                suggestionsContainer.appendChild(suggestionElement);
                            });
                        } else {
                            const noResultsElement = document.createElement('div');
                            noResultsElement.textContent = 'Tidak Ada Kategori';
                            noResultsElement.classList.add('no-results');
                            suggestionsContainer.appendChild(noResultsElement);
                        }

                        if (suggestions.length > 0) {
                            suggestionsContainer.style.display = 'block';
                        } else {
                            suggestionsContainer.style.display = 'none';
                        }
                    });
            }

            namaKategoriInput.addEventListener('input', function(e) {
                const inputText = e.target.value;
                getSuggestions(inputText);
            });

            tambahKategoriButton.addEventListener('click', function() {
                const newKategori = namaKategoriInput.value;
                fetch('/kstore', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Tambahkan token CSRF di sini
                        },
                        body: JSON.stringify({
                            nama_kategori: newKategori
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.id_kategori) {
                            getSuggestions(newKategori);
                            successMessage.textContent = 'Data berhasil ditambahkan';
                            successMessage.style.display = 'block';

                            // Bersihkan input dan suggestions setelah berhasil tambah
                            namaKategoriInput.value = '';
                            suggestionsContainer.innerHTML = '';

                            // Sembunyikan pesan sukses setelah beberapa detik
                            setTimeout(function() {
                                successMessage.style.display = 'none';
                            }, 3000);
                        }
                    });
            });

            document.addEventListener('click', function(e) {
                if (!suggestionsContainer.contains(e.target)) {
                    suggestionsContainer.style.display = 'none';
                }
            });
        });
    </script>

@endsection
