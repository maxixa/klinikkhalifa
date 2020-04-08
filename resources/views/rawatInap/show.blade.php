
@extends('layouts.master')

@section('bc')
Data Rawat Inap {{sprintf('RI%04d',$rawatInap->id)}}
@endsection

@section('content')




<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rawat Inap {{sprintf('RI%04d',$rawatInap->id)}}</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>: <strong>{{ $rawatInap->name }}</strong></td>
                        </tr>
                        <tr>
                            <td>Tanggal Masuk Rawat</td>
                            <td>: {{  \Carbon\Carbon::parse($rawatInap->dateIn)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Keluar Rawat</td>
                            <td>: {{  \Carbon\Carbon::parse($rawatInap->dateOut)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td>Keluhan</td>
                            <td>: {{ $rawatInap->semptom }}</td>
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
            <form action="{{ route('rawat-inap.destroy', $rawatInap->id) }}" method="POST">
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
            <h3 class="card-title">Dafter Tindakan</h3>

        </div>
        <div class="card-body">
            <div class="card-tools">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Tindakan</th>
                                <th>Terapis</th>
                                <th class="text-right">Biaya (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rawatInap->rawatInapDetails as $item)
                            <tr>
                                <td>{{ sprintf('T%04d', $item->id) }}</td>
                                <td><strong>{{ ucfirst($item->teraphy) }}</strong></td>
                                <td>{{ $item->teraphist }}</td>
                                <td class="text-right">{{ number_format($item->price,2, ',', '.') }}</td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak Ada Data Penanganan Pasien</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Grand Total</td>
                                <td class="text-right">
                                <strong>Rp.{{number_format($rawatInap->total,2, ',', '.')}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

