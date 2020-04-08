@extends('layouts.master')

@section('bc')
Ubah Data Terapi
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Terapi</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('terapi.update', $teraphy->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                @include('terapies.form')
                <button type="submit" class="btn btn-primary">Ubah Terapi</button>
            </form>
        </div>
    </div>
</div>

@endsection