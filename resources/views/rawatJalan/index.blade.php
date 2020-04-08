@extends('layouts.master')

@section('bc')
Data Rawat Jalan
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Transaksi Rawat Jalan</h3>
                <div class="card-tools">
                    
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Pasien</th>
                                <th>Tanggal</th>
                                <th class="text-right">Total Biaya (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rawatJalans as $rawatJalan)
                            <tr>
                                <td>{{ sprintf('RJ%04d', $rawatJalan->id) }}</td>
                                <td><a href="{{ route('rawat-jalan.show', $rawatJalan->id) }}"><strong>{{ ucfirst($rawatJalan->name) }}</strong></a></td>
                                <td>{{ \Carbon\Carbon::parse($rawatJalan->date)->format('d M Y') }}</td>
                                <td class="text-right">{{ number_format($rawatJalan->total,2, ',', '.') }}</td>
{{--                                  <td>
                                    <form action="{{ route('rawat-jalan.destroy', $rawatJalan->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn btn-block btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>  --}}
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection