@extends('header')
@extends('footer')

<body>

  {{-- IF LOGIN --}}
  @auth
    
    <div class="create-product" style="border: 3px solid black; padding: 20px; margin-bottom: 5px;">
      <h2 style="text-align: center;">New Product</h2>
      <form action="{{ route('product.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input name="name" type="text" placeholder="Product Name">
        <input name="price" type="integer" placeholder="Price">
        <input name="seller_price" type="integer" placeholder="Seller Price">
        <input name="stock" type="integer" placeholder="Stock">
        <textarea name="description" placeholder="Product Description" cols="30" rows="10"></textarea>
        
        <label for="image">Choose Image:</label>
        <input type="file" name="image" id="image">
        
        <button>Create</button>
      </form>
    </div>

    <p>Congrats you are logged in!</p>

    <form action="/logout" method="POST">
      @csrf
      <i class='bx bx-log-out-circle' ></i><button>Log out</button>
    </form>

      <div style="border: 3px solid black; padding: 20px; margin-bottom: 5px;">
        <h2 style="text-align: center;">All Products</h2>
          <div class="products">
            @foreach($products as $product)
            
                <div class="row">
                    <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" style="max-width: 100px;">
                    <h2>{{$product['name']}}</h2>
                        {{$product['price']}}
                        {{$product['description']}}
                </div>
            
            @endforeach
          </div>
      </div>

  {{-- IF NOT LOGIN --}}
  @else

    <section class="main-home">
        <div class="main-text">
            <h5 style="font-size: 20px">KCLYNE</h5>
            <h1 style="color: rgb(74, 83, 118)">LIQUI MOLY<br></h1>
            <h1>SHOPPING 2024</h1>
            <p>New Collections Featured</p>

            <a href="/" class="main-btn">Shop Now! <i class='bx bxs-chevron-right'></i></a>
        </div>
    </section>

<!-- Featured Producers -->

  <section class="hot-products">
    <div class="center-text">
        <h2>Most Viewed <span>Products</span></h2>
    </div>
  </section>

  @endauth
    
    

</body>
</html>