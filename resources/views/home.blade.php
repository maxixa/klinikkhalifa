
@extends('layouts.master')

@section('bc')
Beranda
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Beranda</h3>
                <div class="card-tools">
                    
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <div class="small-box bg-info">
                            <a href="" class="small-box-footer"><h5>Kemarin</h5></a>
                            <div class="inner">
                                <h3 class="text-center">Rp.{{number_format($incomeYesterday,2, ',', '.')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="small-box {{$incomeToday > $incomeYesterday ? 'bg-success' : 'bg-danger'}}">
                            <a href="" class="small-box-footer"><h5>Hari Ini</h5></a>
                            <div class="inner">
                                <h3 class="text-center">Rp.{{number_format($incomeToday,2, ',', '.')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-6">
                        <div class="small-box bg-info">
                            <a href="" class="small-box-footer"><h5>Bulan Lalu</h5></a>
                            <div class="inner">
                                <h3 class="text-center">Rp.{{number_format($incomeLastMonth,2, ',', '.')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="small-box {{$incomeThisMonth > $incomeLastMonth ? 'bg-success' : 'bg-danger'}}">
                            <a href="" class="small-box-footer"><h5>Bulan Ini</h5></a>
                            <div class="inner">
                                <h3 class="text-center">Rp.{{number_format($incomeThisMonth,2, ',', '.')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

@endsection