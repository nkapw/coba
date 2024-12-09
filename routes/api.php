<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/inspections', [InspectionController::class, 'index']);

// Create a new inspection
Route::post('/inspections', [InspectionController::class, 'store']);

// Display a specific inspection
Route::get('/inspections/{inspection}', [InspectionController::class, 'show']);

// Update an existing inspection
Route::put('/inspections/{inspection}', [InspectionController::class, 'update']);

// Delete an inspection
Route::delete('/inspections/{inspection}', [InspectionController::class, 'destroy']);

Route::get('/schedules', [ScheduleController::class, 'index']);           // Get all schedules
Route::post('/schedules', [ScheduleController::class, 'store']);          // Create a new schedule
Route::get('/schedules/{schedule}', [ScheduleController::class, 'show']); // Get a specific schedule
Route::put('/schedules/{schedule}', [ScheduleController::class, 'update']); // Update a schedule
Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy']); // Delete a schedule

Route::get('/invoices', [InvoiceController::class, 'index']);
Route::get('/invoices/{id}', [InvoiceController::class, 'show']);
Route::post('/invoices', [InvoiceController::class, 'store']);
Route::patch('/invoices/{id}/status', [InvoiceController::class, 'updateStatus']);
Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy']);
