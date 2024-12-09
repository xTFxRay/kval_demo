<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

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
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'image' => $product->image
        ];
    }

    session()->put('cart', $cart);

   
    return redirect()->route('store')->with('success', 'Product added to cart!');
}



    public function viewCart()
    {
        $user = Auth::user(); 
        $cart = session('cart');
        $totalPrice = 0;

        if ($cart) {
            foreach ($cart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }

        return view('cart', compact('totalPrice', 'user'));
    }

  
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }
    

    

    public function checkout()
    {
        $totalPrice = 0;
        $cart = session('cart');
        if ($cart) {
            foreach ($cart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }
        $totalPrice+=5;
        $user = Auth::user(); 
        return view('checkout',compact('totalPrice', 'user'));
    }


    public function storeOrder(Request $request)
    {
      
        $totalAmount = str_replace(',', '', $request->input('total_amount'));

     
        $request->merge(['total_amount' => $totalAmount]);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'payment' => 'required|in:credit_card,on_delivery',
            'card_number' => 'nullable|digits:16', 
            'total_amount' => 'required|numeric|min:0',
        ]);

    

        $order = Order::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'payment_method' => $validated['payment'],
            'card_number' => $validated['payment'] == 'credit_card' ? $validated['card_number'] : null,
            'total_amount' => $validated['total_amount'],
        ]);

        Mail::to($validated['email'])->send(new OrderConfirmation($order));

        return redirect()->route('store')->with('success', 'Pasūtījums veiksmīgi nosūtīts! Jūsu pasūtījuma ID: ' . $order->id);
    }
    
}
