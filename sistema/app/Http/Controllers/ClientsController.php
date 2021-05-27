<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listar()
    {
        return view('clients.list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('clients.register');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {   
        $client = Clients::find($id);
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $clients = Clients::get();
        $response = [
            'status' => 200,
            'response' => $clients 
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
        //
        $validator = Validator::make($request->all(), [
            'names' => 'required',
            'surnames' => 'required',
            'dni' => 'required',
            'description' => 'required',
        ]);
        //dd($validator->fails());
        if ($validator->fails()) {
            $response = [
                'status' => 500,
                'response' => 'Hay algunos campos requeridos faltantes.' 
            ];
            return json_encode($response);
        }

        $newClient = new Clients();
        $newClient->names = $request->input('names');
        $newClient->surnames = $request->input('surnames');
        $newClient->dni = $request->input('dni');
        $newClient->description = $request->input('description');

        $saved = $newClient->save();
        if($saved) {
            $response = [
                'status' => 200,
                'response' => 'Cliente almacenado correctamente' 
            ];
        } else {
            $response = [
                'status' => 500,
                'response' => 'Error al guardar el Cliente' 
            ];
        }
        return json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clients  $clients
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
                'response' => 'Id del usuario requerido.' 
            ];
            return json_encode($response);
        }
        $client = Clients::find($request->input('id'));
        if(is_null($client)) {
            $response = [
                'status' => 500,
                'response' => 'Usuario no encontrado.' 
            ];
        } else {
            $response = [
                'status' => 200,
                'response' => $client
            ];
        }
        return json_encode($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'names' => 'required',
            'surnames' => 'required',
            'dni' => 'required',
            'description' => 'required',
        ]);
        //dd($validator->fails());
        if ($validator->fails()) {
            $response = [
                'status' => 500,
                'response' => 'Id del usuario requerido.' 
            ];
            return json_encode($response);
        }
        $client = Clients::find($request->input('id'));
        if(is_null($client)) {
            $response = [
                'status' => 500,
                'response' => 'Usuario no encontrado.' 
            ];
        } else {
            $client->names = $request->input('names');
            $client->surnames = $request->input('surnames');
            $client->dni = $request->input('dni');
            $client->description = $request->input('description');

            $saved = $client->save();

            $response = [
                'status' => 200,
                'response' =>'Cliente actualizado exitosamente'
            ];
        }
        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients  $clients
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
                'response' => 'Id del usuario requerido.' 
            ];
            return json_encode($response);
        }
        $client = Clients::find($request->input('id'));
        if(is_null($client)) {
            $response = [
                'status' => 500,
                'response' => 'Usuario no encontrado.' 
            ];
        } else {
            $client->delete();
            $response = [
                'status' => 200,
                'response' => 'Cliente eliminado exitosamente'
            ];
        }
        return json_encode($response);
    }
}
