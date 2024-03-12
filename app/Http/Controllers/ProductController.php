<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Products;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all posts from the database
        $product = Products::all();

        // Pass the $products variable to the view
        return view('products.index')->with('product', $product);

    }

    
    public function showProducts()
    {
        $products = Products::all();
        return view('home')->with('product', $products);
    }

    public function store(Request $request)
{
    $messages = [
        'product_name.unique' => 'The product name has already been taken.',
        'cover.unique' => 'The cover image has already been taken.',
        'images.*.unique' => 'An image with the same filename already exists.',
        'supplier_price.numeric' => 'The supplier price must be a number.',
        'seller_retail_price.numeric' => 'The seller retail price must be a number.',
        'stock.required' => 'The stock field is required.',
    ];

    // Validate the request data
    $validator = $request->validate([
        'product_name' => 'required|unique:product',
        'description' => 'required',
        'supplier_price' => 'required|numeric',
        'seller_retail_price' => 'required|numeric',
        'stock' => 'required|integer', // Add validation rule for 'stock'
        'category' => 'required',
        'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048|unique:product',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048|unique:images,image',
    ], $messages);


    if ($request->hasFile("cover")) {
        // Handle cover image upload
        $file = $request->file("cover");
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path("cover/"), $imageName);
    }
// Create a new product instance
$product = new PRODUCTS([
    "product_name" => $request->product_name,
    "description" => $request->description,
    "supplier_price" => $request->supplier_price,
    "seller_retail_price" => $request->seller_retail_price,
    "stock" => $request->stock, // Assign the 'stock' attribute
    "category" => $request->category,
    "cover" => $imageName ?? null, // Assign the cover image name if available
]);

// Save the post
$product->save();

if ($request->hasFile("images")) {
    // Handle multiple images upload
    $files = $request->file("images");
    foreach ($files as $file) {
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path("/images"), $imageName);
        Image::create([
            'product_id' => $product->id,
            'image' => $imageName,
        ]);
    }
}

            Stock::create([
                'product_id' => $product->id,
                'product_stock' => $request->input('stock'),
            ]);

    return redirect('/laabs')->with('success', 'Products created successfully');
}

public function edit($id)
{
    $product = Products::findOrFail($id);
    return view('products.edit')->with('product', $product);
}

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id)
     {
         try {
             // Define custom error messages
             $messages = [
                 'product_name.unique' => 'The product name has already been taken.',
                 'stock.required' => 'The stock field is required.',
                 'cover.unique' => 'The cover image has already been taken.',
                 'images.*.unique' => 'An image with the same filename already exists.',
             ];
     
             // Validate the request data
             $validator = Validator::make($request->all(), [
                 'product_name' => [
                     'required',
                     Rule::unique('product')->ignore($id),
                 ],
                 'description' => 'required',
                 'supplier_price' => 'required',
                 'seller_retail_price' => 'required',
                 'category' => 'required',
                 'cover' => [
                     'image',
                     'mimes:jpeg,png,jpg,gif',
                     'max:2048',
                     Rule::unique('product')->ignore($id),
                 ],
                 'images.*' => [
                     'image',
                     'mimes:jpeg,png,jpg,gif',
                     'max:2048',
                     Rule::unique('images', 'image')->ignore($id),
                 ],
             ], $messages);
     
             // If validation fails, redirect back with errors
             if ($validator->fails()) {
                 return redirect()->back()
                     ->withErrors($validator)
                     ->withInput();
             }
     
             $product = Products::findOrFail($id);
     
             // Handle cover image upload
             if ($request->hasFile("cover")) {
                 // Delete old cover image if it exists
                 if (File::exists(public_path("cover/" . $product->cover))) {
                     File::delete(public_path("cover/" . $product->cover));
                 }
             
                 // Upload new cover image
                 $file = $request->file("cover");
                 $imageName = time() . '_' . $file->getClientOriginalName();
                 $file->move(public_path("cover/"), $imageName);
                 $product->cover = $imageName;
             }
             
             // Update post data
             $productData = [
                 "product_name" => $request->input('product_name', $product->product_name),
                 "description" => $request->input('description', $product->description),
                 "supplier_price" => $request->input('supplier_price', $product->supplier_price),
                 "seller_retail_price" => $request->input('seller_retail_price', $product->seller_retail_price),
                 "stock" => $request->input('stock', $product->stock), // Update the 'stock' attribute
                 "category" => $request->input('category', $product->category),
             ];
             
             $product->update($productData);
     
             // Handle image uploads
             if ($request->hasFile("images")) {
                 foreach ($request->file("images") as $file) {
                     $imageName = time() . '_' . $file->getClientOriginalName();
                     $file->move(public_path("/images"), $imageName);
                     Image::create([
                         'product_id' => $product->id,
                         'image' => $imageName,
                     ]);
                 }
             }

              // Update corresponding stock entry
        $product->stocks()->update([
            'product_stock' => $request->input('stock'),
        ]);
     
             return redirect()->route('index')->with('success', 'Product updated successfully');
         } catch (\Exception $e) {
             // Log any errors
             \Log::error($e->getMessage());
             // Redirect back with an error message
             return redirect()->back()->with('error', 'Error updating Product. Please try again.');
         }
     }
     
    

    /**
     * Remove the specified resource from storage.
     */


public function destroy($id)
    {
         $product=Products::findOrFail($id);

         if (File::exists("cover/".$product->cover)) {
             File::delete("cover/".$product->cover);
         }
         $images=Image::where("product_id",$product->id)->get();
         foreach($images as $image){
         if (File::exists("images/".$image->image)) {
            File::delete("images/".$image->image);
        }
         }
         $product->delete();
         return redirect()->route('index')->with('success', 'Products deleted successfully');
        }

public function deleteimage($id)
    {
        $images = Image::findOrFail($id);
        if (File::exists("images/" . $images->image)) {
            File::delete("images/" . $images->image);
        }

        Image::find($id)->delete();
        return back()->with('success', 'Image deleted successfully');
    }

    public function deletecover($id)
    {
        $cover = Products::findOrFail($id)->cover;
        if (File::exists("cover/" . $cover)) {
            File::delete("cover/" . $cover);
        }
        return back()->with('success', 'Cover image deleted successfully');
    }
    

}