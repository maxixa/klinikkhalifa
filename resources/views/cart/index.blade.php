@extends('layouts.master')

@section('bc')
Transaksi
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Transaksi</h3>
                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" width=100%>
                        <thead>
                            <tr>
                                <th width=10%>Kode</th>
                                <th width=20%>Nama</th>
                                <th width=20%>Harga Satuan (Rp.)</th>
                                <th width=10%>Jumlah</th>
                                <th width=20%>Jumblah Harga (Rp.)</th>
                                <th width=20%></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($carts as $item)
                            <tr>
                                <td>{{ sprintf('HERBAL%04d', $item->id) }}</td>
                                <td><strong>{{ ucfirst($item->name) }}</strong></td>
                                <td class="text-right">{{ number_format($item->price,2, ',', '.') }}</td>
                                    <td><form action="{{ route('cart.updateItem', $item->rowId) }}" class="form-group" method="POST">
                                        @csrf
                                        <span><input name="qty" type="number" value="{{ $item->qty }}" class="form-control" size="3"></span>
                                        <input type="hidden" name="rowId" value="{{$item->rowId}}" id="rowID{{$item->id}}"/>
                                        <span><button class="btn btn-primary btn-sm mt-1">Ubah</button></span>
                                    </form>
                                    
                                </td>
                                <td class="text-right">{{ number_format($item->subtotal,2, ',', '.') }}</td>
                                <td class="text-right" width=10%>
                                    <form action="{{ route('cart.removeItem', $item->rowId) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm mt-1">Hapus</button>
                                    </form>
                                    
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Keranjang kosong</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">
                                <strong>Rp.{{$total}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    @if($total > 0)
                    <div>
                        <a href="{{ route('cart.destroy') }}" class="btn btn-danger btn-sm">Kosongkan Keranjang</a>
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <select name="patient" id="" class="form-control">
                                <option value="" disabled selected>Nama Pasien</option>
                                @foreach($patients as $patient)
                                <option value="{{$patient->id}}">{{$patient->name}}</option>
                                @endforeach
                            </select>
                            
                            <button class="btn btn-primary btn-sm mt-1">Bayar</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
    $(document).ready(function(){
        @forelse ($carts as $item)
        $("#upCart{{$item->id}}").on('chenge keyup', function(){
            var newQty = $("#upCart{{$item->id}}").val();
        });
        @empty
        @endforelse
    });
</script>
@endsection