<?php

namespace App\Http\Controllers\Zab;

use App\Http\Controllers\Controller;
use App\Models\TermsAndConditions;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function getbyall()
    {
        $termsAndConditions = TermsAndConditions::all();
        return response()->json(['data' => $termsAndConditions], 200); // data is found '200'
    }

    public function getbyid($id)
    {
        $termsAndConditions = TermsAndConditions::findOrFail($id);
        return response()->json($termsAndConditions);
    }

    public function Insert(Request $request)
    {
        // Validate the request data
        $validatedData =([
            'version_name' => 'required|string',
            'version_details' => 'nullable|string',
            'user_type' => 'required|in:staff,client',
        ]);

        $request->validate($validatedData);   

        $terms = new TermsAndConditions;
        $terms->version_name = $request->version_name;
        $terms->version_details = $request->version_details;
        $terms->user_type = $request->user_type;
        // Save the TermsAndConditions instance to the database
        $result = $terms->save();
        
        if ($result) {
            // Return the stored data in JSON format
            return response()->json(['data' => $terms], 200);
        } else {
            // Handle the case where TermsAndConditions creation failed
            return response()->json(['error' => 'Failed to save Terms and Conditions data'], 500);
        }
    }

    public function edit($id)
{
    $defaultValues = [
        'version_name' => 'Default Version',
        'version_details' => 'Default Details',
        'user_type' => 'staff',
    ];

    // Check if the record with the given $id exists
    $termsAndConditions = TermsAndConditions::find($id);

    if (!$termsAndConditions) {
        // If not found, create a new one with default values
        $termsAndConditions = TermsAndConditions::create(array_merge(['id' => $id], $defaultValues));
    }

    return response()->json(['data' => $termsAndConditions], 200);
}


    public function store(Request $request)
{
    $validatedData = $request->validate([
        'version_name' => 'required|string',
        'version_details' => 'nullable|string',
        'user_type' => 'required|in:staff,client',
    ]);
 
    $termsAndConditions = TermsAndConditions::create($validatedData);
    return response()->json(['data' => $termsAndConditions], 201);
}


    public function update(Request $request, $id)
    {
        $termsAndConditions = TermsAndConditions::findOrFail($id);

        $validatedData = $request->validate([
            'version_name' => 'required|string',
            'version_details' => 'nullable|string',
            'user_type' => 'required|in:staff,client',
        ]);

        $termsAndConditions->update($validatedData);

        return response()->json($termsAndConditions, 200);
    }

    public function delete($id)
    {
        $termsAndCondition = TermsAndConditions::findOrFail($id);
        $termsAndCondition->delete();

        return response()->json(null, 204);
    }
}
