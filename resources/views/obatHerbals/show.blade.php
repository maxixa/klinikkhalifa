@extends('layouts.master')

@section('bc')
Data Rawat Jalan {{sprintf('POH%04d',$obatHerbal->id)}}
@endsection

@section('content')




<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Obat Herbal {{sprintf('POH%04d',$obatHerbal->id)}}</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>: <strong>{{ $obatHerbal->name }}</strong></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pembelian</td>
                            <td>: {{  \Carbon\Carbon::parse($obatHerbal->date)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Aksi</h3>
            <div class="card-tools">

            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('obat-herbal.destroy', $obatHerbal->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-block btn-danger btn-sm">
                    <i class="fa fa-trash"></i><span> Hapus</span>  
                </button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dafter Obat Herbal</h3>

        </div>
        <div class="card-body">
            <div class="card-tools">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Obat</th>
                                <th class="text-right">Harga (Rp.)</th>
                                <th>Jumlah</th>
                                <th class="text-right">Total (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obatHerbal->obatHerbalDetails as $item)
                            <tr>
                                <td>{{ sprintf('OH%04d', $item->id) }}</td>
                                <td><strong>{{ ucfirst($item->name) }}</strong></td>
                                <td class="text-right">{{ number_format($item->price,2, ',', '.') }}</td>
                                <td>{{ $item->qty }}</td>
                                <td class="text-right">{{ number_format($item->subtotal,2, ',', '.') }}</td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak Ada Data Penanganan Pasien</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Grand Total</strong></td>
                                <td class="text-right">
                                <strong>Rp.{{number_format($obatHerbal->total,2, ',', '.')}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

