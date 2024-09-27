@extends('sidebar')

@section('title', 'Manufaktur')
@section('pageTitle', 'Manufaktur')
@section('pageSubTitle', 'Bills of Materials')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card mx-auto my-5" style="max-width: 70rem;">
        <div class="card-header">
            <div class="text-center fw-bold fs-2 text-black">Order</div>
            <div class="text-end fw-medium fs-5 text-black">Status : {{ $order->status }}</div>
            <div class="text-end mt-2">
                {{-- ORI ISO UTEK UTEK --}}
                {{-- <form action="{{ route('konfirmasi.order', ['id_order' => $order->id_order]) }}" method="post" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </form>
                
                <form action="{{ route('selesai.order', ['id_order' => $order->id_order]) }}" method="post" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">Tandai Selesai</button>
                </form> --}}

                {{-- disable lek status e selesai --}}
                {{-- <form action="{{ route('konfirmasi.order', ['id_order' => $order->id_order]) }}" method="post" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary" {{ $order->status == 'Selesai' ? 'disabled' : '' }}>Konfirmasi</button>
                </form>
                
                <form action="{{ route('selesai.order', ['id_order' => $order->id_order]) }}" method="post" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success" {{ $order->status == 'Selesai' ? 'disabled' : '' }}>Tandai Selesai</button>
                </form> --}}

                <form action="{{ route('konfirmasi.order', ['id_order' => $order->id_order]) }}" method="post" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary" {{ $order->status == 'Selesai' || $order->status == 'Konfirmasi' ? 'disabled' : '' }}>Konfirmasi</button>
                </form>
                
                <form action="{{ route('selesai.order', ['id_order' => $order->id_order]) }}" method="post" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success" {{ in_array($order->status, ['Draft', 'Selesai']) ? 'disabled' : '' }}>Tandai Selesai</button>
                </form>
                
            </div>
        </div>
        
        <div class="card-body">
            <div class="row p-2 mt-2">
                <div class="col-sm-6 col-md-8">
                    <p class="fw-bold m-0">Detail Order</p>
                    <p class="m-0">WH/MO/{{ $order->id_order }}</p>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Produk</th>
                        <th scope="col">Jumlah Produk</th>
                        <th scope="col"></th>
                        <th scope="col">Bahan</th>
                        <th scope="col">Jumlah Bahan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->nama_produk }}</td>
                        <td>{{ $order->jumlah_produk }}</td>
                        <td colspan="3"></td>
                        @foreach ($order->nama_bahan as $index => $bahan)
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    {{ $bahan }}
                                </td>
                                <td>{{ $order->jumlah_bahan[$index] }}</td> {{-- Menampilkan jumlah_bahan yang sesuai dengan nama_bahan --}}
                            </tr>
                        @endforeach
                        {{-- @if (is_array($order->nama_bahan) && is_array($order->jumlah_bahan))
                        <tr>
                            <td>
                                @foreach ($order->nama_bahan as $nama)
                                    {{ $nama }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($order->jumlah_bahan as $jumlah)
                                    {{ $jumlah }}<br>
                                @endforeach
                            </td>
                        @else
                            <td>{{ $order->nama_bahan }}</td>
                            <td>{{ $order->jumlah_bahan }}</td>
                        @endif --}}
                        </tr>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('manufaktur.edit', ['id_order' => $order->id_order]) }}" class="btn btn-warning">Edit</a>

                {{-- <a href="#" target="_blank" class="btn btn-secondary btn-sm">Print</a> --}}
                {{-- <button type="submit" class="btn btn-warning btn-sm">Edit</button> --}}
                {{-- @if (isset($bom))
                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                @endif --}}
                <form action="{{ route('manufaktur.order-detail.destroy', ['id_order' => $order->id_order]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
