<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // 1. Store Invoice
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'pemeriksa' => 'required|string',
            'status' => 'required|in:paid,unpaid',
            'user_id' => 'required|numeric',
            'details' => 'required|array',
            'details.*.description' => 'required|string',
            'details.*.price' => 'required|numeric',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.total' => 'required|numeric',
        ]);

        // Hitung total
        // $total = collect($validatedData['details'])->reduce(function ($carry, $detail) {
        //     return $carry + ($detail['price'] * $detail['quantity']);
        // }, 0);

        // Buat Invoice
        $invoice = Invoice::create([
            'tanggal' => $validatedData['tanggal'],
            'pemeriksa' => $validatedData['pemeriksa'],
            'status' => $validatedData['status'], // Ambil status dari request
            'user_id' => $validatedData['user_id'],
            // 'total' => "1",
        ]);

        // Buat Detail Invoice
        foreach ($validatedData['details'] as $detail) {
            $invoice->details()->create($detail);
        }

        return response()->json($invoice->load('details'), 201);
    }

    // 2. Get All Invoices
    public function index()
    {
        $invoices = Invoice::with('details')->get();
        return response()->json($invoices);
    }

    // 3. Get Single Invoice
    public function show($id)
    {
        $invoice = Invoice::with('details')->where('user_id', $id)->get();

        if ($invoice->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No invoices found for the specified user.',
            ], 404);
        }

        return response()->json($invoice);
    }

    // 4. Update Invoice Status
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'pemeriksa' => 'required|string',
            'details' => 'required|array',
            'details.*.description' => 'required|string',
            'details.*.price' => 'required|numeric',
            'details.*.quantity' => 'required|integer|min:1',
            'status' => 'required|string|in:paid,unpaid',
            'details.*.total' => 'required|numeric',
        ]);

        // Find Invoice
        $invoice = Invoice::findOrFail($id);

        // Update Invoice Data
        $invoice->update([
            'tanggal' => $validatedData['tanggal'],
            'pemeriksa' => $validatedData['pemeriksa'],
            'status' => $validatedData['status'],
        ]);

        // Delete existing details and add new ones
        $invoice->details()->delete();
        foreach ($validatedData['details'] as $detail) {
            $invoice->details()->create($detail);
        }

        return response()->json($invoice->load('details'), 200);
    }

    // 5. Delete Invoice
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(['message' => 'Invoice deleted successfully']);
    }

    public function getByStatus($status)
    {
        // Validasi status
        if (!in_array($status, ['paid', 'unpaid'])) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        // Ambil data invoice berdasarkan status
        $invoices = Invoice::where('status', $status)
            ->with('details')
            ->get();

        return response()->json($invoices, 200);
    }
}
