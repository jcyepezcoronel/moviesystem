@extends('layouts.app')

@section('content')
            <div class="card bg-main text-white">
                <div class="card-header"><h2>{{ __('Bienvenido') }}</h2></div>

                <div class="card-body" style="overflow-y: scroll;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Component Vue -->
                    <img src="{{url('/images/1366_2000.jpeg')}}" class="img-fluid" alt="Peliculas">
                </div>
            </div>
@endsection
