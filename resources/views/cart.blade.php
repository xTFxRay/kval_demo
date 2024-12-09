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
            vertical-align: super;
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
      

        .cart_container {
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

.cart_container h1 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.cart-items {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.cart-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #fff;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.cart-item img {
    border-radius: 8px;
    object-fit: cover;
    width: 100px;
    height: auto;
}

.cart-item-details {
    flex: 1;
    margin-left: 15px;
    text-align: left;
}

.cart-item-details h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #555;
}

.cart-item-details p {
    font-size: 16px;
    margin: 5px 0;
    color: #777;
}

.cart-item button {
    background-color: #ff5c5c;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 8px 12px;
   
}

.cart-item button:hover {
    background-color: #e04e4e;
}

.cart-summary {
    margin-top: 20px;
    text-align: center;
    width: 100%;
}

.cart-summary p {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

.cart-summary a button {

    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: 0 10px;
}


.cart-summary a {
    text-decoration: none;
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

    <div class="cart_container">
        <h1>Jūsu grozs</h1>
    
        @if(session('cart') && count(session('cart')) > 0)
            <div class="cart-items">
                @foreach(session('cart') as $id => $product)
                    <div class="cart-item">
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" width="100">
                        <div class="cart-item-details">
                            <h3>{{ $product['name'] }}</h3>
                            <p class="price">${{ number_format($product['price'], 2) }}</p>
                            <p>Daudzums: {{ $product['quantity'] }}</p>
                        </div>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit">Noņemt</button>
                        </form>
                    </div>
                @endforeach
            </div>
    
            <div class="cart-summary">
                <p>Total: ${{ number_format($totalPrice, 2) }}</p>
                <a href="{{ route('verify') }}"><button>Pasūtīt</button></a>
                <a href="{{ route('store') }}"><button>Atgriezties veikalā</button></a>
            </div>
        @else
            <p>Jūsu grozs ir tukšs</p>
            <a href="{{ route('store') }}"><button>Atgriezties veikalā</button></a>
        @endif
    </div>
<script src="{{ asset('js/app.js') }}"></script>   
</body>



</html>