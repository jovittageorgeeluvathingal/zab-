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

    
    public function insert(Request $request)
{
    // Define the validation rules
    $validatedData = [
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
        'documentation' => 'nullable|string',
        'experience' => 'nullable|string',
        'terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
        'accepted_time' => 'nullable|date',
        'active' => 'nullable|boolean', 
    ];
    // Validate the incoming request data
    $request->validate($validatedData);

    // Create a new TermsAndConditions instance and populate its properties
   $staff  = new Staff;
   $staff->name = $request->name;
   $staff->address = $request->address;
   $staff->phone = $request->phone;
   $staff->password = \Hash::make($request->password);

   $staff->whatsapp = $request->whatsapp;
   $staff->email = $request->email;
   $staff->nationality = $request->nationality;
   $staff->language_speak = $request->language_speak;
   $staff->dob = $request->dob;
   $staff->highest_education = $request->highest_education ;
   $staff->documentation = $request->documentation;
   $staff->experience = $request->experience;
   $staff->terms_and_conditions_id = $request->terms_and_conditions_id;
   $staff->accepted_time = now();#$request->accepted_time;
   
    // Save the TermsAndConditions instance to the database
    $result = $staff->save();
    if ($result) {
        // Return the stored data in JSON format
        return response()->json(['data' => $staff], 200);
    } else {
        // Handle the case where TermsAndConditions creation failed
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
        'active' => 'nullable|boolean', 
        ];
        $staff = Staff::find($id);

        if (!$staff) {
            // If not found, create a new one with default values
            $staff = Staff::create(array_merge(['id' => $id], $defaultValues));
        }
    
        return response()->json(['data' => $staff], 200); 
    }

    public function update(Request $request, $id)
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
            'documentation' => 'nullable|string',
            'experience' => 'nullable|string',
            'terms_and_conditions_id' => 'required|exists:terms_and_conditions,id',
            'accepted_time' => 'nullable|date',
            'active' => 'nullable|boolean',
        ]);
    
        $staff->update($validatedData);
    
        return response()->json(['message' => 'Data updated successfully', 'data' => $staff], 200);
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
{
    $staff = Staff::findOrFail($id);
    $staff->delete();

    return response()->json(['message' => 'Staff data deleted successfully'], 204);
}

/*
public function setActiveStatus(Request $request,$id)
{
    $staff=Staff::findOrFail($id);

    $request->validate([
        'active'=>'required|boolean',
    ]);
    

    $staff->update([
        'active'=> $request->active,
]);

return response()->json(['message' =>'Staff status updated successfully', 'data' =>$staff],200);
}
*/
public function setActiveStatus(Request $request, $id)
{
    $staff = Staff::findOrFail($id);

    $newStatus = $request->input('active');

    if ($newStatus) {
        $staff->active = 0;
    } else {
        $staff->active = 1;
    }

    $staff->save();

    return response()->json(['message' => 'Staff status updated successfully', 'data' => $staff], 200);
}

}


