<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // Display a list of all stock entries
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index')->with('stocks', $stocks);

    }

    // Show the form for creating a new stock entry
    public function create()
    {
        return view('stock.create');
    }

    // Store a newly created stock entry in storage
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_id' => 'required',
            'product_stock' => 'required|integer',
        ]);

        // Create and store the new stock entry
        Stock::create($validatedData);

        return redirect()->route('stocks.index')->with('success', 'Stock entry created successfully');
    }

    // Display the specified stock entry
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        return view('stocks.show')->with('stock', $stock);
    }

    // Show the form for editing the specified stock entry
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        return view('stocks.edit')->with('stock', $stock);
    }

    // Update the specified stock entry in storage
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_id' => 'required',
            'product_stock' => 'required|integer',
        ]);

        // Find the stock entry and update it
        $stock = Stock::findOrFail($id);
        $stock->update($validatedData);

        return redirect()->route('stocks.index')->with('success', 'Stock entry updated successfully');
    }

    // Remove the specified stock entry from storage
    public function destroy($id)
    {
        // Find the stock entry and delete it
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock entry deleted successfully');
    }
}
