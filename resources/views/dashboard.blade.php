@extends('sidebar')

@section('title', 'Dashboard')
@section('pageTitle', 'Dashboard')
@section('pageSubTitle', '')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
          <div class="card-header">Produk</div>
          <div class="card-body">
            <h5 class="card-title">Banyak Produk</h5>
            <p class="card-text"></p>
          </div>
        </div>
    </div>
    <div class="col-md-3">
    <div class="card text-bg-info mb-3 " style="max-width: 18rem;">
          <div class="card-header">Order</div>
          <div class="card-body">
            <h5 class="card-title">Jumlah Order</h5>
            <p class="card-text"></p>
          </div>
        </div>
    </div>
    <div class="col-md-3">
    <div class="card text-bg-light mb-3 " style="max-width: 18rem;">
          <div class="card-header">Pelanggan</div>
          <div class="card-body">
            <h5 class="card-title">Jumlah Pelanggan</h5>
            <p class="card-text"></p>
          </div>
        </div>
    </div>
  </div>
  <div class="col-md-3">
      <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
          <div class="card-header">Transaksi</div>
          <div class="card-body">
            <h5 class="card-title">Jumlah Transaksi</h5>
            <p class="card-text"></p>
          </div>
        </div>
    </div>
      </div>
</div>
@endsection