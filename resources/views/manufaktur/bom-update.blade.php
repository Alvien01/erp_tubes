@extends('sidebar')

@section('title', 'Manufaktur')

@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Update Bill Of Material')

@section('content')
    <div class="card">
        <div class="card-body pt-3">
            <form method="post" action="{{ route('manufaktur.bom-update', ['id_bom' => $bom->id_bom]) }}">
                <input type="hidden" name="id_bom" value="{{ $bom->id_bom }}">
                @csrf
                @method('PUT')
                <div class="d-flex justify-content-end">
                    {{-- REDIREK TOK --}}
                    {{-- <a href="{{ route('detail-bom') }}" class="btn btn-primary btn-sm">Struktur Biaya</a> --}}
                    {{-- Save karo Redirek --}}
                    <button type="submit" class="btn btn-primary btn-sm" id="strukturBiayaButton">Struktur Biaya</button>

                </div>

                <div class="row g-3">
                    <div class="">
                        <label for="inputState" class="form-label">Produk</label>
                        <select class="form-select form-control-sm" id="nama_produk" name="nama_produk" required>
                            <option value="" hidden>- Pilih Produk -</option>
                            @foreach ($produkList as $item)
                                <option value="{{ $item->id_produk }}" selected>
                                    {{ $item->nama_produk }}
                                </option>
                            @endforeach
                            {{-- @if (isset($produk)) --}}
                            {{-- @foreach ($produk as $item)
                                    <option value="{{ $item->id }}" @if (isset($bom) && $bom->id_produk == $item->id) selected @endif>
                                        {{ $item->nama_produk }}</option>
                                @endforeach --}}
                            {{-- @foreach ($bom->$produk as $pr)
                                    <option value="{{ $pr->id }}">{{ $pr->nama_produk }}</option>
                                @endforeach --}}
                            {{-- @endif --}}
                        </select>
                    </div>

                    <div class="">
                        <label for="inputState" class="form-label">Kategori</label>
                        <select class="form-select form-control-sm" id="nama_kategori" name="nama_kategori" required>
                            <option value="" hidden>- Pilih Kategori -</option>
                            @foreach ($kategoriList as $item)
                                <option value="{{ $item->nama_kategori }}" selected>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="productCategory" class="form-label">Jumlah</label>
                        <input type="text" class="form-control form-control-sm" id="jumlah_produk" name="jumlah_produk"
                            required @if (isset($bom)) value="{{ $bom->jumlah_produk }}" @endif>
                    </div>
                    <div class="">
                        <label for="internalReference" class a form-label="">Referensi</label>
                        <input type="text" class="form-control form-control-sm" name="internal_referensi" required
                            @if (isset($bom)) value="{{ $bom->internal_referensi }}" @endif>
                    </div>

                    <!-- Elemen input awal yang sudah ada -->
                    {{-- <div class="dynamicInputs row g-2">
                        <div class="col-md-8">
                            <label for="inputState" class="form-label">Pilih Bahan</label>
                            <select class="form-select form-control-sm" id="nama_bahan" name="nama_bahan" required>
                                <option value="">- Pilih Bahan -</option>
                                
                                    @foreach ($bahanList as $item)
                                        <option value="{{ $item->id_bahan }}"
                                            selected>{{ $item->nama_bahan }}
                                        </option>
                                    @endforeach
                                
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputCity" class="form-label">Jumlah</label>
                            <input type="text" class="form-control form-control-sm" id="jumlah_bahan" name="jumlah_bahan"
                                required @if (isset($bom)) value="{{ $bom->jumlah_bahan }}" @endif>
                        </div>
                    </div> --}}
                    <div class="dynamicInputsContainer">
                        @if(isset($bom) && !empty($bom->nama_bahan))
                            @php
                                $namaBahanArray = json_decode($bom->nama_bahan, true);
                                $jumlahBahanArray = json_decode($bom->jumlah_bahan);
                            @endphp
                            @for ($i = 0; $i < count($namaBahanArray); $i++)
                                <div class="dynamicInputs row g-2">
                                    <div class="col-md-8">
                                        <label for="inputState" class="form-label">Pilih Bahan</label>
                                        <select class="form-select form-control-sm" name="nama_bahan[]" required>
                                            <option value="">- Pilih Bahan -</option>
                                            @foreach ($bahanList as $item)
                                                <option value="{{ $item->nama_bahan }}" @if($item->nama_bahan == $namaBahanArray[$i]) selected @endif>
                                                    {{ $item->nama_bahan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputCity" class="form-label">Jumlah</label>
                                        <input type="text" class="form-control form-control-sm" name="jumlah_bahan[]" required value="{{ $jumlahBahanArray[$i] }}">
                                    </div>
                                </div>
                            @endfor
                        @else
                            <div class="dynamicInputs row g-2">
                                <div class="col-md-8">
                                    <label for="inputState" class="form-label">Pilih Bahan</label>
                                    <select class="form-select form-control-sm" name="nama_bahan[]" required>
                                        <option value="">- Pilih Bahan -</option>
                                        @foreach ($bahanList as $item)
                                            <option value="{{ $item->id_bahan }}">
                                                {{ $item->nama_bahan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputCity" class="form-label">Jumlah</label>
                                    <input type="text" class="form-control form-control-sm" name="jumlah_bahan[]" required>
                                </div>
                            </div>
                        @endif
                    </div>                    

                    <div class="d-flex justify-content-end">
                        {{-- <button type="button" class="btn btn-primary btn-sm" id="addInputBtn">+</button> --}}
                        {{-- <button type="button" class="btn btn-primary btn-sm" id="addInputBtn">-</button> --}}
                    </div>
                </div>

                <div id="success-message" style="display: none" class="alert alert-success">
                    Data berhasil disimpan!
                </div>
            </form>
        </div>
    </div>
@endsection
