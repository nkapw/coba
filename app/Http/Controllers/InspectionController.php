<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Inspection::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'animal' => 'required|string',
            'cage_treatment' => 'required|string',
            'date' => 'required|string',
            'environmental_care' => 'required|string',
            'feeding' => 'required|string',
            'medical_treatment' => 'required|string',
            'inspector' => 'required|string',
            'location' => 'required|string',
            'suggestion' => 'required|string',
            'result' => 'required|string',
        ]);
        $inspection = Inspection::create($validatedData);

        return response()->json($inspection, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inspection $inspection)
    {
        return response()->json($inspection, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inspection $inspection)
    {
        $validatedData = $request->validate([
            'animal' => 'string',
            'cage_treatment' => 'string',
            'date' => 'date',
            'environmental_care' => 'string',
            'feeding' => 'string',
            'medical_treatment' => 'string',
            'inspector' => 'string',
            'location' => 'string',
            'suggestion' => 'string',
            'result' => 'string',            
        ]);
    
        $inspection->update($validatedData);
    
        return response()->json($inspection, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspection $inspection)
    {
        //
    }
}
