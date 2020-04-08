@extends('layouts.master')

@section('bc')
Input Pembelian Obat Herbal
@endsection

@section('content')

@if($patientObatHerbalTotal > 0)
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Input Obat Herbal</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('obat-herbal.addItem') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="obat_herbal_id">Nama Obat Hebal</label>
                    <select name="obat_herbal_id" id="obat_herbal_id" class="form-control" >
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{ sprintf('OH%04d', $product->id) }} | {{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>{{$errors->first('obat_herbal_id')}}</div>

                <div class="form-group">
                    <label for="qty">Jumlah</label>
                    <input type="number" name="qty" 
                        value="1" 
                        class="form-control {{ $errors->has('qty') ? 'is-invalid':'' }}">
                    <p class="text-danger">{{ $errors->first('qty') }}</p>
                </div>
                
                <button type="submit" class="btn btn-block btn-primary">Tambah Obat Herbal</button>
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

                    </tbody>
                </table>
                
                <form action="{{ route('obat-herbal.store') }}" method="post">
                    <div class="form-group">
                        <label for="date">Tanggal Pembelian</label>
                        <input type="date" (yyyy-mm-dd) name="date" class="form-control" 
                            value="{{\Carbon\Carbon::parse(now())->format('Y-m-d')}}" 
                            class="form-control {{ $errors->has('date') ? 'is-invalid':'' }}">
                        <p class="text-danger">{{ $errors->first('date') }}</p>
                    </div>
                    @if(Cart::instance('obatHerbalCart')->total()>0)
                    <input type="hidden" name="patientId" value="{{ $patient->id }}">
                    <button type="submit" class="btn btn-block btn-success">Simpan Transaksi</button>
                    @csrf
                    @endif
                </form>
            </div>
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
                    <table class="table table-hover" 
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th class="text-right">Harga (Rp.)</th>
                                <th>Jumlah</th>
                                <th class="text-right">Total (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obatHerbalCart as $item)
                            <tr>
                                <td>{{ sprintf('OH%04d', $item->id) }}</td>
                                <td><strong>{{ ucfirst($item->name) }}</strong></td>
                                <td class="text-right">{{ number_format($item->price,2, ',', '.') }}</td>
                                <td class="text-right">{{ $item->qty }}</td>
                                <td class="text-right">{{ number_format($item->subtotal,2, ',', '.') }}</td>
                                <td><a href="{{ route('obat-herbal.removeItem', $item->rowId) }}" class="badge bg-danger">Hapus</a></td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tambah Data Obat Herbal</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td><strong>Grand Total</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
    <h3 class="text-center">Silahkan Pilih Pasien Membeli Obat Herbal 
        <a href="{{ route('pasien.index') }}">Disini</a>
    </h3>
</div>
@endif


@endsection

