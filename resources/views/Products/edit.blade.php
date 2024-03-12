@extends('header')


<div class="container" style="margin-top: 50px;">
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-lg-3">
            <p>Cover:</p>
            <form action="/deletecover/{{ $product->id }}" method="post">
                <button class="btn text-danger">X</button>
                @csrf
                @method('delete')
            </form>
            <!-- Display cover image -->
            <img src="{{ asset('cover/' . $product->cover) }}" class="img-responsive" style="max-height: 100px; max-width: 100px;" alt="Cover Image">
            <br>

            @if (count($product->images) > 0)
            <p>Images:</p>
            @foreach ($product->images as $img)
                <form action="{{ route('product.deleteimage', ['id' => $img->id]) }}" method="POST">
                     @csrf
                    @method('DELETE')
                    <button class="btn text-danger">X</button>
                    </form>
                <!-- Display each image -->
            <img src="{{ asset('images/' . $img->image) }}" class="img-responsive" style="max-height: 100px; max-width: 100px;" alt="Product Image">
                @endforeach
            @endif
                </div>

        <div class="col-lg-6">
            <h3 class="text-center text-danger"><b>Edit Product</b></h3>
            <div class="form-group">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="product_name" placeholder="Product Name" value="{{ old('product_name', $product->product_name) }}">
                    <input type="text" name="description" placeholder="Product Description" value="{{ old('description', $product->description) }}">
                    <input type="text" name="supplier_price"  placeholder="Supplier Price" value="{{ old('supplier_price', $product->supplier_price) }}">
                    <input type="text" name="seller_retail_price" placeholder="Seller Retail Price" value="{{ old('seller_retail_price', $product->seller_retail_price) }}">
                    <input type="text" name="stock"  value="{{ old('stock', $product->stock) }}" placeholder="Stock">
                    <input type="text" name="category" value="{{ old('category', $product->category) }}" placeholder="Category">

                    <label class="m-2">Cover Image</label>
                    <input type="file" class="form-control m-2" name="cover">
                    <label class="m-2">Images</label>
                    <input type="file" class="form-control m-2" name="images[]" multiple>
                    <button type="submit" class="btn btn-danger mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@extends('footer')
