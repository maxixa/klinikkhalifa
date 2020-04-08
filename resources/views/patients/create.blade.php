@extends('layouts.master')

@section('bc')
Input Data Pasien
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Input Data Pasien</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('pasien.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                    @include('patients.createForm')

            </form>
        </div>
    </div>
</div>

@endsection