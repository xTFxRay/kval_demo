<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Models\Cart;
use App\Models\CartItem;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category !== 'Visi') {
            $query->where('category', $request->category);
        }
    
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
    
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $query->where('quantity', '>', 0);
    
        if ($request->has('sort')) {
            if ($request->sort === 'price-asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price-desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort === 'newest') {
                $query->orderBy('created_at', 'desc');
            }
        }
    
        $products = $query->distinct()->get();
        $user = Auth::user();
        

        return view('store', compact('user', 'products'));
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        $user = Auth::user(); 
   
        return view('product_view', compact('product','user'));
    }

    public function addToCart($id)
{
    $user = Auth::user();
    $product = Product::findOrFail($id);

    $cart = Cart::firstOrCreate(
        ['user_id' => $user->id], 
        ['total_price' => 0]     
    );

    $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $id)->first();

    if ($cartItem) {
        $cartItem->quantity += 1;
        $cartItem->save();
    } else {
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $id,
            'quantity' => 1,
            'price' => $product->price,
        ]);
    }

    $cart->total_price = CartItem::where('cart_id', $cart->id)->sum(\DB::raw('quantity * price'));
    $cart->save();

    return redirect()->route('store');
}



public function viewCart()
{
    $user = Auth::user(); 

    $cart = Cart::with('items.product')
        ->where('user_id', $user->id)
        ->first();

    if (!$cart) {
        $cart = Cart::create([
            'user_id' => $user->id,
            'total_price' => 0,
        ]);
        $totalPrice = 0;  
        return view('cart', compact('cart', 'totalPrice', 'user'));
    }

    if ($cart->items->isEmpty()) {
        $totalPrice = 0;  
        return view('cart', compact('cart', 'totalPrice', 'user'));
    }

    $totalPrice = $cart->total_price;

    return view('cart', compact('cart', 'totalPrice', 'user'));
}


  
    public function removeFromCart($id)
{
    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->first();

    if (!$cart) {
        return redirect()->route('cart')->with('error', 'Cart not found.');
    }
    $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $id)->first();
   
    if ($cartItem) {
        $cartItem->delete();

        $cart->total_price = CartItem::where('cart_id', $cart->id)->sum(\DB::raw('quantity * price'));
        $cart->save();

        return redirect()->route('cart');
    }

    return redirect()->route('cart');
}
    
public function checkout()
{
    $totalPrice = 0;
    $user = Auth::user();

    $cart = Cart::with('items.product')->where('user_id', $user->id)->where('status', 'active')->first();

    if (!$cart) {
        return view('checkout', ['message' => 'Your cart is empty or not found.']);
    }

    if ($cart->items->isEmpty()) {
        return view('checkout', ['message' => 'Your cart is empty or contains no items.']);
    }

    foreach ($cart->items as $item) {
        if ($item->product) {
            $totalPrice += $item->product->price * $item->quantity;
        }
    }

    $totalPrice += 5.00;

    return view('checkout', compact('totalPrice', 'user', 'cart'));
}



public function storeOrder(Request $request)
{
    $totalAmount = str_replace(',', '', $request->input('total_amount'));
    $request->merge(['total_amount' => $totalAmount]);
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'userID' => 'required|exists:users,id',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:500',
        'payment' => 'required|in:credit_card,on_delivery',
        'card_number' => 'nullable|digits:16',
        'total_amount' => 'required|numeric|min:0',
    ]);

    $cart = Cart::where('user_id', $validated['userID'])->where('status', 'active')->first();

    if (!$cart) {
        return redirect()->route('store')->with('error', 'Your cart is empty or no active cart found.');
    }

    $order = Order::create([
        'name' => $validated['name'],
        'user_id' => $validated['userID'],
        'email' => $validated['email'],
        'address' => $validated['address'],
        'payment_method' => $validated['payment'],
        'card_number' => $validated['payment'] == 'credit_card' ? $validated['card_number'] : null,
        'total_amount' => $validated['total_amount'],
        'cart_id' => $cart->id, 
    ]);

    $cartItems = CartItem::where('cart_id', $cart->id)->get();

    foreach ($cartItems as $item) {
        $product = Product::find($item->product_id);
        $product->quantity -= $item->quantity;
        $product->save();
    }


    $cart->status = 'completed';
    $cart->save();

    Cart::create([
        'user_id' => $validated['userID'],
        'status' => 'active',
        'total_price' => 0,
    ]);

    Mail::to($validated['email'])->send(new OrderConfirmation($order));

    return redirect()->route('store')->with('success', 'Pasūtījums izveidots veiksmīgi! Jūsu pasūtijuma Nr: ' . $order->id);
}

}
