<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    // Fetch all schedules
    public function index()
    {
        return response()->json(Schedule::all());
    }

    // Create a new schedule
    public function store(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'animal_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'inspector' => 'required|string|max:255',
            'inspection_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create the schedule
        $schedule = Schedule::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $schedule
        ], 201);
    }

    // Get a specific schedule
    public function show(Schedule $schedule)
    {
        return response()->json($schedule);
    }

    // Update an existing schedule
    public function update(Request $request, Schedule $schedule)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'animal_name' => 'string|max:255',
            'location' => 'string|max:255',
            'inspector' => 'string|max:255',
            'inspection_date' => 'date',
            'description' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Update the schedule
        $schedule->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $schedule
        ]);
    }

    // Delete a schedule
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return response()->json(['message' => 'Schedule deleted successfully']);
    }
}
