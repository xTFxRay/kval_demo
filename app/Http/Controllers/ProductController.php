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
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai reģistrētiem lietotājiem.');
        }

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

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai reģistrētiem lietotājiem.');
        }

        $product = Product::findOrFail($id);
        $user = Auth::user(); 
   
        return view('product_view', compact('product','user'));
    }

    public function addToCart($id)
{
    //Iegūst pašreizējā lietotāja ID un pievienojamās preces ID
    $user = Auth::user();
    $product = Product::findOrFail($id);

    //Iegūst (vai ja groza nav izveido) grozu
    $cart = Cart::firstOrCreate(
        ['user_id' => $user->id, 'status' => 'active'], 
        ['total_price' => 0]
    );

    //Pārbauda vai šī prece jau ir grozā.
    $cartItem = CartItem::where('cart_id', $cart->id)
        ->where('product_id', $id)
        ->first();

    //Ja ir palielina tās daudzumu  
    //Ja nē pievieno to grozam  
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

    //Palielina kopējo groza cenu par nepieciešamo daudzumu
    $cart->total_price = CartItem::where('cart_id', $cart->id)
        ->sum(\DB::raw('quantity * price'));
    $cart->save();

    return redirect()->route('store')->with('success', 'Prece pievienota grozam!');
}



public function viewCart()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai reģistrētiem lietotājiem.');
    }

    $user = Auth::user(); 

    $cart = Cart::with('items.product')
    ->where('user_id', $user->id)
    ->where('status', 'active') 
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
    $cart = Cart::where('user_id', $user->id)
    ->where('status', 'active')->first(); 
 
    if (!$cart) {
        return redirect()->route('cart')->with('error', 'Grozs nav atrasts!');
    }
    $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $id)->first();
   
    if ($cartItem) {
        $cartItem->delete();

        $cart->total_price = CartItem::where('cart_id', $cart->id)->sum(\DB::raw('quantity * price'));
        $cart->save();

    }

    return redirect()->route('cart')->with('success', 'Prece dzēsta!');
}
    
public function checkout()
{   
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai reģistrētiem lietotājiem.');
    }


    $totalPrice = 0;
    $user = Auth::user();
    
    $cart = Cart::with('items.product')->where('user_id', $user->id)->where('status', 'active')->first();
    if (!$cart) {
        return view('checkout', ['message' => 'Notikusi kļūda']);
    }

    if ($cart->items->isEmpty()) {
        return view('checkout', ['message' => 'Jūsu grozs ir tukšs']);
    }

    foreach ($cart->items as $item) {
        if ($item->product) {
            $totalPrice += $item->product->price * $item->quantity;
        }
    }

    $totalPrice += 5.00; //Fiksēta cena par piegādi
    return view('checkout', compact('totalPrice', 'user', 'cart'));
}





public function storeOrder(Request $request)
{

    //Pārbauda vai adrese atbilst formātam (piem. Rīga, Raiņa Bulvāris 19)
    if (!preg_match('/^[A-Za-zĀ-žā-ž]+(?:,\s[A-Za-zĀ-žā-ž\s0-9]+)+$/', $request->address)) {
        return redirect()->back()->withErrors(['error' => 'Adrese nav derīga.']);
    }
    
    //Noņem komatus kuri izmantoti lai atdalītu tūkstošus veikala skatā (piem. 1,115.49)
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

    //Iegūst lietotāja pēdējo aktīvo grozu
    $cart = Cart::where('user_id', $validated['userID'])->where('status', 'active')->first();


    if (!$cart) {
        return redirect()->route('store')->with('error', 'Grozs ir tukšs vai nav atrasts!');
    }

    //Izveido jaunu ierakstu Order tabulā izmantojot iegūtos datus
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

    
    //Iegūst grozā esošo preču ID lai samazinātu to atlikušo daudzumu datubāzē
    $cartItems = CartItem::where('cart_id', $cart->id)->get();

    foreach ($cartItems as $item) {
        $product = Product::find($item->product_id);
        $product->quantity -= $item->quantity;
        $product->save();
    }

    //Deaktivizē lietotāja grozu (jo ir veikts pasūtījums) un izveido jaunu
    $cart->status = 'completed';
    $cart->save();

    Cart::create([
        'user_id' => $validated['userID'],
        'status' => 'active',
        'total_price' => 0,
    ]);


    //Inicializē e-pasta nosūtīšanu uz lietotāja e-pastu izmantojot iepriekš izveidotu paraugu
    Mail::to($validated['email'])->send(new OrderConfirmation($order));

    
    return redirect()->route('store')->with('success', 'Pasūtījums izveidots veiksmīgi! Jūsu pasūtījuma Nr: ' . $order->id);
}

}
