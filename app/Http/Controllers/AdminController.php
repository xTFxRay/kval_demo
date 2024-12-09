<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;



class AdminController extends Controller
{
public function admin_users()
{
    $user = Auth::user(); 
    $users = User::all();
    return view('admin_users', compact('user', 'users'));
}

public function admin_products()
{
    $user = Auth::user(); 
    $products = Product::all();
    return view('admin_product', compact('user', 'products'));
}

public function admin_order()
{
    $user = Auth::user(); 
    $orders = Order::all();
    return view('admin_order', compact('user', 'orders'));
}

public function user_create()
{
    return view('user_create');
}

public function user_store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role' => 'required|string',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);

    return redirect()->route('users');
}

public function user_edit($id) 
{   
    $user = User::findOrFail($id);
    return view('user_edit', compact('user'));
}

public function user_save(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|string',
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('users');
}

public function user_delete($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users');
}


public function product_create()
{
    return view('product_create');
}

public function product_add(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'price' => 'required|numeric|min:0',
        'category' => 'nullable|string|max:100',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->category = $request->category;
    
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $product->image = $path;
    }

    $product->save();

    return redirect()->route('products')->with('success', 'Produkts pievienots!');
}

public function product_edit($id)
{
    $product = Product::findOrFail($id);
    return view('product_edit', compact('product'));
}

public function product_save(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'price' => 'required|numeric|min:0',
        'category' => 'nullable|string|max:100',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
    ]);

    $product = Product::findOrFail($id);
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->category = $request->category;
    
    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }
        $path = $request->file('image')->store('products', 'public');
        $product->image = $path;
    }

    $product->save();

    return redirect()->route('products')->with('success', 'Produkts atjaunināts!');
}

public function product_delete($id)
{
    $product = Product::findOrFail($id);

    if ($product->image) {
        Storage::delete('public/' . $product->image);
    }

    $product->delete();

    return redirect()->route('products')->with('success', 'Produkts dzēsts!');
}


public function order_delete($id)
{
    $order = Order::findOrFail($id);

    $order->delete();

    return redirect()->route('orders');
}

public function order_edit($id)
{
    $order = Order::findOrFail($id);

    return view('order_edit', compact('order'));
}
public function order_save(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:255',
        'payment_method' => 'required|string|max:255',
        'card_number' => 'required|string|max:255',
        'total_amount' => 'required|numeric',
    ]);

    $order = Order::findOrFail($id);

    $order->update($validated);

    return redirect()->route('orders');
}
}

