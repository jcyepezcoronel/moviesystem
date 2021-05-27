<?php

namespace App\Http\Controllers;

use App\Models\rentals;
use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentalsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listar()
    {
        return view('rentals.list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('rentals.register');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {   
        $rental = rentals::find($id);
        return view('rentals.edit', ['rental' => $rental]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $rentals = rentals::join('clients','clients.id','=','rentals.client_id')
                            ->join('movies','movies.id','=','rentals.movie_id')
                            ->select('rentals.*', 'clients.names as clientnames', 
                                    'clients.surnames as clientsurnames',
                                    'movies.title as movietitle')
                            ->get();
        $response = [
            'status' => 200,
            'response' => $rentals 
        ];
        return json_encode($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'movie_id' => 'required',
            'delivery_date' => 'required',
            'return_date' => 'required',
        ]);
        //dd($validator->fails());
        if ($validator->fails()) {
            $response = [
                'status' => 500,
                'response' => 'Hay algunos campos requeridos faltantes.' 
            ];
            return json_encode($response);
        }

        $movie = Movies::find($request->input('movie_id'));
        if($movie->number_copies <= 0){
            $response = [
                'status' => 500,
                'response' => 'No hay disponibilidad de esta pelicula.' 
            ];
            return json_encode($response);
        }

        $newRental = new rentals();
        $newRental->client_id = $request->input('client_id');
        $newRental->movie_id = $request->input('movie_id');
        $newRental->delivery_date = $request->input('delivery_date');
        $newRental->return_date = $request->input('return_date');
        $newRental->description = $request->input('description');

        $saved = $newRental->save();
        if($saved) {
            $movie->number_copies = $movie->number_copies - 1;
            $movie->save();
            $response = [
                'status' => 200,
                'response' => 'Renta almacenada correctamente' 
            ];
        } else {
            $response = [
                'status' => 500,
                'response' => 'Error al guardar el Renta' 
            ];
        }
        return json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rentals  $rentals
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        //dd($validator->fails());
        if ($validator->fails()) {
            $response = [
                'status' => 500,
                'response' => 'Id de renta requerido.' 
            ];
            return json_encode($response);
        }
        $renta = rentals::join('clients','clients.id','=','rentals.client_id')
                        ->join('movies','movies.id','=','rentals.movie_id')
                        ->select('rentals.*', 'clients.names as clientnames', 
                                'clients.surnames as clientsurnames',
                                'movies.title as movietitle')
                        ->where('movies.id',$request->input('id'))->first();
        if(is_null($renta)) {
            $response = [
                'status' => 500,
                'response' => 'Renta no encontrada.' 
            ];
        } else {
            $response = [
                'status' => 200,
                'response' => $renta
            ];
        }
        return json_encode($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rentals  $rentals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'delivery_date' => 'required',
            'return_date' => 'required',
        ]);
        //dd($validator->fails());
        if ($validator->fails()) {
            $response = [
                'status' => 500,
                'response' => 'Id de renta requerido.' 
            ];
            return json_encode($response);
        }
        $rental = rentals::find($request->input('id'));
        if(is_null($rental)) {
            $response = [
                'status' => 500,
                'response' => 'Renta no encontrada.' 
            ];
        } else {
            $rental->delivery_date = $request->input('delivery_date');
            $rental->return_date = $request->input('return_date');

            $saved = $rental->save();

            $response = [
                'status' => 200,
                'response' =>'Renta actualizada exitosamente'
            ];
        }
        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rentals  $rentals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        //dd($validator->fails());
        if ($validator->fails()) {
            $response = [
                'status' => 500,
                'response' => 'Id de renta requerido.' 
            ];
            return json_encode($response);
        }
        $rental = rentals::find($request->input('id'));
        if(is_null($rental)) {
            $response = [
                'status' => 500,
                'response' => 'Renta no encontrada.' 
            ];
        } else {
            $rental->delete();
            $response = [
                'status' => 200,
                'response' => 'Renta eliminada exitosamente'
            ];
        }
        return json_encode($response);
    }
}
