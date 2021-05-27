<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MoviesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listar()
    {
        return view('movies.list');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listCategories()
    {
        $categories = Categories::get();
        return json_encode($categories);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('movies.register');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {   
        $movie = Movies::find($id);
        return view('movies.edit', ['movie' => $movie]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $movies = Movies::join('categories','categories.id','=','movies.category_id')
        ->addSelect('categories.id as category_id', 'categories.name as category', 'movies.*')
        ->get();
        $response = [
            'status' => 200,
            'response' => $movies 
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
            'title' => 'required',
            'category_id' => 'required',
            'year' => 'required',
            'description' => 'required',
            'number_copies' => 'required',
            'image' => 'required',
        ]);
        //dd($validator->fails());
        if ($validator->fails()) {
            $response = [
                'status' => 500,
                'response' => 'Hay algunos campos requeridos faltantes.' 
            ];
            return json_encode($response);
        }
        if(strlen($request->input('year')) != 4 || !is_numeric($request->input('year'))){
            $response = [
                'status' => 500,
                'response' => 'Formato de año incorrecto.' 
            ];
            return json_encode($response);
        }

        $newMovie = new Movies();
        $newMovie->title = $request->input('title');
        $newMovie->category_id = $request->input('category_id');
        $newMovie->year = $request->input('year');
        $newMovie->image = $request->input('image');
        $newMovie->description = $request->input('description');
        $newMovie->number_copies = $request->input('number_copies');

        $saved = $newMovie->save();
        if($saved) {
            $response = [
                'status' => 200,
                'response' => 'Pelicula almacenado correctamente' 
            ];
        } else {
            $response = [
                'status' => 500,
                'response' => 'Error al guardar el Pelicula' 
            ];
        }
        return json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movies  $movies
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
                'response' => 'Id de pelicula requerido.' 
            ];
            return json_encode($response);
        }
        $movie = Movies::join('categories','categories.id','=','movies.category_id')
                        ->where('movies.id',$request->input('id'))->first();
        if(is_null($movie)) {
            $response = [
                'status' => 500,
                'response' => 'Pelicula no encontrada.' 
            ];
        } else {
            $response = [
                'status' => 200,
                'response' => $movie
            ];
        }
        return json_encode($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'year' => 'required',
            'description' => 'required',
            'number_copies' => 'required',
            'image' => 'required',
        ]);
        //dd($validator->fails());
        if ($validator->fails()) {
            $response = [
                'status' => 500,
                'response' => 'Id de pelicula requerido.' 
            ];
            return json_encode($response);
        }
        $movie = Movies::find($request->input('id'));
        if(is_null($movie)) {
            $response = [
                'status' => 500,
                'response' => 'Pelicula no encontrada.' 
            ];
        } else {
            $movie->title = $request->input('title');
            $movie->category_id = $request->input('category_id');
            $movie->year = $request->input('year');
            $movie->number_copies = $request->input('number_copies');
            $movie->description = $request->input('description');
            $movie->image = $request->input('image');

            $saved = $movie->save();

            $response = [
                'status' => 200,
                'response' =>'Pelicula actualizada exitosamente'
            ];
        }
        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movies  $movies
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
                'response' => 'Id de pelicula requerido.' 
            ];
            return json_encode($response);
        }
        $movie = Movies::find($request->input('id'));
        if(is_null($movie)) {
            $response = [
                'status' => 500,
                'response' => 'Pelicula no encontrada.' 
            ];
        } else {
            $movie->delete();
            $response = [
                'status' => 200,
                'response' => 'Pelicula eliminada exitosamente'
            ];
        }
        return json_encode($response);
    }
}
