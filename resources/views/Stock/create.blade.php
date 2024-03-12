@extends('header')
@extends('footer')

<body>
    <div class="div-create-product">
        <div class="create-product">
        <form class="form-create-product" action="{{ route('stocks.store') }}" method="post" enctype="multipart/form-data">
        @csrf
            <h2 style="text-align: center;">Create Stock</h2>
            <input type="text" name="product_id" value="{{ old('product_id') }}" placeholder="Product ID" required>
                    @error('product_id')
                        <div class="text-danger">   
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                <input type="text" name="product_stock" value="{{ old('product_stock') }}" placeholder="Product Stock" required>
                    @error('product_stock')
                        <div class="text-danger">
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-danger mt-3">Submit</button>
    </form>
</div>

