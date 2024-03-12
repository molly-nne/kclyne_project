<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;

// Routes for users
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/login-page', function () {
    return view('Users/login-page');
});

Route::get('/register-page', function () {
    return view('Users/register-page');
});

// Routes for products
Route::get('/', [ProductController::class, 'showProducts'])->name('product.show');

Route::get('/home', [ProductController::class, 'showProducts'])->name('product.show');

Route::post('/product', [ProductController::class,'store'])->name('product.store');
Route::get('/laabs',[ProductController::class,'index'])->name('index');
Route::get('/create-product', function () {
    return view('Products/create');
});

//Route::post('/create-product', [ProductController::class, 'createProduct'])->name('product.create');

Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('delete.destroy');

Route::delete('/deleteimage/{id}', [ProductController::class, 'deleteimage'])->name('product.deleteimage');
Route::delete('/deletecover/{id}', [ProductController::class, 'deletecover'])->name('product.deletecover');

Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');



// Route for displaying all stock entries
Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');

// Route for displaying the form to create a new stock entry
Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');

// Route for storing a new stock entry
Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');

// Route for displaying a specific stock entry
Route::get('/stocks/{id}', [StockController::class, 'show'])->name('stocks.show');

// Route for displaying the form to edit a stock entry
Route::get('/stocks/{id}/edit', [StockController::class, 'edit'])->name('stocks.edit');

// Route for updating a stock entry
Route::put('/stocks/{id}', [StockController::class, 'update'])->name('stocks.update');

// Route for deleting a stock entry
Route::delete('/stocks/{id}', [StockController::class, 'destroy'])->name('stocks.destroy');
