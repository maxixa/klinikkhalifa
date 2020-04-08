@extends('layouts.master')

@section('bc')
Ubah Data Obat Herbal
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Obat Herbal</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('produk.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                    @include('products.editForm')

            </form>
        </div>
    </div>
</div>

@endsection