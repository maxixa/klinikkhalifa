

@extends('layouts.master')

@section('bc')
Data Rawat Kunjungan
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Transaksi Rawat Kunjungan</h3>
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
                            @forelse ($rawatKunjungans as $rawatKunjungan)
                            <tr>
                                <td>{{ sprintf('RK%04d', $rawatKunjungan->id) }}</td>
                                <td><a href="{{ route('rawat-kunjungan.show', $rawatKunjungan->id) }}"><strong>{{ ucfirst($rawatKunjungan->name) }}</strong></a></td>
                                <td>{{ \Carbon\Carbon::parse($rawatKunjungan->date)->format('d M Y') }}</td>
                                <td class="text-right">{{ number_format($rawatKunjungan->total,2, ',', '.') }}</td>
{{--                                  <td>
                                    <form action="{{ route('rawat-inap.destroy', $rawatInap->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn btn-danger btn-sm">Hapus</button>
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