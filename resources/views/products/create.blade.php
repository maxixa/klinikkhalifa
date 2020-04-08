@extends('layouts.master')

@section('bc')
Input Data Obat Herbal
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Input Data Obat Herbal</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                    @include('products.createForm')

            </form>
        </div>
    </div>
</div>

@endsection