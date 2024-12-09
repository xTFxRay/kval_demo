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
            <h1>Pasūtījumi</h1>
        </div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vārds</th>
                        <th>Ēpasts</th>
                        <th>Adrese</th>
                        <th>Apmaksas veids</th>
                        <th>Kartes numurs</th>
                        <th>Kopējā summa</th>
                        <th>Darbības</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->card_number }}</td>
                            <td>{{ number_format($order->total_amount, 2) }} €</td>
                            <td>
                                <a href="{{ route('order_edit', $order->id) }}" class="action-link">Edit</a>
                                <form action="{{ route('order_delete', $order->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-link" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>
    


<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
