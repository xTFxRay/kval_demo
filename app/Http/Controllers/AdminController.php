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
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin'])) {
            return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai moderatoriem.');
        }
        //Iegūst lietotāajus kuri ir aktīvi
        $user = Auth::user();
        $users = User::where('status', '!=', 'deleted')->get();
        return view('admin_users', compact('user', 'users'));
    }

public function admin_products()
{   
    if (!Auth::check() || !in_array(Auth::user()->role, ['admin'])) {
        return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai moderatoriem.');
    }
    $user = Auth::user(); 
    $products = Product::all();
    return view('admin_product', compact('user', 'products'));
}

public function admin_order()
{   
    if (!Auth::check() || !in_array(Auth::user()->role, ['admin'])) {
        return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai moderatoriem.');
    }
    $user = Auth::user(); 
    $orders = Order::all();
    return view('admin_order', compact('user', 'orders'));
}

public function user_create()
{   
    if (!Auth::check() || !in_array(Auth::user()->role, ['admin'])) {
        return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai moderatoriem.');
    }

    return view('user_create');
}

public function user_store(Request $request)
{

    if (User::where('email', $request->email)->where('status', '!=', 'deleted')->exists()) {
        return redirect()->back()->with("error", "Šis e-pasts jau pieder kādam lietotājam.");
    }
    
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255', 
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
        'role' => 'required',
        'phone' => 'nullable|string|max:15', 
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
    ]);

    //Saglabā attēlu sistēmā
    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('photos', 'public');

    }

    User::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'email' => $request->email,
        'password' => bcrypt($request->password), //Kriptē paroli
        'role' => $request->role,
        'phone' => $request->phone, 
        'photo' => basename($path), 
    ]);
    session()->flash('success', 'Lietotājs veiksmīgi pievienots.');
    return redirect()->route('users');
}


public function user_edit($id) 
{   
    if (!Auth::check() || !in_array(Auth::user()->role, ['admin'])) {
        return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai moderatoriem.');
    }     
    $user = User::findOrFail($id);
    return view('user_edit', compact('user'));
}

public function user_save(Request $request, $id)
{   
    
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required',
        'phone' => 'nullable|max:15',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'password' => 'nullable|min:8|confirmed',
    ]);

    $user = User::findOrFail($id);

    //Dzēš veco attēlu un saglabā jauno attēlu sistēmā
    if ($request->hasFile('photo')) {
        if ($user->photo) {
            Storage::delete($user->photo);
        }
        $path = $request->file('photo')->store('photos', 'public');
    }

    $user->update([
        'name' => $request->name,
        'surname' => $request->surname,
        'email' => $request->email,
        'phone' => $request->phone,
        'role' => $request->role,
        'photo' => basename($path), 
    ]);

    if ($request->password) {
        $user->password = bcrypt($request->password); //Kriptē paroli
        $user->save();
    }
    session()->flash('success', 'Lietotājs veiksmīgi atjaunots.');
    return redirect()->route('users');
}


public function user_delete($id)
{  
    $user = User::findOrFail($id);
    $user->status = 'deleted'; //Logiskā dzēšaana
    $user->email = null; //Dzēš e-pastu lai to varētu izmantot jauns lietotājs
    $user->save();
    session()->flash('success', 'Lietotājs veiksmīgi dzēsts.');
    return redirect()->route('users');
}


public function product_create()
{   
    if (!Auth::check() || !in_array(Auth::user()->role, ['admin'])) {
        return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai moderatoriem.');
    }
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
        'quantity' =>'required|numeric'
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->category = $request->category;
    $product->quantity = $request->quantity;
       
    //Saglabā attēlu sistēmā 
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');

        $product->image = $path;
    }

    $product->save();

    return redirect()->route('products')->with('success', 'Produkts pievienots!');
}

public function product_edit($id)
{   
    if (!Auth::check() || !in_array(Auth::user()->role, ['admin'])) {
        return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai moderatoriem.');
    }
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
    

    //Dzēš veco attēlu un saglabā jauno attēlu sistēmā 
    //Savādāk nekā ar lietotāju funkciju jo produktu attēli glabāajas citā mapē kurai nevar pa tiešo izmantot store funkciju
    if ($request->hasFile('image')) {
        if ($product->image) {
            $oldImagePath = public_path($product->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
    
        $file = $request->file('image');
    
        $destinationPath = public_path('images');

        $fileName = time() . '_' . $file->getClientOriginalName();
    
        $file->move($destinationPath, $fileName);
    
        $product->image = 'images/' . $fileName;
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

    return redirect()->route('products')->with('success', 'Prece veiksmīgi dzēsts!');
}


public function order_delete($id)
{
    $order = Order::findOrFail($id);

    $order->delete();
    session()->flash('success', 'Pasūtījums veiksmīgi dzēsts.');
    return redirect()->route('orders');
}

public function order_edit($id)
{   
    if (!Auth::check() || !in_array(Auth::user()->role, ['admin'])) {
        return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai moderatoriem.');
    }
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
        'card_number' => 'nullable|string|max:16',
        'total_amount' => 'required|numeric',
    ]);

    $order = Order::findOrFail($id);

    $order->update($validated);
    session()->flash('success', 'Pasūtījums saglabāts!');
    return redirect()->route('orders');
}
}

