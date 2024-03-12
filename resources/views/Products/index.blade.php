@extends('header')
@extends('footer')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="container" style="margin-top: 50px;">
        <h3 class="text-center text-danger"><b>Add</b></h3>
        <a href="/create-product" class="btn btn-outline-success">Add New Product</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PRODUCT NAME</th>
                    <th>DESCRIPTION</th>
                    <th>SUPPLIER PRICE</th>
                    <th>SELLER RETAIL PRICE</th>
                    <th>STOCK</th>
                    <th>CATEGORY</th>
                    <th>Cover</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->supplier_price }}</td>
                        <td>{{ $item->seller_retail_price }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->category }}</td>
                        <td><img src="cover/{{ $item->cover }}" class="img-responsive" style="max-height:100px; max-width:100px" alt="" srcset=""></td>
                        <td><a href="/edit/{{ $item->id }}" class="btn btn-outline-primary">Update</a></td>
                        <td>
                            <form action="{{ route('delete.destroy', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?');" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
