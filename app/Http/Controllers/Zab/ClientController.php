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
        'Name' => 'required|string',
        'Email' => 'required|email|unique:clients',
        'Phone' => 'nullable|string',
        'Password' => 'required|string',
        'Whatsapp' => 'nullable|string',
        'Occupation' => 'nullable|string',
        'Companyname' => 'nullable|string',
        'Terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
        'Accepted_time' => 'nullable|date',
    ]);

    $request->validate($validatedData);

    $client = new Client;

    $client->Name = $request->Name;
    $client->Email = $request->Email;
    $client->Phone = $request->Phone;
    $client->Password = $request->Password;
    $client->Whatsapp = $request->Whatsapp;
    $client->Occupation = $request->Occupation;
    $client->Companyname = $request->Companyname;
    $client->Terms_and_conditions_id = $request->Terms_and_conditions_id;
    $client->Accepted_time = $request->Accepted_time;

    // Save the Client instance to the database
    $result = $client->save();

    if ($result) {
        // Return the stored data in JSON format
        return response()->json(['data' => $client], 200);
    } else {
        // Handle the case where client creation failed
        return response()->json(['error' => 'Failed to save client data'], 500);
    }
    }

    
    public function edit( $id)
    {
        $defaultValues = [
            'Name' => 'required|string',
            'Email' => 'required|email|unique:clients,Email,' . $id,
            'Phone' => 'nullable|string',
            'Password' => 'required|string',
            'Whatsapp' => 'nullable|string',
            'Occupation' => 'nullable|string',
            'Companyname' => 'nullable|string',
            'Terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
            'Accepted_time' => 'nullable|date',
        ];
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
            'Name' => 'required|string',
            'Email' => 'required|email|unique:clients,Email,' . $id,
            'Phone' => 'nullable|string',
            'Password' => 'required|string',
            'Whatsapp' => 'nullable|string',
            'Occupation' => 'nullable|string',
            'Companyname' => 'nullable|string',
            'Terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
            'Accepted_time' => 'nullable|date',
            
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
