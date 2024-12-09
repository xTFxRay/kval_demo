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
      

        .calculator_container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 8px;
        max-width: 900px;
        width: 90vh;
        height: auto;
        margin: 20px auto;
    
    }


    .calculator_container h1 {
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
    }

    .edit{
        background-color: black;
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

    <div class="calculator_container">
        <div class="progress">
            <div class="step">
                <div class="bullet active">
                    <span>1</span>
                </div>
                <div class="step-title">Sākums</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>2</span>
                </div>
                <div class="step-title">Dokumentācija</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>3</span>
                </div>
                <div class="step-title">Mājas konstrukcija</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>...</span>
                </div>
                <div class="step-title">...</div>
            </div>
            <div class="step">
                <div class="bullet">
                    <span>11</span>
                </div>
                <div class="step-title">Rezultāti</div>
            </div>
        </div>

        <h2>Moduļu mājas kalkulators</h2>
        <p>Šis ir moduļu mājas cenu kalkulators. Nospiežot sākt Jums tiks uzdoti jautājumi saistībā ar Jums vēlamo mājas komplektāciju un beigās tiks izveidots aptuvens cenu aprēķins Jums tīkamai moduļu mājai. Lai sākt izvēlaties mājas izmēra diapazonu (m2) un nospiediet sākt.</p>
        
        <form action="{{ route('layout') }}" method="get" class="area">
            @csrf
            <label for="squareMeters">Mājas platība (m2):</label>
            <select id="squareMeters" name="squareMeters">
                <option value="40-60">40 m² - 60 m²</option>
                <option value="70-85">70 m² - 85 m²</option>
                <option value="90-120">90 m² - 120 m²</option>
            </select>

           
        
            <input type="submit" value="Sākt">
        </form>

        @auth
            <a href="{{ route('editPrices') }}" class="edit">Rediģēt cenas</a>
        @endauth
        <a href="{{ route('home') }}" class="logout button">Atpakaļ</a>
    </div>
<script src="{{ asset('js/app.js') }}"></script>    
</body>

</html>


    
  

