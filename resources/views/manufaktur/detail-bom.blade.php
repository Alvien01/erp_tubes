@extends('sidebar')

@section('title', 'Manufaktur')
@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Bills of Materials')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card mx-auto my-5" style="max-width: 70rem;">
        <div class="card-header text-center fw-bold fs-2 text-black">Bills of Materials</div>
        <a href="{{route('manufaktur.bom')}}" class="btn btn-warning btn-sm ml-auto">Back</a>
        <div class="card-body">
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Bill Of Material Struktur Biaya | {{ Carbon::now()->format('d/m/Y H:i:s') }}</p>
                    <p class="m-0">{{ $bom->internal_referensi }}</p>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Produk</th>
                        <th scope="col">Internal Referensi</th>
                        <th scope="col">Bahan</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Biaya Produksi/Product Cost</th>
                        <th scope="col">Biaya BoM</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $bom->produk->nama_produk }}</td>
                        <td>{{ $bom->internal_referensi }}</td>
                        <td></td>
                        <td>{{ $bom->jumlah_produk }}</td>
                        {{-- <td>
                            {{ $bom->total_biaya_produk }}
                        </td> --}}
                        <td>
                            @php
                                // Ambil nilai jumlah_produk dan biaya_produksi dari tb_produk
                                $jumlahProduk = $bom->jumlah_produk; // Sesuaikan dengan field yang sesuai di tb_produk
                                $biayaProduksi = $bom->produk->biaya_produksi; // Sesuaikan dengan field yang sesuai di tb_produk

                                // Hitung total_biaya_produk
                                $totalBiayaProduk = $jumlahProduk * $biayaProduksi;
                            @endphp

                            {{ $totalBiayaProduk }}

                            @php
                                // Simpan total_biaya_produk ke dalam tb_bom
                                $bom->total_biaya_produk = $totalBiayaProduk;
                                $bom->save();
                            @endphp
                        </td>

                        <?php
                        // Inisialisasi variabel totalBiayaBahan
                        $totalBiayaBahan = 0;
                        ?>
                        @foreach (json_decode($bom->nama_bahan, true) as $index => $namaBahan)
                            <?php
                            $biayaBahan =\Illuminate\Support\Facades\DB::table('tb_bahan')
                                ->where('nama_bahan', $namaBahan)
                                ->value('biaya_bahan');
                            $decode = json_decode($bom->jumlah_bahan, true)[$index];
                            $jumlahBahan = floatval($decode);
                            $total = $biayaBahan * $jumlahBahan;
                            $totalBiayaBahan += $total;
                            ?>
                        @endforeach
                        <td>
                            <?php
                            echo $totalBiayaBahan;
                            $bom->total_biaya_bahan = $totalBiayaBahan;
                            $bom->save();
                            ?>
                        </td>
                    </tr>
                    @foreach (json_decode($bom->nama_bahan, true) as $index => $namaBahan)
                        <tr>
                            <td></td>
                            <td></td>
                            <td>{{ $namaBahan }}</td>
                            <td>{{ json_decode($bom->jumlah_bahan, true)[$index] }}</td>
                            <td>
                                <?php
                                $biayaBahan =\Illuminate\Support\Facades\DB::table('tb_bahan')
                                    ->where('nama_bahan', $namaBahan)
                                    ->value('biaya_bahan');
                                $decode = json_decode($bom->jumlah_bahan, true)[$index];
                                $jumlahBahan = floatval($decode);
                                $total = $biayaBahan * $jumlahBahan;
                                echo $total;
                                ?> 
                            </td>
                            <td>
                                <?php
                                $biayaBahan = \Illuminate\Support\Facades\DB::table('tb_bahan')
                                    ->where('nama_bahan', $namaBahan)
                                    ->value('biaya_bahan');
                                $decode = json_decode($bom->jumlah_bahan, true)[$index];
                                $jumlahBahan = floatval($decode);
                                $total = $biayaBahan * $jumlahBahan;
                                echo $total;
                                ?>
                            </td>
                        </tr>
                    @endforeach

                    <tr class="border-none">
                        <th colspan="3"></th>
                        <th scope="row">Biaya Satuan</th>
                        <td>{{ $bom->produk->biaya_produksi }}</td>
                        <td>{{ $bom->total_biaya_bahan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('manufaktur.bom-cetak', ['id' => $bom->id_bom]) }}" target="_blank"
                    class="btn btn-secondary btn-sm">Print</a>
                {{-- <button type="submit" class="btn btn-warning btn-sm">Edit</button> --}}
                @if (isset($bom))
                    <a href="{{ route('manufaktur.edit-bom', ['id_bom' => $bom->id_bom]) }}"
                        class="btn btn-warning btn-sm">Edit</a>
                @endif
                <form action="{{ route('manufaktur.bom-detail.destroy', ['id' => $bom->id_bom]) }}" method="post">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
