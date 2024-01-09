<?php

namespace App\Http\Controllers\Zab;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    
    public function getbyall()
    {
        $staff = Staff::all();
        return response()->json(['data' => $staff],200);
    }
    
    public function getbyid($id)
    {
        $staff = Staff::findOrFail($id);
        return response()->json(['data' => $staff]); 
    }

    
    public function Insert(Request $request)
{
    // Define the validation rules
    $validatedData = ([
        'name' => 'required|string',
        'address' => 'nullable|string',
        'phone' => 'nullable|string',
        'password' => 'required|string',
        'whatsapp' => 'nullable|string',
        'email' => 'required|email|unique:staff',
        'nationality' => 'nullable|string',
        'language_speak' => 'nullable|string',
        'dob' => 'nullable|date',
        'highest_education' => 'nullable|string',
        'documentation' => 'nullable|boolean',
        'experience' => 'nullable|string',
        'Terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
        'accepted_time' => 'nullable|date',
    ]);
    // Validate the incoming request data
    $request->validate($validatedData);

    // Create a new staff instance and populate its properties
   $staff  = new Staff;

   $staff->name = $request->name;
   $staff->address = $request->address;
   $staff->phone = $request->phone;
   $staff->password = $request->password;
   $staff->whatsapp = $request->whatsapp;
   $staff->email = $request->email;
   $staff->nationality = $request->nationality;
   $staff->language_speak = $request->language_speak;
   $staff->dob = $request->dob;
   $staff->highest_education = $request->highest_education ;
   $staff->documentation = $request->documentation;
   $staff->experience = $request->experience;
   $staff->Terms_and_conditions_id = $request->Terms_and_conditions_id;
   $staff->accepted_time = $request->accepted_time;

    
    $result = $staff->save();
    if ($result) {
        // Return the stored data in JSON format
        return response()->json(['data' => $staff], 200);
    } else {
        // Handle the case where staff creation failed
        return response()->json(['error' => 'Failed to save staff data'], 500);
    }
}
    public function edit( $id)
    {
        $defaultValues = [
        'name' => 'required|string',
        'address' => 'nullable|string',
        'phone' => 'nullable|string',
        'password' => 'required|string',
        'whatsapp' => 'nullable|string',
        'email' => 'required|email|unique:staff',
        'nationality' => 'nullable|string',
        'language_speak' => 'nullable|string',
        'dob' => 'nullable|date',
        'highest_education' => 'nullable|string',
        'documentation' => 'nullable|boolean',
        'experience' => 'nullable|string',
        'terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
        'accepted_time' => 'nullable|date',
        ];
        $staff = Staff::find($id);

        if (!$staff) {
            // If not found, create a new one with default values
            $staff = Staff::create(array_merge(['id' => $id], $defaultValues));
        }
    
        return response()->json(['data' => $staff], 200); 
    }

   
    public function update(Request $request,$id)
    {
        $staff = Staff::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'password' => 'required|string',
            'whatsapp' => 'nullable|string',
            'email' => 'required|email|unique:staff,Email,' . $id,
            'nationality' => 'nullable|string',
            'language_speak' => 'nullable|string',
            'dob' => 'nullable|date',
            'highest_education' => 'nullable|string',
            'documentation' => 'nullable|boolean',
            'experience' => 'nullable|string',
            'terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
            'accepted_time' => 'nullable|date',
        ]);

        $staff->update($validatedData);

        return response()->json($staff, 200);  
    }


    public function delete($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return response()->json(null, 204);
    }
}
