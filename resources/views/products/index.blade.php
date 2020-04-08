@extends('layouts.master')

@section('bc')
Data Obat Herbal
@endsection

@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Obat Herbal</h3>
      <div class="card-tools">
        <form action="{{ route('produk.index') }}" method="GET">
          @csrf
          <div class="input-group input-group-sm">
            <input type="text" name="search" value="" placeholder="Cari Produk..." class="form-control">
            <span class="input-group-append">
              <button type="submit" class="btn btn-info btn-flat">Cari</button>
            </span>
            <span class="input-group-append"><a href="{{ route('produk.create') }}" class="btn btn-info btn-sm">Tambah</a></span>
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
              <th>Merek</th>
              <th>Satuan</th>
              <th>Stok</th>
              <th>Harga (Rp.)</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $product)
            <tr>
              <td>{{ sprintf('HERBAL%04d', $product->id) }}</td>
              <td><strong>{{ ucfirst($product->name) }}</strong></td>
              <td>{{ $product->merk }}</td>
              <td>{{ $product->satuan }}</td>
              <td>{{ $product->stock }}</td>
              <td class="text-right">{{ number_format($product->price) }}</td>
              <td>
                <form action="{{ route('produk.destroy', $product->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger btn-flat btn-sm">
                    <i class="fa fa-trash"></i>
                  </button>
                </form>
              </td>
              <td>
                <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-warning btn-flat btn-sm">
                  <i class="fa fa-edit"></i>
                </a>
              </td>
              {{--                                  <td>
                                    <form action="{{ route('cart.addItem', $product->id) }}" method="POST">
              @csrf
              <button class="btn btn-primary btn-sm">
                <i class="fa fa-shopping-cart"></i>
              </button>
              </form>
              </td> --}}
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer">
      <div class="col-12 d-flex justify-content-center pt-4 ">
          {{$products->links()}}
      </div>
  </div>
  </div>
</div>

@endsection