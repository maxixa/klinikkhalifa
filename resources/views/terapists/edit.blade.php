@extends('layouts.master')

@section('bc')
Ubah Data Terapis
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Pasien</h3>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('terapis.update', $terapist->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                    @include('terapists.editForm')

            </form>
        </div>
    </div>
</div>

@endsection