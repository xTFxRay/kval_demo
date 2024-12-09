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
      

        .verification_container {
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

  

.verification_container h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

.verification_container p {
    font-size: 16px;
    margin-bottom: 20px;
    color: #555;
}

.verification_container form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.verification_container input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.verification_container button {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
}

.verification_container button:hover {
    background-color: #45a049;
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

    <div class="verification_container">
        <h2>Ievadiet verifikācijas kodu</h2>
        <p>Mēs esam nosūtījuši verifikācijas kodu uz jūsu kontā norādīto adresi. Ievadiet to lai turipinātu.</p>
    
        <form action="{{ route('verify_code') }}" method="POST">
            @csrf
            <input type="text" name="code" id="code" placeholder="Ievadiet kodu" required maxlength="6" pattern="\d{6}">
            
            <button type="submit">Apstiprināt</button>
        </form>
    
        @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif
    </div>
    
    
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
