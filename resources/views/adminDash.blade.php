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
        .content {
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            text-align: center; 
        }

        .admin_overlay {
            background-color: rgba(0, 0, 0, 0.5); 
            border-radius: 10px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); 
            position: relative;
            
        }

        .background_photo {
            position: relative;
            background-image: url('/images/background_photo.jpg');
            background-size: cover; 
            background-position: center; 
            height: 55vh;
            width: 60%;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            text-align: center; 
            margin-right: auto;
            margin-left: auto;
            margin-top: 100px;
        }

    </style>
</head>
<body>
    <header>
        <a href="{{ route('adminDash') }}" class="logo">ModuļuMājas</a>

        <nav>
            <div class = "nav">
            <ul class="links">

                <li><a href="{{ route('adminDash') }}">Sākums</a></li>
                <li><a href="{{ route('users') }}">Lietotāji</a></li>
                <li><a href="{{ route('products') }}">Produkcija</a></li>
                <li><a href="{{ route('orders') }}">Pasūtījumi</a></li>
    

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
    <div class="admin_overlay"></div>
        <div class="background_photo">
            <div class="content">
                <h1>Sveiki! {{ Auth::user()->name }}</h1>
            </div>
        </div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
