@extends('layouts.master')

@section('bc')
Data Terapis
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Terapis</h3>
                <div class="card-tools">
                    <a href="{{ route('terapis.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Provinsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($terapists as $terapist)
                            <tr>
                                <td>{{ sprintf('TERA-KAL%04d', $terapist->id) }}</td>
                                <td><strong>{{ ucfirst($terapist->name) }}</strong></td>
                                <td>{{ $terapist->gender }}</td>
                                <td>{{ $terapist->address }}</td>
                                <td>{{ $terapist->province }}</td>
                                <td>
                                    <form action="{{ route('terapis.destroy', $terapist->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ route('terapis.edit', $terapist->id) }}" 
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