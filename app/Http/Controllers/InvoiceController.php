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
        $invoice = Invoice::with('details')->findOrFail($id);
        return response()->json($invoice);
    }

    // 4. Update Invoice Status
    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:paid,unpaid',
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->update(['status' => $validatedData['status']]);

        return response()->json($invoice);
    }

    // 5. Delete Invoice
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(['message' => 'Invoice deleted successfully']);
    }

    public function getByStatus(Request $request)
    {
        // Validasi query parameter status
        $validatedData = $request->validate([
            'status' => 'required|string|in:paid,unpaid',
        ]);

        // Ambil data invoice berdasarkan status
        $invoices = Invoice::where('status', $validatedData['status'])
            ->with('details') // Include relasi details
            ->get();

        return response()->json($invoices, 200);
    }
}
