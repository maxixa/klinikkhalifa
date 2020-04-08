@extends('layouts.master')

@section('bc')
Input Data Terapi
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Input Data Terapi</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('terapi.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @include('terapies.form')
                <button type="submit" class="btn btn-primary">Tambah Terapi</button>
            </form>
        </div>
    </div>
</div>

@endsection