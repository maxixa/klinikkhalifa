@extends('layouts.master')

@section('bc')
{{$patient->name}}
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Data {{$patient->name}}</h2>
            <div class="card-tools">
                <form action="{{ route('pasien.destroy', $patient->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <a href="{{ route('pasien.edit', $patient->id) }}" 
                        class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>

                    <button class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Kode</td>
                        <td>: {{ sprintf('PASKAL%04d', $patient->id) }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $patient->gender }}</td>
                    </tr>
                    <tr>
                        <td>Keluhan</td>
                        <td>: {{ $patient->simptom }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $patient->address }}</td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td>: {{ $patient->province }}</td>
                    </tr>
                </tbody>
            </table>
            <p></p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{{ route('patient.obatHerbal', $patient->id) }}">Obat Herbal</a>
            <a class="btn btn-primary" href="{{ route('patient.rawatJalan', $patient->id) }}">Rawat Jalan</a>
            <a class="btn btn-primary" href="{{ route('patient.rawatInap', $patient->id) }}">Rawat Inap</a>
            <a class="btn btn-primary" href="{{ route('patient.rawatKunjungan', $patient->id) }}">Rawat Kunjungan</a>
        </div>
    </div>
</div>


@endsection

