@extends('layouts.app')

@section('title', 'Kalkulators')

    <style>
        *{
            vertical-align: unset !important;
        }
        .checkout_container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 8px;
            max-width: 900px;
            width: 70vh;
            height: auto;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .checkout_container h1 {
            font-size: 28px;
            color: #333;
            text-align: center;
        }
        .order-summary p {
            font-size: 18px;
            margin: 10px 0;
        }
        .checkout-form label {
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333; 
        }
        .checkout-form input, .checkout-form select, .checkout-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .checkout-form button {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }
        .checkout-form button:hover {
            background-color: #218838;
        }
        h2{
            margin-bottom: 10px;
        }

    </style>


@section('content')
<div class="checkout_container">
    @if (session('error'))
        <div class="alert alert-danger" style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div style="color: red;">
                @foreach ($errors->all() as $error)
                    <ul>{{ $error }}</ul>
                @endforeach
        </div>
    @endif
    @if (session('success'))
        <div style="color: black;">
            {{ session('success') }}
        </div>
    @endif
    <h1>Pasūtījums</h1>
    <div class="order-summary">
        @if($cart && $cart->items->isNotEmpty())
            @foreach($cart->items as $item)
                <p><strong>{{ $item->product->name }}</strong> x {{ $item->quantity }} - {{ number_format($item->product->price * $item->quantity, 2) }}€</p>
            @endforeach
            <p><strong>Piegāde:</strong> 5.00€</p>
            <p><strong>Kopējā summa:</strong> {{ number_format($totalPrice, 2) }}€</p>
        @else
            <p>Jūsu grozs ir tukšs</p>
        @endif
    </div>

    <form action="{{ route('order') }}" method="POST" class="checkout-form">
        @csrf
        <h2>Apmaksas un piegādes informācija</h2>
        <label for="name">Vārds</label>
        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required readonly>

        <input type="hidden" name="userID" value="{{ Auth::user()->id }}">

        <label for="email">Ē-pasts</label>
        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required readonly>

        <label for="address">Piegādes adrese (piem: Rīga, Raiņa Bulvāris 19)</label>
        <textarea name="address" id="address" rows="3" required></textarea>

        <label for="payment">Apmaksas metode</label>
        <select name="payment" id="payment" required onchange="toggleCardNumberField()">
            <option value="on_delivery">Apmaksa saņemšanas brīdī</option>
            <option value="credit_card">Kredītkarte</option>
        </select>

        <div id="credit_card_field" style="display: none;">
            <label for="card_number">Kredītkarte numurs</label>
            <input type="text" name="card_number" id="card_number" placeholder="Ievadiet kredītkartes numuru" pattern="\d{16}" maxlength="16">
        </div>

        <input type="hidden" name="total_amount" value="{{ number_format($totalPrice, 2) }}">
        <button type="submit">Pasūtīt</button>
    </form>
</div>

@endsection
