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
            align-items: center;
            
           
        }
        .links li a:hover{
            color: gold;
        }
        li, button, a, .fa-instagram, .fa-facebook, .fa-twitter, .fa-user{
            color:white;
        }
      

    .results_container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.7); 
        backdrop-filter: blur(10px);
        border-radius: 8px;
        max-width: 900px;
        width: 90vh;
        height: auto;
        margin: 20px auto;
        position: absolute;
        top: 30%;
    
    }


    .results_container h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

    p{
        margin-bottom: 10px;
    }
    h2{
        margin-bottom: 10px;
        color: white;
    }

    h3{
        
        color: white;
    }


    .edit{
        background-color: black;
    }

    .btn {
        display: inline-block;
        margin: 10px;
        padding: 10px 20px;
        color: white;
        background-color: green;
        text-decoration: none;
        border-radius: 4px;
        font-size: 16px;
        text-align: center;
        transition: background-color 0.3s ease;
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

    <div class="black"></div>
    <div class="results_container">
        <h2>Jūsu mājas cenas aprēķināšana ir pabeigta!</h2>
        
        <h3>Aprēķinātās izmaksas: <span>{{ $totalCost ?? 0 }}</span>€</h3>

        <a href="{{ route('Excel') }}" class="btn">Lejupielādēt Excel Dokumentu</a>
        <a href="{{ route('start') }}" class="btn">Atgriezties uz sākumu</a>

    </div>
<script src="{{ asset('js/app.js') }}"></script>    
</body>


   
</html>


    
  

