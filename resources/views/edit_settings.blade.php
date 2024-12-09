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
            background-image: url(../images/bricks.png);
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            height: 100vh;
        }
        .links li a:hover{
            color: gold;
        }
        li, button, a, .fa-instagram, .fa-facebook, .fa-twitter, .fa-user{
            color:white;
        }

        .overlay1 {
            background-color: rgba(0, 0, 0, 0.5); 
            border-radius: 10px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); 
            
        }

        .text-area {
            position: relative;
            z-index: 3; 
            max-width: 700px;
            cursor: pointer;
            border-bottom: 2px solid #fff;
        }
        .text-overlay {
           
            position: absolute; 
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 500px; 
            background-color: rgba(0, 0, 0, 0.7); 
            border-radius: 15px; 
            padding: 40px; 
            

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


       

        .sub-menu{
            z-index:1000;
            opacity: 100 !important;
        }


        .text1 form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

   
    .text1 .edit {
        width: 100%;
        max-width: 400px; 
        margin-bottom: 20px; 
    }

    .text1 label {
        font-size: 16px;
        color: white;
        display: block;
        margin-bottom: 5px;
    }

    .text1 input[type="text"],
    .text1 input[type="email"],
    .text1 input[type="tel"],
    .text1 input[type="password"],
    .text1 input[type="file"] {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 8px;
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
                        <img src="{{ $user?->photo ? asset('storage/photos/' . $user->photo) : asset('.default-icon.jpg') }}" alt="photo">
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
  
    
    
        <div class="text-overlay">
            <div class="overlay1"></div>
            <div class="text1">
                <h2 style="text-align: center; color: white; margin-bottom: 20px;">Rediģēt lietotāja iestatījumus</h2>
                <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="edit">
                        <label for="name">Vārds</label>
                        <input type="text" id="name" name="name"  value="{{ old('name', Auth::user()->name) }}" required>
                    </div>

                    <div class="edit">
                        <label for="surname">Uzvārds</label>
                        <input type="text" id="surname" name="surname"  value="{{ old('surname', Auth::user()->surname) }}" required>
                    </div>

                    <div class="edit">
                        <label for="email">Ēpasts</label>
                        <input type="email" id="email" name="email"  value="{{ old('email', Auth::user()->email) }}" required>
                    </div>

                    <div class="edit">
                        <label for="phone">Telefons</label>
                        <input type="tel" id="phone" name="phone"  value="{{ old('phone', Auth::user()->phone) }}">
                    </div>
   
                    <div class="edit">
                        <label for="password">Parole</label>
                        <input type="password" id="password" name="password" >
                        <small>Atstājiet tukšu ja nevēlaties mainīt paroli</small>
                    </div>

                    <div class="edit">
                        <label for="photo">Lietotāja foto</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                    </div>
            
                    <button type="submit" class="btn btn-primary">Atjaunot</button>
                </form>
            </div>
            
            </div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
