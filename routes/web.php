<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ProductController;




Route::get('/login', [AuthorizationController::class, 'login'] ) -> name('login');

Route::post('/addSpecification', [CalculatorController::class, 'addSpecification'])->name('addSpecification');

Route::post('/updatePrices', [CalculatorController::class, 'updatePrices'])->name('updatePrices');

Route::get('/editPrices', function () {
    $material_prices = DB::table('products')
    ->select('name', 'price')
    ->get()
    ->pluck('price', 'name') 
    ->toArray();
    return view('editPrices', compact( 'material_prices'));
})->name('editPrices');


Route::get('/specification', function () {
    return view('specification'); 
})->name('specification');

Route::get('/', function () {
    $user = Auth::user(); 
    return view('home', compact('user')); 
})->name('home');

Route::get('/adminDash', function () {
    $user = Auth::user(); 
    return view('adminDash', compact('user')); 
})->name('adminDash');


Route::get('/edit', function () {
    $user = Auth::user(); 
    return view('edit_settings', compact('user')); 
})->name('edit');

Route::get('/modularhouses', function () {
    $user = Auth::user(); 
    return view('modularhouses', compact('user')); 
})->name('modularhouses');




    Route::get('/users', [AdminController::class, 'admin_users'])->name('users');
    Route::get('/products', [AdminController::class, 'admin_products'])->name('products');
    Route::get('/orders', [AdminController::class, 'admin_order'])->name('orders');
    
    Route::get('/user_create', [AdminController::class, 'user_create'])->name('user_create');
    Route::get('/user_store', [AdminController::class, 'user_store'])->name('user_store');
    
    
    Route::get('/user_edit/{id}', [AdminController::class, 'user_edit'])->name('user_edit');
    Route::get('/user_save', [AdminController::class, 'user_save'])->name('user_save');
    Route::delete('/user_delete', [AdminController::class, 'user_delete'])->name('user_delete');


    Route::get('/product_edit/{id}', [AdminController::class, 'product_edit'])->name('product_edit');
    Route::post('/product_save/{id}', [AdminController::class, 'product_save'])->name('product_save');
    Route::get('/product_create', [AdminController::class, 'product_create'])->name('product_create');
    Route::post('/product_add', [AdminController::class, 'product_add'])->name('product_add');
    Route::delete('/product_delete/{id}', [AdminController::class, 'product_delete'])->name('product_delete');
    
    Route::get('/orders/{id}/edit', [AdminController::class, 'order_edit'])->name('order_edit');


    Route::post('/orders/{id}/save', [AdminController::class, 'order_save'])->name('order_save');


    Route::delete('/orders/{id}/delete', [AdminController::class, 'order_delete'])->name('order_delete');



Route::get('/store', [ProductController::class, 'store'])->name('store');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/cart', [ProductController::class, 'viewCart'])->name('cart');
Route::post('/cart/{id}/add', [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/{id}/remove', [ProductController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');  

Route::get('/faq', function () {
    $user = Auth::user(); 
    return view('faq', compact('user')); 
})->name('faq');

Route::post('/checkout/order', [ProductController::class, 'storeOrder'])->name('order');

Route::get('/verify', [EmailController::class, 'verify'])->name('verify');

Route::post('/verify_code', [EmailController::class, 'verify_code'])->name('verify_code');

Route::put('/edit/update', [AuthorizationController::class, 'update'])->name('update')->middleware('auth');

Route::get('/structure', [CalculatorController::class, 'structure'])->name('structure');

Route::get('/layout', [CalculatorController::class, 'layout'])->name('layout');

Route::get('scrapper', [ScrapperController::class, 'scrapper'])->name('scrapper');

Route::get('/heating', [CalculatorController::class, 'heating'])->name('heating');
Route::get('/finish', [CalculatorController::class, 'finish'])->name('finish');

Route::get('/com', [CalculatorController::class, 'com'])->name('com');

Route::get('/furniture', [CalculatorController::class, 'furniture'])->name('furniture');

Route::get('/ameneties', [CalculatorController::class, 'plumblight'])->name('plumblight');



Route::get('/results', [CalculatorController::class, 'results'])->name('results');



Route::get('/building', [CalculatorController::class, 'building'])->name('building');

Route::get('/add', [CalculatorController::class, 'add'])->name('add');

Route::get('/winDoor', [CalculatorController::class, 'winDoor'])->name('winDoor');


Route::get('/calculator', function () {
    $userID = Auth::check() ? Auth::id() : 0;
    $user = Auth::user(); 
    return view('calculatorstart', compact('userID', 'user'));
})->name('start');


Route::get('/word', [ExcelController::class, 'makeExcel'])->name('Excel');


Route::get('/register', [AuthorizationController::class, 'register'] ) -> name('register');
Route::post('/login', [AuthorizationController::class, 'loginPost'] ) -> name('login.post');
Route::post('/register', [AuthorizationController::class, 'registerPost'] ) -> name('register.post');
Route::get('/logout', [AuthorizationController::class, 'logout'])->name('logout');



