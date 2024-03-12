@extends('header')
@extends('footer')
<div class="container">
    <h1>Stock Entry Details</h1>
    <p><strong>ID:</strong> {{ $stock->stock_id }}</p>
    <p><strong>Product ID:</strong> {{ $stock->product_id }}</p>
    <p><strong>Product Stock:</strong> {{ $stock->product_stock }}</p>
    <a href="{{ route('stocks.index') }}" class="btn btn-primary">Back to All Stock Entries</a>
</div>

