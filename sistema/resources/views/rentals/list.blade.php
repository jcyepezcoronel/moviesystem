@extends('layouts.app')

@section('content')
            <div class="card text-white">
                <div class="card-header bg-main">
                <div class="row my-4">
                    <div class="col-6">
                   <h2>{{ __('Alquiler') }}</h2>
                    </div>
                    <div class="col-6 text-end">
                    <a class="btn btn-outline-light" href="/alquiler/registrar" role="button">REGISTRAR</a>
                    </div>
                </div> 
                <table class="table text-white mb-1">
                <thead>
                    <tr>
                    <th class="col-2 text-left">Cliente</th>
                    <th class="col-2 text-center">Pelicula</th>
                    <th class="col-2 text-center">F. Inicio</th>
                    <th class="col-2 text-center">F. Devolución</th>
                    <th class="col-2">Descripción</th>
                    <th class="col-2 text-center">Acciones</th>
                    </tr>
                </thead>
                </table>
                </div>
                <div class="card-body" style="overflow-y: scroll; max-height: 600px;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Component Vue -->
                    <List-Rentals />
                </div>
            </div>
@endsection