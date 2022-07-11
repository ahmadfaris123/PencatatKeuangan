@extends('main')

@section('container')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">HOME</h1>
    </div>
    <div class="container-fluid">
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Jumlah Saldo</h4>
                        <div class="text-right">
                            <h2 class="font-weight-light mb-0"> {{$saldo}}</h2>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Pemasukan</h4>
                        <div class="text-right">
                            <h2 class="font-weight-light mb-0"> {{$transaksiIN}}</h2>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Pengeluaran</h4>
                        <div class="text-right">
                            <h2 class="font-weight-light mb-0"> {{$transaksiOUT}}</h2>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <!-- Column -->
        </div>
        <!-- Row -->
    </div>
</main>
@endsection