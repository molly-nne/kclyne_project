@extends('header')
@extends('footer')

<body>
    <div class="div-create-product">
        <div class="create-product">
            <form class="form-create-product" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h2 style="text-align: center;">Create Product</h2>
            <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="Product Name" required>
                    @error('product_name')
                        <div class="text-danger">
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <input type="text" name="description" value="{{ old('description') }}" placeholder="product description" required>
                    @error('description')
                        <div class="text-danger">
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <input type="text" name="supplier_price" value="{{ old('supplier_price') }}" placeholder="supplier price" required>
                    @error('supplier_price')
                        <div class="text-danger">
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <input type="text" name="seller_retail_price" value="{{ old('seller_retail_price') }}"placeholder="Seller Retail Price" required>
                    @error('seller_retail_price')
                        <div class="text-danger">
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <input type="number" name="stock" value="{{ old('stock') }}" placeholder="Stock" required>
                    @error('stock')
                        <div class="text-danger">
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <input type="text" name="category" value="{{ old('category') }}" placeholder="Category" required>
                    @error('category')
                        <div class="text-danger">
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <label class="m-2">Cover Image</label>
                    <input type="file" id="input-file-now-custom-3" value="{{ old('cover') }}" name="cover" required>
                    @error('cover')
                        <div class="text-danger">
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <label class="m-2">Images</label>
                    <input type="file" id="input-file-now-custom-3" value="{{ old('images') }}" name="images[]" multiple required>
                    @error('images')
                        <div class="text-danger">
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-danger mt-3">Submit</button>
            </form>
        </div>
    </div>
</body>