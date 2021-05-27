@extends('layouts.app')

@section('content')
<div class="card text-white">
    <div class="card-header bg-main">
        <div class="row my-2">
            <div class="col-6">
                <h2>{{ __('Editar Cliente') }}</h2>
            </div>
            <div class="col-6 text-end">
                <!-- <a class="btn btn-outline-light" href="/clientes/registrar" role="button">REGISTRAR</a> -->
            </div>
        </div>
    </div>

    <div class="card-body text-dark" style="overflow-y: scroll; height: 600px;">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <Form-Rentals :data="{{ $rental }}" :mode="'edit'" />        
    </div>
</div>
@endsection
