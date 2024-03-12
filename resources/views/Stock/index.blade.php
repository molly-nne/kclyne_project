@extends('header')
@extends('footer')

<div class="container">
    <h1>All Stock Entries</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product ID</th>
                <th>Product Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td>{{ $stock->stock_id }}</td>
                <td>{{ $stock->product_id }}</td>
                <td>{{ $stock->product_stock }}</td>
                <td>
                    <a href="{{ route('stocks.show', $stock->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>