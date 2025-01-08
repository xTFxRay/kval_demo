<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulators</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
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
            background-size:auto;
            background-position: center;
            height: 100vh; 
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            
            
            align-items: center;
            
            
           
        }
        .links li a:hover{
            color: gold;
        }
        li, button, a, .fa-instagram, .fa-facebook, .fa-twitter, .fa-user{
            color:white;
        }

        .overlay {
            position: absolute;
            width: 80%;
            height: 80%;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 0;
            border-radius: 10px;
            z-index: -1;
            top: 150px;
            
            
        }

        .text-area {
            position: relative;
            z-index: 3; 
            max-width: 700px;
            cursor: pointer;
            border-bottom: 2px solid #fff;
        }
        .text-overlay {
            z-index: 1;
            display:grid;
            padding: 120px 20px; 
            margin: 20px;
            color: white;
            max-width: 80%;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 50px 30px;

        }

        .text-area h1, .text-area p {
            margin: 20px 0;
            font-size: 24px; 
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }
        .question, .answer {
            text-align: left; 
            margin-top: 10px; 
        }

        .question h3, .answer p {
            color: white; 
            margin: 5px 0; 

        }

        .fa-chevron-down {
            margin-left: 10px; 
            vertical-align: middle; 
        }
        .question{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .question h3{

        }
        .answer p{
            padding-top: 16px;
            line-height: 1.5;
            font-size: 24px;
        }
        .answer{
            max-height: 0;
            overflow: hidden;
            transition: max-height 1.4s ease;
        }

        .text-area.active .answer{
            max-height:300px;
        }


        .left {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left img {
            border-radius: 15px; 
            max-width: 100%;      
            height: auto;
            object-fit: cover;
        }
        .right p {
            margin-bottom: 20px; 
        }

        .sub-menu{
            z-index:1000;
            opacity: 100 !important;
        }

        .product_view{
            background-color: white; 
            width:80vh;
            display: grid;
            grid-template-columns: 1fr; 
            grid-template-rows: auto auto; 
            justify-items: center; 
            align-items: start; 
            gap: 20px; 
            height: auto; 
            padding: 20px;
            border-radius: 20px;
        }

        .product_container{
            display: flex;
            justify-content: center;
            align-items: center; 
            width: 100%;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.8); 
            backdrop-filter: blur(10px);
        }


        .product_image {
            display: flex;
            justify-content: center; 
            align-items: center; 
            max-width: 300px; 
            max-height: 300px; 
            overflow: hidden; 
            border-radius: 8px;
            background-color: #f9f9f9; 
        }

        .product_image img {
            max-height: 100%; 
            max-width: 100%; 
            object-fit: contain; 
            border-radius: inherit;
            max-height: inherit;
        }
      
        

        .back {
            margin-bottom: 10px;
            margin-top: 0% !important;
        }

        .product_details{
            text-align: center; 
            display: flex; 
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }
        .product_details h2, 
        .product_details p {
            margin: 5px 0;
        }

        .product_details .price {
            font-size: 20px;
            font-weight: bold;
        }

        .button_row {
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .cart_button,
        .back_button {
            width: 150px;
            padding: 10px;
            font-size: 16px;
            text-align: center;
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
    <div class="product_container">
        <div class="product_view">
            <div class="product_image">
                <img src="{{ asset($product->image ?? 'images/placeholder.jpg') }}" alt="{{ $product->name }}">
            </div>
            <div class="product_details">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description ?? 'Apraksts nav pieejams.' }} (Pieejams: {{$product->quantity}})</p>
                <p class="price">{{ number_format($product->price, 2) }}€</p>
                <div class="button_row">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="cart_button">Pievienot grozam</button>
                    </form>
                    <div class="back">
                    <a class="back" style="padding-right:30px;" href="{{ route('store') }}">
                        <button class="back_button">Atpakaļ uz veikalu</button>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
    


<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

    

