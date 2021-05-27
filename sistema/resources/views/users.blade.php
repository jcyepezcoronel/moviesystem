@extends('layouts.app')

@section('content')
            <div class="card h-75">
                <div class="card-header">{{ __('Usuarios') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    
                    <example-component></example-component>
                </div>
            </div>
@endsection
