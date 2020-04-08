@extends('layouts.master')

@section('bc')
Data Pasien
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pasien</h3>
            <div class="card-tools">
                <form action="{{ route('pasien.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" value="" placeholder="Cari Pasien..." class="form-control">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat">Cari</button>
                        </span>
                        <span class="input-group-append">
                            <a href="{{ route('pasien.create') }}" class="btn btn-info btn-sm">Tambah</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Provinsi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($patients as $patient)
                        <tr>
                            <td>{{ sprintf('PASKAL%04d', $patient->id) }}</td>
                            <td><a
                                    href="{{ route('pasien.show', $patient->id) }}"><strong>{{ ucfirst($patient->name) }}</strong></a>
                            </td>
                            <td>{{ $patient->province }}</td>
                            <td>
                                <form action="{{ route('pasien.destroy', $patient->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <a href="{{ route('pasien.edit', $patient->id) }}" class="btn btn-warning btn-sm">
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
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12 d-flex justify-content-center pt-4 ">
                {{$patients->links()}}
            </div>
        </div>
    </div>
</div>

@endsection