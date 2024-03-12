@extends('header')
@extends('footer')

<div class="container">
    <h1>Edit Stock Entry</h1>
    <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product_id">Product ID:</label>
            <input type="text" name="product_id" id="product_id" class="form-control" value="{{ $stock->product_id }}">
        </div>
        <div class="form-group">
            <label for="product_stock">Product Stock:</label>
            <input type="text" name="product_stock" id="product_stock" class="form-control" value="{{ $stock->product_stock }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>


