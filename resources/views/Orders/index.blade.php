@extends('layouts.master')

@section('bc')
Data Penjualan
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Penjualan</h3>
                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" width=100%>
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Pasien</th>
                                <th>total (Rp.)</th>
                                <th>tanggal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td>{{ sprintf('JUAL%04d', $order->id) }}</td>
                                <td><strong>{{ ucfirst($order->patient->name) }}</strong></td>
                                <td class="text-right">{{ number_format($order->total,2, ',', '.') }}</td>
                                <td>{{$order->created_at}}</td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Keranjang kosong</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-right"><strong >Rp. {{ number_format($total,2, ',', '.') }}</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection