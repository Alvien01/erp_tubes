@extends('sidebar')

@section('title', 'Sales')

@section('pageTitle', 'Sales')
@section('pageSubTitle', 'Customer')

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
            <a href="customer/create-individual" class="btn btn-primary">Tambah Customer Individual</a>
        </div>
        <div class="col-3 text-end pb-3">
            <a href="customer/create-company" class="btn btn-primary">Tambah Customer Company</a>
        </div>
        @foreach ($customer as $customer)
            <div class="col-lg-4 col-md-6 col-sm-6">
                {{-- <a href="{{ route('vendor.edit', $vendor->id) }}"> --}}
                    <a href="{{ $customer instanceof \App\Models\CustomerCompany ? route('company.edit', $customer->id) : route('individual.edit', $customer->id) }}">
                    <div class="card mb-3" style="max-width:540px;">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title m-0">
                                        {{ $customer->nama }} <br>
                                        @if ($customer instanceof \App\Models\CustomerIndividual)
                                            Individual
                                        @elseif ($customer instanceof \App\Models\CustomerCompany)
                                            Company
                                        @endif
                                    </h5>
                                    <p class="card-text m-0">{{ $customer->posisi_pekerjaan }} </p>
                                    <p class="card-text m-0">{{ $customer->nama_perusahaan }} </p>
                                    <p class="card-text m-0">{{ $customer->telp }} </p>
                                    <p class="card-text m-0">{{ $customer->alamat }} </p>
                                    <p class="card-text m-0">{{ $customer->email }} </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
