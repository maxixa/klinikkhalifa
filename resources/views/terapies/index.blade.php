@extends('layouts.master')

@section('bc')
Data Jenis Terapi
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Jenis Terapi</h3>
                <div class="card-tools">
                    <a href="{{ route('terapi.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Biaya</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($terapies as $teraphy)
                            <tr>
                                <td>{{ sprintf('TD%04d', $teraphy->id) }}</td>
                                <td><strong>{{ ucfirst($teraphy->name) }}</strong></td>
                                <td>{{ $teraphy->price }}</td>
                                <td>
                                    <form action="{{ route('terapi.destroy', $teraphy->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ route('terapi.edit', $teraphy->id) }}" 
                                            class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <button class="btn btn-danger btn-sm mt-1">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection