<?php

namespace App\Http\Controllers\Zab;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getbyall()
    {
        $clients = Client::all();
        return response()->json(['data' => $clients],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getbyid($id)
    {
        $clients = Client::findOrFail($id);
        return response()->json(['data' => $clients]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        // Validate the request data
    $validatedData = ([
        'name' => 'required|string',
        'email' => 'required|email|unique:clients',
        'phone' => 'nullable|string',
        'password' => 'required|string',
        'whatsapp' => 'nullable|string',
        'occupation' => 'nullable|string',
        'companyname' => 'nullable|string',
        'terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
        'accepted_time' => 'nullable|date',
    ]);

    $request->validate($validatedData);

    $client = new Client;

    $client->name = $request->name;
    $client->email = $request->email;
    $client->phone = $request->phone;
    $client->password = $request->password;
    $client->whatsapp = $request->whatsapp;
    $client->occupation = $request->occupation;
    $client->companyname = $request->companyname;
    $client->terms_and_conditions_id = $request->terms_and_conditions_id;
    $client->accepted_time = $request->accepted_time;

    // Save the Client instance to the database
    $result = $client->save();

    if ($result) {
        // Return the stored data in JSON format
        return response()->json(['message' => 'Client data inserted successfully','data' => $client], 200);
    } else {
        // Handle the case where client creation failed
        return response()->json(['error' => 'Failed to save client data'], 500);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $defaultValues = ([
            'name' => 'required|string',
            'email' => 'required|email|unique:clients,Email,' . $id,
            'phone' => 'nullable|string',
            'password' => 'required|string',
            'whatsapp' => 'nullable|string',
            'occupation' => 'nullable|string',
            'companyname' => 'nullable|string',
            'terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
            'accepted_time' => 'nullable|date',
        ]);
        $client = Client::find($id);

        if (!$client) {
            // If not found, create a new one with default values
            $client = Client::create(array_merge(['id' => $id], $defaultValues));
        }
    
        return response()->json(['data' => $client], 200); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $client = Client::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:clients,Email,' . $id,
            'phone' => 'nullable|string',
            'password' => 'required|string',
            'whatsapp' => 'nullable|string',
            'occupation' => 'nullable|string',
            'companyname' => 'nullable|string',
            'terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
            'accepted_time' => 'nullable|date',
            
        ]);

        $client->update($validatedData);

        return response()->json($client, 200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function delete( $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(null, 204);
    }
}