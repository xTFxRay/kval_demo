<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulators</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
            margin: 0;
            padding: 0;
 
        }
        body {
            background-image: url("../images/bricks.png");
            background-size:cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; 
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            
           
        }
        .links li a:hover{
            color: gold;
        }
        li, button, a, .fa-instagram, .fa-facebook, .fa-twitter, .fa-user{
            color:white;
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
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .order-summary, .checkout-form {
            width: 100%;
            margin-bottom: 20px;
        }

        .order-summary p {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
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
        }

        .checkout-form button:hover {
            background-color: #218838;
        }





    </style>
</head>
<body>
    <header>
        <a href="{{ route('home') }}" class="logo">ModuļuMājas</a>

        <nav>
            <div class = "nav">
            <ul class="links">

            <li><a href="{{ route('home') }}">Sākums</a></li>
            <li><a href="{{ route('modularhouses') }}">Moduļu mājas</a></li>
            <li><a href="{{ route('store') }}">Būvē pats</a></li>
            <li><a href="{{ route('faq') }}">FAQ</a></li>
            <li><a href="{{ route('start') }}">Kalkulators</a></li>

            </ul>
          
            </div>

            <div class="sub-menu">
                <div class="menu">
                    <div class="info">
                        <img src="{{ $user?->photo ? asset('storage/photos/' . $user->photo) : asset('default_icon.jpg') }}" alt="photo">
                            <h3>{{ $user?->name ?? 'Viesis' }}</h3>
                    </div>
                    <hr>
                    
                    @if (Auth::check())
                        <a href="{{ route('edit') }}" class="menu-link">
                            <i class="fa-solid fa-user-pen"></i>
                            <p>Rediģēt profilu</p>
                            <span>></span>
                        </a>
                        <a href="{{ route('logout') }}" class="menu-link">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <p>Izrakstīties</p>
                            <span>></span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="menu-link">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <p>Pieslēgties</p>
                            <span>></span>
                        </a>
                    @endif
                </div>
            </div>
          
        </nav>
        <div class = "media">
            <a href= "javascript:void(0);" onclick="toggleMenu()" id="subMenu">
                <i class="fa-regular fa-user"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-facebook"></i>
            </a>
        </div>
        
    </header>

    <div class="checkout_container">
        <h1>Pasūtījums</h1>
        

        <div class="order-summary">
            
            @if(session('cart') && count(session('cart')) > 0)
                @foreach(session('cart') as $product)
                    <p>
                        <strong>{{ $product['name'] }}</strong> 
                        x {{ $product['quantity'] }} 
                        - {{ number_format($product['price'] * $product['quantity'], 2) }}€
                    </p>
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
            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required>

            <label for="email">Ē-pasts</label>
            <input type="email" name="email" id="email" value="{{ old('name', Auth::user()->email) }}"required>

            <label for="address">Piegādes adrese</label>
            <textarea name="address" id="address" rows="3" required></textarea>

            <label for="payment">Apmaksas metode</label>
            <select name="payment" id="payment" required onchange="toggleCardNumberField()">
                <option value="credit_card">Kredītkarte</option>
                <option value="on_delivery">Apmaksa saņemšanas brīdī</option>
                
            </select>

            <div id="credit_card_field" style="display: none;">
                <label for="card_number">Kredītkarte numurs</label>
                <input type="text" name="card_number" id="card_number" placeholder="Ievadiet kredītkartes numuru" pattern="\d{16}" maxlength="16">
            </div>

            <input type="hidden" name="total_amount" value="{{ number_format($totalPrice, 2) }}">

            <button type="submit">Pasūtīt</button>
        </form>
    </div>
<script src="{{ asset('js/app.js') }}"></script>  
</body>

</html>
