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
            position: relative;
            display: flex;
            align-items: center;
            z-index: 2;
        }

        .overlay1 {
            background-color: rgba(0, 0, 0, 0.5); 
            border-radius: 10px;
            position: absolute; 
            top: 150px; 
            left: 50px; 
            width: 95%; 
            height: 83%; 
            z-index: 1; 
        }
       



        table {
            width: 90%; 
            margin: 0 auto;
            border-collapse: collapse; 
            background-color: white; 
            color: black; 
            border: 1px solid black; 
        }

        th, td {
            border: 1px solid black; 
            padding: 10px; 
            text-align: left; 
        }

    
        .page_title {
            text-align: center; 
            margin-bottom: 20px; 
            margin-top: 20px; 
        }

        .page_title h1 {
            color: white; 
            font-size: 2em; 
        }


        .action-link {
            display: inline-block;
            padding: 8px 15px;
            background-color: green;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 4px;
            border: none;
            cursor: pointer;
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

<div class="overlay1">
    <div class="page_title">
        <h1>Lietotāji</h1>
        <a href="{{ route('user_create') }}" class="action-link">Pievienot lietotāju</a>
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Ēpasts</th>
                    <th>Telefons</th>
                    <th>Loma</th>
                    <th>Rediģēt</th>
                    <th>Dzēst</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('user_edit', $user->id) }}" class="action-link">Rediģēt</a>
                        </td>
                        <td>
                            <form action="{{ route('user_delete', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Vai tiešām vēlaties dzēst šo lietotāju?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-link">Dzēst</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
