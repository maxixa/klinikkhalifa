@extends('layouts.master')

@section('bc')
Input Data Terapi
@endsection

@section('content')

@if($patientRawatJalanTotal > 0)
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Input Penanganan Pasien</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('rawat-jalan.addItem') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="teraphist_id">Terapis</label>
                    <select name="teraphist_id" id="teraphist_id" class="form-control" >
                        @foreach($teraphists as $teraphist)
                        <option value="{{$teraphist->id}}">{{ sprintf('TERA-KAL%04d', $teraphist->id) }} | {{$teraphist->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>{{$errors->first('teraphist_id')}}</div>

                <div class="form-group">
                    <label for="teraphy_id">Terapi</label>
                    <select name="teraphy_id" id="teraphy_id" class="form-control" >
                        @foreach($teraphies as $teraphy)
                        <option value="{{$teraphy->id}}">{{ sprintf('TD%04d', $teraphy->id) }} | {{$teraphy->name}} | Rp.{{number_format($teraphy->price,2, ',', '.')}}</option>
                        @endforeach
                    </select>
                </div>
                <div>{{$errors->first('teraphist_id')}}</div>
                
                <div class="form-group">
                    <label for="">Biaya</label>
                    <input type="number" name="price" 
                        value="{{ old('price') }}" 
                        class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                    <p class="text-danger">{{ $errors->first('price') }}</p>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Penanganan</button>
            </form>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pasien</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <form action="">
                
            </form>
            <div>
                <table class="table">
                    <tbody>
                        
                        <tr>
                            <td>Kode</td>
                            <td>: {{ sprintf('PASKAL%04d', $patient->id) }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: <strong>{{ $patient->name }}</strong></td>
                        </tr>
                        <tr>
                            <td>Keluhan</td>
                            <td>: {{ $patient->options->simptom }}</td>
                        </tr>

                    </tbody>
                </table>
                
                <form action="{{ route('rawat-jalan.store') }}" method="post">
                    <div class="form-group">
                        <label for="">Tanggal Rawat</label>
                        <input type="date" (yyyy-mm-dd) name="date" class="form-control" 
                            value="{{\Carbon\Carbon::parse(now())->format('Y-m-d')}}" 
                            class="form-control {{ $errors->has('date') ? 'is-invalid':'' }}">
                        <p class="text-danger">{{ $errors->first('date') }}</p>
                    </div>
                    @if(Cart::instance('rawatJalanCart')->total()>0)
                    <input type="hidden" name="patientId" value="{{ sprintf($patient->id) }}">
                    <input type="hidden" name="patientName" value="{{$patient->name}}">
                    <input type="hidden" name="patientSimptom" value="{{$patient->options->simptom}}">
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                    @endif
                    @csrf
                </form>
            </div>
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
                    <table class="table table-hover" width=100%>
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Tindakan</th>
                                <th>Terapis</th>
                                <th class="text-right">Harga (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rawatJalanCart as $item)
                            <tr>
                                <td>{{ sprintf('T%04d', $item->id) }}</td>
                                <td><strong>{{ ucfirst($item->name) }}</strong></td>
                                <td>{{ $item->options->teraphist }}</td>
                                <td class="text-right">{{ number_format($item->price,2, ',', '.') }}</td>
                                <td><a href="{{ route('rawat-jalan.removeItem', $item->rowId) }}" class="badge bg-danger">Hapus</a></td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tambah Data Penanganan Pasien</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Grand Total</td>
                                <td class="text-right">
                                <strong>Rp.{{number_format($total,2, ',', '.')}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-md-12">
    <h3 class="text-center">Silahkan Pilih Pasien Rawat Jalan 
        <a href="{{ route('pasien.index') }}">Disini</a>
    </h3>
</div>
@endif


@endsection

