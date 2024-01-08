<?php

namespace App\Http\Controllers\zabevent;

use App\Http\Controllers\Controller;
use App\Models\TermsConditions;
use Illuminate\Http\Request;

class TermandconditionsController extends Controller
{
    public function getbyall()
    {
        $termsAndConditions = TermsConditions::all();
        return response()->json(['data' => $termsAndConditions], 200);
    }
    

    public function getbyid($id)
    {
        $termsAndConditions = Termandconditions::findOrFail($id);
        return response()->json($termsAndConditions);
    }

    public function edit($id)
    {
        $termsAndConditions = term_and_conditions::findOrFail($id);
        return response()->json($termsAndConditions);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'version_name' => 'required|string',
            'version_details' => 'nullable|string',
            'user_type' => 'required|in:staff,client',
        ]);

        $termsAndConditions = term_and_conditions::create($validatedData);
        return response()->json(['data' => $termsAndConditions], 201);
    }

    public function update(Request $request, $id)
    {
        $termsAndCondition = term_and_conditions::findOrFail($id);

        $validatedData = $request->validate([
            'version_name' => 'required|string',
            'version_details' => 'nullable|string',
            'user_type' => 'required|in:staff,client',
        ]);

        $termsAndCondition->update($validatedData);

        return response()->json($termsAndCondition, 200);
    }

    public function delete($id)
    {
        $termsAndCondition = term_and_conditions::findOrFail($id);
        $termsAndCondition->delete();

        return response()->json(null, 204);
    }
}
