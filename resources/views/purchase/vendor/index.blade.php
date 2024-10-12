@extends('sidebar')

@section('title', 'Purchase')

@section('pageTitle', 'Purchase')
@section('pageSubTitle', 'Vendor')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-9 text-end pb-3">
            <a href="vendor/create" class="btn btn-primary">Tambah Vendor Individual</a>
        </div>
        <div class="col-3 text-end pb-3">
            <a href="vendor/company/create" class="btn btn-primary">Tambah Vendor Company</a>
        </div>
        @foreach ($vendors as $vendor)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="{{ route('vendor.edit', $vendor->id) }}">
                    <a href="{{ $vendor instanceof \App\Models\VendorCompany ? route('company.edit', $vendor->id) : route('vendor.edit', $vendor->id) }}">
                    <div class="card mb-3" style="max-width:540px;">
                        <div class="row g-0">
                            {{-- Add your image display code here if needed --}}
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h5 class="card-title m-0">
                                        {{ $vendor->nama }} <br>
                                        @if ($vendor instanceof \App\Models\VendorIndividual)
                                            Individual
                                        @elseif ($vendor instanceof \App\Models\VendorCompany)
                                            Company
                                        @endif
                                    </h5>
                                    <p class="card-text m-0">Posisi Pekerjaan : {{ $vendor->posisi_pekerjaan }} </p>
                                    <p class="card-text m-0">Nama Perusahaan : {{ $vendor->nama_perusahaan }} </p>
                                    <p class="card-text m-0">Nomor Telefon : {{ $vendor->telp }} </p>
                                    <p class="card-text m-0">Alamat : {{ $vendor->alamat }} </p>
                                    <p class="card-text m-0">Email : {{ $vendor->email }} </p>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
