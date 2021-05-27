@extends('layouts.app')

@section('content')
            <div class="card text-white">
                <div class="card-header bg-main">
                <div class="row my-4">
                    <div class="col-6">
                   <h2>{{ __('Peliculas') }}</h2>
                    </div>
                    <div class="col-6 text-end">
                    <a class="btn btn-outline-light" href="/peliculas/registrar" role="button">REGISTRAR</a>
                    </div>
                </div> 
                <table class="table text-white mb-1">
                <thead>
                    <tr>
                    <th class="col-1"></th>
                    <th class="col-2">Titulo</th>
                    <th class="col-2 text-center">Cateogoria</th>
                    <th class="col-2 text-center">Año</th>
                    <th class="col-1 text-center">Copias</th>
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
                    <List-Movies />
                </div>
            </div>
@endsection